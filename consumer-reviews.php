<?php

require_once('vendor/autoload.php');

// Using Medoo namespace
use Medoo\Medoo;

// Initialize
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'ccp',
    //'server' => 'http://104.248.181.33:3306',
    'server' => 'localhost',
    'username' => 'ccp',
    'password' => 'Quiet22!'
]);

$bbbReviewList = $database->select('review', ['stars', 'name', 'content', 'datetime'], [
    'type' => 'bbb'
]);

$googleReviewList = $database->select('review', ['stars', 'name', 'content', 'datetime'], [
    'type' => 'google'
]);

$assetDir = 'consumer-reviews';
$heroTitle = 'Consumer Reviews';

require_once('insert/header_aggregator.phtml');
?>


    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <!--<div class="section-title">
                <h3>Markets</h3>-->
                <!--<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
            <!--</div>-->
            <div class="row">
                <div class="image col-lg-12" data-aos="fade-in">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">BBB / Better Business Bureau Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Google Business Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-columns">
                            <?php foreach($bbbReviewList as $bbbReview){
                                $nameParts = explode(' ', $bbbReview['name']);
                                if(sizeof($nameParts) >= 2){
                                    $name = ucfirst($nameParts[0]);
                                }
                                else{
                                    $name = ucfirst($bbbReview['name']);
                                }
                                ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <p>
                                                <i class="bx bxs-quote-alt-left quote-icon-left"></i><?= $bbbReview['content'] ?><i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                                <br/><span class="name" style="font-size:.8em;font-weight:600;">&ndash;&nbsp;<?= $name ?></span>
                                                <!--<br/><span class="star"><?= $bbbReview['stars'] ?> out of 5</span>-->
                                            </p>
                                        </div>
                                    </div>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card-columns">
                            <?php foreach($googleReviewList as $googleReview){
                                $nameParts = explode(' ', $googleReview['name']);
                                if(sizeof($nameParts) >= 2){
                                    $name = ucfirst($nameParts[0]);
                                }
                                else{
                                    $name = ucfirst($googleReview['name']);
                                }
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <p>
                                            <i class="bx bxs-quote-alt-left quote-icon-left"></i><?= $googleReview['content'] ?><i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                            <br/><span class="name" style="font-size:.8em;font-weight:600;">&ndash;&nbsp;<?= $name ?></span>
                                            <!--<br/><span class="star"><?= $googleReview['stars'] ?> out of 5</span>-->
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Features Section -->

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