<?php $slider = selectAllOnTable($pdo, "sliders"); ?>
<?php
$image_total = count($slider);
?>
<div class="container mt-5">
    <div id="carouselExampleCaptions" class="carousel slide">

        <div class="carousel-indicators">
            <?php for ($i = 0; $i < $image_total; $i++): ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $i ?>"
                        class="<?= $i === 0 ? 'active' : '' ?>"
                        aria-current="<?= $i === 0 ? 'true' : 'false' ?>"
                        aria-label="Slide <?= $i + 1 ?>"></button>
            <?php endfor; ?>
        </div>

        <div class="carousel-inner">
            <?php foreach ($slider as $index => $item): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="imgForslider/<?= $item['image'] ?>" class="d-block w-100 img-fluid" alt="<?= htmlspecialchars($item['title']) ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-black"><?= htmlspecialchars($item['title']) ?></h5>
                        <p class="text-black"><?= htmlspecialchars($item['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
</div>
