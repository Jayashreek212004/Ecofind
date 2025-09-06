<?php
include 'db.php';

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $conn->query("DELETE FROM products WHERE product_id = $del_id");
    header("Location: seller_dashboard.php");
    exit();
}

// Show all products added by user (user_id = 1 for now)
$user_id = 1;
$result = $conn->query("SELECT * FROM products WHERE user_id = $user_id ORDER BY product_id DESC");

if ($result->num_rows > 0) {
    echo "<h2>My Added Products</h2>";
    echo '<div style="display:flex;flex-wrap:wrap;gap:20px;">';
    while ($row = $result->fetch_assoc()) {
        echo '<div style="border:1px solid #ccc;border-radius:8px;padding:12px;width:220px;text-align:center;background:#fafafa;">';
        echo '<img src="'.$row['image'].'" style="width:120px;height:120px;object-fit:cover;border-radius:6px;"><br>';
        echo '<b>'.$row['title'].'</b><br>';
        echo '<span style="font-size:13px;color:#555;">'.$row['description'].'</span><br>';
        echo '<span style="color:#333;">Price: $'.$row['price'].'</span><br>';
        echo '<span style="color:#333;">Qty: '.$row['quantity'].'</span><br>';
        echo '<a href="seller_dashboard.php?edit='.$row['product_id'].'" class="btn btn-warning btn-sm" style="margin:5px;">Edit</a>';
        echo '<a href="seller_dashboard.php?delete='.$row['product_id'].'" class="btn btn-danger btn-sm" style="margin:5px;" onclick="return confirm(\'Are you sure you want to delete this product?\');">Delete</a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>No products added yet.</p>';
}

// Edit form
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM products WHERE product_id = $edit_id");
    if ($row = $res->fetch_assoc()) {
        echo '<h3>Edit Product</h3>';
        echo '<form method="post" enctype="multipart/form-data" style="max-width:500px;">';
        echo '<input type="hidden" name="edit_id" value="'.$edit_id.'">';
        echo '<label>Title:</label><br><input type="text" name="title" value="'.$row['title'].'" required><br><br>';
        echo '<label>Description:</label><br><textarea name="description" required>'.$row['description'].'</textarea><br><br>';
        echo '<label>Price:</label><br><input type="number" step="0.01" name="price" value="'.$row['price'].'" required><br><br>';
        echo '<label>Quantity:</label><br><input type="number" name="quantity" value="'.$row['quantity'].'" required><br><br>';
        echo '<button type="submit" name="update" class="btn btn-success">Update</button>';
        echo '</form>';
    }
}

// Handle update
if (isset($_POST['update']) && isset($_POST['edit_id'])) {
    $edit_id = intval($_POST['edit_id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $stmt = $conn->prepare("UPDATE products SET title=?, description=?, price=?, quantity=? WHERE product_id=?");
    $stmt->bind_param("ssdii", $title, $description, $price, $quantity, $edit_id);
    $stmt->execute();
    header("Location: seller_dashboard.php");
    exit();
}
?>