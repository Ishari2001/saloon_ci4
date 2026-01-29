<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-4">

<div class="card shadow">
<div class="card-body">
<h4 class="text-center mb-3">🔐 Admin Login</h4>

<?php if(session('error')): ?>
<div class="alert alert-danger"><?= session('error') ?></div>
<?php endif ?>

<form method="post" action="<?= site_url('admin/login') ?>">
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
    <button class="btn btn-primary w-100">Login</button>
</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>
