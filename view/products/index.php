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
                        <th>ID</th>
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
                        <?php foreach ($products as $row): ?>
                            <tr>
                                <td><?= $row->id; ?></td>
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

</body>
</html>