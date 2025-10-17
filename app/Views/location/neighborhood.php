<?php
use App\Core\View;
?>
<h1><?= View::e($title) ?> Nakliyat</h1>
<p><?= View::e(ucfirst(str_replace('-', ' ', $neighborhood))) ?> semti, <?= View::e(ucfirst(str_replace('-', ' ', $district))) ?> ilçesi içinde profesyonel taşımacılık.</p>
<p>
  Yakın semtler: <a href="#">Örnek Semt 1</a>, <a href="#">Örnek Semt 2</a>
</p>
