<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Muso
 */

get_header(); ?>
	
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
                        <section class="error-404 not-found">
                           
                            <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'muso' ); ?></h1>
            
                            <div class="page-content">
                                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'muso' ); ?></p>
            
                                <?php
                                    get_search_form();
            
                                    the_widget( 'WP_Widget_Tag_Cloud' );
                                ?>
            
                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->
                    </div>
                    <div class="col-md-4">
                    	<?php get_sidebar(); ?>
                    </div>
                </div>
    
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>

<?php
get_footer();
