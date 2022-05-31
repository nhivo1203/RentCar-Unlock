<?php

?>
<h1>Create Booking</h1>

<form action="createbooking" method="post">
    <div class="mb-3">
        <label>Car ID</label>
        <input type="number"
               name="car_id"
               class="form-control <?php echo $data['errors']->hasError('car_id') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('car_id') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>User ID</label>
        <input
                type="number"
                name="user_id"
                class="form-control <?php echo $data['errors']->hasError('user_id') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('user_id') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Check In</label>
        <input
                type="date"
                name="check_in"
                class="form-control <?php echo $data['errors']->hasError('check_in') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('check_in') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Check Out</label>
        <input type="date"
               name="check_out"
               class="form-control <?php echo $data['errors']->hasError('check_out') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('check_out') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Total Price</label>
        <input
                type="number"
                value=1
                name="total"
                class="form-control <?php echo $data['errors']->hasError('total') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('total') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
