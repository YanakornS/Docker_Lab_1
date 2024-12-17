<?php
include 'Connects/Connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // ทำการลบสินค้าเมื่อได้รับการยืนยัน
    if (isset($_POST['confirm_delete'])) {
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$product_id])) {
            // รีไดเรกต์ไปที่หน้า Home และแสดงข้อความแจ้งเตือน
            header('Location: Home.php?status=success');
            exit();
        } else {
            // รีไดเรกต์ไปที่หน้า Home และแสดงข้อความแจ้งเตือนกรณีลบไม่สำเร็จ
            header('Location: Home.php?status=error');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Delete Product</h2>

        <!-- ใช้ JavaScript เพื่อแสดง confirm dialog -->
        <form method="POST" onsubmit="return confirmDelete()">
            <p>Are you sure you want to delete this product?</p>
            <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete</button>
            <a href="Home.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this product? This action cannot be undone.');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>