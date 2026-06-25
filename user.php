<?php
require 'auth.php';
requireLogin();
requireAdmin();
require 'config.php';

$sql = "SELECT u.*, COUNT(p.id) AS product_count
        FROM users u
        LEFT JOIN products p ON u.id = p.added_by
        GROUP BY u.id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>User Management</title>

<style>
body{
    background:#212529;
    font-family:Arial;
    margin:30px;
    color:white;
}

h2{
    color:#e83e8c;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.back-btn{
    background:#e83e8c;
    color:white;
    padding:8px 15px;
    border-radius:5px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.back-btn:hover{
    background:#d63384;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    color:black;
}

th{
    background:#e83e8c;
    color:white;
}

th, td{
    padding:10px;
    text-align:center;
    border:1px solid #ddd;
}

.badge-admin{
    background:#e83e8c;
    color:white;
    padding:4px 8px;
    border-radius:5px;
}

.badge-staff{
    background:#6c757d;
    color:white;
    padding:4px 8px;
    border-radius:5px;
}
</style>

</head>
<body>

<div class="top-bar">
    <h2>User Management</h2>
    <a href="index.php" class="back-btn"> Back</a>
</div>

<table>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
    <th>Products Added</th>
    <th>Joined</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <?php if($row['role'] == 'admin'){ ?>
            <span class="badge-admin">Admin</span>
        <?php } else { ?>
            <span class="badge-staff">Staff</span>
        <?php } ?>
    </td>
    <td><?php echo $row['product_count']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>