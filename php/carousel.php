<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

$id     = 'news-' . $module->id;
$chunks = array_chunk($list, 3); // 3 notícias por slide
?>
<div id="<?php echo $id; ?>" class="carousel slide news-carousel" data-bs-ride="carousel" data-bs-interval="6000">

  <div class="carousel-inner">
    <?php foreach ($chunks as $i => $group) : ?>
      <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
        <div class="news-row">
          <?php foreach ($group as $item) :
            $images = json_decode($item->images ?? '{}');
            $img    = !empty($images->image_intro) ? HTMLHelper::_('cleanImageURL', $images->image_intro)->url : '';
          ?>
            <a class="news-card" href="<?php echo $item->link; ?>">
              <?php if ($img) : ?>
                <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($item->title); ?>" loading="lazy">
              <?php endif; ?>
              <div class="news-card__body">
                <h4><?php echo htmlspecialchars($item->title); ?></h4>
                <p><?php echo HTMLHelper::_('string.truncate', strip_tags($item->introtext), 110); ?></p>
                <span class="news-card__more">Ler mais &rarr;</span>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (count($chunks) > 1) : ?>
    <div class="carousel-indicators news-indicators">
      <?php foreach ($chunks as $i => $g) : ?>
        <button type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide-to="<?php echo $i; ?>"
          class="<?php echo $i === 0 ? 'active' : ''; ?>"></button>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  <?php endif; ?>
</div>