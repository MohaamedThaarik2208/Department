<?php
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (
        $name == "" ||
        $email == "" ||
        $username == "" ||
        $password == ""
    ) {
        $message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $message = "Password must contain at least 6 characters.";
    } else {

        try {
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $sql = "INSERT INTO users
                    (name, email, username, password)
                    VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                $name,
                $email,
                $username,
                $hashedPassword
            ]);

            $message = "Registration successful! Please login.";

        } catch (PDOException $e) {
            $message = "Email or username already exists.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>

<header>
    <h1>MCA Department</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="login.php">Login</a>
</nav>

<div class="form-box">

    <h2>Student Registration</h2>

    <?php if ($message != ""): ?>
        <p class="message">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()">

        <input type="text" name="name"
               placeholder="Full Name" required>

        <input type="email" name="email"
               placeholder="Email Address" required>

        <input type="text" name="username"
               placeholder="Username" required>

        <input type="password" name="password"
               id="password"
               placeholder="Password (minimum 6 characters)"
               minlength="6" required>

        <button type="submit">Register</button>

    </form>

    <p>Already registered?
        <a href="login.php">Login here</a>
    </p>

</div>

</body>
</html>