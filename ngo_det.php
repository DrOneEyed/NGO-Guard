<?php
    include 'database_conn.php';
    echo '<h2 class="major">NGO Details</h2>
        <table>
            <tr>
                <th>Name</th>
                <td>'.$check['NGO_NAME'].'</td>
            </tr>
            <tr>
                <th>NGO ID</th>
                <td>'.$check['NGO_ID'].'</td>
            </tr>
            <tr>
                <th>Deals In</th>
                <td>'.$check['DEALS_IN'].'</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>'.$check['PHONE_NO'].'</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>'.$check['ADDRESS'].'</td>
            </tr>
        </table>
        <button onclick="location.href=\'#meter\'">Check NGO-Guard Rating</button>';
?>
