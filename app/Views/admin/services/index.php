<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Services</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
:root {
    --primary-color: #1a3e72;  /* Deep Blue */
    --secondary-color: #f5f7fa; /* Light Gray Background */
    --accent-color: #22c55e;   /* Green Accent */
    --text-color: #1f2937;     /* Dark Gray Text */
    --card-shadow: rgba(0, 0, 0, 0.08);
}

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--secondary-color);
    color: var(--text-color);
    padding: 20px;
}

h3 {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.card {
    border-radius: 12px;
    box-shadow: 0 4px 12px var(--card-shadow);
}

.card-title {
    color: var(--primary-color);
    font-weight: 600;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(26, 62, 114, 0.25);
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: #0f2857;
    border-color: #0f2857;
}

.btn-success {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
}

.btn-success:hover {
    background-color: #1aa34d;
    border-color: #1aa34d;
}

.btn-warning {
    background-color: #f59e0b;
    border-color: #f59e0b;
    color: #fff;
}

.btn-warning:hover {
    background-color: #d97706;
    border-color: #d97706;
}

.table {
    border-radius: 12px;
    overflow: hidden;
}

.table thead {
    background-color: var(--primary-color);
    color: #fff;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #e9efff;
}

.table-hover tbody tr:hover {
    background-color: #d2e0ff;
}

img {
    border-radius: 8px;
}

label.form-label {
    font-weight: 500;
}
</style>
</head>
<body>

<h3>Manage Services</h3>

<!-- Add Service Form -->
<div class="card mb-5 p-4">
    <h5 class="card-title mb-4">Add New Service</h5>
    <form method="post" action="<?= base_url('admin/services/store') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <input class="form-control form-control-lg" name="name" placeholder="Service Name" required>
        </div>

        <div class="mb-3">
            <input class="form-control form-control-lg" name="duration_minutes" type="number" placeholder="Duration (minutes)" required>
        </div>

        <div class="mb-3">
            <input class="form-control form-control-lg" name="price" type="number" step="0.01" placeholder="Price" required>
        </div>

        <div class="mb-3">
            <textarea class="form-control" name="description" placeholder="Description" rows="3"></textarea>
        </div>

        <div class="mb-3">
    <input class="form-control form-control-lg" name="seat_count" type="number" min="1" placeholder="Seat Count" required>
</div>


        <div class="mb-3">
            <input class="form-control" type="file" name="image" accept="image/*">
        </div>

        <button class="btn btn-primary btn-lg w-100">Add Service</button>
    </form>
</div>

<!-- Services Table -->
<div class="card p-4">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
    <tr>
        <th>Name</th>
        <th>Duration</th>
        <th>Price</th>
        <th>Description</th>
        <th>Seat Count</th> <!-- NEW -->
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
<?php foreach($services as $s): ?>
<tr>
    <td>
        <form method="post" action="<?= base_url('admin/services/update/'.$s['id']) ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="text" name="name" class="form-control form-control-sm" value="<?= esc($s['name']) ?>" required>
    </td>
    <td>
            <input type="number" name="duration_minutes" class="form-control form-control-sm" value="<?= esc($s['duration_minutes']) ?>" required>
    </td>
    <td>
            <input type="number" step="0.01" name="price" class="form-control form-control-sm" value="<?= esc($s['price']) ?>" required>
    </td>
    <td>
            <input type="text" name="description" class="form-control form-control-sm" value="<?= esc($s['description']) ?>">
    </td>
    <td>
            <input type="number" name="seat_count" class="form-control form-control-sm" value="<?= esc($s['seat_count']) ?>" min="1" required>
    </td>
    <td>
        <?php if($s['image']): ?>
            <img src="<?= base_url('uploads/services/'.$s['image']) ?>" width="80" alt="Service Image">
        <?php endif; ?>
        <input type="file" name="image" class="form-control form-control-sm mt-1" accept="image/*">
    </td>
    <td>
        <select name="status" class="form-select form-select-sm">
            <option value="active" <?= $s['status']=='active'?'selected':'' ?>>Active</option>
            <option value="inactive" <?= $s['status']=='inactive'?'selected':'' ?>>Inactive</option>
        </select>
    </td>
    <td>
        <button type="submit" class="btn btn-sm btn-primary">Update</button>
        <a href="<?= base_url('admin/services/delete/'.$s['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">Delete</a>
    </td>
        </form>
</tr>
<?php endforeach ?>

</tbody>

        </table>
    </div>
</div>

</body>
</html>
