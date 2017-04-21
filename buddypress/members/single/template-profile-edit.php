<?php get_header(); ?>

    <?php get_template_part('templates/page', 'header'); ?>
	
	<div class="container">
		<?php if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif; ?>

	</div>

<?php get_footer();?>