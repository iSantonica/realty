<?php get_header('second'); ?>

	<section class="blog-section">
			<div class="container-common">
				<a href="<?php echo home_url(); ?>" class="back-link">Вернуться</a>
				<div class="blog-post-wrap">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php
							$day = get_the_date( 'j');
							$month = get_the_date( 'F' );
						?>

							<div class="blog-post">
								<div class="blog-post__date">
									<div class="blog-post__date-day"><?php echo $day ?></div>
									<div class="blog-post__date-month"><?php echo $month ?></div>
								</div>
								<div class="blog-post__img">
									<?php the_post_thumbnail('my-tumb'); ?>
								</div>
								<div class="blog-post__text">
									<h3><?php the_title(); ?></h3>
									<p><?php the_excerpt(); ?></p>
									<a href="<?php the_permalink(); ?>" class="read-link">Читать полностью</a>
								</div>
							</div>

					<?	endwhile;

					endif; ?>

				</div>

				<div class="pagination">
					<?php kama_pagenavi(); ?>
				</div>
			</div>
		</section>

<?php

get_footer('second');
