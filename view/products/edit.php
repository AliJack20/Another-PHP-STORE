<form action="index.php?controller=product&action=update" enctype="multipart/form-data" method="POST">
    <input type="text" name="id" placeholder="S.NO" required><br>
    <input type="text" name="name" placeholder="Product Name" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="number" name="price" placeholder="Price" required><br>
    <select name="category_id">
        <option value="1">Electronics</option>
        <option value="2">Clothing</option>
    </select><br>
    <label>Product Image:</label>
    <input type="file" name="image">
    <button type="submit">Update Product</button>
</form>
