<?php
    include '../conn.php';
    //request update
    $id = $_GET['id'];
    $sql = "UPDATE users SET `update` = 1 WHERE id = '$id'";
    $result = $mysqli->query($sql);

    if ($result) {
        header("Location: ../../dashboard/users.php?success=1");
    } else {
        header("Location: ../../dashboard/users.php?success=0");
    }

    $mysqli->close();
?>