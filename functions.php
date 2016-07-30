<?php
/* ------------------------------------------------------------------------- *
 *  Functions
 *  ________________
 *
 *	For more info on Child Themes:
 *	http://codex.wordpress.org/Child_Themes
 *	________________
 *
/* ------------------------------------------------------------------------- */

// Get Parent Styles

function ac_child_theme_enqueue_styles() {

    $parent_style = 'ac_style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'ac_child_style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );

}
add_action( 'wp_enqueue_scripts', 'ac_child_theme_enqueue_styles' );

function ac_social_sharing_index_rm() {
	?>
    	<div class="post-small-button left p-share" id="share-<?php the_ID(); ?>-wrap">
            <a href="#" class="post-share-temp1" id="share-<?php the_ID(); ?>"><i class="fa fa-share"></i></a>
            <span class="contents clearfix">
                <em><?php _e( 'Share this on', 'acosmin' ); ?></em>
                <a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" rel="nofollow" class="social-btn twitter"><?php ac_icon( 'twitter' ); ?></a>
                <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="social-btn facebook" rel="nofollow"><?php ac_icon( 'facebook' ); ?></a>
                <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="social-btn google-plus" rel="nofollow"><?php ac_icon( 'google-plus' ); ?></a>
                <a href="#share-<?php the_ID(); ?>" class="close-this-temp1"><?php ac_icon( 'times' ); ?></a>
            </span>
        </div><!-- END #share-<?php the_ID(); ?> -->
    <?php
}
add_action( 'ac_action_content_read_more_after', 'ac_social_sharing_index_rm' );

function ac_facebook_api_sharer() {
	if( is_single() ) {
		?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1612717402278523"; // TODO: change app id
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <?php
	}
}
add_action( 'ac_action_body_start', 'ac_facebook_api_sharer' );

function ac_single_share_the_love() {
	$tweet_url = "https://twitter.com/share";
?>
        <h2 class="title">Share this article</h2>
        <div class="share-post-box clearfix">

            <!-- Google Plus -->
            <span class="plus-one">
                <div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>

                <script type="text/javascript">
                    (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/platform.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                </script>
            </span>

            <!-- Facebook Like -->
            <span class="facebook-like">
                <div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-width="50" data-type="box_count"></div>
            </span>

            <!-- Tweet This -->
            <span class="tweet-this">
                <a href="<?php echo $tweet_url; ?>" class="twitter-share-button" data-href="=<?php the_permalink(); ?>" data-via="<?php echo of_get_option( 'ac_twitter_username' ); ?>" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </span>

        </div><!-- END .share-post-box -->
<?php
}
add_action( 'ac_action_single_content_about_social', 'ac_single_share_the_love' );

//Add a new form element...
function position_field() {
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
  $current_user = get_user_by('ID', $_GET['user_id']);

  ?>
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">
          <label for="position"><?php _e( 'Position', 'eversion' ) ?></label>
        </th>
        <td>
          <label for="position">
            <select>
              <?php if (!$current_user) : ?>
                <option value="Staff" selected disabled> Position in Angelite </option>
              <?php endif; ?>
              <?php foreach ($positions as $position) : ?>
                <option value="<?= $position ?>" <?= $current_user->position === $position ? 'selected' : null ?>>
                  <?= $position ?>
                </option>
              <?php endforeach; ?>
            </select>
          </label>
        </td>
      </tr>
    </tbody>
  </table>
  <?php
}
add_action( 'user_new_form', 'position_field' );
add_action( 'edit_user_profile', 'position_field' );


//Save our extra registration user meta.
function save_position_field( $user_id ) {
  if ( isset( $_POST['position'] ) ) {
    update_user_meta( $user_id, 'position', $_POST['position'] );
  }
}
add_action( 'user_register', 'save_position_field' );
add_action( 'edit_user_profile_update', 'save_position_field' );
