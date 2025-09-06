<?php
include 'db.php'; // your database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; // default for now, can change to logged-in user
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $condition = $_POST['condition'];
    $year = $_POST['year'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $dimensions = $_POST['dimensions'];
    $weight = $_POST['weight'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $original_packaging = isset($_POST['original_packaging']) ? 1 : 0;
    $manual_included = isset($_POST['manual_included']) ? 1 : 0;
    $working_condition = $_POST['working_condition'];

    // ✅ Handle file upload
    $image = "images/placeholder.jpg"; 
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO products 
        (user_id, title, category_id, description, price, quantity, `condition`, year_of_manufacture, brand, model, dimensions, weight, material, color, original_packaging, manual_included, working_condition, image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "isisisssssssiissss",
        $user_id,
        $title,
        $category_id,
        $description,
        $price,
        $quantity,
        $condition,
        $year,
        $brand,
        $model,
        $dimensions,
        $weight,
        $material,
        $color,
        $original_packaging,
        $manual_included,
        $working_condition,
        $image
    );

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Product added successfully!</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: ".$stmt->error."</p>";
    }
}
?>

<h2 style="text-align:center; font-family:Arial, sans-serif; color:#333; margin-bottom:30px;">Add New Product</h2>

<form method="POST" enctype="multipart/form-data" style="
    max-width:600px; 
    margin:0 auto; 
    background:rgba(165, 158, 230, 0.58); 
    padding:30px; 
    border-radius:15px; 
    box-shadow:0 8px 25px rgba(14, 14, 14, 0.1);
    font-family:Arial,sans-serif;
">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Title:</label>
    <input type="text" name="title" required style="
        width:100%; 
        padding:10px; 
        border-radius:8px; 
        border:1px solid #ccc; 
        margin-bottom:15px;
        font-size:14px;
    ">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Category:</label>
    <select name="category_id" required style="
        width:100%; 
        padding:10px; 
        border-radius:8px; 
        border:1px solid #ccc; 
        margin-bottom:15px;
        font-size:14px;
    ">
        <option value="1">Electronics</option>
        <option value="2">Clothing</option>
        <option value="3">Furniture</option>
        <option value="4">Home Appliances</option>
        <option value="5">Home Decor</option>
    </select>

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Description:</label>
    <textarea name="description" required style="
        width:100%; 
        padding:10px; 
        border-radius:8px; 
        border:1px solid #ccc; 
        margin-bottom:15px; 
        font-size:14px; 
        resize:vertical;
    "></textarea>

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Price:</label>
    <input type="number" step="0.01" name="price" required style="
        width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;
    ">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Quantity:</label>
    <input type="number" name="quantity" required style="
        width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;
    ">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Condition:</label>
    <input type="text" name="condition" required style="
        width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;
    ">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Year of Manufacture:</label>
    <input type="number" name="year" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Brand:</label>
    <input type="text" name="brand" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Model:</label>
    <input type="text" name="model" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Dimensions:</label>
    <input type="text" name="dimensions" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Weight:</label>
    <input type="text" name="weight" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Material:</label>
    <input type="text" name="material" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Color:</label>
    <input type="text" name="color" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="display:block; margin-bottom:10px;">
        <input type="checkbox" name="original_packaging"> Original Packaging
    </label>
    <label style="display:block; margin-bottom:20px;">
        <input type="checkbox" name="manual_included"> Manual Included
    </label>

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Working Condition:</label>
    <input type="text" name="working_condition" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">

    <label style="font-weight:bold; margin-bottom:5px; display:block;">Upload Image:</label>
    <input type="file" name="image" accept="image/*" style="margin-bottom:25px;">

    <button type="submit" style="
        width:100%; 
        padding:12px; 
        background:#007bff; 
        color:#fff; 
        border:none; 
        border-radius:10px; 
        font-size:16px; 
        font-weight:bold;
        cursor:pointer;
        transition:background 0.3s;
    " onmouseover="this.style.background='#0056b3'" onmouseout="this.style.background='#007bff'">➕ Add Product</button>

</form>
