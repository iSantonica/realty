<?php get_header('second');
?>

<?php
the_post();
$post_id = get_the_ID();
$cur_terms = get_the_terms( $post_id, 'company' );
if( $cur_terms ){
	$cur_term = array_shift( $cur_terms );
}
?>

<section class="single-complex-head" style="background: url(<?php the_field( 'h_banner')   ?>) no-repeat center center / cover;;">
	<div class="single-complex-head-ov">
		<div class="container-common">
			<a href="<?php echo get_term_link( (int)$cur_term->term_id ); ?>" class="back-link">Вернуться</a>
			<h2 class="house-inp"><?php the_title(); ?></h2>
			<div class="single-complex-head-pref">
				<div class="single-complex-head-pref-item">
					<div class="single-complex-head-pref-item-img">
						<img src="<?= get_stylesheet_directory_uri()?>/images/sketch.png" alt="">
					</div>
					<div class="single-complex-head-pref-item-text">
						<span>Застройщик</span>
						<p class="company-inp"><?php the_field( 'company_caption', 'company_' . $cur_term->term_id ); ?></p>
					</div>
				</div>
				<div class="single-complex-head-pref-item">
					<div class="single-complex-head-pref-item-img">
						<img src="<?= get_stylesheet_directory_uri()?>/images/calendar.png" alt="">
					</div>
					<div class="single-complex-head-pref-item-text">
						<span>Срок сдачи</span>
						<p><?php the_field( 'h_term');  ?></p>
					</div>
				</div>
				<div class="single-complex-head-pref-item">
					<div class="single-complex-head-pref-item-img">
						<img src="<?= get_stylesheet_directory_uri()?>/images/placeholder.png" alt="">
					</div>
					<div class="single-complex-head-pref-item-text">
						<span>Адрес</span>
						<p><?php the_field( 'h_iaddr');  ?></p>
					</div>
				</div>
				<div class="single-complex-head-pref-item">
					<div class="single-complex-head-pref-item-img">
						<img src="<?= get_stylesheet_directory_uri()?>/images/brickwall.png" alt="">
					</div>
					<div class="single-complex-head-pref-item-text">
						<span>Материал стен</span>
						<p><?php the_field( 'h_material');  ?></p>
					</div>
				</div>
			</div>

		</div>

		<div class="single-complex-head-form">
			<div class="container-common">
				<div class="single-complex-head-form-inner">
					<div class="single-complex-head-form-text">
						<p>Узнайте больше о жилом комплексе</p>
						<p>Оставьте свой номер, и мы перезвоним Вам</p>
					</div>
					<?php echo do_shortcode('[contact-form-7 id="189" title="form4"]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="single-complex-bg-wrap">

	<?php

	if( have_rows('h_slider') ): ?>

		<section class="single-complex-slider-section">
			<div class="container-common">
				<h3>Фотографии ЖК</h3>
			</div>

			<div class="single-complex-slider-wrap">
				<div class="single-complex-slider-arr single-complex-slider-prev"></div>
				<div class="single-complex-slider-arr single-complex-slider-next"></div>
				<div class="single-complex-slider">

					<?php   while ( have_rows('h_slider') ) : the_row(); ?>

						<div class="single-complex-slider-item">
							<img src="<?php the_sub_field('img'); ?>" alt="">
						</div>

					<?php   endwhile; ?>

				</div>
			</div>
		</section>

	<?php	else :

	endif;

	?>

	<section class="description-single-complex">
		<div class="container-common">
			<h3>Описание ЖК</h3>
			<?php 
			the_content();
			?>
		</div>
	</section>

	<section class="characteristics-single-complex">
		<div class="container-common">
			<h3>Характеристики ЖК</h3>
		</div>
		<div class="container-common">
			<div class="characteristics-house characteristics">
				<div class="characteristics-caption">
					<h4>Дом</h4>
				</div>
				<div class="characteristics-list">
					<ul>

						<?php

						if( have_rows('h_char_dom') ):

							while ( have_rows('h_char_dom') ) : the_row(); ?>

								<li><?php the_sub_field('text'); ?></li>

							<?php   endwhile;

						else :

						endif;

						?>

					</ul>
				</div>
			</div>
		</div>

		<div class="characteristics-yard">
			<div class="container-common">
				<div class="characteristics">
					<div class="characteristics-caption">
						<h4>Двор</h4>
					</div>
					<div class="characteristics-list">
						<ul>
							<?php

							if( have_rows('h_char_dvor') ):

								while ( have_rows('h_char_dvor') ) : the_row(); ?>

									<li><?php the_sub_field('text'); ?></li>

								<?php   endwhile;

							else :

							endif;

							?>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</section>

</div>

<?php if(get_field('show_flats')) : ?>


<section class="apartment-choice">
	<div class="apartment-choice-wrap">
		<div class="apartment-choice-left">
			<h3>Выбор квартиры</h3>
			<div class="apartment-choice-form">
				<form action="">
					<h4>Количество комнат :</h4>
					<div class="choice-form-row">
						<label class="radio">
							<input type="radio" name="count" value="1"  />
							<div class="radio__text"><span class="count-t">1</span></div>
						</label>
						<label class="radio">
							<input type="radio" name="count" value="2"/>
							<div class="radio__text"><span class="count-t">2</span></div>
						</label>
						<label class="radio">
							<input type="radio" name="count" value="3"/>
							<div class="radio__text"><span class="count-t">3</span></div>
						</label>
						<label class="radio">
							<input type="radio" name="count" value="4"/>
							<div class="radio__text"><span class="count-t">4</span></div>
						</label>
						<label class="radio radio-all">
							<input type="radio" name="count" value="0" checked="checked"/>
							<div class="radio__text"><span class="count-t">Все</span></div>
						</label>
					</div>
					<h4>Площадь квартиры, м<sup>2</sup> :</h4>
					<div class="choice-form-row">
						<span class="f-lable">от</span>
						<input type="number" class="input-f sq-min" min="1">
						<span class="f-lable">до</span>
						<input type="number" class="input-f sq-max" min="1">
					</div>

					<h4>Стоимость:</h4>
					<div class="choice-form-row">
						<span class="f-lable">от</span>
						<input type="number" class="input-f p-min" min="1" >
						<span class="f-lable">до</span>
						<input type="number" class="input-f p-max" min="1">
					</div>

					<input class="input-submit" type="submit" value="Подобрать">
				</form>
			</div>
		</div>
		<div class="apartment-choice-right">
			<?php
			$unique_id = 0;
			$title_house = get_the_title();
			// $plan_house = get_field('h_plan_floor');
			$floor_house = get_field('h_floor');


			if (get_field('house_id')) {
				$unique_id = get_field('house_id');
			}

			$args = array(
				'post_type' => 'flat',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => 'flat_id',
						'value' => $unique_id
					),
				)
			);
			$query = new WP_Query( $args );

			$ft = $query->post_count;

			?>
			<h4>Найдено: <span class="flat-total"><strong><?php echo $ft; ?></strong></span> предложений</h4>

			<table class="apartment-choice-table">
				<thead>
					<tr>
						<th>Секция</th>
						<th>Этаж</th>
						<th>№ квартиры</th>
						<th>Кол. комнат</th>
						<th>Площадь, м<sup>2</sup></th>
						<th>Стоимость м<sup>2</sup>, USD</th>
						<th>Стоимость квартиры, USD</th>
					</tr>
				</thead>

				<tbody>

					<?php

					if( $query->have_posts() ):

						while ( $query->have_posts() ) : $query->the_post(); ?>

							<?php

							$saled = get_field('flat_saled');
							(int)$sq = get_field('flat_square');
							$sq_class = '';


							if($sq <= 30){
								$sq_class = 'square_green';
							} else if($sq > 30 && $sq < 55){
								$sq_class = 'square_yellow';
							} else {
								$sq_class = 'square_red';
							}

							?>



							<tr data-title="<?php echo $title_house; ?>" data-plan="<?php the_field('flat_plan'); ?>" class="one-flat <?php 
							if($saled){
								echo'saled';
							}
							?>">
							<td data-label="Секция"><?php the_field('flat_section'); ?></td>
							<td data-label="Этаж" class="j-floor"><?php the_field('flat_floor'); ?></td>
							<td data-label="№ квартиры"><?php the_field('flat_number'); ?></td>
							<td data-label="Кол. комнат" class="j-room"><?php the_field('flat_rooms'); ?></td>
							<td data-label="Площадь, м2" class="j-meter"><span class="square <?php echo $sq_class; ?>"><?php echo round((float)get_field('flat_square'), 2); ?></span></td>
							<td data-label="Стоимость м2, USD" class="j-price_m"><?php the_field('flat_price_m'); ?></td>
							<td data-label="Стоимость квартиры, USD" class="j-price"><?php the_field('flat_price'); ?></td>
						</tr>

					<?php   endwhile;

				else :

				endif;

				wp_reset_postdata();

				?>

			</tbody>
		</table>
	</div>
