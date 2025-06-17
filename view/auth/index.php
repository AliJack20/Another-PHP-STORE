<!-- views/auth/index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, <?= htmlspecialchars($user['fullname']) ?>!</h2>
    <p>You are logged in with email: <?= htmlspecialchars($user['email']) ?></p>

    <a href="index.php?controller=auth&action=logout" class="btn btn-danger mt-3">Logout</a>
</div>

</body>
</html>