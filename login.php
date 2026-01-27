<?php
session_start();
require_once 'connection.php';
$erreurs = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password_hash'];
    
    if (empty($email)) {
        $erreurs[] = "Email is required";
    }
    if (empty($password)) {
        $erreurs[] = "Password is required";
    }
    
    if (count($erreurs) == 0) {
        $stmt = $conn->prepare("SELECT user_id, password_hash FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (md5($password) == $user['password_hash']) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['user_id'];
                header("Location:index.php");
                exit();
            } else {
                $erreurs[] = "Invalid email or password";
            }
        } else {
            $erreurs[] = "Invalid email or password";
        }
        $stmt->close();
    }
}

ob_start();
?>

    <style>
        :root {
            --primary-color: #212529;
            --accent-color: #9a9797;
            --light-bg: #f8f9fa;
            --error-color: #e0245e;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            background-color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header */
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        
        .logo {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        
        .logo span {
            color: var(--accent-color);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        
        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 450px;
        }
        
        .login-card {
            background-color: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
        }
        
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        
        .login-subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
            font-size: 1rem;
        }
        
        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #444;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #ccc;
            box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
            outline: none;
        }
        
        .form-control.is-invalid {
            border-color: var(--error-color);
        }
        
        .invalid-feedback {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 5px;
        }
        
        .btn-login {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 24px;
            padding: 14px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            background-color: #333;
            color: white;
        }
        
        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: #999;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }
        
        /* Social Login */
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .btn-social {
            flex: 1;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 10px;
            background-color: white;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-social:hover {
            background-color: #f9f9f9;
            border-color: #ccc;
        }
        
        .btn-social i {
            font-size: 1.5rem;
        }
        
        .btn-google i {
            color: #DB4437;
        }
        
        .btn-facebook i {
            color: #4267B2;
        }
        
        /* Links */
        .form-links {
            text-align: center;
            margin-top: 25px;
        }
        
        .form-links a {
            color: #444;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .form-links a:hover {
            color: var(--accent-color);
        }
        
        .signup-link {
            display: block;
            margin-top: 15px;
            padding: 12px;
            background-color: #f9f9f9;
            border-radius: 12px;
            text-align: center;
        }
        
        .signup-link span {
            color: #777;
        }
        
        .signup-link a {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        /* Error Message */
        .error-message {
            background-color: rgba(224, 36, 94, 0.1);
            color: var(--error-color);
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }
        
        .error-message i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        /* Footer */
        .footer {
            background-color: white;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 10px;
        }
        
        .footer-link {
            color: #555;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        
        .footer-link:hover {
            color: var(--primary-color);
        }
        
        .copyright {
            color: #888;
            font-size: 0.85rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 30px 20px;
            }
            
            .login-title {
                font-size: 1.75rem;
            }
        }
    </style>



    <!-- Main Content -->
    <div class="main-content">
        <div class="login-container">
            <div class="login-card">
                <h1 class="login-title">Welcome back</h1>
                <p class="login-subtitle">Log in to your T4LIFE account</p>
                
                <?php if (count($erreurs) > 0): ?>
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <?php foreach ($erreurs as $erreur): ?>
                            <?php echo $erreur; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="" autocomplete="off">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?php echo isset($erreurs) && in_array("email is required", $erreurs) ? 'is-invalid' : ''; ?>" 
                               id="email" name="email" placeholder="Enter your email" 
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="password_hash" class="form-label">Password</label>
                        <input type="password" class="form-control <?php echo isset($erreurs) && in_array("password is required", $erreurs) ? 'is-invalid' : ''; ?>" 
                               id="password_hash" name="password_hash" placeholder="Enter your password" 
                               autocomplete="current-password">
                    </div>
                    
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="text-decoration-none fw-medium" style="color: var(--accent-color);">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-login" name="login">Log in</button>
                </form>
                
                <div class="form-links">
                    <a href="#">Trouble logging in?</a>
                </div>
                
                <div class="signup-link">
                    <span>Not on T4LIFE yet? </span>
                    <a href="sign_up.php">Sign up</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form validation on submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password_hash');
            
            let isValid = true;
            
            if (!email.value) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
            }
            
            if (!password.value) {
                password.classList.add('is-invalid');
                isValid = false;
            } else {
                password.classList.remove('is-invalid');
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        // Clear invalid class on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    </script>
<?php
$content = ob_get_clean();
include_once 'layout.php';
?>