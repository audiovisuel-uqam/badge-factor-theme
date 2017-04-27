<?php 
	while (have_posts()) : the_post(); 

		if(!is_front_page()){
			get_template_part('templates/page', 'header');
		}
?>


  <?php  ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
