<?php
include("config.php");

$username = $_POST['admin_user'];
$password = $_POST['user_password'];

/**
 * thirr funksionin e autentikimit
 */
$authenticate = authenticateAdmin($username, $password, $conn);
$isAuthenticated = $authenticate['authenticated'];

if ($isAuthenticated == 1) {

    $row = $authenticate['row'];
    session_start();
    $_SESSION['admin_logged_in'] = 1;
    $_SESSION['admin_id'] = $row['admin_id'];
    $_SESSION['admin_username'] = $row['admin_username'];
    header('location: ../menaxhimi_dhomave.php');

} else {

    header('location: ../index.php');
}

function authenticateAdmin($username, $password, $conn)
{

    $username = mysqli_real_escape_string($conn, $username);
    $password = md5(mysqli_real_escape_string($conn, $password));

    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_username = ? and admin_password = ?");

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $params = array(
        'row' => $result->fetch_assoc(),
        'authenticated' => $result->num_rows
    );

    $stmt->close();
    $conn->close();
    return $params;
}

?>
