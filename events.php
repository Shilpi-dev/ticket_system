<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM events");
?>

<h2>Available Events</h2>
<p><a href="booking_history.php">View Booking History</a> | <a href="logout.php">Logout</a></p>

<div id="message"></div>

<?php while ($event = $result->fetch_assoc()): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;background:#8b8b98">
        <h3><?= htmlspecialchars($event['name']) ?></h3>
        <p>Date: <?= htmlspecialchars($event['event_date']) ?></p>
        <p>Venue: <?= htmlspecialchars($event['venue']) ?></p>
        <p>Available Seats: <span id="seats-<?= $event['id'] ?>"><?= $event['available_seats'] ?></span></p>
        <button onclick="bookTicket(<?= $event['id'] ?>)">Book Ticket</button>
    </div>
<?php endwhile; ?>

<script src="./assets/script.js"></script>
