<body class="text-center">
<div class="container">
    <div class="container-fluid">
        <form class="form-signin" method="post">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
                 height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="email" class="sr-only">email</label>
            <input type="text" id="email" name="email"
                   class="form-control "
                   placeholder="email" value="<?= $data['email'] ?? '' ?>">
            <p><?= $data['error']['email'] ?? '' ?></p>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password"
                   class="form-control "
                   placeholder="Password">
            <p><?= $data['error']['password'] ?? '' ?></p>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
        </form>
    </div>
</div>
</body>
