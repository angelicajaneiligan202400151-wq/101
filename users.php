<?php
require 'auth.php';
requireLogin();
requireAdmin();
require 'config.php';

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body {
            margin: 0;
            background-color: #212529;
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #e83e8c;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div style="padding:40px; min-height:100vh;">

    <h2 style="text-align:center; color:#ff4da6; margin-bottom:20px;">
        Manage Users
    </h2>

    <!-- ✅ TOP BUTTONS -->
    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">

        <!-- ✅ Back Button -->
        <a href="index.php"
   style="background:#e83e8c;
          color:white;
          padding:8px 15px;
          border-radius:5px;
          text-decoration:none;
          font-weight:bold;"
   onmouseover="this.style.background='#d63384'"
   onmouseout="this.style.background='#e83e8c'">
     Back
</a>

        <!-- ✅ Add User Button -->
        <a href="add_user.php"
           style="background:#ff4da6;
                  color:white;
                  padding:8px 15px;
                  border-radius:5px;
                  text-decoration:none;
                  font-weight:bold;">
             Add User
        </a>

    </div>

    <table width="100%">

        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo ucfirst($row['role']); ?></td>
            <td>

                <?php if ($row['id'] == $_SESSION['user_id']): ?>

                    <span style="color:gray; font-weight:bold;">
                        Currently Using
                    </span>

                <?php elseif ($row['role'] === 'staff'): ?>

                    <a href="edit_user.php?id=<?php echo $row['id']; ?>"
                       style="background:#ff4da6;
                              color:white;
                              padding:5px 10px;
                              border-radius:5px;
                              text-decoration:none;
                              margin-right:5px;">
                        Edit
                    </a>

                    <a href="delete_user.php?id=<?php echo $row['id']; ?>"
                       style="background:#ff4da6;
                              color:white;
                              padding:5px 10px;
                              border-radius:5px;
                              text-decoration:none;"
                       onclick="return confirm('Delete this user?')">
                        Delete
                    </a>

                <?php else: ?>

                    <span style="color:#ccc;">No Action</span>

                <?php endif; ?>

            </td>
        </tr>
        <?php endwhile; ?>

    </table>

</div>

</body>
</html>