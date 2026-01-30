<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            text-align: center;
            margin: 30px 0;
            color: #343a40;
        }
        .gallery img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s;
            width: 100%;
        }
        .gallery img:hover {
            transform: scale(1.05);
        }
        .gallery .card {
            border: none;
            background: transparent;
            overflow: hidden;
        }
        .no-images {
            text-align: center;
            color: #6c757d;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2>Our Gallery</h2>

    <div class="row gallery g-3">
        <?php if(!empty($images)): ?>
            <?php foreach($images as $img): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card">
                        <img src="<?= base_url('uploads/gallery/'.$img['image']) ?>" alt="Gallery Image">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-images">No images available at the moment.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle (Optional for responsive behavior) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
