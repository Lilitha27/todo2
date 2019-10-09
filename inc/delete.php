<?php 
 require_once 'config/connect.php';

$checkNumA=$_POST['val'];

$sql="DELETE FROM list_items WHERE ListID='$checkNumA'";

if($db_server->query($sql)) {
    echo "Record deleted successfully";
    unset($sql);
}else{
    echo "Error :".$sql ."<br>".$db_server->error;
}

?>