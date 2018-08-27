<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="section_title main_title col-xs-12">
				<h1>
					<?php the_title(); ?>
				</h1>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="page_content col-xs-12">
		<?php
			if (have_posts()):
				while (have_posts()) : the_post();
					the_content();
				endwhile;
			else:
			echo '<p>Sorry, no posts matched your criteria.</p>';
			endif;
		?>
		</div>
	</div>
</div>
 
<?php get_footer(); ?>
