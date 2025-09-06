<?php
// payment.php
include 'db.php';

$product = null;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM products WHERE product_id = $id");
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment & Delivery</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f9fafb; }
    .container { max-width:450px; margin:40px auto; background:#fff; border-radius:10px; box-shadow:0 2px 8px #ccc; padding:30px; }
    h2 { text-align:center; margin-bottom:20px; }
    .order-summary { margin-bottom:20px; padding:15px; background:#f1f5f9; border-radius:8px; }
    label { display:block; margin-top:16px; margin-bottom:6px; font-weight:500; }
    input, textarea, select { width:100%; padding:10px; border-radius:6px; border:1px solid #bbb; margin-bottom:10px; }
    .submit-btn { width:100%; background:#1e3a8a; color:#fff; border:none; border-radius:8px; padding:12px; font-size:18px; cursor:pointer; margin-top:18px; }
    .submit-btn:hover { background:#2563eb; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Payment & Delivery Details</h2>

    <?php if ($product): ?>
      <div class="order-summary">
        <b>Product:</b> <?php echo $product['title']; ?><br>
        <b>Total Payable:</b> ₹<?php echo $total; ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <label for="address">Delivery Address</label>
      <textarea name="address" id="address" required placeholder="Enter your address..."></textarea>

      <label for="delivery_time">Preferred Delivery Time</label>
      <select name="delivery_time" id="delivery_time" required>
        <option value="Morning">Morning (8am - 12pm)</option>
        <option value="Afternoon">Afternoon (12pm - 4pm)</option>
        <option value="Evening">Evening (4pm - 8pm)</option>
      </select>

      <label for="delivery_date">Delivery Date</label>
      <input type="date" name="delivery_date" id="delivery_date" required>

      <button type="submit" class="submit-btn">Confirm & Pay</button>
    </form>

    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $address = htmlspecialchars($_POST['address']);
      $delivery_time = $_POST['delivery_time'];
      $delivery_date = $_POST['delivery_date'];
      $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // fallback to 1 if not logged in
      $product_id = $product ? $product['product_id'] : null;
      $quantity = 1; // default to 1 for single product checkout
      $price = $product ? $product['price'] : $total;
      $order_date = date('Y-m-d H:i:s');

      // Insert into orders table
      $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, order_date) VALUES (?, ?, ?)");
      $stmt->bind_param("ids", $user_id, $total, $order_date);
      if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        // Insert into order_items table
        $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt2->execute();
        $stmt2->close();

        echo "<div style='margin-top:20px;color:green;text-align:center;'>
                ✅ Thank you! Your order for <b>{$product['title']}</b> will be delivered on 
                <b>$delivery_date</b> during <b>$delivery_time</b> to:<br><br>
                <b>$address</b><br><br>
                Total Paid: ₹$total<br><br>
                <a href='history.php'>View Order History</a>
              </div>";
      } else {
        echo "<div style='margin-top:20px;color:red;text-align:center;'>❌ Error placing order: " . $stmt->error . "</div>";
      }
      $stmt->close();
    }
    ?>
  </div>
</body>
</html>
