<?php
    include '../conn.php';

    // update user
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    
    $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', email = '$email', contact = '$contact', `update` = 0 WHERE id = '$id'";
    $result = $mysqli->query($sql);

    if ($result) {
        setcookie('user', $email, time() + (86400 * 30), "/");
        header("Location: ../../dashboard/account.php?success=1");
    } else {
        header("Location: ../../dashboard/account.php?success=0");
    }

    $mysqli->close();

?>