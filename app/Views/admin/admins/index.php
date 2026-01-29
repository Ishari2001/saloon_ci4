<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.admin-card{
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    border:none;
}
.form-control{
    border-radius:10px;
}
.btn{
    border-radius:10px;
}
.badge-status{
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}
</style>

<div class="container-fluid">

    <div class="row g-4">

        <!-- ================= ADD ADMIN ================= -->
        <div class="col-lg-4">
            <div class="card admin-card p-4">
                <h5 class="fw-bold mb-3">➕ Add New Admin</h5>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('admin/admins/store') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" class="form-control" placeholder="Admin name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="admin@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button class="btn btn-primary w-100">
                        ✅ Create Admin
                    </button>
                </form>
            </div>
        </div>

        <!-- ================= ADMIN LIST ================= -->
        <div class="col-lg-8">
            <div class="card admin-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">👥 Admin Users</h5>
                    <span class="text-muted small">
                        Total: <?= count($admins) ?>
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($admins)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No admins found
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach($admins as $a): ?>
                            <tr>
                                
                                <td class="fw-semibold"><?= esc($a['name']) ?></td>
                                <td><?= esc($a['email']) ?></td>
                               <td>
    <?php if($a['status']): ?>
        <a href="<?= site_url('admin/admins/status/'.$a['id']) ?>"
           class="badge bg-success text-decoration-none">
            Active
        </a>
    <?php else: ?>
        <a href="<?= site_url('admin/admins/status/'.$a['id']) ?>"
           class="badge bg-secondary text-decoration-none">
            Disabled
        </a>
    <?php endif; ?>
</td>

                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
