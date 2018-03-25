<?php
/**
 * Template Name: Full-width, no sidebar
 * Description: A full-width template with no sidebar
 */

get_header();

while ( have_posts() ) : the_post(); ?>
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
            <div class="row">
                <div class="col-md-12">
                    <main id="main" class="site-main" role="main">
                        <?php	
                            get_template_part( 'template-parts/content', ('page') );
                
                
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>
                    </main><!-- #main -->
                </div>
                
            </div><!--row-->
        </div><!-- #primary -->
    </div><!-- container -->
<?php
endwhile; // End of the loop.
?>
<?php
get_footer();
