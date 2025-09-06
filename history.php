<?php
// history.php
// This page displays all order details for the logged-in user.
include 'db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];

// Fetch orders for the user
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9fafb; }
        .container { max-width: 800px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #ccc; padding: 30px; }
        h2 { text-align: center; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #1e3a8a; color: #fff; }
        tr:hover { background: #f1f5f9; }
        .no-orders { text-align: center; color: #888; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Order History</h2>
        <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Items</th>
                <th>Delivery Address</th>
                <th>Delivery Date</th>
                <th>Delivery Time</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo htmlspecialchars($row['items']); ?></td>
                <td><?php echo htmlspecialchars($row['delivery_address']); ?></td>
                <td><?php echo $row['delivery_date']; ?></td>
                <td><?php echo $row['delivery_time']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['order_date']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
        <div class="no-orders">You have not placed any orders yet.</div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
