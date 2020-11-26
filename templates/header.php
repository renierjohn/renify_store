<header class="s-header">
    <div class="row">
        <div class="header-logo">
            <a class="site-logo" href="/">
                <img src="../favicon.ico" alt="Homepage">
            </a>
        </div>
        <nav class="header-nav-wrap">
            <ul class="header-main-nav">
              <?php foreach ($header['links'] as $key => $value): ?>
                <li class="current"><a class=<?=$this->e($value['class'])?> href=<?=$this->e($value['link'])?> title="intro"><?=$this->e($value['title'])?></a></li>
              <?php endforeach; ?>
            </ul>
            <div class="header-cta">
                <a href="/products" class="btn btn--primary header-cta__btn "><?=$this->e($header['label']['title'])?></a>
            </div>
        </nav> <!-- end header-nav-wrap -->
        <a class="header-menu-toggle" href="#"><span>Menu</span></a>
    </div>
</header>
