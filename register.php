<?php
require_once "config.php";


$mess = [];
$errors = [];

if($_SERVER['REQUEST_METHOD']==="POST"){
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if($password === $password2){
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
        $stmt->bind_param('ss',$uname,$password);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result){
            $mess[] = "Registered successfully. Please wait for the admin approval of your account.";
        }else{
            $mess[] = "Registered successfully. Please wait for the admin approval of your account.";
        }
    }else{
        $errors[] = "Password should match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <h1>Scholarship Application Management System</h1>
    <h2>Create your Account</h2>

    <br>

    <?php foreach ($errors as $e): ?>
        <p style="color: red;"><?= h($e) ?></p>
    <?php endforeach;?>

    <br>

    <?php foreach ($mess as $m): ?>
        <p style="color: green;"><?= h($m) ?></p>
    <?php endforeach;?>

    <form action="" method="post">

        <label for="">Username: </label>
        <input type="text" name="uname" id="" placeholder="Enter username" required autofocus>

        <br><br>

        <label for="">Password: </label>
        <input type="password" name="password" id="" placeholder="Enter password" required>

        <br><br>

        <label for="">Re-enter Password: </label>
        <input type="password" name="password2" id="" placeholder="Re-enter password" required>

        <br><br>

        <input type="submit" value="Register">

    </form>

    <br><br>

    <p>Already have an account? <a href="index.php">Sign In</a></p>

</body>
</html>
