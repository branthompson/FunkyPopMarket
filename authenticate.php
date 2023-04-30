
<!-- authenticate.php is the form action (POST) of login.php
This file connects to the sql server which hold our accounts
table and does various checks like if that account exists or
not, if data is entered correctly, unencrypts (hashes) the password
for security, as well as creates the session to keep track of 
the user -->


<?php
session_start();

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

if ( mysqli_connect_errno() ) 
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
if ( !isset($_POST['username'], $_POST['password']) ) 
{
	// Could not retrieve data, tell user to fill both fields
	exit('Please fill both the username and password fields.');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($acc_stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) 
{
	// Bind parameters (s = string), the username is a string so we use "s"
	$acc_stmt->bind_param('s', $_POST['username']);
	$acc_stmt->execute();
	// store the username in database to check and see if it already exists
	$acc_stmt->store_result();

    if ($acc_stmt->num_rows > 0) 
    {
        $acc_stmt->bind_result($id, $password);
        $acc_stmt->fetch();
        //password_verify unencrypts the hashed password from registering
        if (password_verify($_POST['password'], $password)) 
        {
            // Create sessions, this tracks what user is logged in.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            // when log in is successful, send user to the home page.
            header('Location: home.php');
        } 
        else 
        {
            // Incorrect password
            echo 'Incorrect username and/or password. Please Try Again.';
        }
    } 
    else 
    {
        // Incorrect username
        echo 'Incorrect username and/or password. Please Try Again.';
    }

	$acc_stmt->close();
}
?>