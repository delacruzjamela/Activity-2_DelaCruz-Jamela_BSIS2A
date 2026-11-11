<?php
require_once "config.php";

if($_SESSION['role'] === '' || $_SESSION['user_id'] === ''){
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarships</title>

    <style>
        .nav{
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .nav a{
            text-decoration: none;
            color: black;
        }

        .nav a:hover{
            text-decoration: underline;
            color: green;
        }

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

        table, th, tr, td{
            border: 1px solid black;
        }

        table{
            border-collapse: collapse;
            width: 70%;
        }

        th{
            background-color: lightgreen;
            padding: 5px;
        }

        td{
            text-align: center;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="scholarships.php">Scholarships</a>

        <?php if ($_SESSION['role'] === 'admin'):?>
        <a href="users.php">User Management</a>
        <?php endif; ?>

        <a href="logout.php">Logout</a>
    </div>

    <div class="main">

        <div>
            <h3>Add Scholarship</h3>

            <br>

            <form action="" method="post">

                <div>
                    <div>
                        <label for="">Scholarship Name:</label>
                        <input type="text" name="scholarship_name" id="" required>
                    </div>

                    <div>
                        <label for="">Description:</label>
                        <textarea name="description" id="" cols="50" rows="5" required></textarea>
                    </div>

                    <div>
                        <label for="">Eligibility:</label>
                        <textarea name="eligibility" id="" cols="50" rows="5" required></textarea>
                    </div>
                </div>

                <div>
                    <div>
                        <label for="">Benefits:</label>
                        <textarea name="benefits" id="" cols="50" rows="5" required></textarea>
                    </div>

                    <div>
                        <label for="">Application Deadline:</label>
                        <input type="date" name="application_deadline" id="" required>
                    </div>

                    <br>

                    <div>
                        <input type="submit" value="Add Scholarship" name="addscholarshipbtn">
                    </div>
                </div>

            </form>
        </div>

        <br>
        <hr>
        <br>

        <div>
            <h1>Scholarship List</h1>

            <br>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Eligibility</th>
                        <th>Benefits</th>
                        <th>Application Deadline</th>
                        <th>Date Saved</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                    $fetchscholarship = mysqli_query($conn, "SELECT * FROM scholarships");

                    if(mysqli_num_rows($fetchscholarship)>0){
                        while($scholarship = mysqli_fetch_assoc($fetchscholarship)){
                ?>

                    <tr>
                        <td><?php echo $scholarship['id']; ?></td>
                        <td><?php echo $scholarship['scholarship_name']; ?></td>
                        <td><?php echo $scholarship['description']; ?></td>
                        <td><?php echo $scholarship['eligibility']; ?></td>
                        <td><?php echo $scholarship['benefits']; ?></td>
                        <td><?php echo $scholarship['application_deadline']; ?></td>
                        <td><?php echo $scholarship['created_at']; ?></td>

                        <td>
                            <button onclick="window.location.href='editproducts.php?scholarshipid=<?php echo $scholarship['id']; ?>'">Edit</button>
                            <button onclick="window.location.href='deleteproduct.php?scholarshipid=<?php echo $scholarship['id']; ?>'">Delete</button>
                        </td>
                    </tr>

                <?php
                        }
                    }else{
                ?>

                    <tr>
                        <td colspan="8">No scholarships found.</td>
                    </tr>

                <?php
                    }
                ?>

                </tbody>
            </table>
        </div>

    </div>

</body>
</html>

<?php

    if(isset($_POST['addscholarshipbtn'])){

        $name = $_POST['scholarship_name'];
        $desc = $_POST['description'];
        $eligibility = $_POST['eligibility'];
        $benefits = $_POST['benefits'];
        $deadline = $_POST['application_deadline'];

        $userid = $_SESSION['user_id'];

        $insertquery = "INSERT INTO scholarships (scholarship_name,description,eligibility,benefits,application_deadline,created_by) VALUES ('$name','$desc','$eligibility','$benefits','$deadline','$userid')";

        $insertfunc = mysqli_query($conn, $insertquery);

        if($insertfunc){
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
