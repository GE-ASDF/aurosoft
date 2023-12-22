<a class="nav-menu-item <?php echo $active ?> nav-link" href="<?= isset($link) ? route($link):'' ?>">
<div class="<?= isset($classes) ? [...$classes]:'' ?>">
    <i class="bi <?= $icon ?>"></i> <?= $text ?>
</div>
</a>