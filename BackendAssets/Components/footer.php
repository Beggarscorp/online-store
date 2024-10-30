
<?php
?>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Important Links</h4>
                    <div class="links">
                        <p>Home</p>
                        <p>Shop</p>
                        <p>About us</p>
                        <p>Terms and Conditions</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="footer_logs py-5">
                        <img src="<?=BASE_URL?>BackendAssets/assets/images/logos/footer-logo-1.png" alt="footer-logo-1">
                        <img src="<?=BASE_URL?>BackendAssets/assets/images/logos/footer-logo-2.png" alt="footer-logo-2">
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
                        <p>office@beggarscorporation.com</p>
                    </div>
                    <div class="social-media-links">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-linkedin"></i>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <div class="footer_bottom">
        <p>Copyright ©  <span class="golden">Beggars Corporation   | Humanomics Private Limited, India</span></p>
    </div>
    <script src="<?=BASE_URL?>BackendAssets/js/main.js"></script>
    <?php
    if(file_exists(BASE_URL."BackendAssets/js/".CURRENT_PAGE.".js"))
    {
        echo "<script src=".BASE_URL."BackendAssets/js/".CURRENT_PAGE.".js></script>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> -->
    </body>
</html>