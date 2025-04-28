<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

if (isset($_POST['event_id'])) {
    $event_id = (int)$_POST['event_id'];
    $user_id = $_SESSION['user_id'];

    // Check seats
    $stmt = $conn->prepare("SELECT available_seats FROM events WHERE id = ?");
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    $stmt->bind_result($available_seats);
    $stmt->fetch();
    $stmt->close();

    if ($available_seats > 0) {
        // Book ticket
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, event_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $user_id, $event_id);
        $stmt->execute();
        $stmt->close();

        // Decrease seat
        $stmt = $conn->prepare("UPDATE events SET available_seats = available_seats - 1 WHERE id = ?");
        $stmt->bind_param('i', $event_id);
        $stmt->execute();
        $stmt->close();

        // Fetch new seats
        $stmt = $conn->prepare("SELECT available_seats FROM events WHERE id = ?");
        $stmt->bind_param('i', $event_id);
        $stmt->execute();
        $stmt->bind_result($new_seats);
        $stmt->fetch();
        $stmt->close();

        echo json_encode(['success' => true, 'remaining_seats' => $new_seats]);
    } else {
        echo json_encode(['error' => 'No seats available']);
    }
}
?>
