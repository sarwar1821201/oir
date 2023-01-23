<?php
    include '../conn.php';
    //verify user
    $id = $_GET['id'];
    $sql = "UPDATE users SET verified = 1 WHERE id = '$id'";
    $result = $mysqli->query($sql);

    if ($result) {
        header("Location: ../../dashboard/users.php?success=1");
    } else {
        header("Location: ../../dashboard/users.php?verified=0");
    }

    $mysqli->close();
?>