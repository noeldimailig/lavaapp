<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Elite Researcher</h3>
                    <p>
                    Mindoro State University<br>
                    Oriental, Mindoro<br>
                    Philippines <br><br>
                    <strong>Phone:</strong> +6391234567899<br>
                    <strong>Email:</strong> eliteresearcher2021@gmail.com<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('nav/index'); ?>">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('nav/about'); ?>">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php echo site_url('nav/contact'); ?>">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php 
                            if(!isset($_SESSION['user_email']))
                                echo site_url('nav/login');
                            else
                                echo site_url('nav/research');
                        ?>">Cite References</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?php 
                            if(!isset($_SESSION['user_email']))
                                echo site_url('nav/login');
                            else
                                echo site_url('nav/research');
                        ?>" >Bookmark Studies</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p id="newsletter">Be notified when there is something new in our site.</p>
                    <form id="subform" action="<?php echo site_url('user/subscribe'); ?>" method="post">
                        <input type="hidden" id="uid" name="uid" value="<?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
                        <input type="email" id="email" name="email">
                        <input type="submit" id="submit" name="submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Elite Researcher</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Developed by <a href="#">Dimailig | Pine | Cabello</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://twitter.com/ResearcherElite" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="https://web.facebook.com/Elite-Researcher-109216054929284" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/eliteresearcher2021/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
        </div>
    </div>
</footer>

    <!-- Vendor JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <?php echo load_js(array('assets/vendor/purecounter/purecounter')); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/7.0.9/swiper-bundle.min.js" integrity="sha512-bPNHwutl0bNsjHtw+AtR2xvp0BLtpm9mN6LcqzDZifcQSYv/dPVvND245WZVst+m7GhYHX647RoaL9w6VVraxw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha512-pax4MlgXjHEPfCwcJLQhigY7+N8rt6bVvWLFyUMuxShv170X53TRzGPmPkZmGBhk+jikR8WBM4yl7A9WMHHqvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Template Main JS File -->
    <?php echo load_js(array('assets/js/purecounter')); ?>
    <?php echo load_js(array('assets/js/main')); ?>
    <?php echo load_js(array('assets/js/dragndrop')); ?>

    <script>
        $('#subform').submit(function(e){
            e.preventDefault();
            var form = $('#subform');
            var url = form.attr('action');
            var email = $('#email').val();
            var uid = $('#uid').val();
            if(uid == ""){
                location.replace('http://localhost/archive/nav/login');
            }else{
                if(email == ""){
                    document.getElementById('newsletter').innerText = "Enter a valid email!";
                    setTimeout(function(){
                        document.getElementById('newsletter').innerText = "Be notified when there is something new in our site.";
                    }, 3000);
                }else{
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: form.serialize(),
                        success: function(res){
                            if(res){
                                console.log(res);
                                $('#email').val("");
                                document.getElementById('newsletter').innerText = res;
                                setTimeout(function(){
                                    document.getElementById('newsletter').innerText = "Be notified when there is something new in our site.";
                                }, 3000);
                            }
                        }
                    });
                }
            }
        });
    </script>