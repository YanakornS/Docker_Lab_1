<?php
include 'Connects/Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $name = $_POST['name'];
    $category = $_POST['category'];  // หมวดหมู่สินค้า
    $price = $_POST['price'];
    $description = $_POST['description'];
    $features = $_POST['features'];  // คุณสมบัติเฉพาะ
    $stock = $_POST['stock'];  // จำนวนในสต็อก

    // SQL สำหรับเพิ่มสินค้า
    $sql = "INSERT INTO product (name, category, price, description, features, stock) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name, $category, $price, $description, $features, $stock])) {
        // รีไดเรกต์ไปที่หน้า Home พร้อมกับข้อความแจ้งเตือน
        header('Location: Home.php?status=success');
        exit();
    } else {
        // รีไดเรกต์ไปที่หน้า Home พร้อมกับข้อความแจ้งเตือน
        header('Location: Home.php?status=error');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* การตั้งค่าโทนสีพื้นหลังแบบไล่สี */
        body {
            background: linear-gradient(135deg, #D9EAFD, #A8D8FF);
            /* ไล่สีจาก #D9EAFD ไปยัง #A8D8FF */
            /* หรือสามารถใช้หลายๆ สีได้ เช่น linear-gradient(135deg, #D9EAFD, #A8D8FF, #5B9BD5) */
        }

        /* ฟอร์มที่มีพื้นหลังขาวและเงา */
        .container {
            max-width: 600px;
            margin: auto;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        /* เพิ่มสีให้ป้ายการป้อนข้อมูล */
        .input-group-text {
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            color: #495057;
            /* สีของข้อความในป้าย */
        }

        /* ปุ่ม 'Add Product' */
        .btn-custom {
            font-size: 18px;
            padding: 12px 20px;
            width: 100%;
            border-radius: 30px;
            background-color: #4caf50;
            /* สีเขียว */
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        /* เปลี่ยนสีปุ่มเมื่อ hover */
        .btn-custom:hover {
            background-color: #45a049;
        }

        /* ปุ่ม 'Back to Home' */
        .btn-back {
            font-size: 16px;
            padding: 12px 20px;
            width: 100%;
            border-radius: 30px;
            margin-top: 1rem;
            background-color: #6c757d;
            /* สีเทา */
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        /* เปลี่ยนสีปุ่ม 'Back to Home' เมื่อ hover */
        .btn-back:hover {
            background-color: #5a6268;
        }

        /* ปรับปรุงช่องกรอกข้อมูล */
        .form-control {
            border-radius: 30px;
            font-size: 16px;
            border: 1px solid #ccc;
            padding: 12px;
            background-color: #f8f9fa;
        }

        /* สีของหัวข้อ */
        h2 {
            font-size: 28px;
            margin-bottom: 1.5rem;
            color: #333;
            /* สีของหัวข้อ */
        }

        /* เพิ่มพื้นที่ให้ช่องข้อความเพื่อความสะดวก */
        textarea.form-control {
            background-color: #f8f9fa;
            padding: 10px;
            font-size: 14px;
            color: #495057;
        }

        /* ปรับขนาดของปุ่มให้เหมาะสม */
        input[type="number"],
        select,
        textarea {
            font-size: 16px;
            padding: 12px;
        }

        /* เพิ่มเส้นขอบและเปลี่ยนสีของปุ่มเมื่อ hover */
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            border-color: #4caf50;
            /* สีเขียวสำหรับการโฟกัส */
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Add New Product</h2>
        <form method="POST">
            <!-- ชื่อสินค้า -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-cube"></i></span>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
            </div>

            <!-- หมวดหมู่สินค้า -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-list"></i></span>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Home">Home</option>
                    <option value="Beauty">Beauty</option>
                    <option value="Toys">Toys</option>
                    <!-- สามารถเพิ่มหมวดหมู่เพิ่มเติมได้ -->
                </select>
            </div>

            <!-- ราคา -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
            </div>

            <!-- คำอธิบายสินค้า -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                <textarea class="form-control" id="description" name="description" placeholder="Description"
                    rows="4"></textarea>
            </div>

            <!-- คุณสมบัติเฉพาะ (เช่น ขนาด, สี) -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-cogs"></i></span>
                <select class="form-control" id="features" name="features" required>
                    <option value="">Select Feature</option>
                    <option value="Size Xl">Size Xl</option>
                    <option value="Color made to order">Color Made to order</option>
                    <option value="Special Material">Special Material</option>
                    <option value="Light weight">Light weight</option>
                </select>
            </div>

            <!-- จำนวนในสต็อก -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Quantity" required>
            </div>

            <button type="submit" class="btn btn-success btn-custom">Add Product</button>
        </form>

        <a href="Home.php" class="btn btn-secondary btn-back">Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>