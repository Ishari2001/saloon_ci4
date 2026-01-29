<h4>Add New Admin</h4>

<form method="post" action="<?= site_url('admin/admins/store') ?>">
    <input name="name" class="form-control mb-2" placeholder="Name" required>
    <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
    <input name="password" type="password" class="form-control mb-3" placeholder="Password" required>

    <button class="btn btn-success">Add Admin</button>
</form>
