<?php session_start();
include('dbcon.php');

class MemberController{

    public function index() {
    global $conn;
    $stmt = $conn->prepare("
    SELECT 
                                id, 
                                fullname, 
                                email, 
                                password
                            FROM member

    
    ");
    $stmt->execute();
    $members = $stmt->fetchAll(PDO::FETCH_OBJ);

    include 'view/members/index.php';
}


    public function edit() {
    global $conn;

    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM member WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_OBJ);

    include 'view/members/edit.php';
}

    public function update() {
    global $conn;

    if (git push -u origin mainisset($_POST['id'])) {
        $stmt = $conn->prepare("UPDATE member SET id = ?, fullname = ?, email = ? password = ? WHERE id = ?");
        $stmt->execute([
            $_POST['id'],
            $_POST['fullname'],
            $_POST['email'],
            $_POST['password']
        ]);
    }

    header("Location: index.php?controller=member&action=index");
}
    

    public function create() {
    include 'view/members/store.php'; // or create.php
}

    public function delete(){
        global $conn;

        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $stmt = $conn->prepare("DELETE FROM member WHERE id = ?");
            $stmt->execute([$id]);
        }

        header("Location: index.php?controller=member&action=index");
        
    }
    


    public function store() {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO member (id,fullname,email, password) VALUES (?, ?, ?,?)");
    $stmt->execute([
        $_POST['id'],
        $_POST['fullname'],
        $_POST['email'],
        $_POST['password']
        
    ]);

    header("Location: index.php?controller=member&action=index"); // redirect to list
}

}