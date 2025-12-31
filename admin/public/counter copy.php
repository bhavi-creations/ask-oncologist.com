<?php
include './db.connection/db_connection.php';

$page = basename($_SERVER['PHP_SELF']);

// Unique cookie per page per device
$cookie_name = "visited_page_" . md5($page);

// If this device has NOT visited this page before
if (!isset($_COOKIE[$cookie_name])) {

    // Set cookie for 1 year (device-based)
    // setcookie($cookie_name, 'yes', time() + (60 * 60 * 24 * 365), "/");

    // Check if page exists in DB
    $stmt = $conn->prepare(
        "SELECT visit_count FROM visitors WHERE page_name = ?"
    );
    $stmt->bind_param("s", $page);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Increment count
        $update = $conn->prepare(
            "UPDATE visitors 
             SET visit_count = visit_count + 1 
             WHERE page_name = ?"
        );
        $update->bind_param("s", $page);
        $update->execute();
    } else {
        // First visit ever for this page
        $insert = $conn->prepare(
            "INSERT INTO visitors (page_name, visit_count) 
             VALUES (?, 1)"
        );
        $insert->bind_param("s", $page);
        $insert->execute();
    }
}
?>
