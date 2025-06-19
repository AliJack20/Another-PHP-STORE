<?php session_start();
include('dbcon.php');


$controller = new ProductController();
$searchTerm= $_GET['search'] ?? '';
$products = $controller->search($conn,$searchTerm);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wodth=device-width, initial-scale=1.0">

    <?php if(isset( $_SESSION['message'])) : ?>
        <h5 class= "alert alert-success"><?= $_SESSION['message']; ?></h5>
    <?php
        unset($_SESSION['message']);
        endif;  ?>

    
    <div class="card">
        <div class="card-header">
            <h3>ALL PRODUCTS
                <a href="index.php?controller=product&action=create" class="btn btn-primary float-end">Add Product</a>
                <a href="index.php?controller=category&action=index" class="btn btn-secondary">Go to Categories</a>

                <a href="index.php?controller=auth&action=index" class="btn btn-danger float-end ms-2">Logout</a>
            </h3>
            <form method="GET" action="index.php">
                <input type="hidden" name="controller" value="product">
                <input type="hidden" name="action" value="search">
                <input type="text" name="search" placeholder="Search Products" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="card-body"></div>
            <table class="table table-bordered table-striped">
                <thread>
                    <tr> 
                        <th>S.NO</th>
                        <th>name</th>
                        <th>description</th>
                        <th>price</th>
                        <th>Image</th>
                        <th>category_name</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    
                </thread>
                <tbody>
                    <?php if ($products): ?>
                        <?php foreach ($products as $key=>$row): ?>
                            <tr>
                                <td><?= ++$key; ?></td>
                                <td><?= $row->name; ?></td>
                                <td><?= $row->description; ?></td>
                                <td><?= $row->price; ?></td>
                                <td><img src="<?= $row->image; ?>" width="100" height="100"></td>
                                <td><?= $row->category_name ?? 'Uncategorized'; ?></td>
                                <td>
                                    <a href="index.php?controller=product&action=edit&id=<?= $row->id ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="index.php?controller=product&action=delete" method="POST">
                                        <input type="hidden" name="id" value="<?= $row->id ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8">No products found.</td></tr>
                    <?php endif; ?>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>


            </table>


    </div>
</head>
<body>

<!-- Chatbot Floating Button -->
<button id="openChatbot" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 28px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 1000;
">
    💬
</button>

<!-- Chatbot Modal -->
<div id="chatbotModal" style="
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    z-index: 999;
">
    <div style="
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 700px;
        height: 80%;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    ">
        <button id="closeChatbot" style="
            position: absolute;
            top: 10px; right: 15px;
            background: transparent;
            border: none;
            font-size: 24px;
            color: #555;
            cursor: pointer;
            z-index: 10;
        ">&times;</button>
        <iframe
            src="https://www.chatbase.co/chatbot-iframe/8wYpM4aTleM8HD76ykcC2"
            width="100%"
            height="100%"
            style="border: none;"
        ></iframe>
    </div>
</div>

<!-- JS for Chatbot Modal -->
<script>
document.getElementById('openChatbot').onclick = function() {
    document.getElementById('chatbotModal').style.display = 'block';
};
document.getElementById('closeChatbot').onclick = function() {
    document.getElementById('chatbotModal').style.display = 'none';
};
window.onclick = function(e) {
    if (e.target == document.getElementById('chatbotModal')) {
        document.getElementById('chatbotModal').style.display = 'none';
    }
};
</script>


</body>
</html>