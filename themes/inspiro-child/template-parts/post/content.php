<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 * @since Inspiro 1.0.0
 * @version 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part('template-parts/post/article/header'); ?>

	<?php if (! is_single() && 'excerpt' === inspiro_get_theme_mod('display_content')) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php endif ?>

	<?php
	if (is_single() && 'side-right' === inspiro_get_theme_mod('layout_single_post') && is_active_sidebar('blog-sidebar')) {
		echo '<div class="entry-wrapper">';
	}
	?>



	<?php if (is_single() || (! is_single() && 'full-content' === inspiro_get_theme_mod('display_content'))) : ?>
		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					/* translators: %s: Post title. */
					__('Read more<span class="screen-reader-text"> "%s"</span>', 'inspiro'),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . __('Pages:', 'inspiro'),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			);
			?>
			<?php
			// Recupera tutti i campi ACF del post corrente
			$fields = get_fields();

			if ($fields) {
				foreach ($fields as $field_name => $value) {
					echo '<strong>' . esc_html($field_name) . ':</strong> ';
					// Controlla se il valore è un array per gestire eventuali campi ripetitori o complessi
					if (is_array($value)) {
						echo implode(', ', $value); // Stampa i valori separati da virgola
					} else {
						echo esc_html($value); // Stampa il valore del campo
					}
					echo '<br>'; // Aggiunge una nuova riga per la formattazione
				}
			} else {
				echo 'Nessun campo trovato.';
			}
			?>
			<!-- <?php echo do_shortcode('[mostra_acf campo1="offerta" campo2="localita" campo3="tipologia"]') ?> -->
		</div><!-- .entry-content -->

	<?php endif ?>

	<?php if (is_single() && 'side-right' === inspiro_get_theme_mod('layout_single_post') && is_active_sidebar('blog-sidebar')) : ?>

		<aside id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</aside>

		</div><!-- .entry-wrapper -->

		<div class="clear"></div>

	<?php endif ?>

	<?php
	if (is_single()) {
		inspiro_entry_footer();
	}
	?>


</article><!-- #post-<?php the_ID(); ?> -->