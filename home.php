<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php 
  if( is_single() ){
    get_template_part('templates/single-content', get_post_type());
  }
?>

<section class="blog-page-posts-wrap">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>
</section>

<section class="blog-page-posts-pagination">
  <?php
  echo paginate_links([
      'type'      => 'list',
      'prev_next' => false,
  ]);
  ?>
</section>