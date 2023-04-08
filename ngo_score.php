<?php
    require_once 'C:/Codes/WebDev/Dodo Proj/phpml/src/Classification/Ensemble/RandomForest.php';
    use Phpml\Classification\Ensemble\RandomForest;
    include 'database_conn.php';
    
    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
        $conn = mysqli_connect("localhost", "root", "", "ngo guard");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT n.NGO_ID, n.DEALS_IN, SUM(t.AMOUNT) AS total_amount, COUNT(t.TXN_ID) AS txn_count
                FROM NGO_Details n
                LEFT JOIN TXN_Details t ON n.NGO_ID = t.NGO_ID
                GROUP BY n.NGO_ID, n.DEALS_IN";
        $result = mysqli_query($conn, $sql);

        $dataset = [];
        $labels = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dataset[] = [$row['DEALS_IN'], $row['total_amount'], $row['txn_count']];
            $labels[] = $row['NGO_ID'];
        }

        mysqli_close($conn);
        
        shuffle($dataset);
        $split = floor(count($dataset) * 0.8);
        $trainX = array_slice($dataset, 0, $split);
        $trainY = array_slice($labels, 0, $split);
        $testX = array_slice($dataset, $split);
        $testY = array_slice($labels, $split);        

        $classifier = new RandomForest(100);
        $classifier->train($trainX, $trainY);

        $predictions = $classifier->predict($testX);

        $accuracy = 0;
        for ($i = 0; $i < count($predictions); $i++) {
            if ($predictions[$i] == $testY[$i]) {
                $accuracy++;
            }
        }
        $accuracy /= count($predictions);

        echo "Accuracy: " . round($accuracy, 2) * 100 . "%\n";

        $new_data = [
            ['Healthcare', 10000, 50],
            ['Education', 5000, 20],
            ['Environment', 15000, 100]
        ];
        $new_predictions = $classifier->predict($new_data);

        echo '<meter min = "0" max = "100" value="'.$new_predictions.'" 
            low="33" high="66" optimum="80"></meter>
            <div class="center">
                <button>NGO Guard Has Rated This NGO: '.$new_predictions.'&#37;</button>
            </div>';
    }  
?>