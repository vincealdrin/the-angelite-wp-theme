<?php
/* ------------------------------------------------------------------------- *
 *  Staffs page template
 *	___________________________________________________
 *
 *	Template name: Staffs Page
/* ------------------------------------------------------------------------- */

// Custom Post Classes
$classes = array(
    'single-template-1',
	'page-template-full',
    'clearfix'
);

get_header(); ?>

<section class="container<?php ac_mini_disabled() ?> clearfix">

    <div class="wrap-template-1 page-full-width clearfix">

        <section class="content-wrap clearfix" role="main">

            <section class="posts-wrap single-style-template-1 clearfix">

                <article id="page-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
                    <div class="post-content">

                        <?php the_title( '<h2 class="tcenter title">', '</h2>' ); ?>

                        <div class="single-content">
                          <?php
                            $positions = [
                              'Editor-in-Chief',
                              'Managing Editor',
                              'Senior Editor',
                              'News/Online Media Editor',
                              'Features/Literary Editor',
                              'Sports Editor',
                              'Exchange Editor',
                              'Circulations Manager',
                              'Arts Editor',
                              'Staff Writer',
                              'Cartoonist',
                              'Graphic Artist',
                              'Layout Artist',
                              'Photojournalist'
                            ];
                            $plural = [
                            'Staff Writer',
                            'Cartoonist',
                            'Graphic Artist',
                            'Layout Artist',
                            'Photojournalist'
                            ];
                            $staffs = get_users();

                            foreach ($positions as $position) :
                          ?>
                              <ul>
                                <?php
                                  if (in_array($position, $plural)) {
                                    echo "{$position}s";
                                  } else {
                                    echo $position;
                                  }
                                ?>
                          <?php
                              foreach ($staffs as $index => $staff) :
                                if ($staff->position) : ?>
                                  <?php if ($staff->position === $position) : ?>
                                    <li>
                                      <a href="<?= get_author_posts_url($staff->id)?>">
                                        <?= $staff->display_name; ?>
                                      </a>
                                    </li>
                                  <?php endif; ?>
                          <?php endif; endforeach; ?>
                              </ul>
                          <?php endforeach; ?>
                            <ul>
                              Web Developer
                              <li>
                                <a href="https://github.com/vincealdrin/">
                                  Vince Aldrin Cabrera
                                </a>
                              </li>
                            </ul>
                        </div><!-- END .single-content -->

                    </div>
                </article>

            </section><!-- END .posts-wrap -->

        </section><!-- END .content-wrap -->

    </div><!-- END .wrap-template-1 -->

</section><!-- END .container -->

<?php get_footer(); ?>
