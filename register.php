<?php
require 'db.php';

if (isset($_POST['username'], $_POST['password'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param('ss', $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php?registered=1");
        exit;
    } else {
        $error = "Username already taken!";
    }
    $stmt->close();
}
?>

<h2>Register</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>
