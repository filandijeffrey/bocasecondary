<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION["user_id"]);
$user_role = $_SESSION["role"] ?? null;
?>

<!-- Navbar -->
<nav class="navbar navbar-dark navbar-custom sticky-top">
    <div class="container position-relative">

        <!-- Left: Collapsible Toggle -->
        <div class="d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Center: Logo and School Name 
        <div class="navbar-brand-center position-absolute top-50 start-50 translate-middle-x translate-middle-y text-center">
            <img src="BocaLogo.png" alt="School Logo" class="school-logo">
            <div class="school-title">Boca Secondary School</div>
        </div> -->

        <!-- Right: Login/Logout and Dashboard Buttons -->
        <div class="top-buttons d-flex ms-auto">
            <?php if ($is_logged_in): ?>
                <a href="<?php 
                    if ($user_role === 'teacher') echo 'teacher_dashboard.php';
                    elseif ($user_role === 'student') echo 'student_dashboard.php';
                    elseif ($user_role === 'parent') echo 'parent_dashboard.php';
                    else echo 'login.php';
                ?>" class="btn btn-outline-light me-2">Dashboard</a>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            <?php else: ?>
                <a href="login2.php" class="btn btn-success me-2">Login</a>
                <a href="login2.php" class="btn btn-outline-light">Dashboard</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Collapsible Menu Items -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav text-center w-100">
            <li class="nav-item"><a class="nav-link" href="index2.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about2.php">About</a></li>
            <li class="nav-item"><a class="nav-link" href="gallery2.php">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="contact2.php">Contact</a></li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const navbarCollapse = document.getElementById('navbarNavDropdown');

        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: false
                });
                bsCollapse.hide();
            });
        });
    });
</script>

<style>
.navbar-custom {
    background-color: #343a40;
    padding-top: 10px;
    padding-bottom: 10px;
    position: relative;
}

.navbar-nav .nav-link,
.dropdown-item {
    color: white !important;
}

.navbar-nav .nav-link:hover,
.dropdown-item:hover {
    background-color: #28a745 !important;
    color: white !important;
}

.dropdown-menu {
    background-color: #343a40;
}

/* Centering the logo container */
.navbar-brand-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.school-logo {
    max-height: 80px;
    margin-bottom: 5px;
}

.school-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
}

/* Top buttons (Login/Dashboard) */
.top-buttons .btn {
    font-size: 14px;
}
</style>
