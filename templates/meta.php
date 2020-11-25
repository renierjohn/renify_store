<head>
    <?php $dir = __DIR__  ?>
    <meta charset="utf-8">
    <title><?=$this->e($meta['title'])?> | <?=$this->e($meta['siteName'])?> </title>
    <meta name="description" content="">
    <meta name="author" content="Rendroid">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php foreach ($meta['assetsCss'] as $key => $value): ?>
      <link rel="stylesheet" href=<?=$this->e($value['path'])?>>
    <?php endforeach; ?>
    <?php foreach ($meta['assetsJsPrefix'] as $key => $value): ?>
      <script src=<?=$this->e($value['path'])?>></script>
    <?php endforeach; ?>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
