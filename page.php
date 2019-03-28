<?php get_header(); ?>

	<section class="first-section screen-section section-active" id="first-section">
		<div class="video-wrap">
			<video id="vid" src="<?php the_field('video'); ?>" autoplay="autoplay" loop="loop" muted="muted"></video>
			<div class="vid-overlay vid-overlay_white"></div>
		</div>
		<div class="main-container">
			<div class="main-inner main-inner_white">
				<h2 class="wow fadeInUp" data-wow-delay="0.5s"><?php the_field('main_caption'); ?></h2>
			<div class="wow fadeInUp btn-box" data-wow-delay="1s">
				<a  data-fancybox data-src="#hidden-content2" href="javascript:;" class="btn btn_white btn_anim">
					<span class="btn__first">Написать нам</span>
					<span class="btn__second">Написать нам</span>
				</a>
			</div>
			</div>
		</div>
	</section>

	<section class="second-section screen-section" id="second-section">
		<div class="section-bg" style="background-image: url(<?php the_field('bg_second'); ?>);"></div>
		<div class="second-section-line"></div>
		<div class="container">
			<div class="second-inner anim-section">
				<div class="home-slider-wrap">
					<div class="home-slider-arr home-slider-left">
					</div>
					<div class="home-slider-arr home-slider-right">
					</div>
					<div class="home-slider-count"><div class="curr">1</div><span>/</span><div class="total"></div></div>
					<div class="home-slider">
						<?php
							$args = array(
								'taxonomy' => 'company',
								'hide_empty' => false,
								'exclude' => 13,
							);
							$terms = get_terms( $args );
							

							if( $terms && ! is_wp_error($terms) ){
								
								foreach( $terms as $term ){
									$term_id = $term->term_id;
									$taxonomy = 'company';
									$text = get_field( 'company_slider_text', $taxonomy . '_' . $term_id );
									$logo = get_field( 'company_logo', $taxonomy . '_' . $term_id );
									$img = get_field( 'company_slider_img', $taxonomy . '_' . $term_id );
									?>

									<div class="home-slider-item">
										<div class="home-slider-item-inner">
											<div class="home-slider-item-overlay">
											<div class="home-slider-item-left">
												<div class="home-slider__logo">
													<img src="<?php echo $logo; ?>" alt="">
												</div>
												<div class="home-slider__text">
													<?php echo $text; ?>
												</div>
												<a href="<?php echo get_term_link( (int)$term_id ); ?>" class="btn-blue">Подробнее</a>
											</div>
											<div class="home-slider-item-right">
												<div class="home-slider__img-box">
													<div class="home-slider__img-border"></div>
													<div class="home-slider__img">
														<img src="<?php echo $img; ?>" alt="">
													</div>
												</div>
											</div>
										</div>
										</div>
									</div>

							<?php	}
								
							}
						?>
						
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="second-section screen-section" id="second2-section">
		<div class="section-bg" style="background-image: url(<?php the_field('bg_second_2'); ?>);"></div>
		<div class="second-section-line"></div>
		<div class="container">
			<div class="second-inner anim-section">
				<div class="home-slider-wrap">
					<div class="home-slider2">
						

									<div class="home-slider-item">
										<div class="home-slider-item-inner">
											<div class="home-slider-item-overlay home-slider-item-overlay2">
											<div class="home-slider-item-left">
												
												<div class="home-slider__text">
													<?php the_field('text_second_2') ?>
												</div>
												<a href="<?php echo get_term_link( 13 ); ?>" class="btn-blue">Подробнее</a>
											</div>
											<div class="home-slider-item-right">
												<div class="home-slider__img-box">
													<div class="home-slider__img-border"></div>
													<div class="home-slider__img">
														<img src="<?php the_field('foto_second_2') ?>" alt="">
													</div>
												</div>
											</div>
										</div>
										</div>
									</div>

							
						
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="third-section screen-section" id="third-section">
		<div class="section-bg" style="background-image: url(<?php the_field('bg_third'); ?>);"></div>
		<div class="third-wrap">
			<div class="container">
				<div class="third-inner anim-section">
					<div class="photo-wrap">
						<div class="about-me-floating-box" id="floating-box">
							<h2><?php the_field('floating_caption'); ?></h2>
							<p><?php the_field('floating_subcaption'); ?></p>
						</div>
						<img src="<?php the_field('foto_about_me'); ?>" alt="">
					</div>
					<div class="about-me-text-wrap">
						<div class="about-me-text-wrap-scroll scrollbar-inner">
							<?php the_field('text_about'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="fourth-section screen-section" id="fourth-section">
		<div class="section-bg" style="background-image: url(<?php the_field('bg_fourth'); ?>);"></div>
		<div class="fourth-wrap">
			<div class="container">
				<div class="fourth-inner anim-section">
				  <div class="articles-wrap">

				  	<?php
                    
		            $args = array(
		                'post_type' => 'post',
		                'posts_per_page' => 4,
		            );

		            $query = new WP_Query( $args );

		            if ( $query->have_posts() ) {
		                while ( $query->have_posts() ) {
		                    $query->the_post();
		                    ?>

		                    <?php 
		                    	$p_date = get_the_date('j F Y', $post->ID);
		                     ?>

		                    <div class="article">
										  		<div class="article-img" style="background-image: url(<?php the_post_thumbnail_url( ); ?>);"></div>
										  		<div class="article-text">
										  			<div class="article-text-inner">
										  				<h3><?php the_title(); ?></h3>
										  				<p><?php the_excerpt(); ?></p>
										  			</div>
										  			<div class="article-text-bottom">
										  				<a href="<?php the_permalink(); ?>" class="article-more">Подробнее...</a>
															<div class="article-date"><?php echo $p_date; ?></div>
										  			</div>
										  		</div>
										  	</div>

		                    <?php
		                }
		            } else {
		                
		            }

		            wp_reset_postdata();

		        ?>

				  </div>
				  <a  href="<?php echo get_post_type_archive_link('post'); ?>" class="btn btn_white btn_anim">
						<span class="btn__first">Читать все статьи</span>
						<span class="btn__second">Читать все статьи</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="fifth-section screen-section" id="fifth-section">
		<div class="section-bg" style="background-image: url(<?php the_field('bg_fifth'); ?>);"></div>
			
		<div class="fifth-wrap">
			<div class="container">
				<div class="fifth-inner anim-section">
				  <?php the_field('text_vacancii'); ?>
					<div class="phone-box">
						<p><?php the_field('vac_tel_caption'); ?></p>
						<a href="tel:<?php echo str_replace([' ', '-'], '', get_field('vac_tel')); ?>"><?php the_field('vac_tel'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sixth-section screen-section" id="sixth-section">
		<div class="section-bg" style="background: url(<?= get_stylesheet_directory_uri()?>/images/stulovvv.png) no-repeat 60% 150px , url(<?php the_field('bg_sixth'); ?>) no-repeat center center / cover;"></div>
		
		
		<div class="sixth-wrap">
			<div class="container">
				<div class="sixth-inner anim-section">
				  <div class="contacts-wrap">
				  	<div class="contacts-left">
				  		<div class="contacts-left-map">
				  			<?php the_field('map_main'); ?>
				  		</div>
				  	</div>
				  	<div class="contacts-right">
				  		<div class="contacts-text">
				  			<h3><?php the_field('title_contact'); ?></h3>
				  			<p><?php the_field('subtitle_contact'); ?></p>
				  		</div>
				  		<div class="contacts-box">
				  			<a href="tel:<?php echo str_replace([' ', '-'], '', get_field('tel_contact')); ?>" class="contacts-box__tel contacts-box__item"><?php the_field('tel_contact'); ?></a>
				  			<p class="contacts-box__addr contacts-box__item"><?php the_field('addr_contact'); ?></p>
				  			<a href="mailto:<?php the_field('mail_contact'); ?>" class="contacts-box__mail contacts-box__item"><?php the_field('mail_contact'); ?></a>
				  		</div>
				  		<h4><?php the_field('soc_title_contact'); ?></h4>
				  		<div class="contacts-socials">
				  			<div class="contacts-socials__item">
				  				<a href="<?php the_field('facebook_contact'); ?>" class="contacts-socials__fb"></a>
				  			</div>
				  			<div class="contacts-socials__item">
				  				<a href="<?php the_field('vk_contact'); ?>" class="contacts-socials__vk"></a>
				  			</div>
				  			<div class="contacts-socials__item">
				  				<a href="<?php the_field('youtube_contact'); ?>" class="contacts-socials__yt"></a>
				  			</div> 
				  		</div>

				  		<a  data-fancybox data-src="#hidden-content" href="javascript:;" class="btn btn_white btn_anim contact-sect-btn">
								<span class="btn__first">Связаться с нами:</span>
								<span class="btn__second">Связаться с нами:</span>
							</a>

				  		<h4 class="contact-form-caption"><?php the_field('feed_title_contact'); ?></h4>


				  		<div class="contacts-form contacts-form_main">
				  			<?php echo do_shortcode('[contact-form-7 id="187" title="form2"]'); ?>
				  		</div>
				  	</div>
				  </div>
				</div>
			</div>
		</div>
	</section>

	<div id="hidden-content" style="display: none;" class="feed-form feed-form_main">
		<div class="main-popup-form">
			<h4><?php the_field('feed2_caption'); ?></h4>
			<h3><?php the_field('feed2_subcaption'); ?></h3>
  		<div class="contacts-form">
  			<?php echo do_shortcode('[contact-form-7 id="188" title="form3"]'); ?>
  		</div>
		</div>
  	</div>

  	<div id="hidden-content2" style="display: none;" class="c-form">
  		<div class="c-form-inner">
  			<h2><?php the_field('feed1_caption'); ?></h2>
  			<h3><?php the_field('feed1_subcaption'); ?></h3>
  			<div class="c-form-wrap">
  				<?php echo do_shortcode('[contact-form-7 id="186" title="form1"]'); ?>
  			</div>
  		</div>
  	</div>

<?php
get_footer();

