<?php
// cart.php
include 'db.php';
$total = 0;
$product = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM products WHERE product_id = $id");
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $total = $product['price'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9fafb; margin:0; }
    .site-header { background: #1e3a8a; color: #fff; display:flex; justify-content:space-between; padding:15px 40px; }
    .nav-links a { color:#fff; margin:0 10px; text-decoration:none; }
    .cart-layout { display:flex; justify-content:center; gap:30px; padding:40px; }
    .cart-items, .cart-summary { background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,.1); }
    .cart-items { flex:2; }
    .cart-summary { flex:1; }
    .cart-item { display:flex; justify-content:space-between; align-items:center; padding:15px; background:#f1f5f9; border-radius:8px; margin-bottom:15px; }
    .item-img { width:50px; height:50px; border-radius:6px; object-fit:cover; }
    .item-price { font-weight:bold; color:#1e3a8a; }
    .checkout-btn { width:100%; padding:12px; border:none; border-radius:8px; background:#1e3a8a; color:#fff; font-size:16px; cursor:pointer; margin-top:20px; }
    .checkout-btn:hover { background:#2563eb; }
    .site-footer { text-align:center; padding:20px; background:#f3f4f6; margin-top:auto; }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="logo">Cart</div>
    <nav class="nav-links">
      <a href="#">Home</a>
      <a href="#">Shop</a>
      <a href="#">Cart</a>
      <a href="#">Contact</a>
    </nav>
  </header>

  <div class="cart-layout">
    <div class="cart-items">
      <h2>Your Cart</h2>
      <?php if ($product): ?>
        <div class="cart-item">
          <div class="item-info">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>" class="item-img">
            <span><?php echo $product['title']; ?></span>
          </div>
          <span class="item-price">₹<?php echo $product['price']; ?></span>
        </div>
      <?php else: ?>
        <div>No product selected.</div>
      <?php endif; ?>
    </div>

    <div class="cart-summary">
      <h2>Summary</h2>
      <div class="summary-row">
        <span>Subtotal</span>
        <span>₹<?php echo $total; ?></span>
      </div>
      <div class="summary-row">
        <span>Shipping</span>
        <span>₹20</span>
      </div>
      <div class="summary-row total">
        <span>Total</span>
        <span>₹<?php echo $total + 20; ?></span>
      </div>
      <?php if ($product): ?>
        <form method="get" action="payment.php">
          <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
          <input type="hidden" name="total" value="<?php echo $total + 20; ?>">
          <button type="submit" class="checkout-btn">Proceed to Checkout</button>
        </form>
      <?php endif; ?>
    </div>
  </div>

  <footer class="site-footer">
    <p>&copy; <?php echo date("Y"); ?> Shopping Cart. All rights reserved.</p>
  </footer>
</body>
</html>
