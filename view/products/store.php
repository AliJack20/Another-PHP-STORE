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
            <form action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data">
                <input type="text" name="id" placeholder="S.NO" required><br>
                <input type="text" name="name" placeholder="Product Name" required><br>
                <textarea name="description" placeholder="Description"></textarea><br>
                <input type="number" name="price" placeholder="Price" required><br>
                <input type="file" name="image"><br>
                <select name="category_id">
                    <option value="1">Condiments</option>
                    <option value="2">Electronics</option>
                    <option value="3">Clothing</option>
                    <option value="4">Cold Drinks</option>
                    <option value="5">Food</option>
                    <option value="6">Sports</option>
                </select><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</head>
<body>

</body>
</html>