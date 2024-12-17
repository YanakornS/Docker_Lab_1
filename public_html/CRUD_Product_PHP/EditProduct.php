<?php
include 'Connects/Connect.php';

$alert_message = "";

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // เพิ่มการตรวจสอบค่าที่ได้รับจากฟอร์ม
        var_dump($_POST); // ตรวจสอบข้อมูลที่ส่งเข้ามาใน POST

        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $features = $_POST['features'];
        $stock = $_POST['stock'];

        $sql = "UPDATE product SET name = ?, category = ?, description = ?, price = ?, features = ?, stock = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$name, $category, $description, $price, $features, $stock, $product_id])) {
            $alert_message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Product updated successfully!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";

            // Add a JavaScript redirect after successful update
            echo "<script>
                    alert('Product updated successfully!');
                    window.location.href = 'Home.php';
                  </script>";
        } else {
            $alert_message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Error: " . $stmt->errorInfo()[2] . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(135deg, #D9EAFD, #A8D8FF);
            /* ไล่สีจาก #D9EAFD ไปยัง #A8D8FF */
            /* หรือสามารถใช้หลายๆ สีได้ เช่น linear-gradient(135deg, #D9EAFD, #A8D8FF, #5B9BD5) */
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Product</h2>

        <?php
        if ($alert_message) {
            echo $alert_message;
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name <i class="fas fa-cogs"></i></label>
                <input type="text" id="name" name="name" class="form-control"
                    value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>

            <!-- Dropdown for Category -->
            <div class="mb-3">
                <label for="category" class="form-label">Category <i class="fas fa-list"></i></label>
                <select id="category" name="category" class="form-select" required>
                    <option value="">Select Category</option>
                    <option value="Electronics" <?php echo $product['category'] == 'Electronics' ? 'selected' : ''; ?>>
                        Electronics</option>
                    <option value="Fashion" <?php echo $product['category'] == 'Fashion' ? 'selected' : ''; ?>>Fashion
                    </option>
                    <option value="Home" <?php echo $product['category'] == 'Home' ? 'selected' : ''; ?>>Home</option>
                    <option value="Beauty" <?php echo $product['category'] == 'Beauty' ? 'selected' : ''; ?>>Beauty
                    </option>
                    <option value="Toys" <?php echo $product['category'] == 'Toys' ? 'selected' : ''; ?>>Toys</option>
                </select>
            </div>

            <!-- Dropdown for Features -->
            <div class="mb-3">
                <label for="features" class="form-label">Features <i class="fas fa-star"></i></label>
                <select id="features" name="features" class="form-select" required>
                    <option value="">Select Feature</option>
                    <option value="Size xl" <?php echo $product['features'] == 'Size Xl' ? 'selected' : ''; ?>>Size xl
                    </option>
                    <option value="Color made to order" <?php echo $product['features'] == 'Color made to order' ? 'selected' : ''; ?>>Color made to order</option>
                    <option value="Special Material" <?php echo $product['features'] == 'Special Material' ? 'selected' : ''; ?>>Special Material</option>
                    <option value="Light weight" <?php echo $product['features'] == 'Light weight' ? 'selected' : ''; ?>>
                        Light weight</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <i class="fas fa-align-left"></i></label>
                <textarea id="description" name="description" class="form-control"
                    rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price <i class="fas fa-dollar-sign"></i></label>
                <input type="number" id="price" name="price" class="form-control"
                    value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock <i class="fas fa-box"></i></label>
                <input type="number" id="stock" name="stock" class="form-control"
                    value="<?php echo htmlspecialchars($product['stock']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Product</button>
        </form>

        <a href="Home.php" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Back to View Products</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>