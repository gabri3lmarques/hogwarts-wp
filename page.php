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
      <!--
        <div class="page-links">
          <h2 class="page-links__title"><a href="#">About Us</a></h2>
          <ul class="min-list">
            <li class="current_page_item"><a href="#">Our History</a></li>
            <li><a href="#">Our Goals</a></li>
          </ul>
        </div>
      -->
      <!-- page contant -->
      <div class="generic-content">
        <?php the_content(); ?>
      </div>
    </div>
  <?php }
  get_footer();
?>