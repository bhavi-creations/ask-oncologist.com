<?php
// ----------------------------
// Enable error reporting
// ----------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ----------------------------
// Database connection
// ----------------------------
$host = "localhost";
$user = "root";
$pass = "";
$db   = "askoncologist";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ----------------------------
// Handle POST request
// ----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if required POST variables exist
    if(isset($_POST['blog_id'], $_POST['user_name'], $_POST['user_email'], $_POST['comment'])) {

        $blog_id    = intval($_POST['blog_id']);
        $user_name  = trim($conn->real_escape_string($_POST['user_name']));
        $user_email = trim($conn->real_escape_string($_POST['user_email']));
        $comment    = trim($conn->real_escape_string($_POST['comment']));

        // Insert new comment
        $sql = "INSERT INTO blog_comments (blog_id, user_name, user_email, comment, likes, dislikes) 
                VALUES ('$blog_id', '$user_name', '$user_email', '$comment', 0, 0)";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('✅ Comment added successfully!');
                    window.location.href = document.referrer;
                  </script>";
        } else {
            // Show detailed MySQL error
            die("❌ Database Error: " . $conn->error);
        }

    } else {
        die("❌ Error: Missing required form fields.");
    }
}
?>
