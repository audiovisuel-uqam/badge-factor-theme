<?php get_header(); ?>

	<?php get_template_part('partials/title_box'); ?>
	
	<div class="container">
		<?php if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif; ?>

	</div>

<?php get_footer();?>