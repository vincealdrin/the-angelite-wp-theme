<?php
/* ------------------------------------------------------------------------- *
 *  Masonry Gallery page template
 *	___________________________________________________
 *
 *	Template name: Masonry Gallery Width Page
/* ------------------------------------------------------------------------- */
  $cat_id = get_cat_id($pagename);
  $query_args = array(
      'posts_per_page'		=> 12,
  'post_status'         	=> 'publish',
      'cat'					=>  $cat_id,
      'ignore_sticky_posts'	=> 1,
      'paged' => get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1
  );

  $query_posts = new WP_Query( apply_filters( 'ac_widget_masonry1_query_filter', $query_args ) );

get_header(); ?>

<section id="gallery-container" class="container<?php ac_mini_disabled() ?> clearfix">

  <div class="page-full-width">

    <section class="content-wrap" role="main">

      <div class="single-template-1 page-template-full">

        <div class="post-content">

          <?php the_title( '<h2 id="gallery-title-page" class="tcenter title">', '</h2>' ); ?>

          <div class="single-content">

            <section id="ac-widget-masonry-small-19" class="n-mt n-mb container sm-small-masonary builder mini-disabled clearfix">

              <div id="sm-<?php echo absint( $wnum ); ?>-small" class="js-masonry sm-wrap clearfix" data-masonry-options='{ "columnWidth": ".grid-sizer", "gutter": ".gutter-sizer", "percentPosition": true, "itemSelector": ".col" }'>

                <div class="grid-sizer masonry-brick"></div>
                <div class="gutter-sizer masonry-brick"></div>

                <?php
                if( $query_posts->have_posts()) : while ( $query_posts->have_posts() ) : $query_posts->the_post();
                ?>

                <div class="col threecol sc-title-hover sc-item">
                  <figure class="sc-thumbnail<?php if ( ! has_post_thumbnail() ) echo ' no-thumbnail'; ?>">
                    <?php
                    if ( has_post_thumbnail() ) :
                      the_post_thumbnail( 'ac-masonry-small-featured' );
                      else :
                        echo '<img src="' . get_template_directory_uri() . '/images/no-thumbnail.png" alt="' . __( 'No Thumbnail', 'justwrite' ) . '" />';
                      endif;
                      ?>
                      <figcaption class="st-overlay">
                        <?php do_action( 'ac_action_thumbnail_after' ); // Thumbnail action ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="nofollow" class="st-overlay-link"></a>
                      </figcaption>
                    </figure>
                    <div class="sc-entry">
                      <aside class="s-info clearfix">
                        <a href="<?php comments_link(); ?>" rel="nofollow" class="com"><i class="fa fa-comment"></i> <?php comments_number( '0', '1', '%' ); ?></a>
                        <time class="date" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'M d, Y' ); ?></time>
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" id="gallery-author" class="category"><?php echo esc_html( get_the_author() ); ?></a>
                      </aside>
                      <?php the_title( '<h4 class="section-title st-small-2nd st-bold"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                    </div>
                  </div><!-- END .threecol -->

                <?php endwhile;  else : // No posts ?>
                  <h4 class="section-title st-small-2nd st-bold"><?php _e( 'No posts available', 'justwrite' ); ?></h4>
                <?php endif; wp_reset_postdata(); // End Query ?>

              </div>
              <?php
                // Pagination
                $GLOBALS['wp_query'] = $query_posts;

                ac_paginate();
                // Index content wrap inside bottom action
                do_action( 'ac_action_index_content_wrap_inside_bot' );
              ?>
            </section>

          </div><!-- END .single-content -->

        </div><!-- END .post-content -->

      </div><!-- END .single-template-1 -->

    </section><!-- END .content-wrap -->

  </div><!-- END .page-full-width -->

</section><!-- END .container -->

<?php get_footer(); ?>
