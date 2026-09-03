<?php

include __DIR__ . '/db.connection/db_connection.php';

$page  = basename($_SERVER['PHP_SELF']);
$ip    = $_SERVER['REMOTE_ADDR'];
$today = date('Y-m-d');

$totalCount = 0;
$pageCount  = 0;

// ==========================================
// Database available unte matrame execute cheyyi
// ==========================================
if ($conn !== null && $conn instanceof mysqli && !$conn->connect_errno) {

    // ===============================
    // Record visitor
    // once per page per day
    // ===============================
    $check = $conn->prepare("
        SELECT id
        FROM visitor_logs
        WHERE page_name = ?
        AND ip_address = ?
        AND visit_date = ?
        LIMIT 1
    ");

    if ($check) {

        $check->bind_param("sss", $page, $ip, $today);
        $check->execute();

        $res = $check->get_result();

        if ($res && $res->num_rows == 0) {

            $city = 'Unknown';

            $ins = $conn->prepare("
                INSERT INTO visitor_logs
                (
                    page_name,
                    ip_address,
                    visit_date,
                    visited_at,
                    city
                )
                VALUES (?, ?, ?, NOW(), ?)
            ");

            if ($ins) {

                $ins->bind_param(
                    "ssss",
                    $page,
                    $ip,
                    $today,
                    $city
                );

                $ins->execute();
                $ins->close();
            }
        }

        $check->close();
    }


    // ===============================
    // Total Website Visitors
    // ===============================
    $totalRes = $conn->query("
        SELECT COUNT(DISTINCT ip_address) AS total
        FROM visitor_logs
    ");

    if ($totalRes) {

        $totalRow = $totalRes->fetch_assoc();

        if ($totalRow) {
            $totalCount = $totalRow['total'] ?? 0;
        }
    }


    // ===============================
    // Current Page Visitors
    // ===============================
    $pstmt = $conn->prepare("
        SELECT COUNT(DISTINCT ip_address) AS total
        FROM visitor_logs
        WHERE page_name = ?
    ");

    if ($pstmt) {

        $pstmt->bind_param("s", $page);
        $pstmt->execute();

        $pageRes = $pstmt->get_result();

        if ($pageRes) {

            $pageRow = $pageRes->fetch_assoc();

            if ($pageRow) {
                $pageCount = $pageRow['total'] ?? 0;
            }
        }

        $pstmt->close();
    }
}

?>

<style>
#visitor-eye {
    position: relative;
    display: inline-block;
}

#visitor-eye .visitor-tooltip {
    display: none;
    position: absolute;
    z-index: 9999;
    background: #ffffff;
    padding: 10px 15px;
    border-radius: 8px;
    min-width: 220px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

#visitor-eye:hover .visitor-tooltip {
    display: block;
}
</style>


<a href="visitor-analytics.php" id="visitor-eye">

    <img
        src="./assets/img/eye.png"
        style="width:30px;height:30px;"
        alt="Visitor Analytics"
    >

    <div class="visitor-tooltip">

        <div>
            Total Website Visitors:
            <b><?= htmlspecialchars((string)$totalCount) ?></b>
        </div>

        <div>
            This Page Visitors:
            <b><?= htmlspecialchars((string)$pageCount) ?></b>
        </div>

    </div>

</a>