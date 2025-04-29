<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Boca Secondary School</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles3.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>
<body>

    <?php include 'navbar2.php'; ?>

            <!-- Toggler for Mobile 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>-->

            <!-- Centered Logo and Title -->
            <div class="navbar-brand-center text-center mx-auto">
                <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
                <div class="school-title">Boca Secondary School</div>
            </div>

            <!-- Dropdown Menu 
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown">
                            Menu
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="menuDropdown">
                            <li><a class="dropdown-item" href="index2.php">Home</a></li>
                            <li><a class="dropdown-item" href="about2.php">About</a></li>
                            <li><a class="dropdown-item" href="gallery2.php">Gallery</a></li>
                            <li><a class="dropdown-item" href="contact2.php">Contact</a></li>
                            <li><a class="dropdown-item" href="login2.php">Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>-->

    <!-- Slideshow Carousel -->
    <div id="schoolCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="BocaNice.jpg" class="d-block w-100" alt="School Image 1" />
                <div class="carousel-caption">
                    <h5>Empowering Students</h5>
                    <p>Dedicated to academic excellence and growth.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="BocaNetball.jpg" class="d-block w-100" alt="School Image 2" />
                <div class="carousel-caption">
                    <h5>Sports & Discipline</h5>
                    <p>Building strength and teamwork through athletics.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="BocaGirls.jpg" class="d-block w-100" alt="School Image 3" />
                <div class="carousel-caption">
                    <h5>Creativity in Learning</h5>
                    <p>Empowering students through arts and culture.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="BocaJr.jpg" class="d-block w-100" alt="School Image 4" />
                <div class="carousel-caption">
                    <h5>Future Leaders</h5>
                    <p>Fostering responsibility and leadership.</p>
                </div>
        </div>
		<div class="carousel-item">
                <img src="EnProj.jpg" class="d-block w-100" alt="School Image 4" />
                <div class="carousel-caption">
                    <h5>Future Leaders</h5>
                    <p>Fostering responsibility and leadership.</p>
                </div>
            </div>
			<!-- <div class="carousel-item">
                <img src="ScienceFair.jpg" class="d-block w-100" alt="School Image 4" />
                <div class="carousel-caption">
                    <h5>Future Leaders</h5>
                    <p>Fostering responsibility and leadership.</p>
                </div>-->
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#schoolCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#schoolCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- School Information Section -->
    <div class="container info-section text-center">
        <h2>Welcome to Boca Secondary School</h2>
        <p>We are committed to delivering a quality education that nurtures minds and shapes futures.</p>
        <p>Our grading system is built to promote fairness and reflect true academic achievement.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<?php include 'footer.php'; ?>
</body>
</html>
