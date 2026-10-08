<?php
session_start();
if (isset($_SESSION['user_logged_in'])) {
    header("Location: ../index.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = 'Penyelaras HEP';
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Nama pengguna atau kata laluan salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Log Masuk - Sistem Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center vh-100">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Log Masuk Staf</h3>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Pengguna</label>
                            <input type="text" name="username" class="form-control" required placeholder="admin">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kata Laluan</label>
                            <input type="password" name="password" class="form-control" required placeholder="admin123">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Log Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>