<!doctype html>
<html <?php language_attributes(); ?>>
<head>
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500&amp;subset=cyrillic" rel="stylesheet"> 

	<?php wp_head(); ?>
</head>

<body id="screen" class="home-p">

	<header class="header header-fixed header-main">
			<div class="container">
				<div class="header-inner">
					<a href="<?php echo home_url(); ?>" class="logo-box logo-box-main">
						<div class="logo-inner">
							<h1>stulov</h1>
						</div>
						<p>Ваш агент по недвижимости</p>
					</a>

					<div class="header-contacts">
							<a class="header-phone" href="tel:<?php echo str_replace([' ', '-'], '', get_field('tel_main')); ?>"><?php the_field('tel_main'); ?></a>
							<a class="header-email header-email_white" href="mailto:<?php the_field('mail_main'); ?>"><?php the_field('mail_main'); ?></a>
					</div>
				</div>
			</div>
		</header>

		<div class="aside-socials">
				<p>Я в соцсетях</p>
				<div class="aside-socials-icons">
					<a href="<?php the_field('facebook_main'); ?>"><img src="<?php echo get_template_directory_uri()?>/images/facebook.png" alt=""></a>
				<a href="<?php the_field('vk_main'); ?>"><img src="<?php echo get_template_directory_uri()?>/images/vk.png" alt=""></a>
				<a href="<?php the_field('instagram_main'); ?>"><img src="<?php echo get_template_directory_uri()?>/images/instagram.png" alt=""></a>
				</div>	
		</div>

		<?php $links = get_field('main_menu') ?>

		<div class="aside-nav aside-nav_white">
			<ul>
				<li class="current"><a href="#first-section" class="side-link"><span class="menu-text"><?php echo $links[0]['title'] ?></span><span class="aside-dot"></span></a></li>
				<li><a href="#second-section" class="side-link"><span class="menu-text"><?php echo $links[1]['title'] ?></span><span class="aside-dot"></span></a></li>
				<li><a href="#second2-section" class="side-link"><span class="menu-text"><?php echo $links[2]['title'] ?></span><span class="aside-dot"></span></a></li>
				<li><a href="#third-section" class="side-link"><span class="menu-text"><?php echo $links[3]['title'] ?></span><span class="aside-dot"></span></a></li>
				<li><a href="#fourth-section" class="side-link"><span class="menu-text"><?php echo $links[4]['title'] ?></span><span class="aside-dot"></span></a></li>
				<li><a href="#fifth-section" class="side-link"><span class="menu-text"><?php echo $links[5]['title'] ?></span><span class="aside-dot"></span></a></li>
				<li><a href="#sixth-section" class="side-link"><span class="menu-text"><?php echo $links[6]['title'] ?></span><span class="aside-dot"></span></a></li>
			</ul>
			<div class="aside-scroll aside-scroll_white"></div>
		</div>
