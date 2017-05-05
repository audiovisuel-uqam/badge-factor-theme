<?php 
	while (have_posts()) : the_post(); 

?>


  <?php  ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
