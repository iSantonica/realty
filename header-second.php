<!doctype html>
<html <?php language_attributes(); ?>>
<head>
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500&amp;subset=cyrillic" rel="stylesheet"> 

	<?php wp_head(); ?>
</head>

<body>
	
		<header class="header header-second">
			<div class="container">
				<div class="header-inner">
					<a href="<?php echo home_url(); ?>" class="logo-box logo-box-small wow slideInLeft">
						<div class="logo-inner">
							<h1>stulov</h1>
						</div>
						<p>Ваш агент по недвижимости</p>
					</a>

					<div class="header-contacts header-contacts-small wow slideInRight">
							<a class="header-phone" href="tel:<?php echo str_replace([' ', '-'], '', get_field('tel_main', 8)); ?>"><?php the_field('tel_main', 8); ?></a>
							<a class="header-email header-email_white" href="mailto:<?php the_field('mail_main', 8); ?>"><?php the_field('mail_main', 8); ?></a>
					</div>
				</div>
			</div>
		</header>