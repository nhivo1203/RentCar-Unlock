<?php

?>
<h1>Register</h1>

<form action="" method="post">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label>First name</label>
                <input type="text" name="firstname" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label>Last name</label>
                <input type="text" name="lastname" class="form-control">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label>Email address</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
