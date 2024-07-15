<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

// Add products
if (isset($_POST['publish'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $status = 'active';
    $image = $_FILES['image']['name'];
    
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    $select_image = $conn->prepare('SELECT * FROM products WHERE image = ? AND seller_id = ?');
    $select_image->execute([$image, $seller_id]);
    
    if (!empty($image)) {
        if ($select_image->rowCount() > 0) {
            $warning[] = 'Image name already exists';
        } elseif ($image_size > 2000000) {
            $warning[] = 'Image size is too big';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }
    
    if ($select_image->rowCount() > 0 && $image != '') {
        $warning[] = 'Please rename your image';
    } else {
        $insert_product = $conn->prepare('INSERT INTO products (id, seller_id, name, price, image, stock, product_detail, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $description, $status]);
        $success[] = 'Product inserted successfully';
    }
}

// Add products
if (isset($_POST['draft'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $status = 'deactive';
    $image = $_FILES['image']['name'];
    
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    $select_image = $conn->prepare('SELECT * FROM products WHERE image = ? AND seller_id = ?');
    $select_image->execute([$image, $seller_id]);
    
    if (!empty($image)) {
        if ($select_image->rowCount() > 0) {
            $warning[] = 'Image name already exists';
        } elseif ($image_size > 2000000) {
            $warning[] = 'Image size is too big';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }
    
    if ($select_image->rowCount() > 0 && $image != '') {
        $warning[] = 'Please rename your image';
    } else {
        $insert_product = $conn->prepare('INSERT INTO products (id, seller_id, name, price, image, stock, product_detail, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $description, $status]);
        $success[] = 'Product  saved as draft successfully';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Admin Add Products Page</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?> 
        <section class="post-editor">
            <div class="heading">
                <h1>Add Products</h1>
                <img src="../image/separator-img.png" alt="">
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>Product Name<span>*</span></p>
                        <input type="text" name="name" maxlength="100" placeholder="Add product name" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Product Price<span>*</span></p>
                        <input type="number" name="price" maxlength="100" placeholder="Add product price" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Product Detail<span>*</span></p>
                        <textarea name="description" required maxlength="1000" placeholder="Add product details" class="box"></textarea>
                    </div>
                    <div class="input-field">
                        <p>Product Stock<span>*</span></p>
                        <input type="number" name="stock" maxlength="10" min="0" max="999999999" placeholder="Add product stock" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Product Image<span>*</span></p>
                        <input type="file" name="image" accept="image/*" required class="box">
                    </div>
                    <div class="flex-btn">
                        <input type="submit" value="Add Product" class="btn" name="publish">
                        <input type="submit" value="Save as Draft" class="btn" name="draft">
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>
