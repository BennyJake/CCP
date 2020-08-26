<?php

$assetDir = 'philanthropy';
$heroTitle = 'Our Philanthropy';

require_once('insert/header_aggregator.phtml');
?>

    <section id="philanthropy" class="philanthropy features">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="https://www.bbb.org/ProfileImages/31796e59-436f-410d-ae6e-5f9351949f67.webp"
                                     alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://www.bbb.org/ProfileImages/1b806abb-7def-4c23-a014-791cb22c9b45.webp"
                                     alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://www.bbb.org/ProfileImages/177065dc-440c-4ef2-b57f-f4613ea9a76c.webp"
                                     alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 details">
                    <h3>Giving Back to Our Community</h3>
                    <p>CCP has been a longstanding corporate citizen in Taylorville, Ill., and supports many area
                        nonprofits and community groups throughout central Illinois that provide services and benefits
                        for veterans, youth and small business owners. A significant percentage of CCP's annual profit
                        is budgeted and goes toward charitable efforts.</p>
                    <p>Our beneficiaries include:</p>
                    <ul>
                        <li>Taylorville Memorial Hospital</li>
                        <li>Taylorville Police Department</li>
                        <li>Christian County Drug Court</li>
                        <li>American Legion</li>
                        <li>VFW</li>
                        <li>YMCA</li>
                        <li>Kiwanis Organization</li>
                        <li>Taylorville Chamber of Commerce</li>
                        <li>Taylorville High School & Booster Clubs, and other school and recreational sports leagues
                        </li>
                    </ul>
                    <p>CCP also has been a longtime sponsor and supporter for industry associations that advocate for
                        the highest operational standards and fair practices, including the International Association of
                        Credit and Collections Professionals and the Illinois Collectors Association.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Call to Action ======== -->
    <section id="cta" class="cta">
        <div class="container aos-init aos-animate" data-aos="fade-in">

            <div class="text-center section-title">
                <h3>Meet Credit Collection Partners</h3>
                <p>CCP serves public sector clients with a specialization in government agencies. We are large enough to ensure maximum production, yet small enough to give each client the service and attention they expect and deserve. </p>
                <p>&nbsp;</p>
                <div class="text-center">
                    <a href="about.php" class="more-btn">More About Us <i class="bx bx-chevron-right"></i></a>
                </div>
            </div>

        </div>
    </section>


<?php require_once('insert/footer_aggregator.phtml');
