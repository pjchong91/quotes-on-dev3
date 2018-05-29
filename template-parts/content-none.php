<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package QOD_Starter_Theme
 */

?>


<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html( 'Nothing Found' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_search() ) : ?>

			<p><?php esc_html( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html( 'It seems we can&rsquo;t find what you&rsquo;re looking for.' ); ?></p>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
