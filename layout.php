<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T4LIFE - Fashion E-commerce</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Custom Styles pour personnaliser Bootstrap */
        :root {
            --primary-color: #9a9797;
            --dark-bg: #212529;
        }

         body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            background-color: #fff;
            overflow-x: hidden;
        }

        /* --- Top Bar --- */
        .top-bar {
            background-color: var(--dark-bg);
            color: #fff;
            font-size: 0.85rem;
            padding: 5px 0;
            text-align: center;
        }

        /* --- Navbar Styles --- */
         /* --- Navbar Styles --- */
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border-radius: 24px;
            border: 1px solid #e0e0e0;
            background-color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .search-btn {
            border-radius: 0 20px 20px 0;
            padding: 0 15px;
        }

    .search-container {
            max-width: 600px;
            width: 100%;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border-radius: 24px;
            border: 1px solid #e0e0e0;
            background-color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            background-color: white;
            border-color: #ccc;
            box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
            outline: none;
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        

        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
        }

        .navbar .nav-link {
            font-weight: 500;
            margin: 0 10px;
            color: #000;
            position: relative;
            transition: color 0.3s;
        }

        .navbar .nav-link:hover::after {
            width: 100%;
        }

        .navbar .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 0;
            height: 2px;
            background: #000;
            transition: width 0.3s;
        }

        /* --- Stylish Modern User Icons --- */
        .icon-btn {
            position: relative;
            margin-left: 10px;
            color: #000;
            font-size: 1.3rem;
            width: 45px;
            height: 45px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .icon-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .badge-count {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #000;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 0.65rem;
            font-weight: bold;
            border: 2px solid #fff;
        }

        .btn-explore {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-explore:hover {
            background-color: #333;
            border-color: #333;
            transform: translateY(-2px);
            color: white;
        }

        /* --- New Modern Auth Buttons Styles --- */
        .btn-login {
            border: 2px solid #000;
            background-color: transparent;
            color: #000;
            border-radius: 25px;
            padding: 7px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #000;
            color: #fff;
        }

        .btn-signup {
            background-color: #000;
            border: 2px solid #000;
            color: #fff;
            border-radius: 25px;
            padding: 7px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-signup:hover {
            color: #fff;
            background-color: #333;
            border-color: #333;
            transform: translateY(-2px);
        }

        main {
            flex: 1;
            padding-top: 20px;
            padding-bottom: 40px;
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--dark-bg);
            color: #fff;
            padding-top: 50px;
        }

        .photo-img {
            max-width: 100px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .3);
            margin-bottom: 20px;
        }

        .information-title,
        .contact-title {
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 1px solid rgba(255, 255, 255, .2);
            display: inline-block;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .information li a {
            color: #bfc4c9;
            transition: .3s;
            text-decoration: none;
        }

        .information li a:hover {
            color: #fff;
            padding-left: 8px;
        }

        .contact-email {
            border: 1px solid #fff;
            padding: 10px 25px;
            border-radius: 30px;
            color: #fff;
            text-decoration: none;
            transition: .3s;
        }

        .contact-email:hover {
            background: #fff;
            color: #000;
        }

        .social-icons a {
            font-size: 1.2rem;
            margin-right: 15px;
            color: #ccc;
            transition: .3s;
        }

        .social-icons a:hover {
            color: white;
            transform: scale(1.15);
        }

        .copyright {
            background: #000;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            font-size: .9rem;
        }

        .logo-3d {
            width: 100px;
            animation: rotate3D 6s linear infinite;
            transform-style: preserve-3d;
        }

        @keyframes rotate3D {
            from {
                transform: rotateY(0deg);
            }

            to {
                transform: rotateY(360deg);
            }
        }
    </style>
</head>

<body>

    <!-- Top Bar -->
    <div class="top-bar">
        Livraison gratuite pour les commandes de 50 € et plus
    </div>
    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <div class="d-flex align-items-center">
                <a class="navbar-brand me-3" href="T4LIFE.php">
                    <img src="photo/logo.png" alt="T4LIFE" class="logo-3d">
                </a>
                <a href="T4LIFE.php" class="btn btn-explore me-3">Explore</a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="T4LIFE.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="collection.php">Collection</a></li>
                    <li class="nav-item"><a class="nav-link" href="Contact.php">Contact</a></li>
                </ul>

                 <form class="d-flex me-3">
                    <div class="input-group">
                        <input class="form-control search-input" type="search" placeholder="Search items...">
                        <button class="btn btn-outline-dark search-btn" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </form>

                <!-- Modern Stylish Icons Block -->
                <?php if(isset($_SESSION['user_id'])): ?>
                <div class="d-flex align-items-center">
                    <a href="profile.php" class="icon-btn" title="Profile">
                        <i class="bi bi-person"></i>
                    </a>
                    <a href="wishlist.php" class="icon-btn" title="Wishlist">
                        <i class="bi bi-heart"></i>
                    </a>
                    <a href="cart.php" class="icon-btn" title="Shopping Cart">
                        <i class="bi bi-bag"></i>
                        <span class="badge-count">0</span>
                    </a>
                    <a href="logout.php" class="icon-btn ms-2" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </div>
                <?php else: ?>
                <div class="d-flex align-items-center">
                    <a href="login.php" class="btn btn-login me-2">Login</a>
                    <a href="sign_up.php" class="btn btn-signup">Sign Up</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <footer>
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 mb-4">
                        <img src="photo/photo.jpg" class="photo-img" alt="">
                        <p>T4life is your go-to destination for premium T-shirts combining comfort quality and modern
                            style</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 text-center mb-4">
                        <h5 class="information-title">Information</h5>
                        <ul class="information list-unstyled">
                            <li><a href="Contact.php">Contact</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="FAQ.php">FAQ</a></li>
                            <li><a href="#">Track Order</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 text-center">
                        <h5 class="contact-title">Contact Us</h5>
                        <p>Have a question or need help? Our team is here for you</p>
                        <a href="mailto:contact@T4life.co" class="contact-email">
                            <i class="bi bi-envelope"></i> contact@T4life.co
                        </a>
                    </div>

                </div>
            </div>

            <div class="copyright">
                © 2026 T4life. All rights reserved.
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


