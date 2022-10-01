<?php

function hogwarts_files() {
  wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'hogwarts_files');

function hogwarts_features() {
  register_nav_menu('header_menu_location', 'Header Menu Location');
  register_nav_menu('footer_location_one', 'Footer Menu one');
  register_nav_menu('footer_location_two', 'Footer Menu Two');
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'hogwarts_features');

function theme_post_types(){
  // event post type
  register_post_type('event', [
    'supports' => ['title', 'editor', 'excerpt'],
    'has_archive' => true,
    'rewrite' => [
      'slug' => 'events'
    ],
    'public' => true,
    'labels' => [
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit event',
      'all_items' => 'All events',
      'singular_name' => 'Event',
    ],
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-calendar'
  ]);
  //program post type
  register_post_type('program', [
    'supports' => ['title', 'editor'],
    'has_archive' => true,
    'rewrite' => [
      'slug' => 'programs'
    ],
    'public' => true,
    'labels' => [
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit program',
      'all_items' => 'All programs',
      'singular_name' => 'Program',
    ],
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-awards'
  ]);
}

add_action('init','theme_post_types');

add_shortcode('wep_dev', function(){
  return get_current_user_id();
});

function theme_adjust_queries($query){
  if(!is_admin() && is_post_type_archive('event') && is_main_query()){
    $query->set('posts_per_page', '-1');
    $query->set('meta_key','event_date');
    $query->set('orderby','meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', [
      [
        'key' => 'event_date',
        'compare' => '>=',
        'value' => date('Ymd'),
        'type' => 'numeric'                
      ]
    ]);
  }
  if(!is_admin() && is_post_type_archive('program') && is_main_query()){
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }
}

add_action('pre_get_posts', 'theme_adjust_queries');

