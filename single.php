<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CleanResume
 */

 get_header();

?>

	<div class="row">
		<section id="primary" class="col-sm-9">

			<?php while ( have_posts() ) : the_post(); ?>
			<header class="modal-header entry-header">
				<h1 class="modal-title"><?php the_title(); ?></h1>
			</header>
			
			<?php cleanresume_posted_on(); ?>
			
			<div class="modal-body">
				
				<?php the_content(); ?>
				
			</div>
			
			<div class="post-meta footer-post-meta clearfix hidden-print">
				<?php cleanresume_entry_footer(); ?>
				
				<?php if( get_theme_mod( 'active_social_share' ) == '') : ?>
				<div class="avatar-social social-share pull-right">
					<strong>Share This Article: </strong>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="_blank" title="Share on Facebook"><span class="fa fa-facebook"></span><strong class="sr-only">Facebook</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default twitter" href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" target="_blank" title="Tweet this!"><span class="fa fa-twitter"></span><strong class="sr-only">Twitter</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default google-plus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" title="Share on Google Plus"><span class="fa fa-google-plus"></span><strong class="sr-only">Google Plus</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default pinterest" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $url; ?>" target="_blank" title="Share on Pinterest"><span class="fa fa-pinterest"></span><strong class="sr-only">Pinterest</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" target="_blank" title="Share on LinkedIn"><span class="fa fa-linkedin"></span><strong class="sr-only">Linkedin</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default delicious" href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="Bookmark on del.icio.us"><span class="fa fa-delicious"></span><strong class="sr-only">Delicious</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="Stumble it"><span class="fa fa-stumbleupon"></span><strong class="sr-only">StumbleUpon</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default reddit" href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="Vote on Reddit"><span class="fa fa-reddit"></span><strong class="sr-only">Reddit</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default digg" href="http://digg.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="Digg this!"><span class="fa fa-digg"></span><strong class="sr-only">Digg</strong></a>
					<a data-toggle="tooltip" data-placement="top" class="btn btn-default mail" href="mailto:" onclick="" title="Mail to Friend"><span class="fa fa-envelope"></span><strong class="sr-only">Mail</strong></a>
				</div>
				<?php endif; ?>
			</div>
			
			<footer class="modal-footer clearfix hidden-print">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
			</footer>	
			<?php endwhile; // End of the loop. ?>

		</section>

		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>