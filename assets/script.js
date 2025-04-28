function bookTicket(eventId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "book_ticket.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        const response = JSON.parse(this.responseText);
        const messageDiv = document.getElementById('message');
        if (response.success) {
            document.getElementById('seats-' + eventId).innerText = response.remaining_seats;
            messageDiv.innerHTML = "<p style='color:green;'>Booking successful!</p>";
        } else {
            messageDiv.innerHTML = "<p style='color:red;'>" + response.error + "</p>";
        }
    };
    xhr.send("event_id=" + eventId);
}
