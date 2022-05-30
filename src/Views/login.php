<body class="text-center">
<div class="container">
    <div class="container-fluid">
        <form class="form-signin" method="post">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                 height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="email" class="sr-only">email</label>
            <input type="text" id="email" name="email"
                   class="form-control <?php echo $data['errors']->hasError('email') ? 'is-invalid' : '' ?>"
            >
            <div class="invalid-feedback">
                <?php echo $data['errors']->getFirstError('email') ?>
            </div>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password"
                   class="form-control <?php echo $data['errors']->hasError('password') ? 'is-invalid' : '' ?>"
            >
            <div class="invalid-feedback">
                <?php echo $data['errors']->getFirstError('password') ?>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">NhiVo&copy; 2022</p>
        </form>
    </div>
</div>
</body>
