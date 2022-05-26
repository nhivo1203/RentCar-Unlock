<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/bootstrap_template/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap_template/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap_template/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="" method="post">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
         height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="username" class="sr-only">Username</label>
    <input type="text" id="username" name="username"
           class="form-control <?php

           echo $model->hasError('username') ? 'is-invalid' : '' ?>"
           placeholder="Username" value="<?php echo $model->username ?? '' ?>">
    <p><?php echo $model->getFirstError('username') ?></p>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password"
           class="form-control <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>"
           placeholder="Password">
    <p><?php echo $model->getFirstError('password') ?></p>
    <label for="confirmPassword" class="sr-only">confirmPassword</label>
    <input type="password" id="confirmPassword" name="confirmPassword"
           class="form-control <?php echo $model->hasError('confirmPassword') ? 'is-invalid' : '' ?>"
           placeholder="Confirm password">
    <p><?php echo $model->getFirstError('confirmPassword') ?></p>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
</body>
</html>
