<?php
    include 'database_conn.php';
    include 'tot_fund.php';
    echo '<meter min = "0" max = "100" value="'.$per.'" 
    low="33" high="66" optimum="80"></meter>
    <div class="center">
        <button>NGO Guard Has Rated This NGO: '.$per.'&#37;</button>
    </div>';
?>