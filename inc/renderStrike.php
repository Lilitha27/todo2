<?php 

require_once 'config/connect.php';

$result=$db_server->query("SELECT * FROM list_items ORDER BY ListItemID DESC");

$tempNum=0;
if ($result->num_row>0) {
    $strikeArr=array();

    while($row=$result->fetch_assoc()) {
        $strikeArr[$tempNum]=$row["ListItemDone"];
        $tempNum++;
    }
    echo json_encode($strikeArr);
    exit();
}else{
    echo "0 results";
}
?>