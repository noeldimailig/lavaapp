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
                        <?php if($_SESSION['user_role'] == 'Admin' || $_SESSION['user_role'] == 'Super Admin') : ?>
                            <li><a href="<?php echo site_url('nav/admin/index'); ?>">Go to Dashboard</a></li>
                            <li><a href="<?php echo site_url("nav/myprofile?id=".$_SESSION['user_id']); ?>">My Profile</a></li>
                            <li><a href="<?php echo site_url('nav/mydocuments'); ?>">My Documents</a></li>
                            <li><a href="<?php echo site_url('nav/mycitations'); ?>">Saved Citations</a></li>
                            <li><a href="<?php echo site_url('nav/mybookmarks'); ?>">Bookmarked Documents</a></li>
                            <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo site_url("nav/myprofile?id=".$_SESSION['user_id']); ?>">My Profile</a></li>
                            <li><a href="<?php echo site_url('nav/mydocuments'); ?>">My Documents</a></li>
                            <li><a href="<?php echo site_url('nav/mycitations'); ?>">Saved Citations</a></li>
                            <li><a href="<?php echo site_url('nav/mybookmarks'); ?>">Bookmarked Documents</a></li>
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