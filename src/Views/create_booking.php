<?php
?>

<section class="page-section" id="contact">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 pt-5">Create Booking</h2>
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
            <form action="createbooking" method="post">
                <!-- Name input-->
                <div class="form-floating mb-3">
                    <input
                            class="form-control <?php if (isset($data['errors']['car_id'])) {
                                echo $data['errors']['car_id'] ? 'is-invalid' : '';
                            }
                            ?>"
                            name="car_id"
                            value=1
                            type="number"
                            placeholder="Enter your car name..."
                            data-sb-validations="required"
                    />
                    <label for="name">Car ID</label>
                    <div class="invalid-feedback">
                        <?php if (isset($data['errors'])) {
                            echo $data['errors']['car_id'][0];
                        } ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                                class="form-control <?php if (isset($data['errors']['user_id'])) {
                                    echo $data['errors']['user_id'] ? 'is-invalid' : '';
                                }
                                ?>"
                                id="user_id"
                                name="user_id"
                                value=1
                                type="number"
                                placeholder="Enter your car id..."
                                data-sb-validations="required"
                        />
                        <label for="lastname">User ID</label>
                        <div class="invalid-feedback">
                            <?php if (isset($data['errors'])) {
                                echo $data['errors']['user_id'][0];
                            } ?>

                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php if (isset($data['errors']['check_in'])) {
                                        echo $data['errors']['check_in'] ? 'is-invalid' : '';
                                    }
                                    ?>"
                                    id="check_in" name="check_in"
                                    type="date"
                                    placeholder="name@example.com"
                            />
                            <label for="email">Check In</label>
                            <div class="invalid-feedback">
                                <?php if (isset($data['errors'])) {
                                    echo $data['errors']['check_in'][0];
                                } ?>
                            </div>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php if (isset($data['errors']['check_out'])) {
                                        echo $data['errors']['check_out'] ? 'is-invalid' : '';
                                    }
                                    ?>"
                                    id="check_out" name="check_out"
                                    type="date"
                                    placeholder="name@example.com"
                            />
                            <label for="email">Check Out</label>
                            <div class="invalid-feedback">
                                <?php if (isset($data['errors'])) {
                                    echo $data['errors']['check_out'][0];
                                } ?>

                            </div>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php if (isset($data['errors']['total'])) {
                                        echo $data['errors']['total'] ? 'is-invalid' : '';
                                    }
                                    ?>"
                                    id="total" name="total"
                                    value=100
                                    type="number"
                                    placeholder="name"
                            />
                            <label for="password">Total</label>
                            <div class="invalid-feedback">
                                <?php if (isset($data['errors'])) {
                                    echo $data['errors']['total'][0];
                                } ?>
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
