<?php
require_once "config.php";

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: index.php');
    exit;
}

$scholarshipid = $_GET['scholarshipid'];
$fetchscholarship = mysqli_query($conn, "SELECT * FROM scholarships WHERE id ='$scholarshipid'");

if(mysqli_num_rows($fetchscholarship) === 0){
    echo "
        <script>
            alert('No scholarship found with that ID!');
            window.location.href = 'scholarships.php';
        </script>
    ";
}

$scholarship = mysqli_fetch_assoc($fetchscholarship);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Scholarship</title>

    <style>
        form div{
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        form{
            display: flex;
            flex-direction: row;
            gap: 20px;
        }
    </style>
</head>

<body>

    <h3>Edit Scholarship ID<?php echo $scholarship['id']; ?></h3>

    <br>

    <form action="" method="post">

        <div>
            <div>
                <label for="">Scholarship Name:</label>
                <input type="text" name="scholarship_name" id="" required value='<?php echo $scholarship['scholarship_name']; ?>'>
            </div>

            <div>
                <label for="">Description:</label>
                <textarea name="description" id="" cols="50" rows="5" required><?php echo $scholarship['description']; ?></textarea>
            </div>

            <div>
                <label for="">Eligibility:</label>
                <textarea name="eligibility" id="" cols="50" rows="5" required><?php echo $scholarship['eligibility']; ?></textarea>
            </div>
        </div>

        <div>
            <div>
                <label for="">Benefits:</label>
                <textarea name="benefits" id="" cols="50" rows="5" required><?php echo $scholarship['benefits']; ?></textarea>
            </div>

            <div>
                <label for="">Application Deadline:</label>
                <input type="date" name="application_deadline" id="" required value='<?php echo $scholarship['application_deadline']; ?>'>
            </div>

            <br>

            <div>
                <input type="submit" value="Saved Scholarship" name="savebtn">
            </div>
        </div>

    </form>

</body>
</html>

<?php

    if(isset($_POST['savebtn'])){

        $name = $_POST['scholarship_name'];
        $desc = $_POST['description'];
        $eligibility = $_POST['eligibility'];
        $benefits = $_POST['benefits'];
        $deadline = $_POST['application_deadline'];

        $updatequery = "UPDATE scholarships SET scholarship_name='$name', description='$desc', eligibility='$eligibility', benefits='$benefits', application_deadline='$deadline' WHERE id='$scholarshipid'";

        $updatefunc = mysqli_query($conn, $updatequery);

        if($updatefunc){
            echo "
                <script>
                    alert('Scholarship saved successfully!');
                    window.location.href = 'scholarships.php';
                </script>
            ";
        }
        else{
            echo "
                <script>
                    alert('Something went wrong. Please try again!');
                    window.location.href = 'scholarships.php';
                </script>
            ";
        }
    }
?>
