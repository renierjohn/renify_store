<?php foreach ($blocks as $key => $value): ?>
  <?php $this->insert('./blocks/'.$value['blockid'],['content'=>$value['content']]) ?>
<?php endforeach; ?>
