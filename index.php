<?php get_header(); ?>
<div class="slider">
        <?php putRevSlider("home-6") ?>
    <div class="on-slider">
        <div class="container">
            <ul class="items-on-slider">
                <li class="presence">
                    <a href="#">PRESENCE</a>
                </li>
                <li class="agenda">
                    <a href="#">AGENDA</a>
                </li>
                <li class="inscription">
                    <a href="#">INSCRIPTION</a>
                </li>
            </ul>
        </div> 
    </div>
</div>
<?php 
    $args  = array(
        'post_type' => 'page',
        'p' => 29,
        );
    $the_query = new WP_Query( $args ); 
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post(); 
?>

    <?php the_content();?>

<?php
    endwhile;
        wp_reset_postdata(); 
            endif; 
?>


<?php get_footer(); ?>
