<?php
    include '../conn.php';
    //delete user
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = $mysqli->query($sql);

    if ($result) {
        header("Location: ../../dashboard/users.php?success=1");
    } else {
        header("Location: ../../dashboard/users.php?success=0");
    }

    $mysqli->close();
?>
