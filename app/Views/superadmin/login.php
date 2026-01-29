<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Super Admin Login</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
:root{
    --primary:#1a3e72;
    --bg:#f4f6fb;
}

body{
    min-height:100vh;
    background:var(--bg);
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:Inter,system-ui;
}

.login-card{
    background:#fff;
    width:100%;
    max-width:420px;
    padding:40px;
    border-radius:16px;
    box-shadow:0 10px 35px rgba(0,0,0,.08);
}

.login-title{
    text-align:center;
    font-weight:600;
    color:var(--primary);
    margin-bottom:25px;
}

.form-control{
    padding:12px;
    border-radius:10px;
}

.form-control:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 .2rem rgba(26,62,114,.2);
}

.btn-login{
    background:var(--primary);
    border:none;
    padding:12px;
    border-radius:10px;
    font-weight:500;
}

.btn-login:hover{
    background:#0f2857;
}

.brand{
    text-align:center;
    margin-bottom:20px;
    font-weight:600;
    color:#333;
}

</style>
</head>

<body>

<div class="login-card">

    <div class="brand">🔐 Super Admin Panel</div>

    <h4 class="login-title">Sign in</h4>

    <?php if(session()->getFlashdata('msg')): ?>
        <div class="alert alert-danger text-center">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('superadmin/login') ?>">

        <?= csrf_field() ?>

        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
        </div>

        <div class="mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-login w-100 text-white">
            Login
        </button>

    </form>

</div>

</body>
</html>
