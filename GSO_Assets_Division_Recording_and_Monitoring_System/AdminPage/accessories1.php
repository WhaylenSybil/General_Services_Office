<?php
require('./../database/connection.php');
require('../loginPage/login_session.php');

// Establish a connection to the database
$mysqli = new mysqli("localhost", "root", "", "gso_asset");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$accessories = array();
// Query to retrieve data from the 'accessories' table
$sql = "SELECT accessoryName, accessoryBrand, accessorySerialNo, accessoryParticulars, accessoryCost FROM accessories WHERE propertyID = ? ";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Bind the parameter
$propertyID = $_GET['propertyID']; // Assuming propertyID is passed through GET
$stmt->bind_param("i", $propertyID); // Assuming propertyID is an integer

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if the query was successful
if ($result) {
    // Initialize an empty array to store the fetched data
    $accessories = array();

    // Fetch associative array for each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Append each row to the $accessories array
        $accessories[] = $row;
    }

    // Free result set
    $result->free();
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close the statement
$stmt->close();

// Close the connection
$mysqli->close();

// Output the result
// echo "<pre>";
// print_r($accessories);
// echo "</pre>";
// ?>
