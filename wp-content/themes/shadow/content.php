<?php
/**
 * The template for displaying posts on single pages
 *
 */
?>

<?php
	$postinfo = et_get_option( 'foxy_postinfo2' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
	<div class="entry-content">
		<div class="post-heading">
			<h1><?php the_title(); ?></h1>
		</div> <!-- .post-heading -->
	<?php
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Foxy' ), 'after' => '</div>' ) );
	?>
	</div> <!-- .entry-content -->
</article> <!-- end .entry-post-->