<?php
session_start();

// Check if the user is logging in for the first time
if (!isset($_SESSION['firstTimeLogin'])) {
    
    echo "<h2>Welcome to your Buyer Dashboard!</h2>";
    echo "<p>Thank you for choosing us. We hope you have a great experience!</p>";

   
    $_SESSION['firstTimeLogin'] = true;
}
if (isset($_POST['wishlist'])) {
    $propertyId = $_POST['wishlist'];
    $_SESSION['wishlist'][] = $propertyId;
}
elseif (isset($_POST['remove'])) {
    $removeId = $_POST['remove'];
    // Remove the selected item from the wishlist
    if (($key = array_search($removeId, $_SESSION['wishlist'])) !== false) {
        unset($_SESSION['wishlist'][$key]);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Buyer Dashboard</title>
    <style>
        img {
            width: 100px;
        }
        header {
            text-align: center;
            font-size: larger;
            color: red;
        }
		.funko {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}
		.funko .pop {
			flex-basis: 18%;
			margin-bottom: 20px;
			text-align: center;
		}
		.pop img {
			max-width: 100%;
			height: auto;
		}
	</style>
    <!-- Add your CSS stylesheets -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
	<form method="post" action="">
		<input type="text" name="search" placeholder="Search for a Funko Pop">
		<input type="submit" name="submit" value="Search">
	</form>
    <header> Buyers Dashboard </header>
	<br>
	<div class="funko">
		<?php
		// connect to database
		$servername = "localhost";
		$username= "aaltayyar1";
		$password = "aaltayyar1";
		$dbname = "aaltayyar1";
		$conn = new mysqli($servername,$username,$password,$dbname);

		// check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		
		if (isset($_POST['submit'])) {
			$search = $conn->real_escape_string($_POST['search']);
			$sql = "SELECT * FROM funko_pop_images WHERE image_name LIKE '%$search%'";
			$msg = "Search results for '$search':";
		} 
        else {
			// select all records from table if search not submitted
			$sql = "SELECT * FROM funko_pop_images";
			$msg = "All Funko Pops:";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<div class='pop'>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['image_data']) . "' />";
                echo "<p>" . $row['image_name'] . "</p>";
                echo "<p>$" . $row['cost'] . "</p>";
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='wishlist' value='" . $row['id'] . "'>";
                echo "<input type ='submit' value='Add to Wishlist'>";
                echo "</form>";
                echo "</div>";
		    }
		} else {
		    echo "0 results";
		}

		
		$conn->close();
		?>
	</div>
	<p><?php echo $msg; ?></p>
    <button onclick="window.location.href='wishlist.php'">View Wishlist</button>
    
</body>
</html>
