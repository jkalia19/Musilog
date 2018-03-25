<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Muso
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <div class="header-container">
		<?php the_post_thumbnail( 'single-post-thumbnail', array( 'class' => 'single-post-thumbnail' ) ); ?>
        <header class="entry-header" >
            <div class="black-overlay">
            	<div class="container">
					<?php
                        the_title( '<h1 class="entry-title">', '</h1>' );
					?>
            	</div>
            </div>
        </header><!-- .entry-header -->
    </div>
    
    <div class="breadcrumb-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php muso_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
            	<div class="row">
                	<div class="col-md-8">

						<?php
                        
            
                            get_template_part( 'template-parts/content', 'page' );
            
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
            
                        
                        ?>

					</div>
                    <div class="col-md-4">
                    	<?php get_sidebar(); ?>
                    </div>
				</div>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>

<?php
endwhile; // End of the loop.
get_footer();
