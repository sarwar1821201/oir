<?php
    include '../conn.php';

    $url = "../../register.html";

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "member";
    if( isset($_POST['role']) ){
        $role = $_POST['role'];
        $url = "../../dashboard/users.php";
    }
    $sql = "INSERT INTO users (firstName, lastName, email, password, role) VALUES ('$firstName', '$lastName', '$email', '$password', '$role')";

    $result = $mysqli->query($sql);

    
    if ($result) {
        header("Location: $url?success=1");
    } else {
        header("Location: $url?success=0");
    }
    $mysqli->close();
?>