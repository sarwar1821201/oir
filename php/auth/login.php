<?php
    include '../conn.php';
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo $remember;
    
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND verified = 1";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $role = $user['role'];
        if(isset($_POST['remember'])){
            setcookie("email", $user['email'], time() + (86400 * 30), '/');
            setcookie("name", $user['lastName'], time() + (86400 * 30), '/');
            setcookie("role", $role, time() + (86400 * 30), '/');
        }else{
            session_start();
            $_SESSION['user'] = $user['email'];
            $_SESSION['name'] = $user['lastName'];
            $_SESSION['role'] = $role;
        }
        if($role == 'admin'){
            header("Location: ../../dashboard/index.php");
        }else{
            header("Location: ../../dashboard/account.php");
        }
        
    } else {
        header("Location: ../../login.php?success=0");
    }

    
    $mysqli->close();

?>