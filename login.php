<?php
require 'db.php';

if (isset($_POST['username'], $_POST['password'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    if ($id && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header("Location: events.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<h2>Login</h2>
<?php if (isset($_GET['registered'])) echo "<p style='color:green;'>Registered successfully! Please login.</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register</a></p>
