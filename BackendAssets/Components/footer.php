
<?php
?>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Important Links</h4>
                    <div class="links">
                        <p><a href="<?=BASE_URL?>" rel="noopener noreferrer">Home</a></p>
                        <p><a href="<?=BASE_URL?>shop" rel="noopener noreferrer">Shop</a></p>
                        <p><a href="<?=BASE_URL?>about-us">About us</a></p>
                        <p><a href="<?=BASE_URL?>terms-and-conditions">Terms and Conditions</a></p>
                        <p><a href="<?=BASE_URL?>privacy-policy">Privacy Policy</a></p>
                        <p><a href="<?=BASE_URL?>shipping-and-delivery-policy">Shipping and Delivery Policy</a></p>
                        <p><a href="<?=BASE_URL?>cancellation-and-refund-policy">Cancellation and Refund Policy</a></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="footer_logs py-5">
                        <a href="<?=BASE_URL?>">
                            <img src="<?=BASE_URL?>BackendAssets/assets/images/logos/footer-logo-1.png" alt="footer-logo-1">
                            <img src="<?=BASE_URL?>BackendAssets/assets/images/logos/footer-logo-2.png" alt="footer-logo-2">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h4>Contact Information</h4>
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <p>B 12, Navodit Nagar, Tulsipur, Mahmoorganj, Varanasi-221010</p>
                    </div>
                    <div class="address">
                        <i class="bi bi-telephone"></i>
                        <p>	+91 85956 17274</p>
                    </div>
                    <div class="address">
                        <i class="bi bi-envelope"></i>
                        <p><a class="text-decoration-none text-secondary" href="mailto:office@beggarscorporation.com" target="_blank" rel="noopener noreferrer">office@beggarscorporation.com</a></p>
                    </div>
                    <div class="social-media-links">
                        <a href="https://www.instagram.com/beggarscorporation/" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.facebook.com/beggarscorporation" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                        <a href="https://x.com/BeggarsCorp" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/beggars-corporation/" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <div class="footer_bottom">
        <p>Copyright ©  <span class="golden" style="border:none;">Beggars Corporation   | Humanomics Private Limited, India</span></p>
    </div>
    <script src="<?=BASE_URL?>BackendAssets/js/main.js"></script>
    <?php
    $filtePath=BASE_URL."BackendAssets/js/".CURRENT_PAGE.".js";
    $serverPath=$_SERVER['DOCUMENT_ROOT']. "/online-store/BackendAssets/js/" . CURRENT_PAGE . ".js";
    if(file_exists($serverPath))
    {
        echo "<script src=\"" . BASE_URL . "BackendAssets/js/" . CURRENT_PAGE . ".js\"></script>";
    }
    else
    {
        // echo "file not get";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </body>
</html>
