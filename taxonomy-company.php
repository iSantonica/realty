<?php get_header('second');
?>

<?php 
$term = get_queried_object();
$taxonomy = 'company';
$term_id = $term->term_id;

$args2 = array(
	'taxonomy' => 'buildings',
	'hide_empty' => true,
	'orderby'       => 'id', 
	'order'         => 'ASC',
	'parent' => 0,
);
$terms2 = get_terms( $args2 );
?>

<?php

	$buildings_terms = get_field('types_realty', $taxonomy . '_' . $term_id);

	$terms2 = $buildings_terms;
	// echo "<pre>";
	// var_dump($buildings_terms);
	// echo "</pre>";

 ?>

<section class="company-head-section" style="background: #fff url(<?php the_field( 'company_bg', $taxonomy . '_' . $term_id );  ?>) no-repeat center center/cover;">
	<div class="container-common">
		<div class="company-logo-head">
			<img src="<?php the_field( 'company_logo', $taxonomy . '_' . $term_id );  ?>" alt="">
		</div>
	</div>
</section>


<?php if($terms2) : ?>


<section class="complexes-section">
	<div class="container">
		<h2><?php the_field( 'company_page_caption', $taxonomy . '_' . $term_id );  ?></h2>

		<?php

		if( $terms2 && ! is_wp_error($terms2) ){
			echo '<div class="tabs tabs-outer">';
			echo '<ul class="tabs__caption tabs__caption-outer">';
			echo '<li class="active tabs-li">Все</li>';
			foreach( $terms2 as $term2 ) {
				echo '<li class="tabs-li">' . $term2->name . '</li>';
			}
		}

		?>

	</ul>

	<div class="tabs__content tabs__content-outer active">
		<div class="complexes-wrap">
			<?php

			$args3 = array(
				'post_type' => 'house',
				'company' => $term->name,
				'posts_per_page' => -1,
				'order' => 'ASC',
				'orderby' => 'meta_value_num',
				'meta_key' => 'house_id',
			);
			$query = new WP_Query( $args3 );

			?>

			<?php if ($query->have_posts()) {

				while ( $query->have_posts() ) : $query->the_post(); ?>

					<a href="<?php the_permalink() ?>" class="complexes-item">
						<div class="complexes-img">
							<?php the_post_thumbnail() ?>
						</div>
						<div class="complexes-overlay">
							<div class="complexes-caption"><?php the_title(); ?></div>
							<div class="complexes-info">
								<p><span>Цена</span> от <?php the_field( 'h_price_from');  ?> / м<sup>2</sup></p>
								<p><span>Квартира</span> от <?php the_field( 'h_flat_from');  ?></p>
								<p><span>Район</span> <?php the_field( 'h_district'); ?></p>
								<p><span>Адрес</span> <?php the_field( 'h_addr' );  ?></p>
							</div>
							<div class="complexes-more">Подробнее</div>
						</div>
						<div class="complexes-item__title">
							<?php the_title(); ?>
						</div>
					</a>

				<?php endwhile;

			}
			wp_reset_postdata();

			?>

		</div>
	</div>

	<?php

	if( $terms2 && ! is_wp_error($terms2) ){
							//перебираем термы buildings
		foreach( $terms2 as $term2 ) { 
								//для каждого составляем запрос WP_Query
			?>

			<div class="tabs__content tabs__content-outer">
				<div class="complexes-wrap">

					<?php $termchildren = get_term_children( $term2->term_id, 'buildings' );  ?>

					<?php
					if($termchildren){
							//если есть дочерние термы, выводим табы
						?>
						<div class="tabs inner-tabs">

							<ul class="tabs__caption inner-tabs-caption">

							<?php 
								foreach ($termchildren as $child) {
									$termc = get_term_by( 'id', $child, 'buildings' );
									echo '<li class="inner-tabs-caption-li">' . $termc->name . '</li>';
								}
							?>
   
               </ul>

               <?php 
								foreach ($termchildren as $child) { ?>

									<div class="tabs__content inner-tabs-content">
                    <div class="complexes-wrap">

								<?php
									$termc2 = get_term_by( 'id', $child, 'buildings' );
									//var_dump($termc2->name);
									$args_inner = array(
										'post_type' => 'house',
										'company' => $term->name,
										'tax_query' => array(
											array(
												'taxonomy' => 'buildings',
												'field'    => 'id',
												'terms'    => $termc2->term_id,
											)
										),
										// 'buildings' => $termc2->name,
										'posts_per_page' => -1,
										'order' => 'ASC',
										'orderby' => 'meta_value_num',
										'meta_key' => 'house_id',
									);
									$query_inner = new WP_Query( $args_inner );

									if ($query_inner->have_posts()) {

									while ( $query_inner->have_posts() ) : $query_inner->the_post(); ?>

										<a href="<?php the_permalink() ?>" class="complexes-item">
											<div class="complexes-img">
												<?php the_post_thumbnail() ?>
											</div>
											<div class="complexes-overlay">
												<div class="complexes-caption"><?php the_title(); ?></div>
												<div class="complexes-info">
													<p><span>Цена</span> от <?php the_field( 'h_price_from');  ?> / м<sup>2</sup></p>
													<p><span>Квартира</span> от <?php the_field( 'h_flat_from');  ?></p>
													<p><span>Район</span> <?php the_field( 'h_district'); ?></p>
													<p><span>Адрес</span> <?php the_field( 'h_addr' );  ?></p>
												</div>
												<div class="complexes-more">Подробнее</div>
											</div>
											<div class="complexes-item__title">
												<?php the_title(); ?>
											</div>	
										</a>

									<?php endwhile;

							} //end if query2
							wp_reset_postdata(); ?>

									</div>
                </div>

								<?php	
								} //end foreach termchildren
							?>

            </div>
            <!-- .tabs -->

						<?php
						
					} else {
							//если нет дочерних, выводим список

						$args4 = array(
							'post_type' => 'house',
							'company' => $term->name,
							'buildings' => $term2->name,
							'posts_per_page' => -1,
							'order' => 'ASC',
							'orderby' => 'meta_value_num',
							'meta_key' => 'house_id',
						);
						$query2 = new WP_Query( $args4 );


						if ($query2->have_posts()) {

							while ( $query2->have_posts() ) : $query2->the_post(); ?>

								<a href="<?php the_permalink() ?>" class="complexes-item">
									<div class="complexes-img">
										<?php the_post_thumbnail() ?>
									</div>
									<div class="complexes-overlay">
										<div class="complexes-caption"><?php the_title(); ?></div>
										<div class="complexes-info">
											<p><span>Цена</span> от <?php the_field( 'h_price_from');  ?> / м<sup>2</sup></p>
											<p><span>Квартира</span> от <?php the_field( 'h_flat_from');  ?></p>
											<p><span>Район</span> <?php the_field( 'h_district'); ?></p>
											<p><span>Адрес</span> <?php the_field( 'h_addr' );  ?></p>
										</div>
										<div class="complexes-more">Подробнее</div>
									</div>
									<div class="complexes-item__title">
										<?php the_title(); ?>
									</div>	
								</a>

							<?php endwhile;

					} //end if query2
					wp_reset_postdata();
				}
				?>

			</div>
		</div>

	<?php	}
}

