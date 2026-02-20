<?php
session_start();

/* =========================
   DATABASE CONNECTION
========================= */
$conn = null;
include "connection.php"; // إلى ما كانش، الكود غادي يخدم بالـ dummy

/* =========================
   DATA INIT
========================= */
$categories_data = [];
$products_data   = [];

/* =========================
   FETCH FROM DB
========================= */
if (isset($conn) && $conn) {

    // Categories
    $resCat = $conn->query("SELECT * FROM category");
    while ($row = $resCat->fetch_assoc()) {
        $categories_data[] = $row;
    }

    // Products
    $resProd = $conn->query("SELECT * FROM product");
    while ($row = $resProd->fetch_assoc()) {
        $products_data[] = $row;
    }

} else {
    // Dummy Data
    $categories_data = [
        ['category_id'=>1,'name'=>"Women's Jeans",'image'=>'https://picsum.photos/seed/c1/400/500'],
        ['category_id'=>2,'name'=>"Men's T-shirts",'image'=>'https://picsum.photos/seed/c2/400/500'],
    ];

    $products_data = [
        ['product_id'=>1,'name'=>"Blue Jeans",'price'=>200,'category_id'=>1,'image'=>'https://picsum.photos/seed/p1/400/400'],
        ['product_id'=>2,'name'=>"Men T-shirt",'price'=>120,'category_id'=>2,'image'=>'https://picsum.photos/seed/p2/400/400'],
    ];
}

/* =========================
   ADMIN ADD (SIMULATED)
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['add_category'])) {
        $categories_data[] = [
            'category_id'=>rand(100,999),
            'name'=>$_POST['cat_name'],
            'image'=>$_POST['cat_image']
        ];
    }

    if (isset($_POST['add_product'])) {
        $products_data[] = [
            'product_id'=>rand(100,999),
            'name'=>$_POST['prod_name'],
            'price'=>$_POST['prod_price'],
            'category_id'=>$_POST['prod_category'],
            'image'=>$_POST['prod_image']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Collection + Search + Admin</title>
<style>
body{font-family:Arial;background:#f6f6f6;margin:0;padding:20px}
h1,h2{margin-bottom:10px}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
.card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,.08)}
.card img{width:100%;height:260px;object-fit:cover}
.card .p{padding:15px}
.price{font-weight:bold}
input,select,button{padding:8px;width:100%;margin-bottom:10px}
button{background:#111;color:#fff;border:none;border-radius:6px;cursor:pointer}
.admin{background:#fff;padding:20px;border-radius:12px;margin-bottom:40px}
.search{margin-bottom:20px}
</style>
</head>

<body>

<h1>🛍️ Collections</h1>

<!-- 🔍 SEARCH -->
<div class="search">
    <input type="text" id="searchInput" placeholder="Search product...">
</div>

<div id="products" class="grid"></div>

<hr style="margin:50px 0">

<!-- 🔐 ADMIN PANEL -->
<div class="admin">
<h2>⚙️ Admin Panel</h2>

<form method="post">
<h3>Add Category</h3>
<input type="text" name="cat_name" placeholder="Category name" required>
<input type="text" name="cat_image" placeholder="Image URL" required>
<button name="add_category">Add Category</button>
</form>

<form method="post">
<h3>Add Product</h3>
<input type="text" name="prod_name" placeholder="Product name" required>
<input type="number" name="prod_price" placeholder="Price" required>

<select name="prod_category">
<?php foreach($categories_data as $c): ?>
<option value="<?= $c['category_id'] ?>"><?= $c['name'] ?></option>
<?php endforeach; ?>
</select>

<input type="text" name="prod_image" placeholder="Image URL" required>
<button name="add_product">Add Product</button>
</form>
</div>

<script>
const products = <?php echo json_encode($products_data); ?>;
const categories = <?php echo json_encode($categories_data); ?>;

const productsDiv = document.getElementById("products");
const searchInput = document.getElementById("searchInput");

function render(list){
    productsDiv.innerHTML="";
    list.forEach(p=>{
        productsDiv.innerHTML += `
        <div class="card">
            <img src="${p.image}">
            <div class="p">
                <h3>${p.name}</h3>
                <div class="price">${p.price} DH</div>
            </div>
        </div>`;
    });
}

searchInput.addEventListener("keyup",()=>{
    const v = searchInput.value.toLowerCase();
    const filtered = products.filter(p=>p.name.toLowerCase().includes(v));
    render(filtered);
});

render(products);
</script>

</body>
</html>
