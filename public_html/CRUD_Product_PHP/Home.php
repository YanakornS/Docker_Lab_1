<?php
include 'Connects/Connect.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: Singin.php');
    exit;
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        echo "<div class='alert alert-success' role='alert'>Product added successfully!</div>";
    } elseif ($_GET['status'] == 'error') {
        echo "<div class='alert alert-danger' role='alert'>Error: There was an issue adding the product.</div>";
    }
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: Signin.php');
    exit;
}

$sql = "SELECT * FROM product";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .navbar-custom {
            background-color: #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: white !important;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-nav .nav-item .nav-link {
            color: white !important;
            border-radius: 5px;
        }

        .btn-custom {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-actions a {
            margin: 0 10px;
        }

        .table-container {
            margin-top: 3rem;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .btn-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-add:hover {
            background-color: #218838;
            text-decoration: none;
        }

        .table-container h3 {
            color: #007bff;
            text-align: center;
        }

        .product-actions a {
            margin: 0 5px;
        }

        .btn-sm {
            font-size: 14px;
        }

        .footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* ปรับปุ่มให้ใหญ่ขึ้นและมีไอคอน */
        .btn-sm {
            font-size: 16px;
            padding: 8px 16px;
        }

        .btn-sm i {
            margin-right: 5px;
        }

        .product-actions {
            display: flex;
            justify-content: center;
            /* จัดตำแหน่งปุ่มให้อยู่กลาง */
            gap: 10px;
            /* เพิ่มระยะห่างระหว่างปุ่ม */
        }

        .product-actions a {
            display: flex;
            align-items: center;
            /* จัดให้ไอคอนและข้อความอยู่ในแนวเดียวกัน */
            padding: 5px 15px;
            /* เพิ่มระยะห่างในปุ่ม */
            font-size: 14px;
            /* ขนาดข้อความในปุ่ม */
            transition: background-color 0.3s, transform 0.3s;
            /* เพิ่มเอฟเฟกต์เมื่อ hover */
        }

        .product-actions a:hover {
            transform: scale(1.05);
            /* ขยายปุ่มเล็กน้อยเมื่อ hover */
        }

        .product-actions .edit-btn {
            background-color: #ffc107;
            color: white;
        }

        .product-actions .edit-btn:hover {
            background-color: #e0a800;
            /* เปลี่ยนสีเมื่อ hover */
        }

        .product-actions .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .product-actions .delete-btn:hover {
            background-color: #c82333;
            /* เปลี่ยนสีเมื่อ hover */
        }

        .product-actions i {
            margin-right: 5px;
            /* เพิ่มระยะห่างระหว่างไอคอนกับข้อความ */
            font-size: 16px;
            /* ขนาดไอคอน */
        }
    </style>
</head>

<body>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Product Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="#">
                            <img src="https://cdn-icons-png.flaticon.com/512/9131/9131478.png" alt="Profile Image"
                                class="profile-img me-2">
                            <span class="username-color"><?php echo $_SESSION['username']; ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST">
                            <button type="submit" name="logout" class="btn btn-danger btn-sm rounded-pill px-4 py-2">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-1">

        <!-- Add Product Button -->
        <div class="btn-header">
            <a href="AddProduct.php" class="btn-add">
                <i class="fas fa-plus-circle me-2"></i> Add Product
            </a>
        </div>

        <!-- Product List Table -->
        <div class="table-container">
            <h3>Product List</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Features</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['category']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $product['features']; ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td class="product-actions">
                                <a href="EditProduct.php?id=<?php echo $product['id']; ?>"
                                    class="btn btn-warning btn-sm edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="delete.php?id=<?php echo $product['id']; ?>"
                                    class="btn btn-danger btn-sm delete-btn">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>&copy; 2024 Product Management System. All Rights Reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>