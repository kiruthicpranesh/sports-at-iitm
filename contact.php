<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Sports@IITM";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form fields are empty
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    echo "<script>
            alert('All fields are required!');
            window.history.back(); // Redirects the user back to the form
          </script>";
    exit();
}

// Retrieve and sanitize form data
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$message = $conn->real_escape_string($_POST['message']);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
            alert('Invalid email format!');
            window.history.back(); // Redirect back to the form
          </script>";
    exit();
}

// Insert data into the database
$sql = "INSERT INTO Contact (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    // Display a success message and redirect using JavaScript
    echo "<script>
            alert('Message sent successfully!');
            window.location.href = 'index.html';
          </script>";
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>