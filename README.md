A simple and clean Ticket Management System built using Core PHP (no frameworks) and MySQL. It allows users to submit support tickets and admins to manage them easily.

🚀 Features
User registration & login

Admin login

Create, view, update tickets

Ticket statuses (Open, In Progress, Resolved, Closed)

Simple and clean code structure (no composer, no MVC)

Basic security measures (password hashing, session management)

🛠 Requirements
PHP 7.2 or higher

MySQL 5.7 or higher

Apache Server with mod_rewrite enabled

Basic hosting or XAMPP/LAMP/WAMP

📦 Installation Instructions
1. Download or Clone the Repository
bash
Copy
Edit
git clone https://github.com/yourusername/core-php-ticket-system.git
cd core-php-ticket-system
Or just download the .zip and extract.

2. Setup the Database
Create a MySQL database (e.g., ticket_system).

Import the provided SQL file:

Open PHPMyAdmin → select your database → Import → select database.sql

OR using the terminal:

bash
Copy
Edit
mysql -u your_user -p ticket_system < database.sql
3. Configure Database Connection
Open config.php and set your database credentials:

php
Copy
Edit
<?php
$host = "localhost";
$db   = "ticket_system";
$user = "root";
$pass = ""; // your db password

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
4. Set Folder Permissions (if needed)
If the system allows file uploads (attachments for tickets), make sure uploads/ folder is writable:

bash
Copy
Edit
chmod -R 755 uploads/
5. Launch the App
Start your local server (XAMPP, MAMP, etc.) and open your browser:

perl
Copy
Edit
http://localhost/core-php-ticket-system/
