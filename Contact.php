<?php
session_start();
require_once 'connection.php';
$customer_id = $_SESSION['customer_id'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $message = htmlspecialchars($_POST['message']);
    $subject = "Contact Form Message";

    $stmt = $conn->prepare("INSERT INTO ContactMessages (customer_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $customer_id, $name, $email, $subject, $message);

    if($stmt->execute()){
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error sending message.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}

ob_start();
?>

<style>
.left-side{flex:1;position:relative;color:white;padding:50px;display:flex;flex-direction:column;justify-content:flex-end;overflow:hidden;}
.left-side video{position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;}
.left-side::before{content:'';position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.4);z-index:1;}
.content{position:relative;z-index:2;}
.left-side h1{font-size:3rem;margin:0 0 20px 0;text-transform:uppercase;}
.left-side p{font-size:1.2rem;max-width:400px;margin-bottom:30px;}
.btn-contact{;background-color:#424242;color:white;padding:10px;border:none;border-radius:2px;font-size:1.1rem;font-weight:bold;cursor:pointer;text-transform:uppercase;}
.btn-contact:hover{background-color:#7a7878;}
.right-side{flex:1;background-color:#e0e0e0;padding:60px;display:flex;align-items:center;justify-content:center;}
.form-box{background:white;padding:20px;border-radius:8px;box-shadow:0 4px 15px rgba(0,0,0,0.1);width:100%;max-width:450px;}
.form-group{margin-bottom:20px;}
.form-group label{display:block;margin-bottom:8px;font-weight:600;color:#333;}
.form-group input, .form-group textarea{width:100%;padding:12px;border:1px solid #c0bebe;border-radius:4px;font-size:1rem;box-sizing:border-box;}
.btn-send{width:100%;background-color:#424242;color:white;padding:15px;border:none;border-radius:4px;font-size:1.1rem;font-weight:bold;cursor:pointer;text-transform:uppercase;}
.btn-send:hover{background-color:#7a7878;}
.container-contact{display:flex;height:80vh;width:100%;}
h1{font-family: Georgia, 'Times New Roman', Times, serif;}
</style>

<div class="container-contact">
    <!-- Left Side -->
    <div class="left-side">
        <video autoplay muted loop>
            <source src="video.mp4" type="video/mp4">
        </video>
        <div class="content">
            <h1>Contact Us</h1>
            <p>Our team is always ready to collaborate and help you achieve your goals. Reach out today!</p>
            <button type="submit" class="btn-contact" href="Contact.php">Contact us</button>
        </div>
    </div>

    <!-- Right Side -->
    <div class="right-side">
        <div class="form-box" id="contact-form">
            <form action="" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required placeholder="Your Name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="exemple@gmail.com">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone" placeholder="+212 6. . . . . . .">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn-send">Send</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'layout.php';
?>






