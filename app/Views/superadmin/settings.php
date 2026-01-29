<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Super Admin Settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
    margin:0;
    font-family:system-ui,Segoe UI;
    background:#f1f5f9;
}

.container{
    max-width:600px;
    margin:60px auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

h2{
    text-align:center;
    margin-bottom:25px;
    color:#0f172a;
}

label{
    font-weight:600;
    display:block;
    margin-bottom:6px;
}

input[type=text],
input[type=file]{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    margin-bottom:15px;
}

button{
    width:100%;
    padding:14px;
    background:#2563eb;
    border:none;
    color:white;
    border-radius:10px;
    font-weight:700;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.logo-preview{
    text-align:center;
    margin:15px 0;
}

.logo-preview img{
    max-width:140px;
    border-radius:12px;
}

.alert{
    background:#dcfce7;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    color:#166534;
    text-align:center;
    font-weight:600;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.logout{
    text-decoration:none;
    color:#ef4444;
    font-weight:700;
}
</style>
</head>

<body>

<div class="container">

<div class="top-bar">
    <strong>⚙ Super Admin</strong>
    <a class="logout" href="<?= base_url('superadmin/logout') ?>">Logout</a>
</div>

<h2>System Settings</h2>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

<label>Site Name</label>
<input type="text" name="site_name" value="<?= esc($system['site_name']) ?>" required>

<label>System Logo</label>
<input type="file" name="logo" accept="image/*">

<?php if(!empty($system['logo'])): ?>
<div class="logo-preview">
    <p>Current Logo:</p>
    <img src="<?= base_url('uploads/'.$system['logo']) ?>">
</div>
<?php endif; ?>

<button type="submit">Save Changes</button>

</form>

</div>

</body>
</html>
