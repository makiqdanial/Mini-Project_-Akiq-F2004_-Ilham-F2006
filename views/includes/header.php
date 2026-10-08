<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengurusan Acara Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">HEP Event Manager</a>
    <div>
        <span class="text-light me-3">Pengguna: <?= $_SESSION['username'] ?? 'Staf'; ?></span>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Log Keluar</a>
    </div>
  </div>
</nav>
<div class="container">