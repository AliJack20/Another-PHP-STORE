<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wodth=device-width, initial-scale=1.0">
    <title>Insert data into databse using PHP PDO</title>
    <div class="card">
        <div class="card-header">
            <h3>Insert data into databse using PHP PDO
                <a href="index.php" class="btn btn-danger float-end">BACK</a>
            </h3>
        </div>
        <div class="card-body">
            <form action="index.php?controller=category&action=store" method="POST" enctype="multipart/form-data">
                <input type="text" name="category_id" placeholder="C_ID" required><br>
                <input type="text" name="name" placeholder="Category Name" required><br>
                <input type="text" name="parent_id" placeholder="parent_id" required><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</head>
<body>

</body>
</html>