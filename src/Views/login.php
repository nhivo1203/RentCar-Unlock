<body class="text-center">
<div class="container">
    <div class="container-fluid">
        <form class="form-signin" method="post">
            <img class="mb-4"
                 src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBMFV0REE9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--7a4350d76ced467ee165ce6b30eb4d83bf4c6eb9/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/nfq-asia-8bit-rockstars-logo.png"
                 alt="" width="72"
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
