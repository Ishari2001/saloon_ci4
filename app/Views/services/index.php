<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - <?= esc($system['site_name']) ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    /* SECTION TITLE */
    .services-section .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #222;
        position: relative;
        margin-bottom: 3rem;
    }
    .services-section .section-title::after {
        content: '';
        width: 80px;
        height: 4px;
        background: #ff4d6d;
        display: block;
        margin: 10px auto 0;
        border-radius: 3px;
    }

    /* SERVICE CARD */
    .service-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    /* SERVICE IMAGE */
    .service-img img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .service-card:hover .service-img img {
        transform: scale(1.05);
    }

    /* SERVICE BODY */
    .service-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .service-body h5 {
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 10px;
        color: #333;
    }

    .service-body .desc {
        font-size: 0.95rem;
        color: #666;
        flex: 1;
    }

    .service-body .service-info {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        margin-top: 15px;
        color: #333;
    }

    /* BUTTON */
    .service-body .btn {
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: background 0.3s, transform 0.3s;
    }

    .service-body .btn:hover {
        background: #ff4d6d;
        transform: translateY(-3px);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .service-body .service-info {
            flex-direction: column;
            gap: 5px;
        }
    }
    </style>
</head>
<body>

<!-- SERVICES SECTION -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Premium Services</h2>

        <div class="row g-4">
            <?php if(!empty($services)): ?>
                <?php foreach($services as $service): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card">
                            <div class="service-img">
                                <?php if($service['image']): ?>
                                    <img src="<?= base_url('uploads/services/'.$service['image']) ?>" alt="<?= esc($service['name']) ?>">
                                <?php else: ?>
                                    <img src="<?= base_url('assets/images/default-service.png') ?>" alt="No Image">
                                <?php endif; ?>
                            </div>
                            <div class="service-body">
                                <h5><?= esc($service['name']) ?></h5>
                                <p class="desc"><?= esc($service['description']) ?></p>
                                <div class="service-info">
                                    <span>⏱ <?= esc($service['duration_minutes']) ?> min</span>
                                    <span>💰 Rs. <?= esc($service['price']) ?></span>
                                </div>
                                <!-- <a href="<?= base_url('booking') ?>" class="btn btn-primary mt-3">Book Now</a> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-muted">No services available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
