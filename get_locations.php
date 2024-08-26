<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', 'rambok', 'services_db');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$sql = "SELECT DISTINCT location FROM service_providers ORDER BY location";
$result = $conn->query($sql);

$locations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row['location'];
    }
}

echo json_encode($locations);

$conn->close();
?>