<?php
    require_once 'config/connect.php';

    $checkNumA=$_POST['val'];

    $result = $db_server->query("SELECT ListItemDone from list_items WHERE ListID='$checkNumA'");
    $row=$result->fetch_row();

    if($row[0]==0) {
        $sql="UPDATE list_items SET ListItemDone='1' WHERE ListID='$checkNumA'";
        if($db_server->query($sql)) {
            unset($sql);
            echo 1 ;
        }else {
            echo "Error: ".$sql."<br>".$db_server->error;
        }
    }else{
        $sql="UPDATE list_items SET ListItemDone='0' WHERE ListID='$checknumA'";
        if($db_server->query($sql)) {
            unset($sql);
            echo 0;
        }else{
            echo "Error: ".$sql."<br>".$db_server->error;
        }
    }


?>