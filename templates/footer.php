<footer class="s-footer footer">
    <div class="row section-header align-center">
        <div class="col-full">
            <h1 class="display-1">
                Let's Stay In Touch.
            </h1>
            <p class="lead">
            Subscribe for updates, special offers, and other amazing stuff.
            </p>
        </div>
    </div> <!-- end section-header -->
    <div class="row footer__top">
        <div class="col-full footer__subscribe end">
            <div class="subscribe-form">
                <form id="mc-form" class="group" novalidate="true">
                    <input type="email" value="" name="EMAIL" class="email" id="mc-email" placeholder="Email Address" required="">
                    <input type="submit" name="subscribe" value="Sign Up">
                    <label for="mc-email" class="subscribe-message"></label>
                </form>
            </div>
        </div>
    </div> <!-- end footer__top -->
    <div class="row footer__bottom">
        <div class="footer__about col-five tab-full left">
            <h4>About Renify.</h4>
            <p>
              Order the tastier food
            </p>
            <ul class="footer__social">
                <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="col-five md-seven tab-full right end">
            <div class="row">
                <div class="footer__site-links col-five mob-full">
                    <h4>Site links.</h4>
                    <ul class="footer__site-links">
                        <?php foreach ($footer['content']['links'] as $key => $value): ?>
                          <li ><a class=<?=$this->e($value['class'])?> href=<?=$this->e($value['link'])?> title="intro"><?=$this->e($value['title'])?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="footer__contact col-seven mob-full">
                    <h4>Contact Us.</h4>
                    <p>
                    Phone: (+63) 555 1212 <br>
                    Fax: (+63) 555 0100
                    </p>
                    <p>
                    Need help or have a question? Contact us at: <br>
                    <a href="mailto:#0" class="footer__mail-link">renify.official@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-full ss-copyright">
            <span>&copy; Copyright Renify 2020</span>
            <span>Design by <a href="https://www.renify.store/">Rendroid</a></span>
        </div>
    </div> <!-- end footer__bottom -->
    <div class="go-top">
        <a class="smoothscroll" title="Back to Top" href="#top"></a>
    </div>
</footer>
<?php foreach ($footer['assetsJsSuffix'] as $key => $value): ?>
  <script src=<?=$this->e($value['path'])?>></script>
<?php endforeach; ?>
