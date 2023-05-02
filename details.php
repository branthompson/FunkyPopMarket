<?php
session_start();
if (!isset($_SESSION['firstTimeLogin'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}
// Establish the database connection
$servername = "localhost";
$username= "aaltayyar1";
$password = "aaltayyar1";
$dbname = "aaltayyar1";
$conn = new mysqli($servername,$username,$password,$dbname);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the card ID is provided
if (isset($_GET['id'])) {
    $cardId = $_GET['id'];

    // Prepare the SQL statement to fetch the details of the card
    $sql = "SELECT * FROM funko_pop_images WHERE id = $cardId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the card details from the database
        $row = $result->fetch_assoc();

        // Display the card details
        echo "<h2>{$row['image_name']}</h2>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['image_data']) . "' />";
        echo "<p>Cost: $ {$row['cost']}</p>";
    } else {
        echo "Card not found.";
    }
}

// Close the database connection
$conn->close();
?>