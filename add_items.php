<?php
// add_items.php — populate sample products
include 'db.php'; // your database connection

// Make sure user_id = 1 exists in your users table
// Make sure category_id 1-5 exist in your category table
$products = [
    [
        "user_id" => 1,
        "title" => "iPhone 12",
        "category_id" => 1, // Electronics
        "description" => "Used iPhone 12 with minor scratches",
        "price" => 450,
        "quantity" => 1,
        "condition" => "Good",
        "year" => 2020,
        "brand" => "Apple",
        "model" => "A2172",
        "dimensions" => "14.7x7.1x0.7 cm",
        "weight" => "164g",
        "material" => "Glass/Aluminum",
        "color" => "Black",
        "original_packaging" => 1,
        "manual_included" => 1,
        "working_condition" => "Fully functional, battery good",
        "image" => "images/iphone12.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Levi's Jeans",
        "category_id" => 2, // Clothing
        "description" => "Blue slim-fit jeans, lightly worn",
        "price" => 25,
        "quantity" => 2,
        "condition" => "Excellent",
        "year" => 2019,
        "brand" => "Levi's",
        "model" => "501",
        "dimensions" => "100x30x2 cm",
        "weight" => "500g",
        "material" => "Denim",
        "color" => "Blue",
        "original_packaging" => 0,
        "manual_included" => 0,
        "working_condition" => "No defects, zipper smooth",
        "image" => "images/levis_jeans.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "IKEA Chair",
        "category_id" => 3, // Furniture
        "description" => "Wooden chair with cushion, stable",
        "price" => 35,
        "quantity" => 1,
        "condition" => "Good",
        "year" => 2018,
        "brand" => "IKEA",
        "model" => "N/A",
        "dimensions" => "45x45x90 cm",
        "weight" => "7kg",
        "material" => "Wood/Fabric",
        "color" => "Brown",
        "original_packaging" => 0,
        "manual_included" => 0,
        "working_condition" => "Minor scuffs, stable",
        "image" => "images/ikea_chair.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Samsung TV 42\"",
        "category_id" => 1, // Electronics
        "description" => "LED TV with remote, fully functional",
        "price" => 220,
        "quantity" => 1,
        "condition" => "Good",
        "year" => 2017,
        "brand" => "Samsung",
        "model" => "UA42N5300",
        "dimensions" => "95x22x55 cm",
        "weight" => "10kg",
        "material" => "Plastic/Metal",
        "color" => "Black",
        "original_packaging" => 0,
        "manual_included" => 1,
        "working_condition" => "Perfect working condition",
        "image" => "images/samsung_tv42.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Sony Headphones",
        "category_id" => 1, // Electronics
        "description" => "Over-ear wireless headphones",
        "price" => 60,
        "quantity" => 1,
        "condition" => "Very Good",
        "year" => 2021,
        "brand" => "Sony",
        "model" => "WH-CH710N",
        "dimensions" => "18x7x20 cm",
        "weight" => "250g",
        "material" => "Plastic/Leather",
        "color" => "Black",
        "original_packaging" => 1,
        "manual_included" => 1,
        "working_condition" => "No issues, battery fine",
        "image" => "images/sony_headphones.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Dining Table",
        "category_id" => 3, // Furniture
        "description" => "Wooden dining table, seats 4",
        "price" => 120,
        "quantity" => 1,
        "condition" => "Good",
        "year" => 2016,
        "brand" => "Local Brand",
        "model" => "N/A",
        "dimensions" => "120x80x75 cm",
        "weight" => "20kg",
        "material" => "Wood",
        "color" => "Dark Brown",
        "original_packaging" => 0,
        "manual_included" => 0,
        "working_condition" => "Some scratches, solid",
        "image" => "images/dining_table.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Canon DSLR",
        "category_id" => 1, // Electronics
        "description" => "Canon DSLR with 18-55mm lens",
        "price" => 350,
        "quantity" => 1,
        "condition" => "Excellent",
        "year" => 2019,
        "brand" => "Canon",
        "model" => "EOS 200D",
        "dimensions" => "13x9x8 cm",
        "weight" => "450g",
        "material" => "Plastic/Metal",
        "color" => "Black",
        "original_packaging" => 1,
        "manual_included" => 1,
        "working_condition" => "Perfect working condition",
        "image" => "images/canon_dslr.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Nike Sneakers",
        "category_id" => 2, // Clothing
        "description" => "Men's running shoes, size 10",
        "price" => 40,
        "quantity" => 1,
        "condition" => "Very Good",
        "year" => 2020,
        "brand" => "Nike",
        "model" => "Air Zoom Pegasus",
        "dimensions" => "30x10x12 cm",
        "weight" => "800g",
        "material" => "Fabric/Rubber",
        "color" => "White",
        "original_packaging" => 0,
        "manual_included" => 0,
        "working_condition" => "No major wear",
        "image" => "images/nike_sneakers.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Coffee Maker",
        "category_id" => 4, // Home Appliances
        "description" => "Single-serve drip coffee machine",
        "price" => 25,
        "quantity" => 1,
        "condition" => "Good",
        "year" => 2018,
        "brand" => "Hamilton Beach",
        "model" => "N/A",
        "dimensions" => "20x15x30 cm",
        "weight" => "2kg",
        "material" => "Plastic/Metal",
        "color" => "Black",
        "original_packaging" => 0,
        "manual_included" => 1,
        "working_condition" => "Works fine, no leaks",
        "image" => "images/coffee_maker.jpg"
    ],
    [
        "user_id" => 1,
        "title" => "Office Desk Lamp",
        "category_id" => 5, // Home Decor
        "description" => "Adjustable LED desk lamp",
        "price" => 15,
        "quantity" => 2,
        "condition" => "Excellent",
        "year" => 2021,
        "brand" => "Philips",
        "model" => "N/A",
        "dimensions" => "15x15x40 cm",
        "weight" => "1kg",
        "material" => "Metal/Plastic",
        "color" => "Silver",
        "original_packaging" => 1,
        "manual_included" => 1,
        "working_condition" => "Perfectly working",
        "image" => "images/desk_lamp.jpg"
    ]
];

// Insert products into DB
foreach($products as $p){
    $stmt = $conn->prepare("INSERT INTO products (user_id, title, category_id, description, price, quantity, `condition`, year_of_manufacture, brand, model, dimensions, weight, material, color, original_packaging, manual_included, working_condition, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
  $stmt->bind_param(
    "isisisssssssiissss",
    $p['user_id'],           // i
    $p['title'],             // s
    $p['category_id'],       // i
    $p['description'],       // s
    $p['price'],             // d
    $p['quantity'],          // i
    $p['condition'],         // s
    $p['year'],              // i
    $p['brand'],             // s
    $p['model'],             // s
    $p['dimensions'],        // s
    $p['weight'],            // s
    $p['material'],          // s
    $p['color'],             // s
    $p['original_packaging'],// i
    $p['manual_included'],   // i
    $p['working_condition'], // s
    $p['image']              // s
);

    $stmt->execute();
}

echo "10 sample products added successfully ✅";
?>
