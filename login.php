<?php
session_start();
include "db_conn.php";

$name = $_POST['name'];
$pass = $_POST['password'];

if (empty($name)) {
    header("Location: index.php?error=User Name is required");
    exit();
    
} else if (empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM users WHERE name='$name' AND password='$pass'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['name'] === $name && $row['password'] === $pass) {
        echo "Logged In!";
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();
    } else {
        header("Location: index.php?error=Error");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