</div>
</section>

<?php endif; // show flats ?>


<?php if(get_field('show_best')) : ?>

<?php

$query = new WP_Query( $args );

if( $query->have_posts() ): ?>

	<section class="best-deals-section">
		<div class="container">
			<h3>Лучшие предложения</h3>
			<div class="best-deals-wrap">


				<?php   while ( $query->have_posts() ) : $query->the_post(); ?>

					<?php if(get_field('flat_best') == '1') { ?>

						<div class="best-deals-item" data-title="<?php echo $title_house; ?>" data-plan="<?php the_field('flat_plan'); ?>" data-planf="<?php echo $plan_house; ?>">
							<div class="best-deals-item-inner">
								<div class="best-deals-item__img">
									<img src="<?php the_field('flat_plan'); ?>" alt="">
								</div>
								<div class="best-deals-item__info">
									<h4>Лyчшaя квapтиpa пo цeнe:</h4>
									<h3 class="flat-inp"><span class="j-room"><?php the_field('flat_rooms'); ?></span>к квapтиpa, <span class="j-meter"><?php echo round((float)get_field('flat_square'), 2); ?></span>м<sup>2</sup></h3>
									<p><span>Cтoимocть: </span><span class="j-price"><?php the_field('flat_price'); ?></span>$</p>
									<p><span>Цeнa зa м<sup>2</sup>: </span><span class="j-price_m"><?php the_field('flat_price_m'); ?></span>$</p>
									<p><span>Этaжнocть: </span><span class="j-floor"><?php the_field('flat_floor'); ?></span>/<span><?php echo $floor_house; ?></span></p>
									<p><span>B ипoтeкy: </span><?php the_field('flat_ipoteka'); ?></p>
									<a href="javascript:;" class="btn-blue one-flat2">Узнать подробнее</a>
								</div>
							</div>
						</div>

					<?php 	} ?>



				<?php endwhile; ?>

			</div>
		</div>
	</section>

