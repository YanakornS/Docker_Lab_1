<?php
include 'Connects/Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $user['username'];
        header('Location: Home.php');
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Invalid username or password.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #D9EAFD;
        }

        .login-form {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #4A90E2;
            border-color: #4A90E2;
        }

        .btn-primary:hover {
            background-color: #357ABD;
            border-color: #357ABD;
        }

        .input-group-text {
            background-color: #E6F2FF;
            color: #4A90E2;
        }

        a.text-link {
            color: #4A90E2;
        }

        a.text-link:hover {
            color: #357ABD;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100" style="background-color: #D9EAFD;">

    <div class="login-form w-100 px-4 py-5 rounded"
        style="max-width: 400px; background-color: #ffffff; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);">
        <div class="text-center mb-4">
            <i class="fas fa-user-circle text-primary" style="font-size: 3rem;"></i>
            <h2 class="mt-2 text-primary">Welcome Back</h2>
            <p class="text-muted">Please log in to continue</p>
        </div>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                    <input type="text" name="username" id="username" class="form-control"
                        placeholder="Enter your username" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-lock text-primary"></i></span>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter your password" required>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="text-primary text-decoration-none">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill">SignIn</button>
        </form>
        <p class="mt-4 text-center">Don't have an account? <a href="Signup.php"
                class="text-primary fw-bold text-decoration-none">Register here</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>