<?php
require_once "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>MCA Department</h1>
</header>

<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="about.php">About Us</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="hero">

    <h2>Welcome, <?= htmlspecialchars($_SESSION["name"]) ?>!</h2>

    <p>You have successfully logged into the department website.</p>

    <h3>Student Dashboard</h3>

    <p>Welcome to the MCA Computer Science Department.</p>

    <a href="about.php" class="btn">View Department Details</a>

    <a href="logout.php" class="btn">Logout</a>

</div>

</body>
</html>