<?php
session_start();
 $erreurs = array();

require_once 'connection.php';

if (isset($_POST['Enregestrer'])) {

    $user_id  = $_POST['user_id'];
    $email     = $_POST['email'];
    $password_hash   = $_POST['password_hash'];
    $password_hash_confirm  = $_POST['password_hash_confirm'];

    // Validation
    if (empty($user_id)) {
        $erreurs[] = "user_id is required";
    }

    if (empty($email)) {
        $erreurs[] = "email is required";
    }

    if (empty($password_hash)) {
        $erreurs[] = "password is required";
    }

    if ($password_hash_confirm != $password_hash) {
        $erreurs[] = "The two passwords does not match";
    }

    // Check if email exists
    $req = "SELECT * FROM user WHERE email = '$email'";
    $resultat = mysqli_query($conn, $req);
    $user = mysqli_fetch_assoc($resultat);

    if ($user) {
        $erreurs[] = "email already used";
    }

    // If no errors, insert
    if (count($erreurs) == 0) {
        $password = md5($password_hash);
        $req = "INSERT INTO user (user_id, email, password_hash, user_role, created_at)
                VALUES ('$user_id', '$email', '$password', 'user', NOW())";
        mysqli_query($conn, $req);

        $_SESSION['user_id'] = $user_id;

        header("location:login.php");
        exit();
    }
}

ob_start();
?>

<!-- Custom CSS for specific form enhancements -->
<style>
    .form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        background: #fff;
    }
    .form-header {
        background-color: #212529;
        color: white;
        padding: 30px 0;
        text-align: center;
        margin-bottom: 30px;
    }
    .form-title {
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
        margin: 0;
        position: relative;
        display: inline-block;
    }
    .form-title::after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background: #9a9797;
        margin: 10px auto 0;
        border-radius: 2px;
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
        color: #6c757d;
    }
    .form-control {
        border-left: none;
        padding: 12px 15px;
        background-color: #f8f9fa;
    }
    .form-control:focus {
        box-shadow: none;
        background-color: #fff;
        border-color: #ced4da;
    }
    .btn-custom {
        background-color: #212529;
        color: white;
        padding: 12px;
        border-radius: 30px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background-color: #9a9797;
        color: #212529;
        transform: translateY(-2px);
    }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-6 col-lg-5">
        <div class="card form-card">
            <!-- Header Section matching the dark theme of the site -->
            <div class="form-header rounded-top">
                <h2 class="form-title">Sign Up</h2>
                <p class="mb-0 text-white-50 mt-2 small">Create your T4life account today</p>
            </div>
            
            <div class="card-body p-4 px-md-5">
                
                <!-- Error Handling with Icons -->
                <?php if (count($erreurs) > 0): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-octagon-fill me-3 fs-4"></i>
                        <div>
                            <strong class="me-auto">Error!</strong>
                            <ul class="mb-0 ps-2 mt-1 small">
                                <?php foreach ($erreurs as $erreur): ?>
                                    <li><?php echo $erreur; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="post" action="" autocomplete="off">
                    <!-- User ID Input with Icon -->
                    <div class="mb-4">
                        <label for="user_id" class="form-label text-muted fw-bold small text-uppercase ls-1">User ID</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill border-end-0">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="form-control rounded-end-pill border-start-0 ps-0" id="user_id" name="user_id" placeholder="Enter your username" value="<?php echo htmlspecialchars($_POST['user_id'] ?? ''); ?>">
                        </div>
                    </div>

                    <!-- Email Input with Icon -->
                    <div class="mb-4">
                        <label for="email" class="form-label text-muted fw-bold small text-uppercase ls-1">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill border-end-0">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="text" class="form-control rounded-end-pill border-start-0 ps-0" id="email" name="email" placeholder="name@example.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>

                    <!-- Password Input with Icon -->
                    <div class="mb-4">
                        <label for="password_hash" class="form-label text-muted fw-bold small text-uppercase ls-1">Password</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill border-end-0">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control rounded-end-pill border-start-0 ps-0" id="password_hash" name="password_hash" placeholder="••••••••" autocomplete="new-password">
                        </div>
                    </div>

                    <!-- Confirm Password Input with Icon -->
                    <div class="mb-5">
                        <label for="password_hash_confirm" class="form-label text-muted fw-bold small text-uppercase ls-1">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill border-end-0">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input type="password" class="form-control rounded-end-pill border-start-0 ps-0" id="password_hash_confirm" name="password_hash_confirm" placeholder="••••••••" autocomplete="new-password">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom btn-lg shadow-sm" name="Enregestrer">
                            S'inscrire <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                        </button>
                    </div>
                    
                    <div class="text-center mt-4">
                        <span class="text-muted small">Already a member? </span>
                        <a href="login.php" class="text-decoration-none fw-bold small" style="color: #212529;">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
 $content = ob_get_clean();
include_once "layout.php";
?>