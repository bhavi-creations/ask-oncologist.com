<?php
include '../../db.connection/db_connection.php';

// Allowed image formats
$allowedImageFormats = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

// Function to generate a unique file name
function generateUniqueFileName($fileName) {
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    return uniqid() . '_' . time() . '.' . $ext;
}

// Function to upload files
function uploadFile($fileKey, $uploadDir, $allowedFormats = []) {
    if (!empty($_FILES[$fileKey]['name'])) {
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $ext = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
        if(!empty($allowedFormats) && !in_array($ext, $allowedFormats)) {
            die("Error: Invalid file format for $fileKey.");
        }

        $fileName = generateUniqueFileName($_FILES[$fileKey]['name']);
        $destination = rtrim($uploadDir, '/') . '/' . $fileName;

        if(move_uploaded_file($_FILES[$fileKey]['tmp_name'], $destination)) {
            return $fileName; // Only store the filename, not full path
        } else {
            die("Error uploading $fileKey to $destination. Check folder permissions.");
        }
    }
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $blog_id      = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title        = trim($_POST['title'] ?? '');
    $main_content = trim($_POST['main_content'] ?? '');
    $full_content = trim($_POST['full_content'] ?? '');
    $service      = trim($_POST['service'] ?? '');

    if (empty($title) || empty($main_content) || empty($full_content) || empty($service)) {
        die("Error: Title, Main Content, Full Content, and Service cannot be empty.");
    }

    // Upload directories (ensure they exist and are writable)
    $uploadsDir = __DIR__ . "/../uploads/photos/";
    $videosDir  = __DIR__ . "/../uploads/videos/";

    // Upload main files
    $title_image_path = uploadFile('title_image', $uploadsDir, $allowedImageFormats);
    $main_image_path  = uploadFile('main_image', $uploadsDir, $allowedImageFormats);
    $video_path       = uploadFile('video', $videosDir);

    // Sections content & images
    $section_contents = [];
    $section_images   = [];
    for($i=1; $i<=3; $i++){
        $section_contents[$i] = $_POST["section{$i}_content"] ?? '';
        $section_images[$i] = uploadFile("section{$i}_image", $uploadsDir, $allowedImageFormats);
    }

    // If editing, preserve existing files if no new upload
    if ($blog_id > 0) {
        $existing = $conn->query("SELECT * FROM blogs WHERE id=$blog_id")->fetch_assoc();

        $title_image_path = $title_image_path ?: ($existing['title_image'] ?? '');
        $main_image_path  = $main_image_path  ?: ($existing['main_image'] ?? '');
        $video_path       = $video_path       ?: ($existing['video'] ?? '');
        for($i=1;$i<=3;$i++){
            $section_images[$i] = $section_images[$i] ?: ($existing["section{$i}_image"] ?? '');
            $section_contents[$i] = $section_contents[$i] ?: ($existing["section{$i}_content"] ?? '');
        }
    }

    // Prepare SQL
    if ($blog_id > 0) {
        // UPDATE
        $stmt = $conn->prepare("UPDATE blogs 
            SET title=?, main_content=?, full_content=?, title_image=?, main_image=?, video=?, service=?,
                section1_content=?, section1_image=?,
                section2_content=?, section2_image=?,
                section3_content=?, section3_image=?
            WHERE id=?");
        $stmt->bind_param(
            "sssssssssssssi",
            $title,
            $main_content,
            $full_content,
            $title_image_path,
            $main_image_path,
            $video_path,
            $service,
            $section_contents[1],
            $section_images[1],
            $section_contents[2],
            $section_images[2],
            $section_contents[3],
            $section_images[3],
            $blog_id
        );
    } else {
        // INSERT
        $stmt = $conn->prepare("INSERT INTO blogs 
            (title, main_content, full_content, title_image, main_image, video, service,
             section1_content, section1_image,
             section2_content, section2_image,
             section3_content, section3_image, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param(
            "sssssssssssss",
            $title,
            $main_content,
            $full_content,
            $title_image_path,
            $main_image_path,
            $video_path,
            $service,
            $section_contents[1],
            $section_images[1],
            $section_contents[2],
            $section_images[2],
            $section_contents[3],
            $section_images[3]
        );
    }

    // Execute
    if ($stmt->execute()) {
        header("Location: allBlog.php");
        exit();
    } else {
        die("Database error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
