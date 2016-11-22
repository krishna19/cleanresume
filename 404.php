<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CleanResume
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cleanresume-lite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content text-center">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cleanresume-lite' ); ?></p>
					<strong class="error-404"></strong>
				</div>

				<hr class="clearfix">

				<div class="page-widget">
					<div class="col-md-3 col-sm-6">
						<h2 class="widgettitle">Search</h2>
						<?php get_search_form(); ?>
					</div>

					<div class="col-md-3 col-sm-6">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					</div>

					<?php if ( cleanresume_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories col-md-3 col-sm-6">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'cleanresume-lite' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

					<div class="col-md-3 col-sm-6">
					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'cleanresume-lite' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>
					</div>

					<div class="col-md-3 col-sm-6">
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
