<?php
$servername = "localhost";
$username= "aaltayyar1";
$password = "aaltayyar1";
$dbname = "aaltayyar1";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// check if a file was uploaded
if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name = addslashes($_POST['image_name']);
    $cost = floatval($_POST['cost']);

    // check if file is an image
    $image_size = getimagesize($_FILES['image']['tmp_name']);
    if ($image_size === false) {
        echo "File is not an image.";
    } else {
        // insert image into database
        $sql = "INSERT INTO funko_pop_images (image_name, image_data, cost) VALUES ('$image_name', '$image', $cost)";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            header('Location: buyerd.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// close database connection
$conn->close();
?>