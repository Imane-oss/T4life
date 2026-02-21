<?php
session_start();
include "connection.php"; 
$errors = [];

 $categories_data = [];
 $products_data = [];

if (isset($conn) && $conn) {
    $result_cat = $conn->query("SELECT * FROM category");
    while ($row = $result_cat->fetch_assoc()) {
        $categories_data[] = $row;
    }

    $result_prod = $conn->query("SELECT * FROM product");
    while ($row = $result_prod->fetch_assoc()) {
        $products_data[] = $row;
    }
    
} 
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>collection</title>
    <style>
       

        /* --- LAYOUT & UTILITIES --- */
        
        .hidden { display: none !important; }
        .fade-in { animation: fadeIn 0.5s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        h1 { font-size: 32px; margin-bottom: 30px; font-weight: 700; }

        /* --- FILTER BUTTONS --- */
        .filter { display: flex; gap: 15px; margin-bottom: 40px; }
        .filter button {
            background: #fff; border: 1px solid #ddd; padding: 10px 28px;
            border-radius: 30px; cursor: pointer; transition: 0.3s; font-weight: 500;
            font-size: 14px;
        }
        .filter button.active, .filter button:hover { background: #111; color: #fff; border-color: #111; }

        /* --- GRID SYSTEM --- */
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px; }

        /* --- CARDS (Shared) --- */
        .card {
            position: relative; border-radius: 16px; overflow: hidden;
            background: #fff; border: 1px solid #eee; transition: 0.3s; cursor: pointer;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); }
        
        .card img { width: 100%; height: 350px; object-fit: cover; transition: 0.5s; }
        .card:hover img { transform: scale(1.05); }

        /* Category Card Overlay */
        .overlay {
            position: absolute; inset: 0; 
            background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
            display: flex; align-items: flex-end; padding: 25px;
        }
        .overlay h2 { color: #fff; font-size: 20px; font-weight: 600; }

        /* Product Card Specifics */
        .product-info { padding: 20px; }
        .product-info h3 { font-size: 16px; margin-bottom: 5px; }
        .price { color: #555; font-weight: 600; font-size: 15px; }
        
        .add-btn {
            width: 100%; margin-top: 15px; padding: 10px; background: #111; color: #fff;
            border: none; border-radius: 8px; cursor: pointer; transition: 0.3s; font-size: 14px;
        }
        .add-btn:hover { background: #333; }

        /* --- HEART ICON STYLE (NEW) --- */
        .pin {
            position: absolute; top: 15px; right: 15px;
            font-size: 24px; cursor: pointer;
            z-index: 2; transition: 0.3s;
            width: 35px; height: 35px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .pin:hover { transform: scale(1.1); background: #fff; }

        /* --- BACK BUTTON --- */
        .back-btn {
            display: inline-flex; align-items: center; cursor: pointer; 
            color: #777; font-weight: 500; margin-bottom: 20px; transition: 0.2s;
        }
        .back-btn:hover { color: #000; margin-left: -5px; }

        /* --- TOAST NOTIFICATION --- */
        #toast {
            visibility: hidden; min-width: 250px; background-color: #333; color: #fff;
            text-align: center; border-radius: 8px; padding: 16px; position: fixed;
            z-index: 2000; left: 50%; bottom: 30px; transform: translateX(-50%);
            font-size: 14px; opacity: 0; transition: opacity 0.3s, bottom 0.3s;
        }
        #toast.show { visibility: visible; opacity: 1; bottom: 50px; }
    </style>


  

    <!-- === VIEW 1: COLLECTIONS (Categories) === -->
    <main id="view-collections" class="container fade-in">
        <h1>Collections</h1>
        
        <!-- Filters -->
        <div class="filter">
            <button class="active" onclick="filterCategories('all', this)">All</button>
            <button onclick="filterCategories('women', this)">Women</button>
            <button onclick="filterCategories('men', this)">Men</button>
        </div>

        <!-- Categories Grid -->
        <div id="categories-grid" class="grid">
            <!-- Content injected by JS -->
        </div>
    </main>

    <!-- === VIEW 2: PRODUCTS (Hidden by default) === -->
    <main id="view-products" class="container hidden">
        <div class="back-btn" onclick="goHome()">
            &larr; Back to Collections
        </div>
        
        <h1 id="current-category-title" style="margin-top: 10px;">Category Name</h1>
        
        <div id="products-grid" class="grid" style="margin-top: 30px;">
            <!-- Content injected by JS -->
        </div>
    </main>

    <!-- Toast Notification -->
    <div id="toast">Item added to cart!</div>

    <!-- === JAVASCRIPT LOGIC === -->
    <script>
        // 1. PASS PHP DATA TO JS
        const dbCategories = <?php echo json_encode($categories_data); ?>;
        const dbProducts = <?php echo json_encode($products_data); ?>;

        // 2. DEFINE FILTER GROUPS EXACTLY AS REQUESTED
        const womenList = [
            "Women's Jeans", 
            "Women's T-shirts", 
            "Women's Sweaters", 
            "Women's Loafers&Slip-Ons"
        ];

        const menList = [
            "Men's T-shirts", 
            "Men's Jeans", 
            "Men's Sweaters", 
            "Men's Shoes"
        ];

        // 3. DOM ELEMENTS
        const viewCollections = document.getElementById('view-collections');
        const viewProducts = document.getElementById('view-products');
        const categoriesGrid = document.getElementById('categories-grid');
        const productsGrid = document.getElementById('products-grid');
        const catTitle = document.getElementById('current-category-title');
        const toast = document.getElementById("toast");

        // 4. INITIALIZATION
        document.addEventListener('DOMContentLoaded', () => {
            renderCategories('all');
        });

        // 5. RENDER CATEGORIES FUNCTION
        function renderCategories(filterType) {
            categoriesGrid.innerHTML = ""; 

            dbCategories.forEach(cat => {
                let isVisible = false;

                if (filterType === 'all') {
                    isVisible = true;
                } else if (filterType === 'women' && womenList.includes(cat.name)) {
                    isVisible = true;
                } else if (filterType === 'men' && menList.includes(cat.name)) {
                    isVisible = true;
                }

                if (isVisible) {
                    const card = document.createElement('div');
                    card.className = 'card fade-in';
                    card.onclick = () => openCategory(cat.category_id, cat.name);

                    card.innerHTML = `
                        <img src="${cat.image}" alt="${cat.name}">
                        <div class="overlay">
                            <h2>${cat.name}</h2>
                        </div>
                    `;
                    categoriesGrid.appendChild(card);
                }
            });
        }

        // 6. FILTER BUTTON HANDLER
        function filterCategories(type, btnElement) {
            document.querySelectorAll('.filter button').forEach(b => b.classList.remove('active'));
            btnElement.classList.add('active');
            renderCategories(type);
        }

        // 7. OPEN CATEGORY (SWITCH VIEW)
        function openCategory(catId, catName) {
            catTitle.innerText = catName + " Collection";
            
            const filteredProducts = dbProducts.filter(p => p.category_id == catId);
            
            productsGrid.innerHTML = ""; 
            
            if (filteredProducts.length === 0) {
                productsGrid.innerHTML = "<p style='grid-column: 1/-1; text-align:center; color:#777;'>No products found in this category yet.</p>";
            } else {
                filteredProducts.forEach(p => {
                    const card = document.createElement('div');
                    card.className = 'card fade-in'; 
                    
                    // ADDED: Heart Icon inside the card
                    card.innerHTML = `
                        <div class="pin" onclick="toggleHeart(this)">♡</div>
                        <img src="${p.image}" alt="${p.name}">
                        <div class="product-info">
                            <h3>${p.name}</h3>
                            <span class="price">${p.price} DH</span>
                            <button class="add-btn" onclick="addToCart('${p.name}')">Add to Cart</button>
                        </div>
                    `;
                    productsGrid.appendChild(card);
                });
            }

            viewCollections.classList.add('hidden');
            viewProducts.classList.remove('hidden');
            viewProducts.classList.add('fade-in');
            
            window.scrollTo(0, 0);
        }

        // 8. GO BACK (SWITCH VIEW)
        function goHome() {
            viewProducts.classList.add('hidden');
            viewCollections.classList.remove('hidden');
            viewCollections.classList.add('fade-in');
            window.scrollTo(0, 0);
        }

        // 9. TOGGLE HEART FUNCTION (REQUESTED)
        function toggleHeart(pin) {
            if(pin.innerText === "♡") {
                pin.innerText = "♥";
                pin.style.color = "#ff4757";
                showToast("Added to favorites");
            } else {
                pin.innerText = "♡";
                pin.style.color = "inherit";
            }
        }

        // 10. ADD TO CART ACTION
        function addToCart(itemName) {
            showToast(itemName + " added to cart!");
        }

        // Helper: Show Toast
        function showToast(message) {
            toast.innerText = message;
            toast.className = "show";
            setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
        }
    </script>
<?php
$content = ob_get_clean();
include_once 'layout.php';
?>
