<?php
session_start();
$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars(trim($_POST["fullname"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $birthdate = $_POST["birthdate"];

    if (empty($fullname) || empty($email) || empty($username) || empty($password) || empty($gender) || empty($birthdate)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $data = "$fullname | $email | $username | $gender | $birthdate | $hashed_password\n";
        file_put_contents("users.txt", $data, FILE_APPEND);
        $_SESSION['fullname'] = $fullname;
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="teasub2.css">
    <script src="testsub3.js" defer></script>
</head>
<body>

<div class="container">
    <?php if ($success): ?>
        <h2>Sign-up Successful!</h2>
        <p>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?>!</p>
        <a href="?view=1">View All Registered Users</a>
    <?php else: ?>
        <h2>Sign Up Form</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="post" action="signup.php">
            <label>Full Name</label>
            <input type="text" name="fullname" required><br>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm" required>

            <label>Gender</label>
            <select name="gender" required>
                <option value="">Select</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>

            <label>Birthdate</label>
            <input type="date" name="birthdate" required>

            <button type="submit">Sign Up</button>
        </form>
    <?php endif; ?>
</div>

<?php if (isset($_GET['view'])): ?>
    <div class="user-list">
        <h2>Registered Users</h2>
        <table border="1" cellpadding="8">
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Birthdate</th>
            </tr>
            <?php
            $lines = @file("users.txt");
            if ($lines) {
                foreach ($lines as $line) {
                    $parts = explode(" | ", $line);
                    if (count($parts) >= 5) {
                        echo "<tr>
                                <td>" . htmlspecialchars($parts[0]) . "</td>
                                <td>" . htmlspecialchars($parts[1]) . "</td>
                                <td>" . htmlspecialchars($parts[2]) . "</td>
                                <td>" . htmlspecialchars($parts[3]) . "</td>
                                <td>" . htmlspecialchars($parts[4]) . "</td>
                              </tr>";
                    }
                }
            }
            ?>
        </table>
    </div>
<?php endif; ?>

</body>
</html>

