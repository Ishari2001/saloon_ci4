<!DOCTYPE html>
<html>
<head>
    <title>Admin Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img{
            height:150px;
            object-fit:cover;
            border-radius:10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">

    <h3 class="mb-4">Gallery Manager</h3>

    <!-- Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Upload form -->
    <form method="post" action="<?= base_url('admin/gallery/upload') ?>" enctype="multipart/form-data" class="mb-4">
        <input type="file" name="image" required class="form-control mb-2">
        <button class="btn btn-primary">Upload Image</button>
    </form>

    <!-- Image list -->
    <div class="row g-3">
        <?php foreach($images as $img): ?>
            <div class="col-md-3 text-center">
                <img src="<?= base_url('uploads/gallery/'.$img['image']) ?>" class="w-100 mb-2">
                <a href="<?= base_url('admin/gallery/delete/'.$img['id']) ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Delete image?')">
                   Delete
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>
</body>
</html>
