<?php session_start();
include('dbcon.php');

class CategoryController{

    public function index() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
        include 'view/categories/index.php';
    }


    public function edit() {
        global $conn;
        $id = $_GET['category_id'] ?? null;
        if (!$id) die("Category ID missing.");

        $stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);
        $category = $stmt->fetch(PDO::FETCH_OBJ);
        include 'view/categories/edit.php';
    }

    public function update() {
    global $conn;

    $id = $_POST['category_id'];
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];

    $stmt = $conn->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE category_id = ?");
    $stmt->execute([$name, $parent_id, $id]);

    header("Location: index.php?controller=category&action=index");
    exit();
}


    

    public function create() {
    include 'view/categories/store.php'; // or create.php
}



    public function store() {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO categories (category_id,name,parent_id) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['category_id'],
        $_POST['name'],
        $_POST['parent_id']
        
    ]);

    header("Location: index.php?controller=category&action=index"); // redirect to list
}

    public function delete() {
        global $conn;
        $id = $_POST['category_id'] ?? null;
        if (!$id) die("Category ID missing.");

        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);

        header("Location: index.php?controller=category&action=index");
        exit();
    }
    

}