<section class="page-section" id="contact">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 pt-5">Login</h2>
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
            <form action="login" method="post">
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control"
                                    id="email" name="email"
                                    type="email"
                                    placeholder="name@example.com"
                            />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback"  >
                            </div>
                        </div>
                        <!-- Password input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control"
                                    id="password" name="password"
                                    type="password"
                                    placeholder="name"
                            />
                            <label for="password">Password</label>
                            <div class="invalid-feedback">
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
