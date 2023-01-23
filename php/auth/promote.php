<?php

    include '../conn.php';
    
    $id = $_GET['id'];
    $role = $_GET['role'];
    $sql = "UPDATE users SET role = '$role' WHERE id = '$id'";
    $result = $mysqli->query($sql);

    if ($result) {
        header("Location: ../../dashboard/users.php?success=1");
    } else {
        header("Location: ../../dashboard/users.php?success=0");
    }

    $mysqli->close();
?>