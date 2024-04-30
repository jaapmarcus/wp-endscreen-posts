<?php
/*
Plugin Name: wp-endscreen-posts
Plugin URI: https://eris.nu
Description: Select 9 random posts for end screen
Version: 0.0.1
Author: Jaap Marcus
Author URI: https://eris.nu
License: Unkown
*/

function wp_endscreen_posts() {
  $args = array(
    'post_type' => 'post',
    'orderby' => 'rand',
    'posts_per_page' => 9,
    'meta_query' => array(
        array(
          'key' => 'jtheme_video_file',
          'value' => '',
          'compare' => '!='
        )
      )
  );

  $query = new WP_Query($args);
  if ($query->have_posts()) {
    echo '<div id="endscreen-data">';
    echo '<div id="endscreen-container">';
    while ($query->have_posts()) {
      $query->the_post();
      echo '<div class="endscreen-item"><a href="' . get_the_permalink() .'">
        <img src="'. get_the_post_thumbnail_url('', 'video-thumb') .'"></a>
        <div class="endscreen-item-title">' . get_the_title() .'</div></div>
';
    }
    echo '</div>';
    echo '</div>';
  }
}

add_shortcode('[wp-endscreen]', 'wp_endscreen_posts');