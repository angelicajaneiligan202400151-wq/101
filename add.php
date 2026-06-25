<?php
require 'auth.php';
requireLogin();
require 'config.php';

// ✅ Get categories & suppliers
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");
$suppliers = mysqli_query($conn, "SELECT * FROM suppliers ORDER BY name");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category_id'];
    $supplier = $_POST['supplier_id'];

    $added_by = $_SESSION['user_id'];

    $sql = "INSERT INTO products 
            (name, description, price, stock, category_id, supplier_id, added_by)
            VALUES 
            ('$name', '$description', '$price', '$stock', '$category', '$supplier', '$added_by')";

    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link rel="stylesheet" href="style.css">

<style>
body{
    font-family: Arial, sans-serif;
    background: #212529;
    margin: 0;
}
.container{
    width:700px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}
h1{
    text-align:center;
    color:#e83e8c;
    margin-bottom:25px;
}
label{
    display:block;
    font-weight:600;
    margin-top:15px;
    margin-bottom:5px;
}
input, textarea, select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:6px;
    box-sizing:border-box;
}
textarea{
    resize:vertical;
    min-height:100px;
}
</style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container">

<h1>Add Product</h1>

<form method="POST">

<label>Product Name</label>
<input type="text" name="name" required>

<label>Description</label>
<textarea name="description" required></textarea>

<label>Price</label>
<input type="number" step="0.01" name="price" required>

<label>Stock</label>
<input type="number" name="stock" required>

<label>Category</label>
<select name="category_id" required>
    <option value="">-- Select Category --</option>
    <?php while($cat = mysqli_fetch_assoc($categories)): ?>
        <option value="<?php echo $cat['id']; ?>">
            <?php echo $cat['name']; ?>
        </option>
    <?php endwhile; ?>
</select>

<label>Supplier</label>
<select name="supplier_id" required>
    <option value="">-- Select Supplier --</option>
    <?php while($sup = mysqli_fetch_assoc($suppliers)): ?>
        <option value="<?php echo $sup['id']; ?>">
            <?php echo $sup['name']; ?>
        </option>
    <?php endwhile; ?>
</select>

<!-- ✅ Save & Back Buttons -->
<div style="margin-top:25px; display:flex; justify-content:space-between;">

    <a href="index.php"
       style="background:#6c757d;
              color:white;
              padding:12px 20px;
              border-radius:6px;
              text-decoration:none;
              font-weight:bold;">
        Back
    </a>

    <button type="submit"
            style="background:#e83e8c;
                   color:white;
                   padding:12px 25px;
                   border:none;
                   border-radius:6px;
                   font-size:16px;
                   font-weight:bold;
                   cursor:pointer;">
        Save Product
    </button>

</div>

</form>

</div>

</body>
</html>