<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php wp_title(''); ?></title>
        <meta name="description" content="Black and White Photos">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/themes/keenmagazine/favicon.ico" type="image/x-icon">
		<?php wp_head(); ?>
		
	</head>
	
	<?php 
		
		if( is_front_page() ):
			$site_classes = array( 'site-class', 'my-class' );
		else:
			$site_classes = array( 'no-site-class' );
		endif;
		
	?>
	
	<body <?php body_class( $site_classes ); ?>>
		
		<div class="container top_menu">
			<div class="header">
				<div class="logo">
					<a href="<?php echo site_url(); ?>">
						<img src="<?php echo site_url(); ?>/wp-content/themes/keenmagazine/public/dist/img/logo.png" alt="Keen Magazine Logo">
					</a>
				</div>
				<div class="menu">
						<?php 
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_class' => 'main_menu',
								'walker' => new Walker_Nav_primary()
								)
							);
						?>	
				</div>
			</div>
			<div class="header_mob">
				<div class="logo_mob">
					<a href="<?php echo site_url(); ?>">
						<img class="mob_logo" src="<?php echo site_url(); ?>/wp-content/themes/keenmagazine/public/dist/img/logo-mob.png" alt="Keen Magazine Logo">
					</a>
					<i id="mob_hamburger" class="fa fa-bars fa-2x" aria-hidden="true"></i>
				</div>
			<div id="mob" class="mob">
				
				
			<?php 
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_class' => 'mob_menu',
						'walker' => new Walker_Nav_primary()
						)
					);
				?>			           
				<div class="social social_mob">
					<ul>
						<!-- <li><a href=""><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a></li> -->
						<li><a target="_blank" href="https://www.instagram.com/keenmagazine/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a></li>
						<!-- <li><a href=""><i class="fa fa-pinterest-square fa-2x" aria-hidden="true"></i></a></li> -->
					</ul>
				</div>	
			</div>
			</div>
		</div>
		
		
				    
		</div>
	
