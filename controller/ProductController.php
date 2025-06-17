<?php 
include('dbcon.php');

class ProductController{

    public function index() {
    global $conn;
    $stmt = $conn->prepare("
    SELECT 
                                products.id, 
                                products.name, 
                                products.description, 
                                products.price, 
                                products.image, 
                                categories.name AS category_name
                            FROM products
                            LEFT JOIN categories ON products.category_id = categories.category_id
    
    ");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_OBJ);

    include 'view/products/index.php';
}


    public function edit() {
    global $conn;

    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_OBJ);

    include 'view/products/edit.php';
}

    public function update() {
    global $conn;

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];

        // Handle uploaded image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $imageName = $_FILES['image']['name'];
            $imageTmp = $_FILES['image']['tmp_name'];
            $imagePath = "uploads/" . $imageName;

            move_uploaded_file($imageTmp, $imagePath);
        } else {
            // fallback to existing image (you can improve this by querying the current value from DB)
            $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
            $imagePath = $existing['image'];
        }

        // Update the product
        $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ?, category_id = ? WHERE id = ?");
        $stmt->execute([$name, $description, $price, $imagePath, $category_id, $id]);

        header("Location: index.php?controller=product&action=index");
        exit;
    }
}

    

    public function create() {
    include 'view/products/store.php'; // or create.php
}

    public function delete(){
        global $conn;

        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);
        }

        header("Location: index.php?controller=product&action=index");
        
    }

    public function search($conn, $searchTerm) {
    $query = "SELECT products.*, categories.name AS category_name 
              FROM products 
              LEFT JOIN categories ON products.category_id = categories.category_id 
              WHERE products.name LIKE :search OR products.description LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->execute([':search' => "%$searchTerm%"]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
    


    public function store() {
    global $conn;

    // Handle file upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $destination = 'uploads/' . $imageName;

        // Create uploads folder if it doesn't exist
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        move_uploaded_file($imageTmpPath, $destination);
        $image = $destination;
    }

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['category_id'],
        $image
    ]);

    header("Location: index.php?controller=product&action=index");
}


}