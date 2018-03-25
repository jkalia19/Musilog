<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Muso
 */

?>
<div class="item col-md-6">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<?php 
		if ( has_post_format( 'video' )) {
			echo wp_oembed_get(muso_catch_first_video());
		}else{
			if(has_post_thumbnail()){ ?>
				<div class="img-container image-wrapper">
					<a href="<?php the_permalink('') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('muso-featured-thumbnails'); ?></a>
				</div>
			<?php } else {?>
				<div class="img-placeholder image-wrapper">
					<i class="fa fa-camera" aria-hidden="true"></i>
				</div>
			<?php } 
		}?>
        
        <div class="post-details">
            <header class="entry-header">
                <?php
                if ( is_single() ) :
                    the_title( '<h1 class="entry-title">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;
        
                if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php muso_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php
                endif; ?>
            </header><!-- .entry-header -->
        
            <div class="entry-content">
                <?php
                    the_excerpt();
        
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'muso' ),
                        'after'  => '</div>',
                    ) );
                ?>
                <a href="<?php the_permalink('') ?>" class="read_more"><?php _e( 'Read More', 'muso' ); ?></a>
            </div><!-- .entry-content -->
    	</div>
        
    </article><!-- #post-## -->
</div>