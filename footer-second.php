<footer class="footer">
  		<div class="container-common">
  			<div class="footer-top">
  				<a href="<?php echo home_url(); ?>" class="logo-box logo-box-small">
						<div class="logo-inner">
							<h1>stulov</h1>
						</div>
						<p>Ваш агент по недвижимости</p>
					</a>
					<div class="footer-contacts">
						<div class="footer-contacts-left">
							<a class="footer-phone" href="tel:<?php echo str_replace([' ', '-'], '', get_field('tel_main', 8)); ?>"><?php the_field('tel_main', 8); ?></a>
							<a class="footer-email" href="mailto:<?php the_field('mail_main', 8); ?>"><?php the_field('mail_main', 8); ?></a>
						</div>
						<div class="footer-contacts-right">
							<p><?php the_field('addr_contact', 8); ?></p>
						</div>
					</div>
  			</div>
  			<div class="footer-bottom">
  				<div class="footer-copy">
  					<?php the_field('copyright', 8); ?>
  				</div>
  			</div>
  		</div>
  	</footer>

<?php wp_footer(); ?>

</body>
</html>