<?php
$bill = 0;
$units = "";

$breakdown = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $units = $_POST['units'];
    $remaining = $units;

    // First 50 units
    if ($remaining > 0) {
        $u = min($remaining, 50);
        $cost = $u * 3.5;
        $breakdown[] = "$u × 3.5 = ₹$cost";
        $bill += $cost;
        $remaining -= $u;
    }

    // Next 100 units
    if ($remaining > 0) {
        $u = min($remaining, 100);
        $cost = $u * 4;
        $breakdown[] = "$u × 4 = ₹$cost";
        $bill += $cost;
        $remaining -= $u;
    }

    // Next 100 units
    if ($remaining > 0) {
        $u = min($remaining, 100);
        $cost = $u * 5.2;
        $breakdown[] = "$u × 5.2 = ₹$cost";
        $bill += $cost;
        $remaining -= $u;
    }

    // Above 250 units
    if ($remaining > 0) {
        $cost = $remaining * 6.5;
        $breakdown[] = "$remaining × 6.5 = ₹$cost";
        $bill += $cost;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>⚡ Electricity Bill Calculator</h2>

    <form method="POST">
        <input type="number" name="units" placeholder="Enter units..." value="<?php echo $units; ?>" required>
        <button type="submit">Calculate</button>
    </form>

    <?php if ($bill > 0): ?>
    <div class="result">
        <h3>📊 Bill Breakdown</h3>

        <?php foreach ($breakdown as $row): ?>
            <div class="row">
                <span><?php echo $row; ?></span>
            </div>
        <?php endforeach; ?>

        <hr>

        <div class="row">
            <strong>Total Units:</strong>
            <strong><?php echo $units; ?></strong>
        </div>

        <div class="row">
            <strong>Total Bill:</strong>
            <strong>₹ <?php echo number_format($bill, 2); ?></strong>
        </div>
    </div>
    <?php endif; ?>

</div>

</body>
</html>