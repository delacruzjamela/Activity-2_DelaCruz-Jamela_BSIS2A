<?php
require_once "config.php";

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: index.php');
    exit;
}

$scholarshipid = $_GET['scholarshipid'];

$deletescholarship = mysqli_query($conn, "DELETE FROM scholarships WHERE id ='$scholarshipid'");

if ($deletescholarship) {
    echo "
        <script>
            alert('Scholarship deleted successfully!');
            window.location.href = 'scholarships.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Something went wrong. Please try again!');
            window.location.href = 'scholarships.php';
        </script>
    ";
}

?>
