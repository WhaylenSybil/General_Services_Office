<?php
// Include your database connection file
// Establish PDO database connection
$host = 'localhost';
$dbname = 'gso_asset';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if propertyID is set in the POST data
if (isset($_POST['propertyID'])) {
    $propertyID = $_POST['propertyID'];

    // Assuming you have a database table named 'accessories' with columns like 'accessoryName', 'accessoryBrand', 'accessorySerialNo', 'accessoryParticulars', 'accessoryCost'
    // Fetch accessory details for the given propertyID
    $sql = "SELECT accessoryName, accessoryBrand, accessorySerialNo, accessoryParticulars, accessoryCost FROM accessories WHERE propertyID = :propertyID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':propertyID', $propertyID);
    $stmt->execute();
    
    // Fetch and display accessory details as HTML table rows
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['accessoryName']}</td>";
        echo "<td>{$row['accessoryBrand']}</td>";
        echo "<td>{$row['accessorySerialNo']}</td>";
        echo "<td>{$row['accessoryParticulars']}</td>";
        echo "<td>{$row['accessoryCost']}</td>";
        echo "</tr>";
    }
} else {
    // If propertyID is not set, handle the error or return a message
    echo "Error: Property ID not provided.";
}
?>