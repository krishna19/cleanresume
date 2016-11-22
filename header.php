<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CleanResume
 */

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html <?php language_attributes(); ?> id="ie7">
<![endif]-->
<!--[if IE 8]>
<html <?php language_attributes(); ?> id="ie8">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/css3-mediaqueries.js"></script>
<![endif]-->

</head>
<body <?php body_class(); ?>>

	<main id="main" class="container">
		<div class="wrapper">

			<?php if ( is_home() ) : ?>
			<nav id="resume-options" class="resume-options hidden-print wow fadeInUp" data-wow-delay="100ms">
				<?php if ( get_theme_mod( 'template_layouts' ) == 'fullwidth' ) { ?>
				<div class="container">
				<?php } ?>
				<a href="#" onclick="window.print(); return false;" class="btn btn-default btn-md btn-print"><span class="fa fa-print"></span> Print It</a>
				<?php if ( get_theme_mod( 'avatar_resume' ) ) : ?>
				<a href="<?php echo get_theme_mod('avatar_resume'); ?>" target="_blank" class="btn btn-default btn-md btn-pdf"><span class="fa fa-file-pdf-o"></span> Download CV</a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'template_layouts' ) == 'fullwidth' ) { ?>
				</div>
				<?php } ?>
			</nav>
			<?php else: ?>
			<nav id="resume-options" class="resume-options hidden-print wow fadeInUp" data-wow-delay="100ms">
				<?php if ( get_theme_mod( 'template_layouts' ) == 'fullwidth' ) { ?>
				<div class="container">
				<?php } ?>
					<a href="<?php echo get_home_url(); ?>" class="btn btn-primary btn-md pull-left"><span class="fa fa-arrow-circle-left"></span> Go Back</a>
				<?php if ( get_theme_mod( 'template_layouts' ) == 'fullwidth' ) { ?>
				</div>
				<?php } ?>
			</nav>
			<?php endif; ?>

			<?php if ( is_home() ) : ?>
			<header id="header" class="row">
				<div class="col-md-3 col-sm-4 col-xs-4 wow fadeInRight avatar-thumbnail" data-wow-delay="300ms">
					<?php if( get_theme_mod( 'active_avatar_tooltip' ) == '1') : ?>
					<em class="say-hello wow fadeInUp" data-wow-delay="1200ms">Hello There</em>
					<?php endif; ?>
					<a href="#" class="thumbnail">
					<?php if ( get_theme_mod( 'avatar_image' ) ) : ?>
						<img class="avatar-photo" src="<?php echo esc_url( get_theme_mod( 'avatar_image' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php else : ?>
						<img class="avatar-photo" src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar-image.jpg" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php endif; ?>
					</a>
				</div>
				<div class="col-md-5 col-sm-8 col-xs-8 wow fadeInRight" data-wow-delay="500ms">
					<h1 class="avatar-name"><?php bloginfo( 'name' ); ?></h1>
					<h6 class="avatar-designation"><?php bloginfo( 'description' ); ?></h6>
					<hr class="clearfix hidden-print">
					<ul class="avatar-contact-info">
						<li>
							<?php $admin_email = get_theme_mod( 'admin_email' );
							if ( $admin_email ) { ?>
								<a href="mailto:<?php echo $admin_email; ?>"><span class="fa fa-envelope-o"></span> <?php echo $admin_email; ?></a>
							<?php } else { ?>
								<a href="mailto:<?php bloginfo( 'admin_email' ); ?>"><span class="fa fa-envelope-o"></span> <?php bloginfo( 'admin_email' ); ?></a>
							<?php } ?>
						</li>
						<li><a class="avatar-tel" href="tel:<?php echo get_theme_mod( 'phone_number' ); ?>"><span class="fa fa-phone"></span> <?php echo get_theme_mod( 'phone_number' ); ?></a></li>
						<li>
							<?php $admin_url = get_theme_mod( 'admin_url' );
							if ( $admin_url ) { ?>
								<a href="mailto:<?php echo $admin_url; ?>"><span class="fa fa-globe"></span> <?php echo $admin_url; ?></a>
							<?php } else { ?>
								<a class="site-url" href="<?php echo get_site_url(); ?>"><span class="fa fa-globe"></span> <?php echo get_site_url(); ?></a>
							<?php } ?>
						</li>
					</ul>
					<?php if( get_theme_mod( 'active_social' ) == '1') : ?>
					<br class="hidden-print">
					<ul class="avatar-social list-inline hidden-print">
						<?php if ( get_theme_mod( 'facebook_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'facebook_icon' )); ?>" title="Facebook" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon facebook"><span class="fa fa-facebook"></span><strong class="sr-only">Facebook</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'googleplus_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'googleplus_icon' )); ?>" title="Google Plus" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon google-plus"><span class="fa fa-google-plus"></span><strong class="sr-only">Google +</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'twitter_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'twitter_icon' )); ?>" title="Twitter" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon twitter"><span class="fa fa-twitter"></span><strong class="sr-only">Twitter</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'linkedin_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'linkedin_icon' )); ?>" title="Linkedin" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon linkedin"><span class="fa fa-linkedin"></span><strong class="sr-only">Linkedin</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'instagram_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'instagram_icon' )); ?>" title="Instagram" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon instagram"><span class="fa fa-instagram"></span><strong class="sr-only">Instagram</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'flickr_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'flickr_icon' )); ?>" title="Flickr" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon flickr"><span class="fa fa-flickr"></span><strong class="sr-only">Flickr</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'pinterest_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'pinterest_icon' )); ?>" title="Pinterest" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon pinterest"><span class="fa fa-pinterest"></span><strong class="sr-only">Pinterest</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'tumblr_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'tumblr_icon' )); ?>" title="Tumblr" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon tumblr"><span class="fa fa-tumblr"></span><strong class="sr-only">Tumblr</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'behance_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'behance_icon' )); ?>" title="Behance" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon behance"><span class="fa fa-behance"></span><strong class="sr-only">Behance</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'dribbble_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'dribbble_icon' )); ?>" title="Dribbble" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon dribbble"><span class="fa fa-dribbble"></span><strong class="sr-only">Dribbble</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'fivehundred_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'fivehundred_icon' )); ?>" title="500px" data-toggle="tooltip" data-placement="top" target="_blank" class="btn btn-default btn-hexagon fivehundredpx"><span class="fa fa-500px"></span><strong class="sr-only">500px</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'github_icon' ) ) : ?>
						<li><a href="<?php echo esc_url( get_theme_mod( 'github_icon' )); ?>" title="Github" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-hexagon github"><span class="fa fa-github-alt"></span><strong class="sr-only">Github</strong></a></li>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'skype_icon' ) ) : ?>
						<li><a href="skype:<?php echo esc_url( get_theme_mod( 'skype_icon' )); ?>?add" title="Skype" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-hexagon skype"><span class="fa fa-skype"></span><strong class="sr-only">Skype</strong></a></li>
						<?php endif; ?>
					</ul>
					<?php endif; ?>
				</div>
				<div class="col-md-4 avatar-information-wrapper wow fadeInRight" data-wow-delay="700ms">
					<?php $identity_info_section_title = get_theme_mod( 'identity_info_section_title' );
					if ( $identity_info_section_title ) {
						echo '<h2 class="title">' . $identity_info_section_title . '</h2>';
					} else {
						echo '<h2 class="title">Identity Information</h2>';
					} ?>

					<?php
					if ( get_theme_mod( 'identity_info_fullname' ) || get_theme_mod( 'identity_info_dob' ) || get_theme_mod( 'identity_info_company' ) || get_theme_mod( 'identity_info_occupation' ) || get_theme_mod( 'identity_info_city' ) || get_theme_mod( 'identity_info_country' ) || get_theme_mod( 'identity_info_address' ) ) { ?>
					<table class="table table-responsive avatar-information">
						
						<?php if ( get_theme_mod( 'identity_info_fathername' ) ) : ?>
						<tr>
							<td>Father Name</td>
							<td><?php echo get_theme_mod( 'identity_info_fathername' ); ?></td>
						</tr>
						<?php endif; ?>
						
						<?php if ( get_theme_mod( 'identity_info_dob' ) ) : ?>
						<tr>
							<td>Date of Birth</td>
							<td><?php echo get_theme_mod( 'identity_info_dob' ); ?></td>
						</tr>
						<?php endif; ?>
						
						<?php if ( get_theme_mod( 'identity_info_company' ) ) : ?>
						<tr>
							<td>Company</td>
							<td><?php echo get_theme_mod( 'identity_info_company' ); ?></td>
						</tr>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'identity_info_occupation' ) ) : ?>
						<tr>
							<td>Occupation</td>
							<td><?php echo get_theme_mod( 'identity_info_occupation' ); ?></td>
						</tr>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'identity_info_id' ) ) : ?>
						<tr>
							<td>ID Number</td>
							<td><?php echo get_theme_mod( 'identity_info_id' ); ?></td>
						</tr>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'identity_info_passport' ) ) : ?>
						<tr>
							<td>Passport No.</td>
							<td><?php echo get_theme_mod( 'identity_info_passport' ); ?></td>
						</tr>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'identity_info_license' ) ) : ?>
						<tr>
							<td>Driving License</td>
							<td><?php echo get_theme_mod( 'identity_info_license' ); ?></td>
						</tr>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'identity_info_social' ) ) : ?>
						<tr>
							<td>Social Security</td>
							<td><?php echo get_theme_mod( 'identity_info_social' ); ?></td>
						</tr>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'identity_info_city' ) ) : ?>
						<tr>
							<td>City</td>
							<td class="text-capitalize"><?php echo get_theme_mod( 'identity_info_city' ); ?></td>
						</tr>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'active_country' ) == '1' && get_theme_mod( 'identity_info_country' ) ) : ?>
						<tr>
							<td>Country</td>
							<td class="text-capitalize"><?php echo get_theme_mod( 'identity_info_country' ); ?></td>
						</tr>
						<?php endif; ?>
						
						<?php if ( get_theme_mod( 'identity_info_address' ) ) : ?>
						<tr>
							<td>Mailing Address</td>
							<td><?php echo get_theme_mod( 'identity_info_address' ); ?></td>
						</tr>
						<?php endif; ?>
					</table>
					<?php } else {
						echo '<p>Sorry, this section dont have any content. Please go to Customizer > Content Sections & Title > Identity Information to add content.</p>';
					} ?>
				</div>
			</header><!-- #masthead -->
			<?php endif; ?>
