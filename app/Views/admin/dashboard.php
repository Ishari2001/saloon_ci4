<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">
    <i class="fa fa-chart-line me-2 text-primary"></i> Dashboard Overview
</h3>
<style>
.card{
    border-radius:16px;
}
.card-body h6{
    color:#64748b;
}
.card-body h3{
    font-weight:700;
}
</style>


<!-- Stats -->
<div class="row g-4 mb-4">
    <?php
        $weeklyBookings = $weeklyBookings ?? '[]';
        $weeklyRevenue  = $weeklyRevenue ?? '[]';
    ?>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Appointments</h6>
                <h3><?= $totalAppointments ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Today Bookings</h6>
                <h3><?= $todayBookings ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Revenue</h6>
                <h3>Rs. <?= number_format($totalRevenue) ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Active Barbers</h6>
                <h3><?= $activeBarbers ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Bookings (Last 7 Days)</h6>
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Revenue (Last 7 Days)</h6>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const bookingData = <?= $weeklyBookings ?>;
const revenueData = <?= $weeklyRevenue ?>;

/* BOOKINGS */
new Chart(document.getElementById('bookingChart'), {
    type: 'line',
    data: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        datasets: [{
            label: 'Bookings',
            data: bookingData,
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display:false }
        }
    }
});

/* REVENUE */
new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        datasets: [{
            label: 'Revenue',
            data: revenueData,
            borderRadius: 10
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display:false }
        }
    }
});

</script>


<?= $this->endSection() ?>
