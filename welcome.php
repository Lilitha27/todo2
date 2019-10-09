<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

 
// Include config file
require_once "config/connect.php";

// Getting Data For Actions In ToDo
    if(isset($_GET['to'])){
        $key = $_GET['to'];
        if($_GET['action'] == 'done'){
           $_SESSION['todo'][$key]['done']=true; 
        }else if($_GET['action'] == 'cancel'){
          $_SESSION['todo'][$key]['done']=false;   
        }else{
            unset( $_SESSION['todo'][$key]);
        }
    }

?>
 <ul>
    <?php 

    $todo_res= $db_server->query("SELECT * FROM list_items ORDER BY listItemID DESC");

    // check success of building resouce
    if ($todo_res)die("Database access failed :".$db_server->error());
    // temp int incrementor
    $tempNum=0;
    // check if resource is not empty
    if($todo_res->num_rows>0) {
        // output data of each row 
        while ($row = $todo_res->fetch_assoc()) {
            // render to DOM 
            echo "<li>".$row["ListText"]."<li>" ;
            $ListIDCount =$row["ListItemID"];
            // create sequence of list items from 0 to infinity
            $sql_listID ="UPDATE list_items SET ListID='$tempNum' WHERE ListItemID='$ListCount'";
            // Execute query and validate ensure listid is sequential
            if($db_server->query($sql_listID)) 
            {
                // echo  "New record created succefully";
                $tempNum++;
                unset($sql_listID);
            }else {
                echo "Error: ".$sql_listID."<br>".$db_server->error;
            }
        }
    }else{
        echo "0 results";
    }
    ?>
</ul>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">
    <link href="css/todo.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <title>THINGS TO DO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <!-- Start Bootstrap Columns And Following Naming Convention To Align The Items In The Centre Of The Page -->
    <div class="text-center mt-5 container">
    <div class="container">
  <div class="row justify-content-center">
    <h1>GORDIE'S TODO LIST</h1>
  </div>
</div>
        <div class="row">
            <div class="col-sm-2"></div>
                <div class="col-sm-8">
                <!-- Creating A Form -->
                <form method="post" action="todo.php">
                        <div class="input-group mt-5 mb-3">
                            <input type="text" class="form-control" name="todo_input" placeholder="Item Todo " aria-label="Todo Item" aria-describedby="button-addon2">
                            <input type="date" class="form-control" name="todo_date" aria-label="Todo Date" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" name="submit" type="submit" id="button-addon2">
                                        Add Todo
                                    </button>
                                </div>
                        </div>
                    </form>
                    <!-- Ending A Form -->

                    <?php
                    // prepare and bind
                    // $stmt = $mysqli->prepare("INSERT INTO items (list_items) VALUES (?)");
                    // $stmt->bind_param("s", $list_items);

                    // set parameters and execute
                    // $list_items = $_SESSION['todo_input'];
                    // $stmt->execute();

                    // echo "New records created successfully";

                    // $stmt->close();
                    // $mysqli->close();
                    // ?>
                    <?php
                        // Session Super Global
                            if(!empty($_SESSION['todo'])){
                                // ForEach For Loop Starts
                                foreach($_SESSION['todo'] as $key => $value){
                                    // Displaying All The Items In A Div And In A Bootstrap Alert Box
                                    echo '<div class="alert alert-light border shadow-sm pb-4">';
                                    echo "<li>".$value['todo_item']."---".$value['todo_dates'].
                                    '<a class="btn btn-danger float-right" href="index.php?to='. $key.'&action=delete">Delete</a>'."</li><br>";
                                    echo '</div>';
                                    // End Of Displaying Items
                                }
                                // End ForEach For Loop
                            }
                        // End Session Super Global    
                        ?>
                        </div>
                <div class="col-sm-2"></div>
        </div>
    </div>
    <!-- End Bootstrap Columns And Following Naming Convention To Align The Items In The Centre Of The Page -->


<script src="js/todo.js"></script>
<script type="type/javascript">
    cleanUp();
</script>

<?php $db_server->close(); ?>

</body>
</html>