<?php 
    require('db.php');

    extract($_POST);

    $query    = "INSERT into `urls` (url, domain, user_id)
                     VALUES ('$address', '$domain', $id)";
    $result   = mysqli_query($con, $query);

    if($result){
    }else{
        echo "<pre>";
        echo "An Error occured.<br>";
        echo "Error: ".$con->error."<br>";
        echo "SQL: ".$sql."<br>";
        echo "</pre>";
    }
    
    $con->close();
?>