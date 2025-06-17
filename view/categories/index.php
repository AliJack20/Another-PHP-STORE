<?php 
include('dbcon.php');

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
            <h3>ALL CATEGORIES
                <a href="index.php?controller=category&action=create" class="btn btn-primary float-end">Add Category</a>
                <a href="index.php?controller=product&action=index" class="btn btn-secondary">Go to Products</a>
            </h3>
        </div>
        <div class="card-body"></div>
            <table class="table table-bordered table-striped">
                <thread>
                    <tr> 
                        <th>Category S.NO</th>
                        <th>name</th>
                        <th>parent_id</th>
                        <th colspan="2">Actions</th>

                    </tr>
                    
                </thread>
                <tbody>
                    <?php if ($categories): ?>
                        <?php foreach ($categories as $row): ?>
                            <tr>
                                <td><?= $row->category_id; ?></td>
                                <td><?= $row->name; ?></td>
                                <td><?= $row->parent_id; ?></td>
                                <td>
                                    <a href="index.php?controller=category&action=edit&category_id=<?= $row->category_id ?>" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="index.php?controller=category&action=delete" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                        <input type="hidden" name="category_id" value="<?= $row->category_id ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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