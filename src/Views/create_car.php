<?php

?>

<section class="page-section" id="contact">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 pt-5">Create Car</h2>
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
                            class="form-control <?php if (isset($data['errors']['name'])) {
                                echo $data['errors']['name'] ? 'is-invalid' : '';
                            }
                            ?>"
                            name="name"
                            type="text"
                            placeholder="Enter your car name..."
                            data-sb-validations="required"
                    />
                    <label for="name">Car name</label>
                    <div class="invalid-feedback">
                        <?php if (isset($data['errors'])) {
                            echo $data['errors']['name'][0];
                        } ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                                class="form-control <?php if (isset($data['errors']['type'])) {
                                    echo $data['errors']['type'] ? 'is-invalid' : '';
                                }
                                ?>"
                                id="type"
                                name="type"
                                type="text"
                                placeholder="Enter your last name..."
                                data-sb-validations="required"
                        />
                        <label for="lastname">Car Type</label>
                        <div class="invalid-feedback">
                            <?= $data['errors']['type'][0] ?>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php if (isset($data['errors']['brand'])) {
                                        echo $data['errors']['brand'] ? 'is-invalid' : '';
                                    }
                                    ?>"
                                    id="brand" name="brand"
                                    type="text"
                                    placeholder="name@example.com"
                            />
                            <label for="email">Car Brand</label>
                            <div class="invalid-feedback">
                                <?= $data['errors']['brand'][0] ?>
                            </div>
                        </div>
                        <!-- Username number input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php if (isset($data['errors']['image'])) {
                                        echo $data['errors']['image'] ? 'is-invalid' : '';
                                    }
                                    ?>"
                                    id="image"
                                    name="image"
                                    type="file"
                                    placeholder="name"
                            />
                            <label for="image">Image</label>
                            <div class="invalid-feedback">
                                <?= $data['errors']['image'][0] ?>
                            </div>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <input
                                    class="form-control <?php if (isset($data['errors']['price'])) {
                                        echo $data['errors']['price'] ? 'is-invalid' : '';
                                    }
                                    ?>"
                                    id="price" name="price"
                                    value=100
                                    type="number"
                                    placeholder="name"
                            />
                            <label for="password">Price</label>
                            <div class="invalid-feedback">
                                <?= $data['errors']['price'][0] ?>
                            </div>
                        </div>
                        <!-- Submit Button-->
                        <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Send</button>
            </form>
        </div>
    </div>
</section>
