<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

include('class/DBConnection.php');

$db = new DBConnection();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title id="page-title">Home - Elite Researcher</title>
        <?php include('default/header.php'); ?>
    </head>
    <body>
        <header id="header" class="fixed-top">
            <div class="container d-flex align-items-center">
                <h1 class="logo me-auto"><a href="<?php echo site_url('nav/index'); ?>">Elite Researcher</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                        <li><a class="active" href="<?php site_url('nav/index'); ?>">Home</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Documents</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="<?php echo site_url('nav/research'); ?>">Research</a></li>
                                <li><a href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                                <li><a href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                                <li><a href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo site_url('nav/about'); ?>">About</a></li>
                        <li><a href="<?php echo site_url('nav/contact'); ?>">Contact</a></li>

                        <?php if($this->session->userdata('user_email')) : ?> 
                        <li class="dropdown d-flex flex-row justify-content-center">
                            <a href="#">
                                <img class="mx-1" src="<?php echo BASE_URL . PUBLIC_DIR.'/profile_pictures/'.$this->session->userdata('user_profile'); ?>" alt="" style="width: 20px; height: 20px; border-radius: 50%;">
                                <span><?php echo $this->session->userdata('username'); ?></span> <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul>
                                <?php if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 3) : ?>
                                    <li><a href="<?php echo site_url('nav/dashboard'); ?>">Go to Dashboard</a></li>
                                    <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                                    <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                                    <?php else: ?>
                                    <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                                    <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                                <?php endif ?>
                            </ul>
                        </li>
                    </ul>
                <?php endif ?>
                </nav><!-- .navbar -->
                <?php if(!isset($_SESSION['user_email'])) : ?>
                <a href="<?php echo site_url('nav/login'); ?>" class="get-started-btn">Get Started</a>
                <?php endif ?>
            </div>
        </header><!-- End Header -->
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex justify-content-center align-items-center">
            <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
                <h1>Learning Today,<br>Leading Tomorrow</h1>
                <h2><q>Don't look for facts and research to fit your narative: build a story out of what you find</q></h2>
                <h4 style="color: #c4c4c4;"><i>-Brendan Wolfe</i></h4>
                <a href="
                    <?php 
                        if(!isset($_SESSION['user_email']))
                            echo site_url('nav/login');
                        else
                            echo site_url('nav/research');
                    ?>" 
                class="btn-get-started">Get Started</a>
            </div>
        </section>
        <!-- End Hero -->

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">
                    <div class="row">
                        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                            <img src="<?php echo BASE_URL . PUBLIC_DIR.'/img/about.jpg'; ?>" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                            <h3>Elite Researcher: An Archive for Mindoro State University Research, Thesis, and Dissertation</h3>
                            <p class="fst-italic">
                                Just two years ago, everything seems to be alright. We are fine doing what we usually do until the pandemic caused by Covid-19 hits us all.
                                <!-- At the blink of an eye everything we used to do suddenly changed, several restrictions are issued to prevent further spreading of the virus. -->
                                Classes are now done remotely either online or via modular learning. Gathering resources became hard for those students who has research subjects like us due to non availability of physical libraries. With this, we became eager to developed an online archive for our institution that will cater all viable resources available during face-to-face classes. The developers aims:
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle"></i> To create an archive of all the past and present studies conducted by the students, faculty and staffs.</li>
                                <li><i class="bi bi-check-circle"></i> To generate automatic citation of the study selected in APA format.</li>
                            </ul>
                            <p>We hope that other researchers like us will be greatly benefited by using this site.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About Section -->

            <!-- ======= Counts Section ======= -->
            <section id="counts" class="counts section-bg">
                <div class="container">
                    <div class="row counters">
                        <?php
                            foreach($data['d_cat'] as $file) : ?>
                                <?php if($file['id'] != 1) :
                                $res = $db->get_cat_id($file['id']);
                                $rec = (int)$res;
                        ?>
                                <div class="col-lg-3 col-8 text-center">
                                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $rec;?>" data-purecounter-duration="1" class="purecounter"></span>
                                    <p><?php echo $file['category'];?></p>
                                </div>
                            <?php endif?>
                        <?php endforeach ?>
                    </div>
                </div>
            </section>
            <!-- End Counts Section -->

            <!-- ======= Why Us Section ======= -->
            <section id="why-us" class="why-us">
                <div class="container" data-aos="fade-up">

                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-stretch">
                            <div class="content">
                                <h3>Why Choose Elite Researcher?</h3>
                                <p>
                                    Administrators of the site are staffs of the institution to assure the integrity and credibility of documents being provided.
                                </p>
                                <div class="text-center">
                                    <a href="<?php echo site_url('nav/about'); ?>" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-boxes d-flex flex-column justify-content-center">
                                <div class="row">
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="bx bx-file"></i>
                                            <h4>Source Materials</h4>
                                            <p>All the documents provided are in PDF format.</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="bx bx-calendar"></i>
                                            <h4>Up to Date</h4>
                                            <p>All the documents are up to date.</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="bx bx-lock"></i>
                                            <h4>Authenticity</h4>
                                            <p>All the documents provided are original and with full consent of the author(s).</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .content-->
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Why Us Section -->

            <!-- ======= Features Section ======= -->
            <section id="features" class="features">
                <div class="container" data-aos="fade-up">

                    <div class="row" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-lg-4 col-md-4">
                            <div class="icon-box">
                                <i class="ri-links-line" style="color: #ffbb2c;"></i>
                                <h3><a href="<?php echo site_url('nav/research'); ?>">Generate References</a></h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mt-4  mt-md-0">
                            <div class="icon-box">
                                <i class="ri-bookmark-3-line" style="color: #11dbcf;"></i>
                                <h3><a href="<?php echo site_url('nav/research'); ?>">Bookmark Studies</a></h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mt-4  mt-md-0">
                            <div class="icon-box">
                                <i class="ri-search-line" style="color: #29cc61;"></i>
                                <h3><a href="<?php echo site_url('nav/research'); ?>">Search Specific Documents</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Features Section -->

            <!-- ======= Testimonials Section ======= -->
            <section id="testimonials" class="testimonials">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Studies</h2>
                        <p>Recent Uploads</p>
                    </div>

                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            <?php foreach($data['docs'] as $doc) : 
                                if($doc['state'] == 'Published'):?>
                                    <div class="swiper-slide">
                                        <div class="courses">
                                            <div class="col-lg-12 d-flex align-items-stretch">
                                                <div class="course-item">
                                                    <div class="course-content">
                                                        <h6><a href="<?php 
                                                            if(isset($_SESSION['user_id'])){
                                                            echo site_url('nav/preview/'.encrypt_id($doc['id']));
                                                            }
                                                            else {
                                                            echo site_url('nav/login');
                                                            }
                                                        ?>"><?php echo $doc['title'];?></a></h6>
                                                        <p>
                                                            <?php
                                                                $sub_desc = "" ;
                                                                $desc_length = strip_tags($doc['description']);
                                                                if(strlen($desc_length) > 500){
                                                                    $shorten = substr($desc_length, 0, 100);
                                                                    $sub_desc = substr($shorten, 0, strrpos($shorten, ' ')).'...';
                                                                    echo $sub_desc;
                                                                }  
                                                                else echo $sub_desc;
                                                            ?>
                                                        </p>
                                                        <div class="trainer d-flex justify-content-between align-items-center">
                                                            <div class="trainer-profile d-flex align-items-center">
                                                                <span><?php echo $doc['authors']; ?></span>
                                                            </div>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div> <!-- End course content -->
                                                </div> <!-- End Course Item-->
                                            </div> <!-- End Col -->
                                        </div> <!-- End Courses -->
                                    </div><!-- End swiper slide -->
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <!-- End Testimonials Section -->
   
            <!-- ======= Trainers Section ======= -->
            <section id="trainers" class="trainers">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Developers</h2>
                    </div>
                    <div class="row d-flex align-items-center justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="member">
                                <img src="<?php echo BASE_URL . PUBLIC_DIR.'/assets/img/trainers/noeldimailig-removebg.png'; ?>" class="img-fluid" alt="">
                                <div class="member-content">
                                    <h4>Noel M. Dimailig</h4>
                                    <span>Developer</span>
                                    <p>You know research is good when it is back up by other related studies.</p>
                                    <div class="social">
                                        <!-- <a href=""><i class="bi bi-twitter"></i></a> -->
                                        <a href="https://web.facebook.com/noeldimailig18" target="_blank"><i class="bi bi-facebook"></i></a>
                                        <a href="https://www.instagram.com/no.el7729/" target="_blank"><i class="bi bi-instagram"></i></a>
                                        <a href="https://github.com/noeldimailig" target="_blank"><i class="bi bi-github"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="member">
                                <img src="<?php echo BASE_URL . PUBLIC_DIR.'/assets/img/trainers/lilethpine-removebg.png'; ?>" class="img-fluid" alt="">
                                <div class="member-content">
                                    <h4>Lileth V. Pine</h4>
                                    <span>Developer</span>
                                    <p>Finding related studies is really hard when you don't know where to start.</p>
                                    <div class="social">
                                        <!-- <a href=""><i class="bi bi-twitter"></i></a> -->
                                        <a href="https://web.facebook.com/lilethpine" target="_blank"><i class="bi bi-facebook"></i></a>
                                        <a href="https://www.instagram.com/lethpine/" target="_blank"><i class="bi bi-instagram"></i></a>
                                        <a href="https://github.com/lilethpine" target="_blank"><i class="bi bi-github"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="member">
                                <img src="<?php echo BASE_URL . PUBLIC_DIR.'/assets/img/trainers/ed.png'; ?>" class="img-fluid" alt="">
                                <div class="member-content">
                                    <h4>Eduardo M. Cabello</h4>
                                    <span>Developer</span>
                                    <p>Research is the stepping stone to unfold the answers and good foundation of information is the key to open the opportunities.</p>
                                    <div class="social">
                                        <!-- <a href=""><i class="bi bi-twitter"></i></a> -->
                                        <a href="https://web.facebook.com/wittyeduard" target="_blank"><i class="bi bi-facebook"></i></a>
                                        <a href="https://www.instagram.com/eduardobytheway/" target="_blank"><i class="bi bi-instagram"></i></a>
                                        <a href="https://github.com/eduardocabello" target="_blank"><i class="bi bi-github"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Trainers Section -->

        </main><!-- End #main -->
        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="border-0" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    ...
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include('default/footer.php'); ?>
    </body>
</html>
