<?php
/*
Template Name: Product Listing

*/
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

get_header(); ?>
<?php if ( astra_page_layout() == 'left-sidebar' ) { ?>
  <?php get_sidebar(); 
 } 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'      => 'product', // Replace with your actual custom post type
    'posts_per_page' => 1, // -1 to display all posts
    'orderby'        => 'date', // Order by date
    'order'          => 'DESC', // Descending order
    'paged'          => $paged
);
$custom_query = new WP_Query($args);
?>
  <div id="primary" <?php astra_primary_class(); ?>>
    <div class="container" style="max-width: 1170px; padding: 0 20px;">
      <div class="product-list-main">    
        
      <?php if ($custom_query->have_posts()) : ?>
        <div class="list grid-view-filter product-info-wrapper">
         <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>   
         <a href="<?php the_permalink(); ?>" class="image-with-date">
            <div class="image card-img-top m-0 overflow-hidden bsb-overlay-hover">
              <img class="img-fluid bsb-scale bsb-hover-scale-up" src="http://localhost/rotary/wp-content/uploads/2025/02/single-post-img-2.jpg" loading="lazy">
              <figcaption>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                </svg>
                <h4 class="h6 bsb-hover-fadeInRight mt-2">Read More</h4>
              </figcaption>
            
              <div class="date">
                <span><?php the_date(); ?></span>
              </div>
            </div>
            <div class="heading">
              <h3><?php the_title(); ?></h3>
            </div>
            <div class="description">
              <p><?php the_excerpt(); ?></p>
            </div>
          </a>     
        
        <?php endwhile;   ?>
        </div>    
        <?php 

    ob_start();
    echo "<div class='ast-pagination'><nav class='navigation pagination' aria-label='Post pagination'><div class='nav-links'>";
    echo paginate_links(array(
        'total' => $custom_query->max_num_pages,
        'current' => $paged,
        'prev_text' => __('« Previous'),
        'next_text' => __('Next »'),
    ));
    echo '</div></nav></div>';
    $output = ob_get_clean();
    echo apply_filters( 'astra_pagination_markup', $output ); 
    wp_reset_postdata();
    ?>
    <?php 
    else :
          echo '<section class="no-results not-found">
  <div class="page-content"><img width="640" height="466" src="'.get_template_directory_uri().'/assets/images/no-posts-found.gif"></div></section>';
      endif;?>
      
    </div>
  </div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) { ?>

  <?php get_sidebar(); ?>

<?php } ?>

<?php get_footer(); ?>
