<?php
/**
 * core config file to connect with database
 */
$servername = "localhost";
$username = "root";
$password = "root";
$database = 'arberia_hotel';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
