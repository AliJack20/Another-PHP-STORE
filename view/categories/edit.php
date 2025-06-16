<form action="index.php?controller=category&action=update" method="POST">
    <input type="hidden" name="category_id" value="<?= $category->category_id ?>">
    
    <label>Name</label>
    <input type="text" name="name" value="<?= $category->name ?>">

    <label>Parent Category</label>
    <input type="number" name="parent_id" value="<?= $category->parent_id ?>">

    <button type="submit" class="btn btn-primary">Update</button>
</form>
