<!DOCTYPE html>
<html>
<head>
<title><?= esc($system['site_name']) ?></title>
<style>
    body{
font-family:Poppins,system-ui;
background:#f8fafc;
}

.glass{
background:white;
box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.nav-link{
color:#0f172a;
font-weight:600;
}

.hero{
height:100vh;
background:
linear-gradient(rgba(255,255,255,.7),rgba(255,255,255,.7)),
url('../images/hero.jpg');
background-size:cover;
display:flex;
align-items:center;
}

.hero h1{
font-size:60px;
font-weight:800;
}

.btn-primary{
background:#f59e0b;
border:none;
}

.section-title{
text-align:center;
font-weight:700;
margin-bottom:40px;
}

.service-card{
background:white;
border-radius:20px;
text-align:center;
padding-bottom:20px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.3s;
}

.service-card:hover{
transform:translateY(-8px);
}

.service-card img{
width:100%;
height:220px;
object-fit:cover;
border-radius:20px 20px 0 0;
}

.service-card i{
font-size:32px;
margin:15px 0;
color:#f59e0b;
}

.about{
background:#fff7ed;
padding:80px 0;
}

.gallery-img{
width:100%;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.cta{
background:#fde68a;
padding:80px 0;
}

footer{
padding:20px;
text-align:center;
background:white;
}
footer p{
color:white;
}

.salon-footer{
background:black;
padding:60px 0 25px;
color:#475569;
}

.salon-footer h5{
font-weight:700;
margin-bottom:15px;
}

.salon-footer ul{
list-style:none;
padding:0;
}

.salon-footer ul li{
margin-bottom:8px;
}

.salon-footer ul a{
text-decoration:none;
color:white;
font-weight:500;
}

.salon-footer ul a:hover{
color:#f59e0b;
}

.salon-footer i{
color:#f59e0b;
margin-right:8px;
}

.socials a{
display:inline-flex;
width:36px;
height:36px;
border-radius:50%;
background:#fde68a;
align-items:center;
justify-content:center;
margin-right:8px;
color:white;
transition:.3s;
}

.socials a:hover{
background:#f59e0b;
color:white;
}

.copyright{
text-align:center;
font-size:14px;
margin-top:15px;
}
.about-img {
  max-width: 20%;  /* Reduce image width */
  height:60px;
}
.navbar-brand {
  display: flex;
  align-items: center; /* vertically center image and text */
  gap: 0.5rem; /* space between logo and text */
}

.navbar-brand img {
  height: 50px; /* adjust logo height */
  object-fit: contain;
}

.site-name {
  font-size: 1.5rem; /* site name font size */
  font-weight: 700; /* bold text */
  color: #333; /* text color, change as needed */
  white-space: nowrap; /* prevent text from breaking */
}

    </style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?= base_url('assets/css/salon.css') ?>">

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top glass shadow-sm py-3">
  <div class="container">

    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="#">
  <img src="<?= base_url('uploads/'.$system['logo']) ?>" height="50" alt="Logo" class="rounded me-2">
  <span class="site-name"><?= esc($system['site_name']) ?></span>
</a>

    <!-- Navbar Toggler for Mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center gap-3">
        <li class="nav-item"><a class="nav-link text-dark fw-medium" href="#">Home</a></li>
         <a class="nav-link text-dark fw-medium" href="<?= base_url('services') ?>">Services</a>
        
        <li class="nav-item">
          <a href="<?= base_url('booking') ?>" class="btn btn-primary rounded-pill px-4">Book Now</a>
        </li>
      </ul>
    </div>

  </div>
</nav>

<!-- HERO -->
<section class="hero position-relative text-white" style="background: url('<?= base_url('uploads/hero.jpg') ?>') center/cover no-repeat; min-height: 90vh; display:flex; align-items:center;">
  <div class="container text-center">
    <h1 class="display-4 fw-bold text-shadow"><?= esc($system['site_name']) ?></h1>
    <p class="lead text-shadow mb-4">Luxury Beauty & Grooming Experience</p>
    <a href="<?= base_url('booking') ?>" class="btn btn-lg btn-primary rounded-pill shadow-lg">
      Book Appointment
    </a>
  </div>
</section>


<!-- SERVICES -->
<section class="container py-5">

<h2 class="section-title">Our Services</h2>

<div class="row g-4">

<div class="col-md-4">
<div class="service-card">
<img src="<?= base_url('uploads/hair.webp') ?>">
<i class="fa-solid fa-scissors"></i>
<h5>Hair Styling</h5>
</div>
</div>

<div class="col-md-4">
<div class="service-card">
<img src="<?= base_url('uploads/facial.avif') ?>">
<i class="fa-solid fa-spa"></i>
<h5>Facial & Skin</h5>
</div>
</div>

<div class="col-md-4">
<div class="service-card">
<img src="<?= base_url('uploads/makeup.jpeg') ?>">
<i class="fa-solid fa-face-smile"></i>
<h5>Makeup</h5>
</div>
</div>

</div>

</section>

<!-- GALLERY -->
<section class="about py-5">
  <div class="container">

    <h2 class="section-title text-center mb-5">Our Salon</h2>

    <!-- Row 1: Image Left, Text Right -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6 text-center">
        <img src="<?= base_url('uploads/g1.jpg') ?>" class="img-fluid rounded shadow about-img" alt="Salon Image 1">
      </div>
      <div class="col-md-6">
        <h3>Luxury Hair Care</h3>
        <p>Experience top-notch hair styling and treatments in a relaxing and modern environment. Our expert stylists bring out the best in you.</p>
      </div>
    </div>

    <!-- Row 2: Text Left, Image Right -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6 order-md-2 text-center">
        <img src="<?= base_url('uploads/g2.jpg') ?>" class="img-fluid rounded shadow about-img" alt="Salon Image 2">
      </div>
      <div class="col-md-6 order-md-1">
        <h3>Rejuvenating Spa</h3>
        <p>Relax and refresh with our luxurious spa services. From facials to massages, we ensure a premium grooming experience.</p>
      </div>
    </div>

    <!-- Row 3: Image Left, Text Right -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6 text-center">
        <img src="<?= base_url('uploads/g3.jpg') ?>" class="img-fluid rounded shadow about-img" alt="Salon Image 3">
      </div>
      <div class="col-md-6">
        <h3>Professional Styling</h3>
        <p>Our team stays updated with the latest trends and techniques to provide the perfect look tailored to you.</p>
      </div>
    </div>

  </div>
</section>




<footer class="salon-footer mt-5">

<div class="container">

<div class="row gy-4">

<!-- BRAND -->
<div class="col-md-4">

<img src="<?= base_url('uploads/'.$system['logo']) ?>" height="50">

<p class="mt-3">
Premium beauty & grooming experience.  
Book your moment of luxury today.
</p>

<div class="socials">
<a href="#"><i class="fab fa-facebook-f"></i></a>
<a href="#"><i class="fab fa-instagram"></i></a>
<a href="#"><i class="fab fa-tiktok"></i></a>
</div>

</div>

<!-- LINKS -->
<div class="col-md-4">

<h5>Quick Links</h5>

<ul>
<li><a href="<?= base_url('/') ?>">Home</a></li>
<li><a href="<?= base_url('booking') ?>">Book Appointment</a></li>
<li><a href="#">Services</a></li>
<li><a href="#">Contact</a></li>
</ul>

</div>

<!-- CONTACT -->
<div class="col-md-4">

<h5>Contact Us</h5>

<p><i class="fa fa-clock"></i> Tue – Sun : 9:00 AM – 7:00 PM</p>
<p><i class="fa fa-location-dot"></i> Colombo, Sri Lanka</p>
<p><i class="fa fa-phone"></i> +94 77 123 4567</p>

</div>

</div>

<hr>

<p class="copyright">
© <?= date('Y') ?> <?= esc($system['site_name']) ?> — All Rights Reserved
</p>

</div>

</footer>


</body>
</html>
