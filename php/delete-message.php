<?php
    include 'conn.php';
    // delete message
    $id = $_GET['id'];
    $sql = "DELETE FROM messages WHERE id = '$id'";
    $result = $mysqli->query($sql);
    
    if ($result) {
        header("Location: ../dashboard/messages.php?success=1");
    } else {
        header("Location: ../dashboard/messages.php?success=0");
    }

    $mysqli->close();
?>