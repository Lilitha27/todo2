<?php 
function sanitizeString ($var) {
    include 'config/connect.php';
    $var =strip_tags($var);
    $var=htmlspecialchars($var);
    $var=stripslashes($var);
    $db_server->real_escape_string($var);
    return $var;

    if (isset($_POST['add'])){
        $listTextClean = sanitizeString($_POST['add']);

        $sql = "INSERT INTO list_items(Listtext)VALUES ('$listTextClean')";

        if($db_server->query($sql)) {
            unset($sql);
        }else{
            echo "Error: ".$sql."<br>".$db_server->error;
        }
    }
}
?>