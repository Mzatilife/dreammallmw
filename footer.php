<!-- Instagram Begin -->
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            <?php
            $insta = $shop->viewShopWithIg(0, 6);
            foreach ($insta as $ig) {
            ?>
                <div class="col-lg-2 col-md-4 col-sm-4 col-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="assets/images/logos/<?php echo $ig['logo'] ?>">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="<?php echo $ig['instagram'] ?>">@ <?php echo $ig['shop_name'] ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Instagram End -->
<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./index.php" class="row">
                            <img src="img/black.png" width="30px" height="25px" alt="logo">
                            <h4>ream<sup>Mall</sup></h4>
                        </a>
                    </div>
                    <p>Dream<sup>Mall</sup> has been developed to help business owners come together
                        and advertise their businesses for free!</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="about.php">About</a></li>
                        <li><a href="blog.php">Blogs</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="login.php">My Account</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="shops.php">Shops</a></li>
                        <li><a href="products.php">Random Products</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>Socials</h6>
                    <p>
                        Check out our stuff on the following social media platforms.
                    </p>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-whatsapp"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>
                            document.write(new Date().getFullYear());
                        </script> | <a href="https://colorlib.com" target="_blank">Colorlib</a> |
                        Developed by <a href="https://dreamcodemw.com" target="_blank">DreamcodeMW</a></p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->