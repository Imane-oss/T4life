<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop Layout Bootstrap</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Custom Styles pour personnaliser Bootstrap */
        :root {
            --primary-color: #9a9797; /* Bleu Bootstrap */
            --dark-bg: #212529;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* --- Top Bar --- */
        .top-bar {
            background-color: var(--dark-bg);
            color: #ccc;
            font-size: 0.85rem;
            padding: 5px 0;
        }
        .top-bar a {
            color: #ccc;
            text-decoration: none;
            margin-left: 15px;
            transition: color 0.3s;
        }
        .top-bar a:hover {
            color: #fff;
        }

          .contact-title {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 10px;
            display: inline-block;
        }

        .information-title{
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 10px;
            display: inline-block;
        }
        .information{
            font-size: 1.2rem;
            text-decoration: none;
            color: #fff;
            
        }
        .information:hover{
            color: #000000;
        }

        .contact-email {
            font-size: 1.2rem;
            text-decoration: none;
            color: #fff;
            border: 1px solid #fff;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .contact-email:hover {
            background-color: #fff;
            color: #000000;
        }

        /* --- Navbar Styles --- */
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }
        
        .search-input {
            border-radius: 20px 0 0 20px;
            border: 1px solid #ced4da;
        }
        .search-btn {
            border-radius: 0 20px 20px 0;
            padding: 0 15px;
        }

        .icon-btn {
            position: relative;
            margin-left: 15px;
            color: #333;
            font-size: 1.2rem;
        }
        .badge-count {
            position: absolute;
            top: -5px;
            right: -8px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 0.7rem;
        }

        /* --- Main Content Placeholder --- */
        main {
            flex: 1; /* Ykholi yemlli l fou9 w louta */
            padding-top: 20px;
            padding-bottom: 40px;
        }

        /* --- Footer Styles --- */
        footer {
            background-color: var(--dark-bg);
            color: #fff;
            padding-top: 40px;
        }
        footer h5 {
            color: #fff;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        footer ul {
            padding-left: 0;
            list-style: none;
        }
        footer ul li {
            margin-bottom: 10px;
        }
        footer ul li a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
        }
        footer ul li a:hover {
            color: #000000;
            padding-left: 5px;
        }
        .social-icons a {
            font-size: 1.2rem;
            margin-right: 15px;
            color: #ddd8d8;
            transition: color 0.3s;
        }
        .social-icons a:hover {
            color: var(--primary-color);
        }
        .copyright {
            background-color: #010101;
            padding: 15px 0;
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #ffffff;
        }
      #mainNav{
      font-family: 'Poppins', sans-serif;
      transition: color 0.3s ease;
      }
      #mainNav:hover {
      color: black;
      cursor: pointer;
    }
    .photo-img {
    width: 100%;
    max-width: 100px; /* men 350px l 200px bach tkon sghira */
    border-radius: 5px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    margin-bottom: 20px;
}

.logo{
     width: 100%;
    max-width: 100px; /* men 350px l 200px bach tkon sghira */
   
}
/* 3D Logo Animation */
.logo-container {
    perspective: 800px; /* كيعطي العمق 3D */
}

.logo-3d {
    animation: rotate3D 6s linear infinite;
    transform-style: preserve-3d;
}

@keyframes rotate3D {
    from {
        transform: rotateX(20deg) rotateY(0deg);
    }
    to {
        transform: rotateX(20deg) rotateY(360deg);
    }
}

    
    </style>
</head>
<body>

    <!-- 1. Header Section -->
    
    <!-- Top Bar (Tel, Email, Socials) -->
    <div class="top-bar d-none d-md-block">
        <div class="container d-flex justify-content-between">
            <div>
                <span><i class="bi bi-envelope"></i> contact@T4life.tn</span>
                <span class="ms-3"><i class="bi bi-telephone"></i> +216 71 000 000</span>
            </div>
            <div>
                <a href="https://web.facebook.com/mareabykmccompany/?_rdc=1&_rdr#"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/accounts/login/"><i class="bi bi-instagram"></i></a>
               
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand logo-container" href="">
    <img src="logo.png" alt="photo" class="logo logo-3d">
</a>


            <!-- Nav Links & Search -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About Us </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Collection</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex me-3 mb-2 mb-lg-0" role="search">
                    <div class="input-group">
                        <input class="form-control search-input" type="search" placeholder="search your items..." aria-label="Search">
                        <button class="btn btn-outline-primary search-btn" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </form>


                <!-- Icons (User, Wishlist, Cart) -->
                <div class="d-flex align-items-center">
                    <a href="#" class="icon-btn"><i class="bi bi-person"></i></a>
                    <a href="#" class="icon-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="icon-btn">
                        <i class="bi bi-cart3"></i>
                        
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 3. Footer Section -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- About Column -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <img src="photo.jpg" alt="photo" class="photo-img mx-auto mx-md-0" >
                    <p> T4life is your number one destination for online T-shirts.
                         We offer a wide selection of high-quality, comfortable, and stylish T-shirts to suit every taste and occasion. Discover our unique designs and find
                         the perfect T-shirt to complete your style.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                 <!-- Col 3: Customer Care (Track Order, FAQ) -->
                <div class="col-lg-4 col-md-6 text-center pt-5">
                    <h5 class="information-title">Information</h5>
                    <ul class="information">
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Track</a></li>
                        
                    </ul>
                </div>

               <!-- Middle Column: Contact Us -->
            <div class="col-lg-4 col-md-6 text-center">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <h3 class="contact-title">Contact Us</h3>
                    <p >We'd love to hear from you. Whether you have a question about our collections, your order, or simply want to connect — the T4life team is here to help, contact us at :</p>
                    <a href="https://mail.google.com/mail/u/0/" class="contact-email">
                        <i class="far fa-envelope me-2"></i> contact@T4life.co
                    </a>
                </div>
            </div>

        
        <!-- Copyright Bar -->
        <div class="copyright">
            <div class="container">
                <p class="mb-0">&copy; 2026 T4life E-Commerce. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle (Required for Navbar Toggler) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