?>

</div><!-- .tabs -->
</div>
</section>

<?php endif; //если есть связанные с компанией термы ?>

<section class="about-company-section">
	<div class="about-company-inner">
		<div class="about-company-left" style="background-image: url(<?php the_field( 'company_big_img', $taxonomy . '_' . $term_id );  ?>);">
			<div class="about-company-left__logo">
				<img src="<?php the_field( 'company_logo', $taxonomy . '_' . $term_id );  ?>" alt="">
			</div>
		</div>
		<div class="about-company-right">
			<div class="about-company-right__text">
				<div class="about-company-right__text-back"><?php the_field( 'company_caption', $taxonomy . '_' . $term_id );  ?></div>
				<h2><?php the_field( 'company_caption', $taxonomy . '_' . $term_id );  ?></h2>
				<?php the_field( 'company_desc', $taxonomy . '_' . $term_id );  ?>
			</div>
			<div class="about-company-gallery">
				<?php

				if( have_rows('company_img', $taxonomy . '_' . $term_id) ):

					while ( have_rows('company_img', $taxonomy . '_' . $term_id) ) : the_row(); ?>

						<div class="about-company-gallery-img"><img src="<?php the_sub_field('img'); ?>" alt=""></div>

					<?php   endwhile;

				else :

				endif;

				?>

			</div>
		</div>
	</div>	
</section>

<section class="agent-section" style="background-image: url(<?= get_stylesheet_directory_uri()?>/images/about-stulov.png);">
	<div class="container-common">
		<div class="agent-section-wrap">
			<div class="agent-section-left">
				<div class="agent-section-img">
					<img src="<?php the_field('a_photo', 8) ?>" alt="">
				</div>
			</div>
			<div class="agent-section-right">
				<a href="<?php echo home_url(); ?>" class="logo-caption"><h2>STULOV</h2></a>
				<p><?php the_field('a_text', 8) ?></p>
				<a  data-fancybox data-src="#hidden-content2" href="javascript:;" class="btn btn_white btn_anim">
					<span class="btn__first">Связаться со мной</span>
					<span class="btn__second">Связаться со мной</span>
				</a>
			</div>
		</div>
	</div>
</section>

<section class="back-section">
	<div class="container-common">
		<div class="back-box">
			<a href="<?php echo home_url(); ?>" class="back-box-btn"></a>
			<p>Вернуться</p>
		</div>
	</div>
</section>

<div id="hidden-content2" style="display: none;" class="c-form">
	<div class="c-form-inner">
		<h2><?php the_field('feed1_caption', 8); ?></h2>
		<h3><?php the_field('feed1_subcaption', 8); ?></h3>
		<div class="c-form-wrap">
			<?php echo do_shortcode('[contact-form-7 id="186" title="form1"]'); ?>
		</div>
	</div>
</div>

<?php
get_footer('second');
