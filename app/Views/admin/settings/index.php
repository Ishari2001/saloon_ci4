<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h3>Salon Settings</h3>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Form to add/update setting -->
<div class="card mb-4 p-3">
    <form action="<?= site_url('admin/settings/save') ?>" method="post">
        <?= csrf_field() ?>
        <div class="row g-3 align-items-end">

            <!-- Key -->
            <div class="col-md-3">
                <label>Key</label>
                <select name="key" class="form-control" id="keySelect" required>
                    <option value="open_time">Open Time</option>
                    <option value="close_time">Close Time</option>
                    <option value="full_day_closed">Full Day Closed</option>
                </select>
            </div>

            <!-- Value -->
            <div class="col-md-3">
                <label>Value</label>
                <input type="time" name="value" class="form-control" id="timeInput">
                <small class="text-muted" id="fullDayText" style="display:none;">
                    For full day closed, leave time empty
                </small>
            </div>

            <!-- Date -->
            <div class="col-md-3">
                <label>Date (optional)</label>
                <input type="date" name="date" class="form-control">
                <small class="text-muted">Leave empty for default hours</small>
            </div>

            <!-- Submit -->
            <div class="col-md-3">
                <button class="btn btn-primary w-100">Save</button>
            </div>
        </div>
    </form>
</div>

<!-- Display existing settings -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Key</th>
            <th>Value</th>
            <th>Date</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($settings as $s): ?>
        <tr>
            <td><?= $s['key'] ?></td>
            <td>
                <?php if($s['key']=='full_day_closed' && $s['value']=='1'): ?>
                    ✅ Closed
                <?php else: ?>
                    <?= $s['value'] ?>
                <?php endif; ?>
            </td>
            <td><?= $s['date'] ?: 'Default' ?></td>
            <td><?= $s['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
const keySelect = document.getElementById('keySelect');
const timeInput = document.getElementById('timeInput');
const fullDayText = document.getElementById('fullDayText');

function toggleTimeInput() {
    if (keySelect.value === 'full_day_closed') {
        timeInput.style.display = 'none';
        fullDayText.style.display = 'block';
        timeInput.value = ''; // clear time if switching
    } else {
        timeInput.style.display = 'block';
        fullDayText.style.display = 'none';
    }
}

// Initial toggle
toggleTimeInput();

// On key change
keySelect.addEventListener('change', toggleTimeInput);
</script>

<?= $this->endSection() ?>
