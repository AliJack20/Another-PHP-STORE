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
            <h3>ALL MEMBERS
                <a href="index.php?controller=member&action=create" class="btn btn-primary float-end">Add Member</a>
            </h3>
        </div>
        <div class="card-body"></div>
            <table class="table table-bordered table-striped">
                <thread>
                    <tr> 
                        <th>id</th>
                        <th>fullname</th>
                        <th>email</th>
                        <th>password</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    
                </thread>
                <tbody>
                    <?php if ($members): ?>
                        <?php foreach ($members as $row): ?>
                            <tr>
                                <td><?= $row->id; ?></td>
                                <td><?= $row->fullname; ?></td>
                                <td><?= $row->email; ?></td>
                                <td><?= $row->password; ?></td>
                                <td>
                                    <a href="index.php?controller=member&action=edit&id=<?= $row->id ?>" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="index.php?controller=member&action=delete" method="POST">
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