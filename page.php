<?php
  get_header();
  while(have_posts()) {
    the_post(); ?>
    <!-- page banner -->
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p>DONT FORGET TO REPLACE ME LATER</p>
        </div>
      </div>  
    </div>
    <!-- main page content -->
    <div class="container container--narrow page-section">
      <?php
        // get_the_id returns the id of current page
        // wp_get_post_parent_id returns id of the parent page
        //if the page doesnt have a parent, returns zero wicth is false
        $the_parent_id = wp_get_post_parent_id(get_the_ID());
        if($the_parent_id):
        ?>
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
              <a class="metabox__blog-home-link" href="<?php echo(get_permalink($the_parent_id)); ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
                <?php echo(get_the_title($the_parent_id)); ?>
              </a>
              <span class="metabox__main"><?php the_title(); ?></span>
            </p>
          </div>
        <?php 
        endif;
      ?>
      <!-- links -->
      <?php
        //check if the current page has childs
        $has_child = get_pages(['child_of' => get_the_ID()]);
        if($the_parent_id || $has_child):
      ?>
      <div class="page-links">
        <!-- get_the_title() returns the title of the id, if its 0 return the actual page  -->
        <h2 class="page-links__title"><a href="<?php echo get_the_permalink($the_parent_id) ?>"><?php echo get_the_title($the_parent_id) ?></a></h2>
        <ul class="min-list">
          <?php
            // if the page has parent $find_child_of = to father ID
            if($the_parent_id){
              $find_child_of = $the_parent_id;
            } 
            // else $find_child_of = the pages ID
            else {
              $find_child_of = get_the_ID();
            }
            wp_list_pages([
              'title_li' => NULL,
              'child_of' => $find_child_of,
              'sort_column' => 'menu_order'
            ]);
          ?>
        </ul>
      </div>
      <?php endif ?>
      <!-- page contant -->
      <div class="generic-content">
        <?php the_content(); ?>
      </div>
    </div>
  <?php }
  get_footer();
?>