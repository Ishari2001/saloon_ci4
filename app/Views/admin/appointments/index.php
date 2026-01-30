<h3 class="mb-4">All Appointments</h3>

<table class="custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Barber</th>
            <th>Services</th>
            <th>Date</th>
            <th>Start</th>
            <th>End</th>
            <th>Total Price</th> <!-- ✅ Added -->
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($appointments as $a): ?>
        <tr>
            <td><?= $a['id'] ?></td>
            <td><?= $a['customer_name'] ?></td>
            <td><?= $a['email'] ?></td> 
            <td><?= $a['phone'] ?></td>
            <td><?= $a['barber_name'] ?></td>
            <td><?= implode(', ', $a['services']) ?></td>
            <td><?= $a['date'] ?></td>
            <td><?= $a['start_time'] ?></td>
            <td><?= $a['end_time'] ?></td>
            <td>Rs <?= number_format($a['total_price'], 2) ?></td> <!-- ✅ Display total price -->
            <td>
                <span class="badge <?= $a['status'] ?>">
                    <?= ucfirst($a['status']) ?>
                </span>
            </td>
            <td>
               <form method="post" action="<?= base_url('admin/appointments/update/'.$a['id']) ?>" class="d-flex gap-2 align-items-center">
                    <?= csrf_field() ?>
                    
                    <select name="status" class="form-select form-select-sm status-select">
                        <option value="pending"    <?= $a['status']=='pending'?'selected':'' ?>>Pending</option>
                        <option value="confirmed"  <?= $a['status']=='confirmed'?'selected':'' ?>>Confirmed</option>
                        <option value="completed"  <?= $a['status']=='completed'?'selected':'' ?>>Completed</option>
                        <option value="cancelled"  <?= $a['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                    </select>

                    <button type="submit" class="btn btn-update">Update</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<style>
/* Table container */
.custom-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    border-radius: 10px;
    overflow: hidden;
}

/* Table header */
.custom-table thead tr {
    background: linear-gradient(90deg, #4e73df, #1cc88a);
    color: #fff;
    text-align: left;
}

.custom-table thead th {
    padding: 12px 15px;
    font-weight: 600;
}

/* Table body rows */
.custom-table tbody tr {
    background: #fff;
    transition: all 0.2s ease-in-out;
}

.custom-table tbody tr:nth-child(even) {
    background: #f8f9fc;
}

.custom-table tbody tr:hover {
    background: #e2e6ea;
}

/* Table cells */
.custom-table tbody td {
    padding: 10px 12px;
    vertical-align: middle;
}

/* Status badges */
.badge {
    padding: 5px 10px;
    border-radius: 12px;
    color: #fff;
    font-size: 0.85rem;
    text-align: center;
    display: inline-block;
}

.badge.pending { background-color: #6c757d; }       /* Gray */
.badge.confirmed { background-color: #198754; }     /* Green */
.badge.completed { background-color: #0d6efd; }     /* Blue */
.badge.cancelled { background-color: #dc3545; }     /* Red */

/* Buttons */
.btn-primary {
    border-radius: 5px;
    font-size: 0.85rem;
}
.form-select-sm {
    font-size: 0.85rem;
    border-radius: 5px;
}

.status-select {
    border-radius: 8px;
    min-width: 120px;
    padding: 5px 10px;
    font-size: 0.85rem;
    border: 1px solid #ced4da;
    transition: all 0.2s ease-in-out;
}

.status-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
}

/* Update button */
.btn-update {
    background: linear-gradient(90deg, #4e73df, #1cc88a);
    color: #fff;
    font-size: 0.85rem;
    font-weight: 500;
    padding: 5px 12px;
    border: none;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
}

.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>
