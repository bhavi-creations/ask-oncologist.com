<?php

include './db.connection/db_connection.php';

// Service filter
$service = isset($_GET['service']) ? trim($_GET['service']) : '';

$result = null;
$stmt   = null;

// Database available unte matrame query execute cheyyali
if ($conn instanceof mysqli && !$conn->connect_errno) {

    $sql = "
        SELECT
            id,
            slug,
            title,
            main_content,
            main_image,
            created_at
        FROM blogs
    ";

    if (!empty($service)) {
        $sql .= " WHERE service = ?";
    }

    $sql .= " ORDER BY created_at DESC";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        if (!empty($service)) {
            $stmt->bind_param("s", $service);
        }

        $stmt->execute();

        $result = $stmt->get_result();
    }
}

?>

<?php include 'navbar.php'; ?>


<style>

.post-box {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.box-content {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.post-desc {
    flex-grow: 1;
}

.blog-date {
    margin-top: 10px;
    font-size: 13px;
    background: #000;
    color: #fff;
    display: inline-block;
    padding: 6px 12px;
    border-radius: 4px;
    font-weight: 600;
}

.blog_section {
    display: flex;
    justify-content: center;
    margin: 20px 0px;
}

.database-message {
    text-align: center;
    padding: 40px 20px;
    font-size: 16px;
}

</style>


<main class="blog_section_stylings" style="margin-top: 220px;">

    <div class="blog_section">
        <h1>Blogs</h1>
    </div>


    <div
        class="container blog-sidebar-list"
        style="padding-top:20px; padding-bottom:20px;"
    >

        <div class="row">

            <div class="col-lg-12">

                <div class="grid row">

                    <?php

                    if ($result && $result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {

                            // ==============================
                            // Image
                            // ==============================

                            if (!empty($row['main_image'])) {

                                $image_path =
                                    "admin/uploads/photos/" .
                                    htmlspecialchars(
                                        $row['main_image'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                            } else {

                                $image_path = "default_image.png";
                            }


                            // ==============================
                            // Blog URL
                            // ==============================

                            if (!empty($row['slug'])) {

                                $blog_link_val =
                                    urlencode($row['slug']);

                            } else {

                                $blog_link_val =
                                    (int)$row['id'];
                            }

                            $final_url =
                                "fullblog.php?id=" .
                                $blog_link_val;


                            // ==============================
                            // Date
                            // ==============================

                            $formatted_date =
                                date(
                                    "d M Y, h:i A",
                                    strtotime($row['created_at'])
                                );


                            // ==============================
                            // Preview Content
                            // ==============================

                            $clean_content =
                                strip_tags(
                                    html_entity_decode(
                                        $row['main_content']
                                    )
                                );

                            $preview =
                                mb_substr(
                                    $clean_content,
                                    0,
                                    100
                                );


                            // ==============================
                            // Safe Title
                            // ==============================

                            $safe_title =
                                htmlspecialchars(
                                    $row['title'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                );


                            // ==============================
                            // Blog Card
                            // ==============================

                            echo "

                            <div class='grid-item col-sm-12 col-lg-4 mb-5'>

                                <div class='post-box card_bg_div_box'>

                                    <figure>

                                        <a href='{$final_url}'>

                                            <img
                                                src='{$image_path}'
                                                alt='{$safe_title}'
                                                class='img-fluid blog_box_image'
                                            >

                                        </a>

                                    </figure>


                                    <div class='box-content'>

                                        <h5 class='box-title'>

                                            <a
                                                class='box-title'
                                                href='{$final_url}'
                                            >
                                                {$safe_title}
                                            </a>

                                        </h5>


                                        <p
                                            class='post-desc mt-3'
                                            style='text-align:justify;'
                                        >
                                            {$preview}...
                                        </p>


                                        <a href='{$final_url}'>

                                            <button
                                                class='blog_main_btn'
                                                type='button'
                                            >
                                                Read More..
                                            </button>

                                        </a>


                                        <p class='blog-date'>
                                            🕒 {$formatted_date}
                                        </p>

                                    </div>

                                </div>

                            </div>

                            ";
                        }

                    } elseif ($conn === null) {

                        // MySQL currently unavailable
                        echo "
                            <div class='col-12 database-message'>
                                <p>
                                    Blogs are temporarily unavailable.
                                </p>
                            </div>
                        ";

                    } else {

                        echo "
                            <div class='col-12 database-message'>
                                <p>No blog posts found.</p>
                            </div>
                        ";
                    }

                    ?>

                </div>

            </div>

        </div>

    </div>

</main>


<?php include './footer.php'; ?>


<?php

if ($stmt instanceof mysqli_stmt) {
    $stmt->close();
}

if ($conn instanceof mysqli) {
    $conn->close();
}

?>