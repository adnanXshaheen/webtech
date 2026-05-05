<?php
session_start();

$conn = new mysqli("localhost", "root", "", "test_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
)");

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: app.php");
    exit();
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<p>Registration successful! Please login.</p>";
    } else {
        echo "<p>Error: Email already exists.</p>";
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user['name'];

            setcookie("user_email", $email, time() + (7 * 24 * 60 * 60));

            setcookie("last_login", date("Y-m-d H:i:s"), time() + (7 * 24 * 60 * 60));

            header("Location: app.php");
            exit();
        } else {
            echo "<p>Invalid password</p>";
        }
    } else {
        echo "<p>User not found</p>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Auth App</title>
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>

    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['user']; ?> 🎉</p>

    <?php if (isset($_COOKIE['last_login'])): ?>
        <p>Last Login: <?php echo $_COOKIE['last_login']; ?></p>
    <?php endif; ?>

    <a href="?logout=true">Logout</a>

<?php else: ?>

    <h2>Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email"
            value="<?php echo $_COOKIE['user_email'] ?? ''; ?>" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button name="login">Login</button>
    </form>

    <hr>

    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button name="register">Register</button>
    </form>

<?php endif; ?>

</body>
</html>
