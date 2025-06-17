<form action="index.php?controller=product&action=update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product->id ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product->name) ?>" required><br>

    <label>Description</label>
    <textarea name="description"><?= htmlspecialchars($product->description) ?></textarea><br>

    <label>Price</label>
    <input type="number" name="price" value="<?= $product->price ?>" required><br>

    <label>Category</label>
    <select name="category_id">
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category->category_id ?>" <?= $category->category_id == $product->category_id ? 'selected' : '' ?>>
                <?= htmlspecialchars($category->name) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Current Image:</label><br>
    <?php if ($product->image): ?>
        <img src="<?= $product->image ?>" width="100"><br>
    <?php endif; ?>

    <label>Change Image</label>
    <input type="file" name="image"><br>

    <button type="submit" name="update_product_btn">Update</button>
</form>
