<section class="page-section" id="contact">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Create Car</h2>
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
            <form enctype="multipart/form-data" action="createcar" method="post">
                <!-- Name input-->
                <div class="form-floating mb-3">
                    <input
                            class="form-control <?php echo $data['errors']->hasError('name') ? 'is-invalid' : '' ?>"
                            name="name"
                            type="text"
                            placeholder="Enter your car name..."
                            data-sb-validations="required"
                    />
                    <label for="name">Car name</label>
                    <div class="invalid-feedback">
                        <?php echo $data['errors']->getFirstError('name') ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                                class="form-control <?php echo $data['errors']->hasError('type') ? 'is-invalid' : '' ?>"
                                id="type"
                                name="type"
                                type="text"
                                placeholder="Enter your last name..."
                                data-sb-validations="required"
                        />
                        <label for="lastname">Car Type</label>
                        <div class="invalid-feedback">
                            <?php echo $data['errors']->getFirstError('type') ?>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php echo $data['errors']->hasError('brand') ? 'is-invalid' : '' ?>"
                                    id="brand" name="brand"
                                    type="text"
                                    placeholder="name@example.com"
                            />
                            <label for="email">Car Brand</label>
                            <div class="invalid-feedback"  >
                                <?php echo $data['errors']->getFirstError('brand') ?>
                            </div>
                        </div>
                        <!-- Username number input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php echo $data['errors']->hasError('image') ? 'is-invalid' : '' ?>"
                                    id="image"
                                    name="image"
                                    type="file"
                                    placeholder="name"
                            />
                            <label for="image">Image</label>
                            <div class="invalid-feedback" >
                                <?php echo $data['errors']->getFirstError('image') ?>
                            </div>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php echo $data['errors']->hasError('price') ? 'is-invalid' : '' ?>"
                                    id="price" name="price"
                                    value=100
                                    type="number"
                                    placeholder="name"
                            />
                            <label for="password">Price</label>
                            <div class="invalid-feedback">
                                <?php echo $data['errors']->getFirstError('price') ?>
                            </div>
                        </div>
                        <!-- Submit Button-->
                        <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Send</button>
            </form>
        </div>
    </div>
</section>
