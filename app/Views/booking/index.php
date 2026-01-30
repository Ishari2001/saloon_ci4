<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= esc($system['site_name']) ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f7fb;
    font-family:Inter,system-ui;
}
.section{
    background:#fff;
    border-radius:14px;
    padding:20px;
    margin-bottom:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}
.card-item{
    cursor:pointer;
    border:2px solid transparent;
    transition:.25s;
}
.card-item:hover{ transform:translateY(-3px); }
.card-item.active{
    border-color:#0d6efd;
    background:#eef5ff;
}
.time-btn{
    min-width:90px;
    margin-bottom:5px;
}
.time-btn.active{
    background:#0d6efd;
    color:#fff;
}
.time-btn.full{
    background:#e5e7eb;
    color:#9ca3af;
    pointer-events:none;
}
.confirm-box{
    background:#f8fafc;
    border-radius:12px;
    padding:15px;
}
</style>
</head>

<body class="container py-4">

<div class="text-center mb-4">

<?php if(!empty($system['logo'])): ?>
<img src="<?= base_url('uploads/'.$system['logo']) ?>"
     style="max-height:90px;margin-bottom:10px">
<?php endif; ?>

<h3 class="fw-bold">
    <?= esc($system['site_name']) ?>
</h3>

</div>


<!-- STEP 1: SERVICE -->
<div class="section">
<h5>1️⃣ Choose Service</h5>
<div id="serviceList" class="row g-3"></div>
</div>

<!-- STEP 2: BARBER -->
<div class="section">
<h5>2️⃣ Choose Beautician</h5>
<div id="barberList" class="row g-3 text-center">
    <div class="text-muted">Select a service first</div>
</div>
</div>

<!-- STEP 3: DATE & TIME -->
<div class="section">
<h5>3️⃣ Select Date & Time</h5>
<input type="date" id="bookDate" class="form-control mb-3">

<div id="timeList" class="d-flex gap-2 flex-wrap">
    <div class="text-muted">Select service, beautician & date</div>
</div>
</div>

<!-- STEP 4: CONFIRM -->
<!-- STEP 4: CONFIRM -->
<div class="section">
    <h5>4️⃣ Confirm Booking</h5>

   <div class="confirm-box mb-3">
    <div id="cService">Service: —</div>
    <div id="cBarber">Beautician: —</div>
    <div id="cDate">Date: —</div>
    <div id="cTime">Time: —</div>
    <div id="cPrice" class="fw-bold">Price: Rs 0</div> <!-- NEW -->

    <div class="mb-3">
        <label for="cName" class="form-label">Name:</label>
        <input type="text" id="cName" class="form-control" placeholder="Enter your name" required>
    </div>

    <div class="mb-3">
        <label for="cPhone" class="form-label">Phone:</label>
        <input type="text" id="cPhone" class="form-control" placeholder="Enter your phone" required>
    </div>

    <div class="mb-3">
        <label for="cEmail" class="form-label">Email:</label>
        <input type="email" id="cEmail" class="form-control" placeholder="Enter your email" required>
    </div>
</div>

    <button class="btn btn-success w-100 py-2" onclick="confirmBooking()">
        ✅ Confirm Appointment
    </button>
</div>



<script>
let selectedService = null;
let selectedServiceName = '';
let selectedDuration = 0;
let selectedSeats = 1;

let selectedBarber = null;
let selectedBarberName = '';

let selectedTime = null;

/* ===================== LOAD SERVICES ===================== */
function loadServices() {
    fetch("<?= base_url('booking/services') ?>")
        .then(r => r.json())
        .then(services => {
            serviceList.innerHTML = '';
            services.forEach(s => {
                serviceList.innerHTML += `
                <div class="col-md-4">
                    <div class="card card-item p-2"
                         onclick="selectService(${s.id}, '${s.name}', ${s.duration_minutes}, ${s.seat_count || 1}, this, ${s.price})">

                        <img src="<?= base_url('uploads/services/') ?>${s.image}"
                             class="img-fluid rounded mb-2"
                             style="height:140px; object-fit:cover"
                             onerror="this.src='<?= base_url('uploads/no-image.png') ?>'">

                        <h6 class="fw-bold">${s.name}</h6>
                        <small>${s.duration_minutes} min | Seats: ${s.seat_count || 1}</small>
                        <div class="fw-bold">Rs ${s.price}</div>
                    </div>
                </div>`;
            });
        })
        .catch(err => {
            console.error("Failed to load services:", err);
            serviceList.innerHTML = '<div class="text-danger">Failed to load services. Please try again later.</div>';
        });
}


/* ===================== SELECT SERVICE ===================== */

let selectedPrice = 0;

