<h1>Rent Car</h1>
<h3>Welcome to Nhi Vo Website</h3>

<div class="container">
    <div class="row">
        <?php foreach ($data['cars'] as $car) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?= $car['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $car['price'] ?>$/Day</h5>
                        <h5 class="card-title"><?= $car['name'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Nhi Vo</h6>
                        <p class="card-text"><?= $car['type'] ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
