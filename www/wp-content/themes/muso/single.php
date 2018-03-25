<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
                        if ( is_single() ) {
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        } else {
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        }
            
                    if ( 'post' === get_post_type() ) : ?>
                    <div class="entry-meta">
                        <?php muso_posted_on(); ?>
                    </div><!-- .entry-meta -->
                    <?php
                    endif; ?>
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
                        
                            get_template_part( 'template-parts/content-single', get_post_format() );
                
                            the_post_navigation();
                
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
