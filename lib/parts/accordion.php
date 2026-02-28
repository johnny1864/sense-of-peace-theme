<?php
$icon = isset($args['icon']) ? getIMG($args['icon']['ID'], 'sm') : false;
$label = $args['label'];
$group = $args['group'] ?? null;
$content = $args['content'];
$active = (bool) $args['active'] ?? false;
?>

<div class="accordion<?php echo $active ? " active" : null; ?>" data-group="<?php echo $group; ?>">
    <button class="accordion__trigger" type="button">
        <?php if ($icon) : ?><div class="accordion__icon"><?php echo $icon; ?></div><?php endif; ?>
        <span class="accordion__label"><?php echo $label; ?></span>
        <?php echo getSVG('chevron'); ?>
    </button>
    <div class="accordion__content"><?php echo $content; ?></div>
</div>