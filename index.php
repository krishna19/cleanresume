<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CleanResume
 */

get_header(); ?>

			<hr class="clearfix hidden-print">
			
			<section class="row">
				<div class="col-md-8">
					<article class="content-wrapper about-avatar wow fadeInUp" data-wow-delay="1000ms">
						<?php
						$about_section_title = get_theme_mod( 'about_section_title' );
						$about_section_content = get_theme_mod( 'about_section_content' );
						
						if ( $about_section_title ) {
							echo '<h2 class="title">' . $about_section_title . '</h2>';
						} else {
							echo '<h2 class="title">Short About Me</h2>';
						}

						if ( $about_section_content ) {
							echo '<div class="about-content">' . $about_section_content . '</div>'; 
						} else {
							echo '<p>Sorry, this section dont have any content. Please go to Customizer > Content Sections & Title > About Section to add content.</p>';
						}
						?>
					</article>
					<section class="content-wrapper avatar-experience has-timeline clearfix">
						<?php $experience_section_title = get_theme_mod( 'experience_section_title' );
						if ( $experience_section_title ) {
							echo '<h2 class="title wow fadeIn" data-wow-delay="200ms">' . $experience_section_title . '</h2>';
						} else {
							echo '<h2 class="title wow fadeIn" data-wow-delay="200ms">Professional Expereince</h2>';
						} ?>

						<?php
						$experience_post_count = get_theme_mod( 'experience_post_count' );
						$experience_post_order = get_theme_mod( 'experience_post_sortorder' );

						$args = array( 'post_type' => 'experience', 'order' => $experience_post_order, 'posts_per_page' => $experience_post_count );
						$the_query = new WP_Query( $args ); 
						?>
						<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php
						$organisation_institute = get_post_meta($post->ID, "custom_options_organisation-institute", true);
						$exp_starting_date = get_post_meta($post->ID, "custom_options_starting-date", true);
						$exp_end_date = get_post_meta($post->ID, "custom_options_end-date", true);
						$exp_present = get_post_meta($post->ID, "custom_options_present", true);
						?>

						<div class="row box wow fadeInUp clearfix">
							<div class="col-xs-4 col-sm-3 col-md-3">

								<h4 class="experience-company"><?php if( $organisation_institute ) : echo $organisation_institute; endif; ?></h4>
								<strong class="experience-year">
								<?php
									if( $exp_starting_date ) : echo $exp_starting_date; endif;
									echo ' - ';
									if ( $exp_present == '1') {
										echo 'Present';
									} else if ( $exp_present == '0' ) {
										if( $exp_end_date ) : echo $exp_end_date; endif;
									}
								?>
								</strong>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9">
								<h3 class="job-designation"><?php the_title(); ?></h3>
								<div class="job-description"><?php the_content(); ?></div>
							</div>
						</div>
						
						<?php endwhile; else :  ?>
						<p><?php _e( 'Sorry, there is no Expereicne post added so far. Please go to Dashboard and add one.', 'cleanresume-lite' ); ?></p>
						<?php endif; ?>
					</section>
					<section class="content-wrapper avatar-experience avatar-education has-timeline clearfix">
						<?php $education_section_title = get_theme_mod( 'education_section_title' );
						if ( $education_section_title ) {
							echo '<h2 class="title wow fadeIn" data-wow-delay="200ms">' . $education_section_title . '</h2>';
						} else {
							echo '<h2 class="title wow fadeIn" data-wow-delay="200ms">Education History</h2>';
						} ?>

						<?php
						$education_post_count = get_theme_mod( 'education_post_count' );
						$education_post_order = get_theme_mod( 'education_post_sortorder' );

						$args = array( 'post_type' => 'education', 'order' => $education_post_order, 'posts_per_page' => $education_post_count );
						$the_query = new WP_Query( $args ); 
						?>
						<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php
						$collage_institute = get_post_meta($post->ID, "custom_options_college-institute", true);
						$qualification_year = get_post_meta($post->ID, "custom_options_qualification-year", true);
						$still_studying = get_post_meta($post->ID, "custom_options_still-studying", true);
						?>

						<div class="row box wow fadeInUp clearfix">
							<div class="col-xs-4 col-sm-3 col-md-3">
								<h4 class="experience-company h5"><?php if( $collage_institute ) : echo $collage_institute; endif; ?></h4>
								<strong class="experience-year">
								<?php
									if ( $still_studying == '1') {
										echo 'Still Studying';
									} else if ( $still_studying == '0' ) {
										if( $qualification_year ) : echo $qualification_year; endif;
									}
								?>
								</strong>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9">
								<h3 class="job-designation"><?php the_title(); ?></h3>
								<div class="job-description"><?php the_content(); ?></div>
							</div>
						</div>
						
						<?php endwhile; else :  ?>
						<p><?php _e( 'Sorry, there is no Education History post added so far. Please go to Dashboard and add one.', 'cleanresume-lite' ); ?></p>
						<?php endif; ?>
					</section>
				</div>
				<aside class="col-md-4">
					<div class="sidebar-wrapper avatar-skills col-print-6" data-wow-delay="1200ms">
						<?php $skills_section_title = get_theme_mod( 'skills_section_title' );
						if ( $skills_section_title ) {
							echo '<h2 class="title">' . $skills_section_title . '</h2>';
						} else {
							echo '<h2 class="title">My Skills</h2>';
						} ?>
						
						<?php 
						$args = array( 'post_type' => 'skills', 'order' => 'ASC', 'posts_per_page' => -1 );
						$the_query = new WP_Query( $args ); 
						?>
						<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
						<?php
						$skill_expertise = get_post_meta($post->ID, "additional_options_skill-expertise", true);
						$skill_color = get_post_meta($post->ID, "additional_options_skill-color", true);
						?>

						<div class="progress skill-<?php global $post; $post_slug=$post->post_name; echo $post_slug; ?>">
							<div class="progress-bar" role="progressbar" data-progress-animate="<?php if( $skill_expertise ) : echo $skill_expertise; endif; ?>%" aria-valuenow="<?php if( $skill_expertise ) : echo $skill_expertise; endif; ?>" aria-valuemin="0" aria-valuemax="100" style="background-color: <?php if( $skill_color ) : echo $skill_color; endif; ?>">
								<span class="pull-left text-uppercase"><?php the_title(); ?></span>
								<strong class="pull-right"><?php if( $skill_expertise ) : echo $skill_expertise; endif; ?>%</strong>
							</div>
						</div>
						
						<?php endwhile; else :  ?>
						<p><?php _e( 'Sorry, there are no Skills added so far. Please go to Dashboard and add one.', 'cleanresume-lite' ); ?></p>
						<?php endif; ?>
					</div> <!-- End Sidebar Content Wrapper -->
					<div class="sidebar-wrapper avatar-services col-print-6 wow fadeInUp" data-wow-delay="200ms">
						<?php $services_section_title = get_theme_mod( 'services_section_title' );
						if ( $services_section_title ) {
							echo '<h2 class="title">' . $services_section_title . '</h2>';
						} else {
							echo '<h2 class="title">What I Do</h2>';
						} ?>

						<?php
						$services_section_content = get_theme_mod( 'services_section_content' );
						$services_section_content_li = '<li>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</li>\n<li>"),trim($services_section_content,"\n\r")).'</li>';
						
						if ( $services_section_content ) {
							echo '<ul>' . $services_section_content_li . '</ul>';
						} else {
							echo '<p>Sorry, there is no list added for Services so far. Please go to Customizer > Content Sections & Title > Sidebar Content & Title section and add some.</p>';
						} ?>
					</div> <!-- End Sidebar Content Wrapper -->
					<div class="sidebar-wrapper avatar-interests wow fadeInUp" data-wow-delay="300ms">
						<?php $interest_section_title = get_theme_mod( 'interest_section_title' );
						if ( $interest_section_title ) {
							echo '<h2 class="title">' . $interest_section_title . '</h2>';
						} else {
							echo '<h2 class="title">Interest & Hobbies</h2>';
						} ?>

						<?php
						$interest_section_content = get_theme_mod( 'interest_section_content' );
						$interest_section_content_li = '<li>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</li>\n<li>"),trim($interest_section_content,"\n\r")).'</li>';


						if ( $interest_section_content ) {
							echo '<ul>' . $interest_section_content_li . '</ul>';
						} else {
							echo '<p>Sorry, there is no list added for Interest or Hobbies so far. Please go to Customizer > Content Sections & Title > Sidebar Content & Title section and add some.</p>';
						} ?>
					</div> <!-- End Sidebar Content Wrapper -->
					<div class="sidebar-wrapper avatar-languages wow fadeInUp" data-wow-delay="300ms">
						<?php $language_section_title = get_theme_mod( 'language_section_title' );
						if ( $language_section_title ) {
							echo '<h2 class="title">' . $language_section_title . '</h2>';
						} else {
							echo '<h2 class="title">What I Speak</h2>';
						} ?>

						<ul class="list-border list-language">
							<?php 
							$args = array( 'post_type' => 'languages', 'order' => 'ASC', 'posts_per_page' => -1 );
							$the_query = new WP_Query( $args ); 
							?>
							<?php if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<?php $language_proficiency = get_post_meta($post->ID, "additional_options_language-proficiency", true); ?>

							<li><?php the_title(); ?> <small><?php if( $language_proficiency ) : echo $language_proficiency; endif; ?></small> <small class="pull-right language-skills"><?php if( $language_proficiency ) : echo $language_proficiency; endif; ?></small></li>
							
							<?php endwhile; else :  ?>
							<li><?php _e( 'Sorry, there is no Language added so far. Please go to Dashboard and add one.', 'cleanresume-lite' ); ?></li>
							<?php endif; ?>
						</ul>
					</div> <!-- End Sidebar Content Wrapper -->
				</aside>
			</section>
			
			<?php if( get_theme_mod( 'active_portfolio' ) == '1') : ?>
			
			<hr class="clearfix hidden-print">
			
			<section id="portfolio" class="clearfix hidden-print">
				<?php $portfolio_section_title = get_theme_mod( 'portfolio_section_title' );
				if ( $portfolio_section_title ) {
					echo '<h2 class="title wow fadeIn" data-wow-delay="200ms">' . $portfolio_section_title . '</h2>';
				} else {
					echo '<h2 class="title wow fadeIn" data-wow-delay="200ms">My Portfolio</h2>';
				} ?>
				
				<div class="portfolio-thumbs">
					<?php
					$portfolio_post_count = get_theme_mod( 'portfolio_post_count' );
					$portfolio_post_order = get_theme_mod( 'portfolio_post_sortorder' );

					$args = array( 'post_type' => 'portfolio', 'order' => $portfolio_post_order, 'posts_per_page' => $portfolio_post_count );
					$the_query = new WP_Query( $args ); 
					?>
					<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					<div class="col-md-3 col-sm-4 col-xs-6 noPadding">
						<?php if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							echo '<a href="' . $large_image_url[0] . '" class="portfolio-thumb wow fadeIn" data-wow-delay="200ms" data-gallery="" title="' . the_title_attribute( 'echo=0' ) . '">';
							the_post_thumbnail( 'portfolio-thumb', array( 'class' => 'img-thumbnail img-responsive' ) );
							echo '<div class="overlay"><span class="fa fa-search-plus"></span></div></a>';
						} ?>
					</div>
					
					<?php wp_reset_postdata(); ?>
					<?php endwhile; else :  ?>
					<p><?php _e( 'Sorry, there is no Portfolio post added so far. Please go to Dashboard and add one.', 'cleanresume-lite' ); ?></p>
					<?php endif; ?>
				</div>
			</section>
			<?php endif; ?>

<?php get_footer(); ?>
