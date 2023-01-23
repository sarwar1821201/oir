<?php
    include 'conn.php';
    
    $userTable = "CREATE TABLE `users` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `firstName` VARCHAR(128) NOT NULL , 
        `lastName` VARCHAR(128) NOT NULL , 
        `email` VARCHAR(128) NOT NULL , 
        `contact` VARCHAR(18) NULL , 
        `password` VARCHAR(128) NOT NULL , 
        `role` VARCHAR(64) NOT NULL , 
        `verified` BOOLEAN NOT NULL DEFAULT FALSE , 
        `update` BOOLEAN NOT NULL DEFAULT FALSE , 
        PRIMARY KEY (`id`),
        UNIQUE(`email`)
        )";

    if ($mysqli->query($userTable) === TRUE) {
        echo "Table user created successfully";
    } else {
        echo "Error creating table: " . $mysqli->error;
    }

    echo('<br>');

    // create messages table
    $messagesTable = "CREATE TABLE `messages` ( 
        `id` INT NOT NULL AUTO_INCREMENT , 
        `fullName` VARCHAR(256) NOT NULL , 
        `email` VARCHAR(128) NOT NULL , 
        `message` TEXT NOT NULL , 
        `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        PRIMARY KEY (`id`)
        )";

    if ($mysqli->query($messagesTable) === TRUE) {
        echo "Table messages created successfully";
    } else {
        echo "Error creating table: " . $mysqli->error;
    }

    echo('<br>');


    // create companies table
    $companiesTable = "CREATE TABLE `companies` ( 
        `id` INT NOT NULL AUTO_INCREMENT , 
        `title` VARCHAR(256) NOT NULL , 
        `location` TEXT NULL , 
        PRIMARY KEY (`id`)
        )";

    if ($mysqli->query($companiesTable) === TRUE) {
        echo "Table Companies created successfully";
    } else {
        echo "Error creating table: " . $mysqli->error;
    }


    $mysqli->close();
?>