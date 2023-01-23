<?php
    include 'conn.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM companies WHERE id = '$id'";
    $result = $mysqli->query($sql);
    
    if ($result) {
        header("Location: ../dashboard/companies.php?success=1");
    } else {
        header("Location: ../dashboard/companies.php?success=0");
    }

    $mysqli->close();
?>