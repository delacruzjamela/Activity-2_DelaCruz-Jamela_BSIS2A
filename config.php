<?php

$conn = mysqli_connect("localhost", "root", "", "act2");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

function h($str){
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

session_start();
?>
