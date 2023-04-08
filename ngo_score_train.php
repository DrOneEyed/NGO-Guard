<?php
require_once 'C:/Codes/WebDev/Dodo Proj/phpml/src/Classification/Ensemble/RandomForest.php';
require_once 'C:/Codes/WebDev/Dodo Proj/phpml/src/ModelManager.php';
require_once 'C:/Codes/WebDev/Dodo Proj/phpml/src/Preprocessing/Imputer.php';

use Phpml\Classification\Ensemble\RandomForest;
use Phpml\ModelManager;
use Phpml\Preprocessing\Imputer;
use Phpml\Preprocessing\Imputer\Strategy\MeanStrategy;

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

$classifier = new RandomForest(100);
$classifier->train($dataset, $labels);

$imputer = new Imputer(null, new MeanStrategy(), Imputer::AXIS_COLUMN);
$model = [$imputer, $classifier];

$serializer = new ModelManager();
$serializer->saveToFile($model, 'model.phpml');

$model = $serializer->restoreFromFile('model.phpml');

$new_data = [
    [$dataset[0][0], $dataset[0][1], $dataset[0][2]]
];
$new_data = $imputer->transform($new_data);

$new_predictions = $model[1]->predict($new_data);

echo "NGO Score: " . $new_predictions[0] . "\n";
