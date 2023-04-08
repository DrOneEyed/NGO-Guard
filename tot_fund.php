<?php
    include 'database_conn.php';
    if ($_SERVER['REQUEST_METHOD']=='POST')
	{
        $overseas= "SELECT sum(AMOUNT) FROM txn_details WHERE NGO_ID = '$id' and LOCATION = 'OVERSEAS'";
        $result = mysqli_query($conn, $overseas);
        $ost = mysqli_fetch_array($result);

        $indiaP= "SELECT sum(AMOUNT) FROM txn_details WHERE NGO_ID = '$id' and LOCATION = 'INDIA PUBLIC'";
        $result = mysqli_query($conn, $indiaP);
        $pt = mysqli_fetch_array($result);

        $indiaG= "SELECT sum(AMOUNT) FROM txn_details WHERE NGO_ID = '$id' and LOCATION = 'INDIA GOVT'";
        $result = mysqli_query($conn, $indiaG);
        $gt = mysqli_fetch_array($result);
                                            
        $tot = $ost['sum(AMOUNT)'] + $pt['sum(AMOUNT)'] + $gt['sum(AMOUNT)'];
                                            
        $data = "SELECT DATE_OF_TXN, LOCATION, AMOUNT FROM txn_details WHERE NGO_ID = '$id' ORDER BY DATE_OF_TXN";
        $result = mysqli_query($conn, $data);

        $inTot = $pt['sum(AMOUNT)'] + $gt['sum(AMOUNT)'];

        $inPer = ($inTot/$tot) * 100;
        $govPer = $gt['sum(AMOUNT)']/$inTot * 100;
        $points = 0;

        if($inPer > 70){$points+=3;}
        else if($inPer > 50){$points+=2;}
        else if($inPer > 30){$points+=1;}

        if($govPer > 70){$points+=2;}
        else if($govPer > 50){$points+=1;}
                                            
        $per = ($points/5) * 100;
        if($per < 10){$per = 10;}

        $dataP = "SELECT DATE_OF_TXN, AMOUNT FROM `txn_details` WHERE NGO_ID = '$id'";
        $result1 = mysqli_query($conn, $dataP);
        $dp = array();
        foreach($result1 as $row){
            $dp[] = $row;
        }
    }
?>