<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$stmt = $conn->prepare("
    SELECT b.booking_time, e.name, e.event_date, e.venue
    FROM bookings b
    JOIN events e ON b.event_id = e.id
    WHERE b.user_id = ?
    ORDER BY b.booking_time DESC
    LIMIT ? OFFSET ?
");
$stmt->bind_param('iii', $user_id, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Booking History</h2>
<p><a href="events.php">Back to Events</a> | <a href="logout.php">Logout</a></p>

<?php if ($result->num_rows > 0): ?>
    <?php while ($booking = $result->fetch_assoc()): ?>
        <div style="border:1px solid #ccc; padding:10px; margin:10px;background:#b9cbcb">
            <h3><?= htmlspecialchars($booking['name']) ?></h3>
            <p>Date: <?= htmlspecialchars($booking['event_date']) ?></p>
            <p>Venue: <?= htmlspecialchars($booking['venue']) ?></p>
            <p>Booked on: <?= htmlspecialchars($booking['booking_time']) ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No bookings found.</p>
<?php endif; ?>

<?php if ($result->num_rows == $limit): ?>
    <a href="?page=<?= $page + 1 ?>">Next Page</a>
<?php endif; ?>
