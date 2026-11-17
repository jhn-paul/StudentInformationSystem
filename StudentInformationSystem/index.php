<?php

require_once "students.php";
require_once "functions.php";

$keyword = isset($_GET["search"]) ? trim($_GET["search"]) : "";

$filteredStudents = searchStudents($students, $keyword);

$totalStudents = countStudents($students);
$activeStudents = countActiveStudents($students);
$shownStudents = countStudents($filteredStudents);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Information System</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="app-shell">

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-mark">S</div>

            <div>
                <h1>Student<span>Hub</span></h1>
                <p>INFORMATION SYSTEM</p>
            </div>
        </div>

        <nav class="navigation">
            <a href="index.php" class="nav-link active">
                ▦ &nbsp; Dashboard
            </a>

            <a href="#student-records" class="nav-link">
                ▤ &nbsp; Student Records
            </a>
        </nav>

        <div class="sidebar-note">
            <span class="note-dot"></span>

            <div>
                <strong>System status</strong>
                <small>All records are loaded</small>
            </div>
        </div>

        <div class="sidebar-footer">
            PHP MINI PROJECT · 2026
        </div>

    </aside>


    <main class="main-content">

        <header class="topbar">

            <div>
                <p class="eyebrow">OVERVIEW / STUDENTS</p>
                <h2>Dashboard</h2>
            </div>

            <div class="profile">
                <div class="profile-avatar">AD</div>

                <div>
                    <strong>Administrator</strong>
                    <small>School Records</small>
                </div>
            </div>

        </header>


        <section class="welcome">

            <div>
                <p class="eyebrow light">STUDENT MANAGEMENT</p>

                <h3>
                    Student Information<br>
                    System
                </h3>

                <p class="welcome-copy">
                    A simple dashboard for viewing, organizing,
                    and searching student records.
                </p>
            </div>

            <div class="welcome-art">
                <div class="art-card">
                    <span>STUDENT DATA</span>
                    <strong><?php echo e($totalStudents); ?></strong>
                    <small>Records available</small>
                </div>
            </div>

        </section>


        <section class="stats-grid">

            <article class="stat-card">
                <div class="stat-label">TOTAL STUDENTS</div>

                <strong class="stat-number">
                    <?php echo e($totalStudents); ?>
                </strong>

                <p>All registered sample records</p>
            </article>


            <article class="stat-card">
                <div class="stat-label">ACTIVE STUDENTS</div>

                <strong class="stat-number">
                    <?php echo e($activeStudents); ?>
                </strong>

                <p>Currently marked as active</p>
            </article>


            <article class="stat-card">
                <div class="stat-label">RECORDS SHOWN</div>

                <strong class="stat-number">
                    <?php echo e($shownStudents); ?>
                </strong>

                <p>Based on your current search</p>
            </article>

        </section>


        <section class="records-section" id="student-records">

            <div class="section-heading">

                <div>
                    <p class="eyebrow">DATABASE / DIRECTORY</p>

                    <h3>Student Records</h3>

                    <p class="section-description">
                        Browse the student information stored in the PHP array.
                    </p>
                </div>

                <span class="record-count">
                    <?php echo e($shownStudents); ?> RECORDS
                </span>

            </div>


            <form class="search-form" action="index.php" method="GET">

                <input
                    type="text"
                    name="search"
                    placeholder="Search student..."
                    value="<?php echo e($keyword); ?>"
                >

                <button type="submit">Search</button>

                <?php if ($keyword !== ""): ?>
                    <a href="index.php" class="clear-search">Clear</a>
                <?php endif; ?>

            </form>


            <div class="table-wrap">

                <table>

                    <thead>
                        <tr>
                            <th>STUDENT ID</th>
                            <th>STUDENT NAME</th>
                            <th>COURSE</th>
                            <th>YEAR LEVEL</th>
                            <th>EMAIL ADDRESS</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($shownStudents > 0): ?>

                            <?php foreach ($filteredStudents as $student): ?>

                                <tr>

                                    <td class="student-id">
                                        <?php echo e($student["id"]); ?>
                                    </td>

                                    <td>
                                        <strong>
                                            <?php echo e(displayName($student["name"])); ?>
                                        </strong>
                                    </td>

                                    <td>
                                        <?php echo e($student["course"]); ?>
                                    </td>

                                    <td>
                                        <?php echo e($student["year"]); ?>
                                    </td>

                                    <td>
                                        <?php echo e($student["email"]); ?>
                                    </td>

                                    <td>
                                        <span class="status <?php echo strtolower($student["status"]) === "active" ? "status-active" : "status-inactive"; ?>">
                                            <?php echo e($student["status"]); ?>
                                        </span>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="empty-state">
                                    No student records found.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <div class="table-footer">
                Showing <?php echo e($shownStudents); ?>
                of <?php echo e($totalStudents); ?> student records
            </div>

        </section>


        <footer class="page-footer">
            StudentHub · PHP Information Management System
        </footer>

    </main>

</div>

</body>
</html>