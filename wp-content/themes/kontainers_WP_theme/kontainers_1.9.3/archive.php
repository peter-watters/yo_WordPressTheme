<?php
/**
 * kontainers_WP_theme template for displaying Archives
 *
 * @package WordPress
 * @subpackage kontainers_WP_theme
 * @since kontainers_WP_theme 1.0
 */

get_header(); ?>

<!--  This holds the WP page Content - k-blog-holder class for blog pages only -->
<div class="non-app k-blog-holder">

	<!--  Top bar with nav -->
	<?php include('top-nav.php') ?>

	<!--  form_holder - holds scrolling content -->
	<div class="form_holder">

		<!--  conent_holder - positions content -->
		<div class="content_holder">

			<h1> <a href="<?php echo get_page_link() ?>">Shipping Blog</a></h1>
			<!--  blog-nav - holds navigation elements scraped from standard WP elements -->
			<?php include('blog-nav.php'); ?>
			<section class="page-content primary" role="main"><?php

				if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title">
					<?php
					if ( is_category() ):
						printf( __( 'Category Archives: %s', 'kontainers_wp_theme' ), single_cat_title( '', false ) );

					elseif ( is_tag() ):
						printf( __( 'Tag Archives: %s', 'kontainers_wp_theme' ), single_tag_title( '', false ) );

					elseif ( is_tax() ):
						$term     = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						$taxonomy = get_taxonomy( get_query_var( 'taxonomy' ) );
						printf( __( '%s Archives: %s', 'kontainers_wp_theme' ), $taxonomy->labels->singular_name, $term->name );

					elseif ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'kontainers_wp_theme' ), get_the_date() );

					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'kontainers_wp_theme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'kontainers_wp_theme' ) ) );

					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'kontainers_wp_theme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'kontainers_wp_theme' ) ) );

					elseif ( is_author() ) : the_post();
						printf( __( 'All posts by %s', 'kontainers_wp_theme' ), get_the_author() );

					else :
						_e( 'Archives', 'kontainers_wp_theme' );

					endif;
					?>
						</h1>
					</header>


					<?php

					if ( is_category() || is_tag() || is_tax() ):
						$term_description = term_description();
						if ( ! empty( $term_description ) ) : ?>

							<div class="archive-description"><?php
							echo $term_description; ?>
							</div><?php

						endif;
					endif;

					if ( is_author() && get_the_author_meta( 'description' ) ) : ?>

						<div class="archive-description">
						<?php the_author_meta( 'description' ); ?>
						</div><?php

					endif;

					while ( have_posts() ) : the_post();

						get_template_part( 'loop', get_post_format() );

					endwhile;

				else :

					get_template_part( 'loop', 'empty' );

				endif; ?>

				<div class="pagination">

					<?php get_template_part( 'template-part', 'pagination' ); ?>

				</div>
			</section>

		</div>
		<!--/content_holder-->

	</div>
	<!--/form_holder-->

</div>
<?php get_footer(); ?>


