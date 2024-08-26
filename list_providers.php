<?php
$conn = new mysqli('localhost', 'root', 'rambok', 'services_db');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$location = $_GET['location'];
$service = $_GET['service'];

$location = $conn->real_escape_string($location);
$service = $conn->real_escape_string($service);

$sql = "SELECT * FROM service_providers WHERE location LIKE '%$location%'";

// Filter by service if specified
if (!empty($service)) {
    $sql .= " AND services LIKE '%$service%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Location</th><th>Services</th></tr>";
    while($row = $result->fetch_assoc()) {
        // Check if the services offered by the provider match the desired service
        $services_offered = explode(',', $row["services"]);
        if (in_array($service, $services_offered)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["location"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["services"]) . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
} else {
    echo "No results found for the location: " . htmlspecialchars($location);
}

$conn->close();
?>
