<?php get_header('second');
?>

	<section class="single-section">
			<div class="container-common">
				<a href="<?php echo get_post_type_archive_link('post'); ?>" class="back-link">Вернуться</a>
				<div class="single-post-wrap">
					<div class="single-post-img" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);">
						<h2><?php the_title(); ?></h2>
					</div>
					<div class="single-post-text">
							<?php the_post(); 
								the_content(); ?>
					</div>
					
				</div>
			</div>
		</section>

		


<?php
get_footer('second');
