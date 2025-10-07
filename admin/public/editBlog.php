<?php
// Database connection
include '../../db.connection/db_connection.php';

// Get blog ID from URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Initialize variables
$title = $service = $main_content = $full_content = '';
$main_image = $video = '';
$section_contents = [1 => '', 2 => '', 3 => ''];
$section_images = [1 => '', 2 => '', 3 => ''];

if ($blog_id > 0) {
    $result = $conn->query("SELECT * FROM blogs WHERE id=$blog_id");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $service = $row['service'];
        $main_content = $row['main_content'];
        $full_content = $row['full_content'];
        $main_image = $row['main_image'];
        $video = $row['video'];
        $section_contents[1] = $row['section1_content'];
        $section_contents[2] = $row['section2_content'];
        $section_contents[3] = $row['section3_content'];
        $section_images[1] = $row['section1_image'];
        $section_images[2] = $row['section2_image'];
        $section_images[3] = $row['section3_image'];
    }
} else {
    echo "Invalid blog ID.";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ask Oncologist - Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navbar.php'; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit BLOG</h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-11">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">EDIT CONTENT</h6>
                                </div>
                                <div class="card-body">

                                    <form id="editblogform" action="addBlog.php" method="POST" enctype="multipart/form-data" style="color:black;">
                                        <input type="hidden" name="id" value="<?php echo $blog_id; ?>">

                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">ENTER TITLE</label>
                                            <input type="text" class="form-control" name='title' value="<?php echo htmlspecialchars($title); ?>" required>
                                        </div>

                                        <!-- Service Dropdown -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Select Service:</label>
                                            <select name="service" class="form-control" required>
                                                <option value="">Select a Service</option>
                                                <?php
                                                $services = [
                                                    "Bladder Cancer", "Brain Cancer", "Cervical Cancer", "Childhood Cancer", "Colon Cancer",
                                                    "Esophageal Cancer", "Kidney Cancer", "Leiomyosarcoma Cancer", "Leukemia Cancer", "Liver Cancer",
                                                    "Lung Cancer", "Lymphoma Cancer", "Melanoma Cancer", "Ovarian Cancer", "Pancreatic Cancer",
                                                    "Prostate Cancer", "Sarcoma/Bone Cancer", "Stomach Cancer", "Testicular Cancer", "Uterine Cancer",
                                                    "Head Neck Cancer", "Breast Cancer", "Multiple Cancer", "Honors Cancer", "Other"
                                                ];
                                                foreach ($services as $s) {
                                                    $selected = ($service == $s) ? 'selected' : '';
                                                    echo "<option value=\"$s\" $selected>$s</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Main Content -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">ENTER MAIN CONTENT</label>
                                            <div id="mainEditor" style="height:200px;"></div>
                                            <input type="hidden" name="main_content" id="mainContentData">
                                        </div>

                                        <!-- Main Image -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Choose Main Image</label>
                                            <input type="file" name="main_image" class="form-control">
                                            <?php if (!empty($main_image)) { ?>
                                                <img src="uploads/blogs/<?php echo $main_image; ?>" style="max-width:200px;" class="img-thumbnail mt-2">
                                            <?php } ?>
                                        </div>

                                        <!-- Video -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Choose Video</label>
                                            <input type="file" name="video" class="form-control">
                                            <?php if (!empty($video)) { ?>
                                                <video width="300" controls class="mt-2">
                                                    <source src="uploads/blogs/<?php echo $video; ?>" type="video/mp4">
                                                </video>
                                            <?php } ?>
                                        </div>

                                        <!-- Full Content -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">ENTER FULL CONTENT</label>
                                            <div id="editor" style="height:400px;"></div>
                                            <input type="hidden" name="full_content" id="formcontentdata">
                                        </div>

                                        <!-- Sections -->
                                        <?php for ($i = 1; $i <= 3; $i++): ?>
                                            <div class="mb-3">
                                                <label class="form-label text-primary">Section <?php echo $i; ?> Content</label>
                                                <div id="editor<?php echo $i; ?>" style="height:200px;"></div>
                                                <input type="hidden" name="section<?php echo $i; ?>_content" id="sectionContent<?php echo $i; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-primary">Section <?php echo $i; ?> Image</label>
                                                <input type="file" name="section<?php echo $i; ?>_image" class="form-control">
                                                <?php if (!empty($section_images[$i])) { ?>
                                                    <img src="uploads/blogs/<?php echo $section_images[$i]; ?>" style="max-width:200px;" class="img-thumbnail mt-2">
                                                <?php } ?>
                                            </div>
                                        <?php endfor; ?>

                                        <!-- Buttons -->
                                        <div class='row p-3'>
                                            <div class='col-xl-7'></div>
                                            <button type='reset' class='btn btn-danger mx-1 my-2 col-xl-2'>Clear</button>
                                            <button type='submit' class='btn btn-success mx-1 my-2 col-xl-2'>Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        const toolbarOptions = [
            [{'header': '1'}, {'header': '2'}, {'font': []}],
            [{'size': []}],
            ['bold', 'italic', 'underline', 'strike'],
            [{'color': []}, {'background': []}],
            ['link', 'blockquote'],
            [{'list': 'ordered'}, {'list': 'bullet'}],
            [{'indent': '-1'}, {'indent': '+1'}],
            [{'direction': 'rtl'}],
            [{'align': []}],
            ['clean']
        ];

        const quillMain = new Quill('#mainEditor', { theme: 'snow', modules: { toolbar: toolbarOptions } });
        const quillFull = new Quill('#editor', { theme: 'snow', modules: { toolbar: toolbarOptions } });
        const quill1 = new Quill('#editor1', { theme: 'snow', modules: { toolbar: toolbarOptions } });
        const quill2 = new Quill('#editor2', { theme: 'snow', modules: { toolbar: toolbarOptions } });
        const quill3 = new Quill('#editor3', { theme: 'snow', modules: { toolbar: toolbarOptions } });

        // Load existing content
        quillMain.root.innerHTML = <?php echo json_encode($main_content); ?>;
        quillFull.root.innerHTML = <?php echo json_encode($full_content); ?>;
        quill1.root.innerHTML = <?php echo json_encode($section_contents[1]); ?>;
        quill2.root.innerHTML = <?php echo json_encode($section_contents[2]); ?>;
        quill3.root.innerHTML = <?php echo json_encode($section_contents[3]); ?>;

        // On submit
        document.querySelector('#editblogform').onsubmit = function() {
            document.querySelector('#mainContentData').value = quillMain.root.innerHTML;
            document.querySelector('#formcontentdata').value = quillFull.root.innerHTML;
            document.querySelector('#sectionContent1').value = quill1.root.innerHTML;
            document.querySelector('#sectionContent2').value = quill2.root.innerHTML;
            document.querySelector('#sectionContent3').value = quill3.root.innerHTML;
        };
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
