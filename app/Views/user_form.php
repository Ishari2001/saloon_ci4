<!DOCTYPE html>
<html>
<head>
    <title>Save User</title>
</head>
<body>

<h2>Add User</h2>

<?php if (isset($errors)) : ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error) : ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
    </ul>


<?php endif ?>
<form method="post" action="<?= base_url('user/save') ?>">
    <?= csrf_field() ?>

    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
