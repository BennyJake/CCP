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

$bbbOverallReview = $database->select('overall_review', ['rating', 'number_reviews'], [
    'service' => 'bbb'
])[0];

$googleReviewList = $database->select('review', ['stars', 'name', 'content', 'datetime'], [
    'type' => 'google'
]);

$googleOverallReview = $database->select('overall_review', ['rating', 'number_reviews'], [
    'service' => 'google'
])[0];

$fullReviewList = array_merge($bbbReviewList, $googleReviewList);

$assetDir = 'consumer-reviews';
$heroTitle = 'Consumer Reviews';

require_once('insert/header_aggregator.phtml');
?>

<style type="text/css">
    @charset "UTF-8";
    :root {
        --star-size: 60px;
        --star-color: #fff;
        --star-background: #fc0;
    }

    .Stars {
        --percent: calc(var(--rating) / 5 * 100%);
        display: inline-block;
        font-size: var(--star-size);
        font-family: Times;
        line-height: 1;
    }
    .Stars::before {
        content: "★★★★★";
        letter-spacing: 3px;
        background: linear-gradient(90deg, var(--star-background) var(--percent), var(--star-color) var(--percent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <!--<div class="section-title">
                <h3>Markets</h3>-->
                <!--<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
            <!--</div>-->
            <div class="row" style="padding-bottom:0px;">
                <div class="image col-lg-6" style="text-align:center;" data-aos="fade-in">
                    <h2>Google Rating</h2>
                    <div class="Stars" style="--rating: <?= $googleOverallReview['rating']; ?>" aria-label="Rating of this product is <?= $googleOverallReview['rating']; ?> out of 5."></div>
                            <p><span style="font-weight: 600;font-size=1.2em;"><?= $googleOverallReview['rating']; ?>/5</span> average from <span style="font-weight: 600;font-size=1.2em;"><?= $googleOverallReview['number_reviews']; ?></span> reviews</p>
                    <p><a target="_blank" href="https://www.google.com/search?q=google+review+credit+collection+partners&oq=google+review+credit+collection+partners&aqs=chrome..69i57j69i64.7495j0j7&sourceid=chrome&ie=UTF-8#lrd=0x8874e416683a0b7b:0x74a59ba5e41618e8,1,,,"
                          class="more-btn">View All <i class="bx bx-chevron-right"></i></a></p>
                </div>
                <div class="image col-lg-6" style="text-align:center;" data-aos="fade-in">
                    <h2>BBB Rating</h2>
                    <div class="Stars" style="--rating: <?= $bbbOverallReview['rating']; ?>" aria-label="Rating of this product is <?= $bbbOverallReview['rating']; ?> out of 5."></div>
                    <p><span style="font-weight: 600;font-size=1.2em;"><?= $bbbOverallReview['rating']; ?>/5</span> average from <span style="font-weight: 600;font-size=1.2em;"><?= $bbbOverallReview['number_reviews']; ?></span> reviews</p>
                    <p><a target="_blank" href="https://www.bbb.org/us/il/taylorville/profile/collections-agencies/credit-collection-partners-0734-310569227/customer-reviews"
                          class="more-btn">View All <i class="bx bx-chevron-right"></i></a></p>
                </div>
            </div>
            <div class="row" style="padding-top:0px;">
                <div class="image col-lg-12" data-aos="fade-in">

                            <div class="card-columns">
                            <?php foreach($fullReviewList as $review){
                                $nameParts = explode(' ', $review['name']);
                                if(sizeof($nameParts) >= 2){
                                    $name = ucfirst($nameParts[0]);
                                }
                                else{
                                    $name = ucfirst($review['name']);
                                }
                                ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <p>
                                                <i class="bx bxs-quote-alt-left quote-icon-left"></i><?= $review['content'] ?><i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                                <br/><span class="name" style="font-size:.8em;font-weight:600;">&ndash;&nbsp;<?= $name ?></span>
                                                <!--<br/><span class="star"><?= $review['stars'] ?> out of 5</span>-->
                                            </p>
                                        </div>
                                    </div>
                            <?php } ?>
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