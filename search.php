
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
	<div class="search-result">
  		<?php get_template_part('templates/content', 'search'); ?>
	</div>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
