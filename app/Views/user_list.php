<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>

<h2>Users</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created</th>
    </tr>

    <?php foreach ($users as $user) : ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= esc($user['name']) ?></td>
        <td><?= esc($user['email']) ?></td>
        <td><?= $user['created_at'] ?></td>
    </tr>
    <?php endforeach ?>
</table>

</body>
</html>
