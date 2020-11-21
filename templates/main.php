
<section id="about" class="s-about target-section">
    <div class="row section-header has-bottom-sep" data-aos="fade-up">
        <div class="col-full">
            <h1 class="display-1">
                Best Foods
            </h1>
            <p class="lead">
                Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                omnis ea.
            </p>
        </div>
    </div>
    <div class="row wide about-desc" data-aos="fade-up">
        <div class="col-full slick-slider about-desc__slider">
          <?php foreach ($contents as $key => $value): ?>
            <div class="about-desc__slide">
                <h3 class="item-title"> <?=$this->e($value['title'],'strip_tags|strtoupper')?></h3>
                <?=$this->e($value['details'],'strip_tags')?>
            </div>
          <?php endforeach; ?>
        </div>
    </div>
</section>

<?php $this->insert('./blocks/pricing')?>
<?php $this->insert('./blocks/video')?>
