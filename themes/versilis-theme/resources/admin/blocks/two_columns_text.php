<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'testimonial';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$label = get_field('label') ?: 'Label';
$title = get_field('title') ?: 'Title';
$col_text_1 = get_field('col_text_1') ?: 'Text....';
$col_text_2 = get_field('col_text_2') ?: 'Text....';

?>

<div id="<?php echo esc_attr($id); ?>" class="container <?php echo esc_attr($className); ?> grid-x grid-container">
  <span class="label"><?php echo $label; ?></span>
  <h2 class="title"><?php echo $title; ?></h2>
  <div class="row">
    <div class="col-12 col-lg-6">
      <?php echo $col_text_1; ?>
    </div>
    <div class="col-12 col-lg-6">
      <?php echo $col_text_2; ?>
    </div>
  </div>
</div>