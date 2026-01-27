<?php
session_start();
 $erreurs = array();

require_once 'connection.php';

ob_start();
?>


    <style>
        :root {
            --primary-color: #212529;
            --accent-color: #9a9797;
            --light-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            background-color: #fff;
            overflow-x: hidden;
        }
        
        /* Header */
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
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
        
        .nav-btn {
            padding: 8px 18px;
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-login {
            color: var(--primary-color);
            border: none;
            background: none;
        }
        
        .btn-login:hover {
            background-color: #f0f0f0;
        }
        
        .btn-signup {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }
        
        .btn-signup:hover {
            background-color: #333;
            color: white;
        }
        
        /* Category Tags */
        .category-section {
            padding: 20px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .category-scroll {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding: 5px 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        .category-scroll::-webkit-scrollbar {
            display: none;
        }
        
        .category-tag {
            flex-shrink: 0;
            padding: 8px 16px;
            border-radius: 20px;
            background-color: #f0f0f0;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .category-tag:hover, .category-tag.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Masonry Grid */
        .masonry-grid {
            column-count: 5;
            column-gap: 15px;
            padding: 20px 0;
        }
        
        @media (max-width: 1200px) {
            .masonry-grid {
                column-count: 4;
            }
        }
        
        @media (max-width: 992px) {
            .masonry-grid {
                column-count: 3;
            }
        }
        
        @media (max-width: 768px) {
            .masonry-grid {
                column-count: 2;
            }
        }
        
        @media (max-width: 576px) {
            .masonry-grid {
                column-count: 1;
            }
        }
        
        .pin-card {
            break-inside: avoid;
            margin-bottom: 15px;
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
        }
        
        .pin-image {
            width: 100%;
            display: block;
            transition: transform 0.3s ease;
        }
        
        .pin-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
        }
        
        .pin-card:hover .pin-overlay {
            opacity: 1;
        }
        
        .pin-card:hover .pin-image {
            transform: scale(1.03);
        }
        
        .pin-actions {
            display: flex;
            justify-content: flex-end;
        }
        
        .pin-action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            color: var(--primary-color);
            border: none;
            margin-left: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .pin-action-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .pin-details {
            background: none;
            border-radius: 16px;
            padding: 12px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .pin-card:hover .pin-details {
            transform: translateY(0);
        }
        
        .pin-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 5px;
            color: white;
        }
        
        .pin-price {
            font-weight: 500;
            color: white;
        }
        
        /* CTA Section - Updated with JPEG background */
        .cta-section {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(rgba(33, 37, 41, 0.85), rgba(33, 37, 41, 0.85)), url('https://sfile.chatglm.cn/images-ppt/0197f3453d2a.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            margin-top: 30px;
        }
        
        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }
        
        .cta-text {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
            color: #f0f0f0;
        }
        
        .btn-cta {
            background-color: transparent;
            color: white;
            border: 2px solid white;
            padding: 15px 40px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-cta:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        /* Footer */
        .footer {
            background-color: white;
            padding: 40px 20px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .footer-link {
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .footer-link:hover {
            color: var(--primary-color);
        }
        
        .copyright {
            color: #888;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 10px 0;
            }
            
            .logo {
                font-size: 1.5rem;
            }
            
            .search-container {
                max-width: 200px;
                display: none;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .cta-text {
                font-size: 1rem;
            }
            
            .btn-cta {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>


    <!-- Category Tags -->
    <div class="category-section">
        <div class="container">
            <div class="category-scroll">
                <a href="#" class="category-tag active">All</a>
                <a href="#" class="category-tag">Men's Fashion</a>
                <a href="#" class="category-tag">Women's Fashion</a>
                <a href="#" class="category-tag">Hoodies</a>
                <a href="#" class="category-tag">T-Shirts</a>
                <a href="#" class="category-tag">Jackets</a>
                <a href="#" class="category-tag">Accessories</a>
                <a href="#" class="category-tag">Summer Collection</a>
                <a href="#" class="category-tag">Winter Wear</a>
                <a href="#" class="category-tag">Sale</a>
            </div>
        </div>
    </div>

    <!-- Masonry Grid -->
    <div class="container">
        <div class="masonry-grid">
            <!-- Pin 1 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/066421bbab2a.jpg" alt="Women's Hoodie" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Women's Graphic Hoodie</h4>
                        <p class="pin-price">$45.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 2 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/85770163fdfa.jpg" alt="Women's Floral Hoodie" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Women's Floral Hoodie</h4>
                        <p class="pin-price">$55.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 3 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/e58878916487.jpg" alt="Rainbow Hoodie" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Rainbow Print Hoodie</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 4 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/90f698e41b01.png" alt="Men's White Hoodie" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Men's White Hoodie</h4>
                        <p class="pin-price">$48.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 5 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/fb24bd73212b.jpg" alt="Casual Women's Top" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Casual Women's Top</h4>
                        <p class="pin-price">$35.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 6 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/728ab2b532ba.jpg" alt="Black Hoodie" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Black Essential Hoodie</h4>
                        <p class="pin-price">$52.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 7 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/dc9836c3993e.jpg" alt="Men's Cardigan" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Men's Grey Cardigan</h4>
                        <p class="pin-price">$65.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 8 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/b2d0896923c5.jpg" alt="Women's Green Shirt" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Women's Green Velvet Shirt</h4>
                        <p class="pin-price">$75.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 9 -->
            <div class="pin-card">
                <img src="https://sfile.chatglm.cn/images-ppt/45b7926b3046.jpg" alt="Summer Dress" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Summer Black Top</h4>
                        <p class="pin-price">$42.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 10 -->
            <div class="pin-card">
                <img src="images/57.jpg" alt="White T-Shirt" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Classic White T-Shirt</h4>
                        <p class="pin-price">$25.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 11 -->
            <div class="pin-card">
                <img src="images/56.jpg" alt="Colorful Hoodies" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Colorful Hoodie Collection</h4>
                        <p class="pin-price">$45.00</p>
                    </div>
                </div>
            </div>
            
            <!-- Pin 12 -->
            <div class="pin-card">
                <img src="images/55.jpg" alt="Designer Hoodie" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Designer Hoodie</h4>
                        <p class="pin-price">$65.00</p>
                    </div>
                </div>
            </div>
                        <!-- Pin 13 -->
            <div class="pin-card">
                <img src="images/289.png" alt="Colorful Hoodies" class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Colorful Hoodie Collection</h4>
                        <p class="pin-price">$45.00</p>
                    </div>
                </div>
            </div>
                        <!-- Pin 14 -->
            <div class="pin-card">
                <img src="images/30038774.png" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                        <!-- Pin 15 -->
            <div class="pin-card">
                <img src="images/904.png" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                        <!-- Pin 16 -->
            <div class="pin-card">
                <img src="images/54-mobile.jpg" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                                   <!-- Pin 17 -->
            <div class="pin-card">
                <img src="images/46.jpg" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                                   <!-- Pin 17 -->
            <div class="pin-card">
                <img src="images/307.png" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                                   <!-- Pin 18 -->
            <div class="pin-card">
                <img src="images/308.jpg" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                                   <!-- Pin 19 -->
            <div class="pin-card">
                <img src="images/309.jpg" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                                   <!-- Pin 20 -->
            <div class="pin-card">
                <img src="images/310.jpg" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                                   <!-- Pin 21 -->
            <div class="pin-card">
                <img src="images/311.png" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
                                   <!-- Pin 22 -->
            <div class="pin-card">
                <img src="images/312.png" alt=" cool hoddies " class="pin-image">
                <div class="pin-overlay">
                    <div class="pin-actions">
                        <button class="pin-action-btn"><i class="bi bi-heart"></i></button>
                        <button class="pin-action-btn"><i class="bi bi-cart"></i></button>
                    </div>
                    <div class="pin-details">
                        <h4 class="pin-title">Cool Hoodies</h4>
                        <p class="pin-price">$50.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cta-section">
        <div class="container">
            <h2 class="cta-title">Join the T4LIFE Community</h2>
            <p class="cta-text">Create your account today to save your favorite items, get personalized recommendations, and be the first to know about new arrivals and exclusive offers.</p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="index.php" class="btn-cta">Explore</a>
                <a href="sign_up.php" class="btn-cta">Sign Up Now</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Category tag active state
        document.querySelectorAll('.category-tag').forEach(tag => {
            tag.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.category-tag').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Pin card click - navigate to product page
        document.querySelectorAll('.pin-card').forEach(card => {
            card.addEventListener('click', function() {
                // In a real application, this would navigate to the product page
                console.log('Product clicked');
            });
        });
        
        // Pin action buttons - prevent card click
        document.querySelectorAll('.pin-action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                // In a real application, this would add to cart or wishlist
                if (this.querySelector('.bi-heart')) {
                    this.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                        icon.style.color = '#e0245e';
                    } else {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                        icon.style.color = '';
                    }
                } else if (this.querySelector('.bi-cart')) {
                    alert('Added to cart!');
                }
            });
        });
    </script>
</body>
</html>
<?php
 $content = ob_get_clean();
include_once "layout.php";
?>