<?php
include 'config.php';

$message = '';

// Clear all bookings
if (isset($_POST['clear_all'])) {
    mysqli_query($conn, "UPDATE seats SET passenger_name=NULL, status='available'");
    $message = "All bookings cleared!";
}

// Book seat
if (isset($_POST['book_seat'])) {
    $seat = $_POST['seat_number'];
    $name = $_POST['passenger_name'];

    $check = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT status FROM seats WHERE seat_number='$seat'")
    );

    if ($check['status'] == 'available') {
        mysqli_query(
            $conn,
            "UPDATE seats SET passenger_name='$name', status='booked' WHERE seat_number='$seat'"
        );
        $message = "Seat $seat booked!";
    } else {
        $message = "Seat already booked!";
    }
}

// Fetch all seats
$seats = [];
$result = mysqli_query($conn, "SELECT * FROM seats ORDER BY seat_number");

while ($row = mysqli_fetch_assoc($result)) {
    $seats[$row['seat_number']] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Airplane Booking</title>

    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        h2, h3 { color: #333; }
        h2 { text-align: center; }

        .message {
            background: #4CAF50;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
        }

        .legend {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 5px;
        }

        .legend span { margin: 0 15px; }

        .legend-box {
            display: inline-block;
            width: 30px;
            height: 30px;
            margin-right: 5px;
            border-radius: 5px;
        }

        .seats-container {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 10px;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            margin: 8px 0;
            align-items: center;
        }

        .row-label {
            width: 50px;
            font-weight: bold;
        }

        .seat {
            width: 50px;
            height: 50px;
            margin: 0 5px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
        }

        .available { background: #4CAF50; color: white; }
        .booked { background: #f44336; color: white; cursor: not-allowed; }

        .aisle {
            margin: 0 10px;
            color: #999;
        }

        input {
            padding: 10px;
            margin: 5px;
        }

        button {
            padding: 10px 20px;
            background: #2196F3;
            color: white;
            border: none;
        }

        .clear {
            background: #f44336;
            width: 100%;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th { background: #2196F3; color: white; }
    </style>
</head>

<body>

<div class="container">

    <h2>✈️ Airplane Seat Booking</h2>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <!-- Legend -->
    <div class="legend">
        <span><span class="legend-box" style="background:#4CAF50;"></span>Available</span>
        <span><span class="legend-box" style="background:#f44336;"></span>Booked</span>
    </div>

    <!-- Seat Layout -->
    <div class="seats-container">
        <h3 style="text-align:center;">Seating Arrangement</h3>

        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="seat-row">

                <div class="row-label">Row <?= $i ?></div>

                <!-- Left side -->
                <?php foreach (['A','B','C'] as $col): 
                    $num = $i . $col;
                    $s = $seats[$num];
                    $cls = $s['status'] == 'available' ? 'available' : 'booked';
                    $click = $s['status'] == 'available'
                        ? "onclick=\"document.getElementById('seat').value='$num'\""
                        : "";
                ?>
                    <div class="seat <?= $cls ?>" <?= $click ?>><?= $num ?></div>
                <?php endforeach; ?>

                <div class="aisle">AISLE</div>

                <!-- Right side -->
                <?php foreach (['D','E','F'] as $col): 
                    $num = $i . $col;
                    $s = $seats[$num];
                    $cls = $s['status'] == 'available' ? 'available' : 'booked';
                    $click = $s['status'] == 'available'
                        ? "onclick=\"document.getElementById('seat').value='$num'\""
                        : "";
                ?>
                    <div class="seat <?= $cls ?>" <?= $click ?>><?= $num ?></div>
                <?php endforeach; ?>

            </div>
        <?php endfor; ?>

    </div>

    <!-- Booking Form -->
    <h3>Book a Seat</h3>
    <form method="POST">
        <input type="text" id="seat" name="seat_number" placeholder="Click seat" readonly required>
        <input type="text" name="passenger_name" placeholder="Passenger Name" required>
        <button name="book_seat">Book</button>
    </form>

    <!-- Booked Seats -->
    <h3>Booked Seats</h3>

    <?php
    $booked = mysqli_query($conn, "SELECT * FROM seats WHERE status='booked'");
    if (mysqli_num_rows($booked) > 0):
    ?>
        <table>
            <tr>
                <th>Seat</th>
                <th>Passenger</th>
            </tr>

            <?php while ($b = mysqli_fetch_assoc($booked)): ?>
                <tr>
                    <td><?= $b['seat_number'] ?></td>
                    <td><?= $b['passenger_name'] ?></td>
                </tr>
            <?php endwhile; ?>

        </table>
    <?php else: ?>
        <p>No seats booked</p>
    <?php endif; ?>

    <!-- Clear All -->
    <form method="POST">
        <button class="clear" name="clear_all">Clear All Bookings</button>
    </form>

</div>

</body>
</html>