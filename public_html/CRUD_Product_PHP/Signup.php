<?php
include 'Connects/Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql_check = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([$username]);
    $existingUser = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $message = "Username already taken. Please choose a different username.";
        $alertClass = "alert-danger";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$username, $password])) {
            $message = "Registration successful! Welcome, $username.";
            $alertClass = "alert-success";
        } else {
            $message = "Error: " . $stmt->errorInfo();
            $alertClass = "alert-danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: #D9EAFD;
            font-family: 'Roboto', sans-serif;
        }

        .register-form {
            background-color: #fff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 420px;
            width: 100%;
        }

        .register-form h2 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 25px;
            border: 1px solid #ddd;
            padding-left: 40px;
            font-size: 16px;
        }

        .input-group-text {
            background-color: #EAF1F5;
            border: none;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            border-radius: 25px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .alert {
            font-size: 16px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .text-link {
            color: #3498db;
            text-decoration: none;
        }

        .text-link:hover {
            color: #2980b9;
        }

        .footer-link {
            color: #3498db;
            font-size: 14px;
            text-decoration: none;
        }

        .footer-link:hover {
            color: #2980b9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 16px;
            color: #2c3e50;
        }

        .input-group-text i {
            color: #3498db;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="register-form">
        <h2 class="text-center">Create Your Account</h2>

        <?php if (isset($message)): ?>
            <div class="alert <?php echo $alertClass; ?> text-center">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username"
                    required>
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-check-circle"></i> SingUp
            </button>
        </form>

        <p class="mt-3 text-center">
            Already have an account? <a href="Signin.php" class="text-link">
                <i class="fas fa-sign-in-alt"></i> Signin here
            </a>
        </p>

        <div class="text-center">
            <a href="index.php" class="footer-link">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>