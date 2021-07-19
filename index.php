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

$homePageTestimonialList = $database->select('review', ['name','type','title','content', 'image'], [
    'homepage' => 1,
    'OR' => [
            'type' => ['clerk', 'attorney']
    ]
]);

$homePageReviewList = $database->select('review', ['name','type','title','content', 'image'], [
    'homepage' => 1,
    'OR' => [
            'type' => ['bbb', 'google']
    ]
]);

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

require_once('insert/head.phtml');
require_once('insert/top_bar.phtml');
require_once('insert/header.phtml');
?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container" data-aos="fade-in">
      <!--<h1>Welcome to CCP</h1>
      <h2>Collections | Consulting</h2>-->
      <div style="margin: 0px auto;width: 400px;">
        <img src="https://res.cloudinary.com/df5atw3fa/image/upload/v1625084025/CCP/logo/CCP_Logo_W_fuyi9s.png">
      </div>
      <!--<div class="d-flex align-items-center">
        <i class="bx bxs-right-arrow-alt get-started-icon"></i>
        <a href="#about" class="btn-get-started scrollto">Work With Us</a>
      </div>-->
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">


            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                  <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100" style="margin-top:20px;">
                      <div class="icon-box alt-icon-box mt-4 mt-xl-0">
                          <i class="bx bx-group"></i>
                          <h4>Who We Are</h4>
                          <p>
                              82 years of Service, Compliance and Results
                          </p>
                          <div class="text-center">
                              <a href="about.php" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                          </div>
                      </div>
                  </div>
                <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100" style="margin-top:20px;">
                  <div class="icon-box alt-icon-box mt-4 mt-xl-0">
                    <i class="bx bx-message-detail"></i>
                    <h4>Consumer Reviews</h4>
                    <p>Hear from our consumers</p>
                    <div class="text-center">
                      <a href="consumer-reviews.php" class="more-btn">View All <i class="bx bx-chevron-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200" style="margin-top:20px;">
                  <div class="icon-box alt-icon-box mt-4 mt-xl-0">
                    <i class="bx bx-credit-card-front"></i>
                    <h4>Pay Online</h4>
                    <p>Log-in to view account details, create payment plans, see payment history, and more</p>
                    <div class="text-center">
                      <a href="https://ccp.int001.com/" class="more-btn">Pay Now <i class="bx bx-chevron-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300" style="margin-top:20px;">
                  <div class="icon-box alt-icon-box mt-4 mt-xl-0">
                    <i class="bx bx-door-open"></i>
                    <h4>Client Log-In</h4>
                    <p>Access your Client dashboard</p>
                    <div class="text-center">
                      <a href="https://ccp.interprose.com/login.do?customerID=CCP" class="more-btn">Log&ndash;In <i class="bx bx-chevron-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Reviews Section ======= -->
    <section id="reviews" class="reviews section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3>Consumer Reviews</h3>
                <!--<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
            </div>

            <div class="owl-carousel testimonials-carousel">

                <?php foreach($homePageReviewList as $homePageReview){
                    $singleReview = convert_smart_quotes($homePageReview['content']);
                    $showPartial = strlen($singleReview) > 100;
                    if($showPartial){
                        $content = substr($singleReview,0,100) . '...';
                    }
                    else{
                        $content = $singleReview;
                    }
                    ?>
                    <div>
                        <p class="review-item">
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            <?= $content ?>
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            <?php
                            if($showPartial){ ?>
                                <span class="click-for-full"><a href="consumer-reviews.php">click for full review</a></span>
                            <?php } ?>
                            <br/><span class="name"><?= $homePageReview['name'] ?></span>
                        </p>

                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="text-center" style="margin-top:20px">
                <a href="consumer-reviews.php" class="more-btn">View All <i class="bx bx-chevron-right"></i></a>
            </div>
        </div>
    </section><!-- End Reviews Section -->


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3>Client Testimonials</h3>
                <!--<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
            </div>

            <div class="owl-carousel testimonials-carousel">

                <?php foreach($homePageTestimonialList as $homePageTestimonial){
                    $singleTestimonial = convert_smart_quotes($homePageTestimonial['content']);
                    $showPartial = strlen($singleTestimonial) > 200;
                    if($showPartial){
                        $content = substr($singleTestimonial,0,200) . '...';
                    }
                    else{
                        $content = $singleTestimonial;
                    }
                    ?>
                    <div class="testimonial-item">
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            <?= $content ?>
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            <?php
                            if($homePageTestimonial['type'] == 'clerk') {
                                $active = 'circuit-clerks';
                            } elseif ($homePageTestimonial['type'] == 'attorney'){
                                $active = 'states-attorneys';
                            }
                            if($showPartial){ ?>
                                <br/><a href="client-testimonials.php?active=<?=  $active ?>">click for full testimonial</a>
                            <?php } ?>
                            <img src="https://res.cloudinary.com/df5atw3fa/image/upload/v1625083834/CCP/client/<?= $homePageTestimonial['image'] ?>" class="testimonial-img" alt=""/>
                            <span class="name"><?= $homePageTestimonial['name'] ?></span><br/>
                            <span class="description"><?= $homePageTestimonial['title'] ?></span>
                        </p>

                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="text-center" style="margin-top:20px">
                <a href="client-testimonials.php" class="more-btn">View All <i class="bx bx-chevron-right"></i></a>
            </div>
        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="fade-in">

        <div class="text-center section-title">
            <h3>Meet Credit Collection Partners</h3>
            <p>CCP serves public sector clients with a specialization in government agencies. We are large enough to ensure maximum production, yet small enough to give each client the service and attention they expect and deserve. </p>
          <p>&nbsp;</p>
            <div class="text-center">
                <a href="about.php" class="more-btn">More About Us <i class="bx bx-chevron-right"></i></a>
            </div>
        </div>

      </div>
    </section><!-- End Cta Section -->


<?php require_once('insert/footer_aggregator.phtml');