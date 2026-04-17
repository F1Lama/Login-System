<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.css">
<link rel="stylesheet" href="CSS/variables.css">
<link rel="stylesheet" href="CSS/main.css">
</head>

<body>

<div class="container mt-5">

    <div class="card p-4 text-center shadow">

        <h2 class='dash' >Welcome  <?php echo $user['username']; ?> 👋</h2>

        <p class='dashp'> Your Email: <?php echo $user['email']; ?></p>

        <a href="logout.php" class="btn btn-custom mt-3">
    Logout
</a>

    </div>

</div>

</body>
</html>