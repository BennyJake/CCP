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

$clerkReviewList = $database->select('review', ['id','name','title','content', 'image'], [
    'type' => 'clerk'
]);

$attorneyReviewList = $database->select('review', ['id','name','title','content', 'image'], [
    'type' => 'attorney'
]);

$assetDir = 'client-testimonials';
$heroTitle = 'Client Testimonials';

function convert_smart_quotes($string)

{
    $search = array(chr(145),
        chr(146),
        chr(147),
        chr(148),
        chr(151));

    $replace = array("'",
        "'",
        '"',
        '"',
        '-');

    return str_replace($search, $replace, $string);
}

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
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Circuit Clerks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">State's Attorneys</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-columns">
                                <?php foreach($clerkReviewList as $clerkReview){ ?>
                                    <div class="card" id="<?= $clerkReview['id'] ?>">
                                        <div class="card-body">
                                            <p>
                                                <?php
                                                $copy = convert_smart_quotes($clerkReview['content']);
                                                $parts = explode(' ', $copy);
                                                $copyLast = array_pop($parts);
                                                $copySecondLast = array_pop($parts);
                                                $copyFirst = implode(' ', $parts);
                                                $copy = '<i class="bx bxs-quote-alt-left quote-icon-left"></i>&nbsp;' . $copyFirst . ' <nobr>' . $copySecondLast . ' ' . $copyLast . '&nbsp;<i class="bx bxs-quote-alt-right quote-icon-right"></i></nobr>';

                                                echo $copy;

                                                if(isset($clerkReview['image']) && !empty($clerkReview['image'])) { ?>
                                                    <br/><img style="max-width:250px" src="https://res.cloudinary.com/df5atw3fa/image/upload/v1625083834/CCP/client/<?= $clerkReview['image'] ?>">
                                                <?php } ?>
                                                <br/><span class="name" style="font-size:.8em;font-weight:600;">&ndash;&nbsp;<?= $clerkReview['name'] ?></span>
                                                <br/><span class="name" style="font-size:.8em;font-weight:600;">&nbsp;&nbsp;<?= convert_smart_quotes($clerkReview['title']) ?></span>
                                            </p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card-columns">
                                <?php foreach($attorneyReviewList as $attorneyReview){ ?>
                                    <div class="card" id="<?= $attorneyReview['id'] ?>">
                                        <div class="card-body">
                                            <p>
                                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>&nbsp;<?= convert_smart_quotes($attorneyReview['content']) ?>&nbsp;<i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                                <?php
                                                if(isset($attorneyReview['image']) && !empty($attorneyReview['image'])) { ?>
                                                <br/><img style="max-width:250px" src="https://res.cloudinary.com/df5atw3fa/image/upload/v1625083834/CCP/client/<?= $attorneyReview['image'] ?>">
                                                <?php } ?>
                                                <br/><span class="name" style="font-size:.8em;font-weight:600;">&ndash;&nbsp;<?= $attorneyReview['name'] ?></span>
                                                <br/><span class="name" style="font-size:.8em;font-weight:600;">&nbsp;&nbsp;<?= $attorneyReview['title'] ?></span>
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