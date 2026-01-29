<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'Admin Dashboard' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body { background:#f5f7fb; }
        .sidebar {
            width:250px;
            min-height:100vh;
            background:#1e293b;
        }
        .sidebar a {
            color:#cbd5e1;
            text-decoration:none;
            padding:12px 20px;
            display:block;
        }
        .sidebar a:hover, .sidebar a.active {
            background:#2563eb;
            color:#fff;
        }
    </style>
</head>

<body>
<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="text-white text-center py-3 border-bottom">Salon Admin</h5>

        <a href="<?= site_url('admin/dashboard') ?>" class="<?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
            <i class="fa fa-chart-line me-2"></i> Dashboard
        </a>

        <a href="<?= site_url('admin/services') ?>" class="<?= uri_string() == 'admin/services' ? 'active' : '' ?>">
            <i class="fa fa-scissors me-2"></i> Services
        </a>

        <a href="<?= site_url('admin/barbers') ?>" class="<?= uri_string() == 'admin/barbers' ? 'active' : '' ?>">
            <i class="fa fa-user-tie me-2"></i> Barbers
        </a>

       <a href="<?= site_url('admin/appointments') ?>" class="<?= uri_string() == 'admin/appointments' ? 'active' : '' ?>">
    <i class="fa fa-calendar-check me-2"></i> Appointments

    <?php if(!empty($pendingAppointments)): ?>
        <span class="badge bg-danger float-end">
            <?= $pendingAppointments ?>
        </span>
    <?php endif; ?>
</a>


          <a href="<?= site_url('admin/admins') ?>" class="<?= uri_string() == 'admin/appointments' ? 'active' : '' ?>">
            <i class="fa fa-calendar-check me-2"></i> Create Admin
        </a>

        <!-- Settings link -->
        <a href="<?= site_url('admin/settings') ?>" class="<?= uri_string() == 'admin/settings' ? 'active' : '' ?>">
            <i class="fa fa-cogs me-2"></i> Settings
        </a>

        <a href="<?= site_url('admin/logout') ?>" class="text-danger">
            <i class="fa fa-sign-out me-2"></i> Logout
        </a>
    </div>

    <!-- Content -->
    <div class="flex-grow-1 p-4">
        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