<?php	else :

endif;

wp_reset_postdata();

?>

<?php endif; // show best ?>

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
				<a  data-fancybox data-src="#hidden-content" href="javascript:;" class="btn btn_white btn_anim">
					<span class="btn__first">Связаться со мной</span>
					<span class="btn__second">Связаться со мной</span>
				</a>
			</div>
		</div>
	</div>
</section>

<div id="flat" style="display: none;" class="flat-modal">
	<div class="flat-modal-inner">
		<div class="flat-modal-left">
			<div class="flat-plan-box">
				<div class="flat-plan-buttons">
					<div class="flat-plan-btn act-fb">План квартиры</div>
					<div class="flat-plan-btn">План этажа</div>
				</div>
				<div class="flat-plan-content">
					<div class="flat-plan-img fpi-act">
						<a href="" data-fancybox="images"><img class="m-plan" src="" alt=""></a>
					</div>
					<div class="flat-plan-img">
						<div class="slider-for-plan-wrap" style="position: relative;">
							<div class="home-slider-arr home-slider-left2">
							</div>
							<div class="home-slider-arr home-slider-right2">
							</div>
							<div class="slider-for-plan">

								<?php if(get_field('h_plan_floor')): ?> 
									<?php while(the_repeater_field('h_plan_floor')): ?> 
										<a href="<?php the_sub_field('img'); ?>" data-fancybox="images2"><img src="<?php the_sub_field('img'); ?>" alt=""></a>		
									<?php endwhile; ?> 
								<?php endif;?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="flat-modal-right">
			<h2><span class="m-room"></span>к квapтиpa, <span class="m-meter"></span>м<sup>2</sup><br> в ЖК <span class="b-name">"Восьмая жемчужина"</span></h2>
			<div class="flat-info-box">
				<div class="flat-info-row">
					<div class="flat-info-item">
						<p><span class="m-floor"></span>/<span><?php the_field('h_floor') ?></span></p>
						<span class="span-flat">Этаж</span>
					</div>
					<div class="flat-info-item">
						<p><span class="mm-room"></span></p>
						<span class="span-flat">Комнат</span>
					</div>
				</div>
				<div class="flat-info-row">
					<div class="flat-info-item">
						<p><span class="mm-meter"></span></p>
						<span class="span-flat">Площадь, м2</span>
					</div>
					<div class="flat-info-item">
						<p><span class="m-pricem"></span></p>
						<span class="span-flat">Стоимость м2, USD</span>
					</div>
				</div>
				<div class="flat-info-item">
					<p><span class="m-price"></span></p>
					<span class="span-flat">Стоимость квартиры, USD</span>
				</div>
			</div>
			<div class="flat-form-box">
				<h3>Свяжитесь с нами:</h3>
				<?php echo do_shortcode('[contact-form-7 id="190" title="form5"]'); ?>
			</div>
		</div>
	</div>
</div>

<div id="hidden-content" style="display: none;" class="c-form">
	<div class="c-form-inner">
		<h2><?php the_field('feed1_caption', 8); ?></h2>
		<h3><?php the_field('feed1_subcaption', 8); ?></h3>
		<div class="c-form-wrap">
			<?php echo do_shortcode('[contact-form-7 id="186" title="form1"]'); ?>
		</div>
	</div>
</div>

<div id="flat2" style="display: none;" class="c-form">
	<div class="c-form-inner">
		<h2><?php the_field('feed1_caption', 8); ?></h2>
		<h3><?php the_field('feed1_subcaption', 8); ?></h3>
		<div class="company-hid"></div>
		<div class="flat-hid"></div>
		<div class="c-form-wrap">
			<?php echo do_shortcode('[contact-form-7 id="195" title="form6"]'); ?>
		</div>
	</div>
</div>


<?php
get_footer('second');