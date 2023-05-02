<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['firstTimeLogin'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}


$wishlist = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the remove form is submitted
    if (isset($_POST['remove'])) {
        $removeId = $_POST['remove'];
        // Remove the selected item from the wishlist
        if (($key = array_search($removeId, $wishlist)) !== false) {
            unset($wishlist[$key]);
            $_SESSION['wishlist'] = $wishlist;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Wishlist</title>
    <link rel="stylesheet" href="buyerpage.css">
    <style>
        .wishlist {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            
        }
        .wishlist .pop {
            flex-basis: 18%;
            margin-bottom: 20px;
            text-align: center;
        }
        .pop img {
            width: 100px;
            height: auto;
        }
    </style>
    <!-- Add your CSS stylesheets -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>Wishlist</header>
    <br>
    <div class="wishlist">
        <?php
        // Connect to your database and retrieve the Funko Pop details
        $servername = "localhost";
		$username= "aaltayyar1";
		$password = "aaltayyar1";
		$dbname = "aaltayyar1";
		$conn = new mysqli($servername,$username,$password,$dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        if (!empty($wishlist)) {
            $wishlistIds = implode(",", $wishlist);
            $sql = "SELECT * FROM funko_pop_images WHERE id IN ($wishlistIds)";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='pop'>";
                    echo "<img class='image'src='data:image/jpeg;base64," . base64_encode($row['image_data']) . "' />";
                    echo "<p>" . $row['image_name'] . "</p>";
                    echo "<p>$" . $row['cost'] . "</p>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='remove' value='" . $row['id'] . "'>";
                    echo "<input class='wishlist'type ='submit' value='Remove from Wishlist'>";
                    echo "</form>";
                    echo "</div>";
                }
                
            } 
            else {
                echo "No wishlist items available.";
            }
        } 
        else {
            echo "Your wishlist is empty.";
        }

        
        $conn->close();
        ?>
    </div>
    <button class='backbutt'onclick="window.location.href='buyerd.php'">Back to Dashboard</button>
    
</body>
</html