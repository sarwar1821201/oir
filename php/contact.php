<?php
    include 'conn.php';

    // store contact messages
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (fullName, email, message) VALUES ('$name', '$email', '$message')";
    echo($sql);
    $result = $mysqli->query($sql);

    if ($result) {
        header("Location: ../contact.html?success=1");
    } else {
        echo($mysqli->error);
        // header("Location: ../contact.html?success=0");
    }

?>