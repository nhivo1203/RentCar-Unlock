<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="/assets/img/avataaars.svg" alt="..."/>
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">Rent car website by Nhi Vo</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Trainer: Bang Dinh Savage and Mr Tinh Le</p>
    </div>
</header>

<section class="page-section portfolio" id="portfolio">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Cars</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <?php foreach ($data['cars'] as $car) { ?>
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="d-flex justify-content-center container mt-5">
                        <div class="card p-5 bg-white">
                            <div class="about-product text-center mt-2">
                                <img src="<?= $car['image'] ?>" width="300" height="200">
                                <div>
                                    <h4><?= $car['name'] ?></h4>
                                    <h6 class="mt-0 text-black-50"><?= $car['type'] ?></h6>
                                </div>
                            </div>
                            <div class="stats mt-2">
                                <div class="d-flex justify-content-between p-price">
                                    <span>Car Brand</span><span><?= $car['brand'] ?></span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                <span>Price</span><span><strong>$<?= $car['price'] ?>/Day</strong></span>
                            </div>
                            <button class="btn btn-primary mt-4">Rent</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
</section>

<!-- Footer-->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">
                    Can Tho
                    <br/>
                    Victoria Resort
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Around the Web</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About Me</h4>
                <p class="lead mb-0">
                    Vo Truc Nhi Backend Fresher @ CanTho Office
                    .
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright &copy; NhiVo Website 2022</small></div>
</div>
