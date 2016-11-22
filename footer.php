<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CleanResume
 */

?>

		</div>
	</main> <!-- End Main -->

	<?php if( get_theme_mod( 'active_top' ) == '1') : ?>
	<a href="#main" id="toTop" class="btn btn-primary hidden-print" data-toggle="tooltip" data-placement="left" title="Go to Top">
		<span class="fa fa-arrow-up"></span>
		<strong class="sr-only">Go to Top</strong>
	</a>
	<?php endif; ?>

	<?php if( is_home() && get_theme_mod( 'active_portfolio' ) == '1') : ?>
	<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls hidden-print" data-use-bootstrap-modal="false">
		<!-- The container for the modal slides -->
		<div class="slides"></div>
		<!-- Controls for the borderless lightbox -->
		<h3 class="title">Portfolio Title</h3>
		<a class="prev"><span class="fa fa-chevron-left"></span></a>
		<a class="next"><span class="fa fa-chevron-right"></span></a>
		<a class="close"><span class="fa fa-close"></span></a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
		<!-- The modal dialog, which will be used to wrap the lightbox content -->
		<div class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Portfolio Modal Title</h4>
					</div>
					<div class="modal-body next"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left prev"><i class="glyphicon glyphicon-chevron-left"></i> Previous</button>
						<button type="button" class="btn btn-primary next">Next <i class="glyphicon glyphicon-chevron-right"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Bootstrap Image Gallery -->
	<?php endif; ?>
	
	<?php wp_footer(); ?>

</body>
</html>
