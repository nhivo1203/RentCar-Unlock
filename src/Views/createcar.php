<?php

?>
<h1>Create Car</h1>

<form action="createcar" method="post">
    <div class="mb-3">
        <label>Car name</label>
        <input type="text"
               name="name"
               class="form-control <?php echo $data['errors']->hasError('name') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('name') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Car Type</label>
        <input
                type="text"
                name="type"
                class="form-control <?php echo $data['errors']->hasError('type') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('type') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Car Brand</label>
        <input
                type="text"
                name="brand"
                class="form-control <?php echo $data['errors']->hasError('brand') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('brand') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="text"
               name="image"
               class="form-control <?php echo $data['errors']->hasError('image') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('image') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input
                type="number"
                value=1
                name="price"
                class="form-control <?php echo $data['errors']->hasError('price') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('price') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
