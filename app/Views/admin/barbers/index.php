<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Barbers</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary:#1a3e72;
    --accent:#22c55e;
    --bg:#f4f6fb;
    --card:#ffffff;
    --text:#1f2937;
}

body{
    font-family:'Inter',sans-serif;
    background:var(--bg);
    color:var(--text);
}

.page-wrapper{
    max-width:1400px;
    margin:auto;
}

.page-title{
    font-weight:700;
    color:var(--primary);
}

.card{
    border:none;
    border-radius:14px;
    background:var(--card);
    box-shadow:0 10px 25px rgba(0,0,0,.07);
}

.section-title{
    font-weight:600;
    color:var(--primary);
}

.form-control,.form-select{
    border-radius:10px;
}

.form-control:focus,.form-select:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 .2rem rgba(26,62,114,.15);
}

.btn-primary{ background:var(--primary); border:none; }
.btn-primary:hover{ background:#102c55; }

.btn-success{ background:var(--accent); border:none; }
.btn-success:hover{ background:#16a34a; }

.btn-danger{ border:none; }

.table thead{
    background:var(--primary);
    color:#fff;
}

.table td,.table th{
    vertical-align:middle;
    white-space:nowrap;
}

.table-responsive{
    border-radius:12px;
    overflow:hidden;
}

@media(max-width:768px){
    .mobile-stack thead{ display:none; }
    .mobile-stack tr{ display:block; margin-bottom:1rem; border-bottom:1px solid #e5e7eb; padding-bottom:1rem; }
    .mobile-stack td{ display:block; border:none; }
}
</style>
</head>

<body class="p-3 p-md-4">
<div class="page-wrapper">

<h3 class="page-title mb-4">Manage Barbers</h3>

<div class="row g-4">

    <!-- LEFT COLUMN -->
    <div class="col-lg-6">

        <!-- ADD BARBER -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="section-title mb-3">➕ Add New Barber</h5>
                <form method="post" action="<?= base_url('admin/barbers/store') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input class="form-control" name="name" placeholder="Barber Name" required>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" name="phone" placeholder="Phone Number">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Services</label>
                            <select name="services[]" class="form-select" multiple>
                                <?php foreach($services as $s): ?>
                                <option value="<?= $s['id'] ?>"><?= esc($s['name']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success w-100">Save Barber</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- BARBERS LIST -->
        <div class="card">
            <div class="card-body">
                <h5 class="section-title mb-3">✂️ Barbers List</h5>
                <div class="table-responsive">
                    <table class="table table-hover mobile-stack">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Services</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($barbers as $b): ?>
                        <tr>
                            <form method="post" action="<?= base_url('admin/barbers/update/'.$b['id']) ?>">
                                <?= csrf_field() ?>
                                <td><input class="form-control form-control-sm" name="name" value="<?= esc($b['name']) ?>"></td>
                                <td><input class="form-control form-control-sm" name="phone" value="<?= esc($b['phone']) ?>"></td>
                                <td>
                                    <select name="services[]" class="form-select form-select-sm" multiple>
                                        <?php
                                        $assigned = array_column($b['services'], 'id');
                                        foreach($services as $s):
                                        ?>
                                        <option value="<?= $s['id'] ?>" <?= in_array($s['id'],$assigned)?'selected':'' ?>><?= esc($s['name']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="active" <?= $b['status']=='active'?'selected':'' ?>>Active</option>
                                        <option value="inactive" <?= $b['status']=='inactive'?'selected':'' ?>>Inactive</option>
                                    </select>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-primary mb-1">Update</button>
                                    <a href="<?= base_url('admin/barbers/delete/'.$b['id']) ?>" onclick="return confirm('Delete barber?')" class="btn btn-sm btn-danger mb-1">Delete</a>
                                </td>
                            </form>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- RIGHT COLUMN -->
    <div class="col-lg-6">

        <!-- ADD LEAVE -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="section-title mb-3">📅 Add Leave</h5>
                <form method="post" action="<?= base_url('admin/barbers/add-leave') ?>">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="barber_id" class="form-select" required>
                                <?php foreach($barbers as $b): ?>
                                <option value="<?= $b['id'] ?>"><?= esc($b['name']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <input type="text" name="reason" class="form-control" placeholder="Reason (optional)">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100">Add Leave</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- LEAVE LIST -->
       <div class="card">
    <div class="card-body">
        <h5 class="section-title mb-3">📋 Leave List</h5>

        <?php if (!empty($leaves)): ?>

            <?php
            // Group leaves by barber name
            $groupedLeaves = [];
            foreach ($leaves as $l) {
                $groupedLeaves[$l['barber_name']][] = $l;
            }
            ?>

            <?php foreach ($groupedLeaves as $barberName => $barberLeaves): ?>
                <div class="border rounded p-3 mb-3">
                    <h6 class="fw-bold mb-2">
                        ✂️ <?= esc($barberName) ?>
                    </h6>

                    <?php foreach ($barberLeaves as $leave): ?>
                        <div class="ps-3 mb-2 border-start">
                            <small class="d-block">
                                📅 <?= esc($leave['start_date']) ?> → <?= esc($leave['end_date']) ?>
                            </small>
                            <?php if (!empty($leave['reason'])): ?>
                                <span class="text-muted small">
                                    Reason: <?= esc($leave['reason']) ?>
                                </span>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>

                </div>
            <?php endforeach ?>

        <?php else: ?>
            <p class="text-muted">No leave records found.</p>
        <?php endif ?>
    </div>
</div>


    </div>

</div>

</div>
</body>
</html>
