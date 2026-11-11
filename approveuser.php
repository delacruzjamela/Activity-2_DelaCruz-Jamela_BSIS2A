<?php
require_once "config.php";

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: index.php');
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}

$userid = $_GET['userid'] ?? '';

if ($userid === '') {
    header('Location: users.php');
    exit;
}

$approveuser = mysqli_query(
    $conn,
    "UPDATE users SET status = 'approved' WHERE id = '$userid'"
);

if ($approveuser) {
    echo "
        <script>
            alert('User is approved');
            window.location.href = 'users.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Something went wrong. Please try again later.');
            window.location.href = 'users.php';
        </script>
    ";
}
?>
