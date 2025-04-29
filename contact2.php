<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <?php include 'navbar2.php'; ?>

<!-- Centered Logo and Title -->
            <div class="navbar-brand-center text-center mx-auto">
                <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
                <div class="school-title">Boca Secondary School</div>
            </div>

    <div class="container mt-5 mb-5 info-section">
        <h2 class="text-center mb-3">Contact Us</h2>
        <p class="text-center mb-4">Have questions? Get in touch with us using the information or form below.</p>

        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-6 mb-4">
                <h4>School Address</h4>
                <p><strong>Boca Secondary School</strong></p>
                <p>Boca, St. George, Grenada</p>
                <p><strong>Email:</strong> bss@moe.edu.gd</p>
                <p><strong>Phone:</strong> +1 (473) 440-2608</p>
                <p><strong>WhatsApp:</strong> +1 (473) 421-3176</p>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <h4>Send Us a Message</h4>
                <form action="process_contact.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Send Message</button>
                </form>
            </div>
        </div>
    </div>

<!-- Include Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>

</body>
</html>
