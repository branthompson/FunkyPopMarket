
<!-- register.php is the form action (POST) of register.html
This file connects to the sql server which hold our accounts
table and does various checks like if that account exists or
not, if data is entered correctly, encrypts (hashes) the password
for security -->


<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'bthompson71';
$DATABASE_PASS = 'bthompson71';
$DATABASE_NAME = 'bthompson71';

// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = 'root';
// $DATABASE_PASS = '';
// $DATABASE_NAME = 'login';


// connect using the info above.
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) 
{
	// Display error if failed to connect to SQL server
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Creates a sql table called 'accounts' that holds the username and password of users.
$sql = "CREATE TABLE IF NOT EXISTS `accounts` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;";

if (!$conn->query($sql)) 
{
    // Display error if problem with query
    exit('Error creating/updating accounts table: ' . $conn->error);
}

// check if the data from the login form was already submitted 
if (!isset($_POST['username'], $_POST['password'])) 
{
	// Could not retrieve data, tell user to fill both fields
	exit('Please complete the registration form!');
}
// check the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password'])) 
{
	exit('Please complete the registration form');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($acc_stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) 
{
	// Bind parameters (s = string), the username is a string so we use "s"
	$acc_stmt->bind_param('s', $_POST['username']);
	$acc_stmt->execute();
	$acc_stmt->store_result();
	// store the username in database to check and see if it already exists
	if ($acc_stmt->num_rows > 0) 
    {
		// Username already exists
		echo 'Username exists, please choose another!';
	} 
    else 
    {
		// insert new account into the accounts database
        if ($acc_stmt = $conn->prepare('INSERT INTO accounts (username, password) VALUES (?, ?)')) {
            // hash the password and use password_verify when a user logs in. ENCRYPTION
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $acc_stmt->bind_param('ss', $_POST['username'], $password);
            $acc_stmt->execute();

            // Add a success message to the URL
            header('Location: login.php?msg=success');
            exit();
        } 
        else 
        {
	        // statement could not be prepared
	        echo 'Could not prepare statement!';
        }
	}
	$acc_stmt->close();
} 
else 
{
	// statement could not be prepared
	echo 'Could not prepare statement!';
}
$conn->close();
?>