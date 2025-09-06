<?php
include 'db.php'; // your database connection

$result = $conn->query("
    SELECT p.*, c.category AS category_name
    FROM products p
    JOIN categories c ON p.category_id = c.category_id
");

if ($result->num_rows > 0) {
    // Page background
    echo '<div style="background: linear-gradient(to right, #f0f4f8, #d9e2ec); min-height:100vh; padding:40px 20px;">';

    echo "<h2 style='text-align:center;font-family:Arial,sans-serif;margin-bottom:30px;color:#333;'>Our Products</h2>";
    echo '<div style="display:flex;flex-wrap:wrap;gap:25px;justify-content:center;">';
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    foreach ($products as $i => $row) {
        echo '<form method="post" style="margin:0;">';
        echo '<button type="submit" name="show_details" value="'.$i.'" style="border:none;background:none;cursor:pointer;padding:0;">';
        echo '<div style="
            width:200px;
            text-align:center;
            background:#fff;
            border-radius:12px;
            padding:15px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
            transition:transform 0.3s, box-shadow 0.3s;
        " onmouseover="this.style.transform=\'translateY(-5px)\';this.style.boxShadow=\'0 8px 20px rgba(0,0,0,0.15)\'" onmouseout="this.style.transform=\'translateY(0)\';this.style.boxShadow=\'0 4px 15px rgba(0,0,0,0.1)\'">';
        
        echo '<img src="'.$row['image'].'" width="180" height="180" style="object-fit:cover;border-radius:10px;border:1px solid #eee;margin-bottom:10px;" alt="'.$row['title'].'"><br>';
        echo '<span style="font-weight:bold;font-size:16px;color:#222;">'.$row['title'].'</span>';
        echo '</div>';
        echo '</button>';
        echo '<div style="margin-top:10px;text-align:center;">';
        echo '<a href="cart.php?id='.$row['product_id'].'" style="
            display:inline-block;
            padding:8px 14px;
            background:#007bff;
            color:#fff;
            border-radius:8px;
            text-decoration:none;
            font-size:14px;
            transition:background 0.3s;
        " onmouseover="this.style.background=\'#0056b3\'" onmouseout="this.style.background=\'#007bff\'">Buy Now</a>';
        echo '</div>';
        echo '</form>';
    }
    echo '</div>';

    // Show details if button pressed
    if (isset($_POST['show_details'])) {
        $idx = intval($_POST['show_details']);
        if (isset($products[$idx])) {
            $row = $products[$idx];
            echo '<div style="
                margin:40px auto;
                padding:25px;
                border-radius:12px;
                border:1px solid #ddd;
                background:#ffffffcc; /* slight transparency for elegance */
                max-width:650px;
                box-shadow:0 6px 20px rgba(0,0,0,0.1);
                font-family:Arial,sans-serif;
            ">';
            echo '<h3 style="margin-bottom:20px;color:#333;">'.$row['title'].'</h3>';
            echo '<img src="'.$row['image'].'" width="250" style="object-fit:cover;border-radius:12px;border:1px solid #eee;margin-bottom:20px;" alt="'.$row['title'].'"><br>';
            
            echo '<div style="line-height:1.6;color:#555;font-size:15px;">';
            echo '<b>Category:</b> '.$row['category_name'].'<br>';
            echo '<b>Description:</b> '.$row['description'].'<br>';
            echo '<b>Price:</b> $'.$row['price'].'<br>';
            echo '<b>Quantity:</b> '.$row['quantity'].'<br>';
            echo '<b>Condition:</b> '.$row['condition'].'<br>';
            echo '<b>Year:</b> '.$row['year_of_manufacture'].'<br>';
            echo '<b>Brand:</b> '.$row['brand'].'<br>';
            echo '<b>Model:</b> '.$row['model'].'<br>';
            echo '<b>Dimensions:</b> '.$row['dimensions'].'<br>';
            echo '<b>Weight:</b> '.$row['weight'].'<br>';
            echo '<b>Material:</b> '.$row['material'].'<br>';
            echo '<b>Color:</b> '.$row['color'].'<br>';
            echo '<b>Original Packaging:</b> '.($row['original_packaging'] ? 'Yes' : 'No').'<br>';
            echo '<b>Manual Included:</b> '.($row['manual_included'] ? 'Yes' : 'No').'<br>';
            echo '<b>Working Condition:</b> '.$row['working_condition'].'<br>';
            echo '</div>';
            echo '</div>';
        }
    }

    echo '</div>'; // close page background
} else {
    echo "<p style='text-align:center;font-size:16px;color:#555;'>No products found.</p>";
}
?>
