<?php
    include './conn.php';

    $title = $_POST['title'];
    $location = "";
    if( isset($_POST['location']) ){
        $location = $_POST['location'];
    }
    $sql = "INSERT INTO companies (title, location) VALUES ('$title', '$location')";
    

    $result = $mysqli->query($sql);

    
    if ($result) {
        header("Location: ../dashboard/companies.php?success=1");
    } else {
        header("Location: ../dashboard/companies.php?success=0");
    }
    $mysqli->close();
?>