function selectService(id, name, duration, seats, el, price){
    document.querySelectorAll('.card-item').forEach(c=>c.classList.remove('active'));
    el.classList.add('active');

    selectedService = id;
    selectedServiceName = name;
    selectedDuration = duration;
    selectedSeats = seats;
    selectedPrice = price; // set selected price

    cService.innerText = "Service: " + name;
    cPrice.innerText   = "Price: Rs " + price; // update UI

    barberList.innerHTML = '<div class="text-muted">Loading barbers...</div>';
    timeList.innerHTML = '<div class="text-muted">Select barber & date</div>';

    loadBarbers();
}

/* ===================== LOAD BARBERS ===================== */
function loadBarbers(){
    if(!selectedService || !bookDate.value){
        barberList.innerHTML = '<div class="text-muted">Select date first</div>';
        return;
    }

    fetch(`<?= base_url('booking/barbers') ?>/${selectedService}?date=${bookDate.value}`)
    .then(r=>r.json())
    .then(barbers=>{
        barberList.innerHTML='';

        if(barbers.length === 0){
            barberList.innerHTML =
              '<div class="text-danger">No barbers available on this date</div>';
            return;
        }

        barbers.forEach(b=>{
            barberList.innerHTML += `
            <div class="col-md-3">
                <div class="card card-item p-3"
                     onclick="selectBarber(${b.id},'${b.name}',this)">
                    ✂️ ${b.name}
                </div>
            </div>`;
        });
    });
}

/* ===================== SELECT BARBER ===================== */
function selectBarber(id,name,el){
    document.querySelectorAll('#barberList .card-item')
        .forEach(c=>c.classList.remove('active'));

    el.classList.add('active');

    selectedBarber = id;
    selectedBarberName = name;

    cBarber.innerText = "Barber: " + name;

    loadSlots();
}

/* ===================== LOAD TIME SLOTS (WITH SEAT CHECK) ===================== */
function loadSlots(){
    if(!selectedService || !selectedBarber || !bookDate.value){
        return;
    }

    timeList.innerHTML = '<div class="text-muted">Loading slots...</div>';

    fetch(`<?= base_url('booking/slots') ?>?service_id=${selectedService}&barber_id=${selectedBarber}&date=${bookDate.value}`)
.then(r=>r.json())
.then(slots=>{
    timeList.innerHTML='';
    if(slots.error){
        timeList.innerHTML = `<div class="text-danger">${slots.error}</div>`;
        return;
    }

    slots.forEach(slot=>{
        const full = slot.booked >= selectedSeats;
        timeList.innerHTML += `
            <button class="btn btn-outline-primary time-btn ${full?'full':''}"
                    onclick="selectTime('${slot.time}',this)">
                ${slot.time} ${full? '(Full)':''} <br>
                <small>${slot.booked}/${selectedSeats}</small>
            </button>`;
    });
});

}

/* ===================== SELECT TIME ===================== */
function selectTime(t,el){
    if(el.classList.contains('full')) return;

    document.querySelectorAll('.time-btn').forEach(b=>b.classList.remove('active'));
    el.classList.add('active');

    selectedTime = t;
    cTime.innerText = "Time: " + t;
    cDate.innerText = "Date: " + bookDate.value;
}

/* ===================== DATE CHANGE ===================== */
bookDate.addEventListener('change', ()=>{
    cDate.innerText = "Date: " + bookDate.value;

    selectedBarber = null;
    cBarber.innerText = "Barber: —";
    timeList.innerHTML = '<div class="text-muted">Select barber</div>';

    loadBarbers(); // ✅ reload barber list based on leave
});

/* ===================== CONFIRM BOOKING ===================== */
function confirmBooking() {
    // Get input values
    let customerName  = document.getElementById('cName').value.trim();
    let customerPhone = document.getElementById('cPhone').value.trim();
    let customerEmail = document.getElementById('cEmail').value.trim();

    // Validation
    if (!customerName || !customerPhone || !customerEmail) {
        alert("Please enter your name, phone, and email");
        return;
    }

    if (!selectedService || !selectedBarber || !selectedTime || !bookDate.value) {
        alert("Please complete all steps");
        return;
    }

    // Send booking request
    fetch("<?= base_url('booking/confirm') ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        },
        body: JSON.stringify({
            name: customerName,
            phone: customerPhone,
            email: customerEmail,
            service_ids: [selectedService],
            barber_id: selectedBarber,
            date: bookDate.value,
            time: selectedTime
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.error) {
            alert("⚠️ "+res.error);
            loadSlots(); // reload slots if full
            return;
        }
        alert("✅ Booking Successful! Confirmation email sent.");
        window.location.href = "<?= base_url('/') ?>";
    });
}


/* INIT */
loadServices();
</script>

</body>
</html>
