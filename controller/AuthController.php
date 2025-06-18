<?php 
include('dbcon.php');

class AuthController{

    public function loginForm(){
        include 'view/auth/login.php';

    }
// checking if the pull works

    public function login() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch user by email
        $stmt = $conn->prepare("SELECT * FROM member WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // If password was stored as plain text
            if ($password === $user['password']) {
                // Login success
                $_SESSION['member'] = [
                    'id' => $user['id'],
                    'name' => $user['fullname'],
                    'email' => $user['email']
                ];
                header("Location: index.php?controller=product&action=index");
                exit();
            } else {
                $error = "Invalid email or password.";
                echo $error;
            }

        } else {
            $error = "Invalid email or password.";
            echo $error;
        }

        include 'view/auth/login.php';
    } else {
        include 'view/auth/login.php';
    }
}


    public function registerForm(){
        include 'view/auth/register.php';
    }

    public function register() {
    global $conn;

    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Storing plain text (not recommended)

    // Optional: Check if the email already exists
    $check = $conn->prepare("SELECT * FROM member WHERE email = ?");
    $check->execute([$email]);
    if ($check->rowCount() > 0) {
        echo "Email already registered.";
        return;
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO member (id,fullname, email, password) VALUES (?,?, ?, ?)");
    $stmt->execute([$id,$fullname, $email, $password]);

    // Redirect to login page
    header("Location: index.php?controller=auth&action=loginForm");
}

    public function index() {
        // Redirect to login if not authenticated
        if (!isset($_SESSION['member'])) {
            header("Location: index.php?controller=auth&action=loginForm");
            exit;
        }

        $user = $_SESSION['member']; // Assuming $_SESSION['user'] stores logged-in user data
        include 'views/auth/index.php';
    }


    public function logout() {
        session_destroy();
        header("Location: index.php?controller=AuthController&action=loginForm");
    exit;
}

    

}