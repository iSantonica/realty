<?php
/*
Template Name: Archives
*/
?>

<?php get_header('second'); ?>

	<section class="blog-section">
			<div class="container-common">
				<a href="<?php echo home_url(); ?>" class="back-link">Вернуться</a>
				<div class="blog-post-wrap">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php
							$day = get_the_date( 'j');
							$month = get_the_date( 'F' );
							var_dump($day) ;
							echo "1111111";
						?>

							<div class="blog-post">
								<div class="blog-post__date">
									<div class="blog-post__date-day"><?php echo $day ?></div>
									<div class="blog-post__date-month"><?php echo $month ?></div>
								</div>
								<div class="blog-post__img">
									<img src="<?php the_post_thumbnail(); ?>" alt="">
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
					<ul>
						<li><a href="">1</a></li>
						<li><a href="">2</a></li>
						<li><span class="current">3</span></li>
						<li><span>...</span></li>
						<li><a href="">13</a></li>
					</ul>
				</div>
			</div>
		</section>

<?php

get_footer('second');
