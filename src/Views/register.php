<?php

?>
<h1>Register</h1>

<form action="register" method="post">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label>First name</label>
                <input type="text"
                       name="firstname"
                       class="form-control <?php echo $data['errors']->hasError('firstname') ? 'is-invalid' : '' ?>"
                >
                <div class="invalid-feedback">
                    <?php echo $data['errors']->getFirstError('firstname') ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Last name</label>
                <input type="text"
                       name="lastname"
                       class="form-control <?php echo $data['errors']->hasError('lastname') ? 'is-invalid' : '' ?>"
                >
                <div class="invalid-feedback">
                    <?php echo $data['errors']->getFirstError('lastname') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label>Email address</label>
        <input
                type="email"
                name="email"
                class="form-control <?php echo $data['errors']->hasError('email') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('email') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input
                type="text"
                name="username"
                class="form-control <?php echo $data['errors']->hasError('username') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('username') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password"
               name="password"
               class="form-control <?php echo $data['errors']->hasError('password') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('password') ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Confirm Password</label>
        <input
                type="password"
                name="confirmPassword"
                class="form-control <?php echo $data['errors']->hasError('confirmPassword') ? 'is-invalid' : '' ?>"
        >
        <div class="invalid-feedback">
            <?php echo $data['errors']->getFirstError('confirmPassword') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
