<section class="page-section" id="contact">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 pt-5">Register</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <!-- Contact Section Form-->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form action="register" method="post">
                <!-- Name input-->
                <div class="form-floating mb-3">
                    <input
                            class="form-control <?php echo $data['errors']->hasError('firstname') ? 'is-invalid' : '' ?>"
                            name="firstname"
                            type="text"
                            placeholder="Enter your first name..."
                            data-sb-validations="required"
                    />
                    <label for="firstname">First name</label>
                    <div class="invalid-feedback">
                        <?php echo $data['errors']->getFirstError('firstname') ?>
                </div>
                <div class="form-floating mb-3">
                    <input
                            class="form-control <?php echo $data['errors']->hasError('lastname') ? 'is-invalid' : '' ?>"
                            id="lastname"
                            name="lastname"
                            type="text"
                            placeholder="Enter your last name..."
                            data-sb-validations="required"
                    />
                    <label for="lastname">Last name</label>
                    <div class="invalid-feedback">
                        <?php echo $data['errors']->getFirstError('lastname') ?>
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input
                                class="form-control <?php echo $data['errors']->hasError('email') ? 'is-invalid' : '' ?>"
                                id="email" name="email"
                                type="email"
                                placeholder="name@example.com"
                        />
                        <label for="email">Email address</label>
                        <div class="invalid-feedback"  >
                            <?php echo $data['errors']->getFirstError('email') ?>
                        </div>
                    </div>
                    <!-- Username number input-->
                    <div class="form-floating mb-3">
                        <input
                                class="form-control <?php echo $data['errors']->hasError('username') ? 'is-invalid' : '' ?>"
                                id="username"
                                name="username"
                                type="text"
                                placeholder="name"
                        />
                        <label for="username">Username</label>
                        <div class="invalid-feedback" >
                            <?php echo $data['errors']->getFirstError('username') ?>
                        </div>
                    </div>
                    <!-- Message input-->
                    <div class="form-floating mb-3">
                        <input
                                class="form-control <?php echo $data['errors']->hasError('password') ? 'is-invalid' : '' ?>"
                                id="password" name="password"
                                type="password"
                                placeholder="name"
                        />
                        <label for="password">Password</label>
                        <div class="invalid-feedback">
                            <?php echo $data['errors']->getFirstError('password') ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                                class="form-control <?php echo $data['errors']->hasError('confirmPassword') ? 'is-invalid' : '' ?>"
                                id="confirmPassword" name="confirmPassword"
                                type="password"
                                placeholder="name"/>
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="invalid-feedback">
                            <?php echo $data['errors']->getFirstError('confirmPassword') ?>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br/>
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3">Error sending message!</div>
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Send</button>
            </form>
        </div>
    </div>
</section>
