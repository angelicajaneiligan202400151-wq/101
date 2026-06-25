<?php
require 'auth.php';
requireLogin();
requireAdmin();
require 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users (username, email, password_hash, role)
                  VALUES ('$username', '$email', '$hashed', '$role')");

    $message = "User added successfully!";
}
?>

<div style="padding:40px; background:#212529; min-height:100vh;">

    <h2 style="color:#ff4da6; text-align:center;">Add User</h2>

    <?php if ($message): ?>
        <p style="color:lightgreen; text-align:center;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" style="max-width:400px; margin:20px auto; background:white; padding:20px; border-radius:8px;">

        <input type="text" name="username" placeholder="Username" required
               style="width:100%; padding:8px; margin-bottom:10px;"><br>

        <input type="email" name="email" placeholder="Email" required
               style="width:100%; padding:8px; margin-bottom:10px;"><br>

        <input type="password" name="password" placeholder="Password" required
               style="width:100%; padding:8px; margin-bottom:10px;"><br>

        <select name="role" required
                style="width:100%; padding:8px; margin-bottom:15px;">
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit"
                style="background:#ff4da6; color:white; padding:8px 15px; border:none; border-radius:5px;">
            Add User
        </button>

        <a href="users.php"
           style="margin-left:10px; background:#6c757d; color:white; padding:8px 15px; border-radius:5px; text-decoration:none;">
           Back
        </a>

    </form>

</div>

