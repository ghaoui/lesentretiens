<?php get_header(); ?>

<?php 
$typeLink = get_post_type();

switch ($typeLink){
   case 'fruits':
       $img = 'http://goubellattrading.com/wp-content/uploads/2017/10/Artboard-1.png';
       $title = "[:fr]Fruits[:en]Fruits[:it]frutta[:]";
       break;
   case 'legumes':
       $img = 'http://goubellattrading.com/wp-content/uploads/2017/10/Artboard-3.png';
        $title = "Légumes";
       break;
   case 'bio':
       $img = 'http://goubellattrading.com/wp-content/uploads/2017/10/Artboard-5.png';
        $title = "Bio";
       break;
   case 'agrume':
       $img = 'http://goubellattrading.com/wp-content/uploads/2017/10/Artboard-4.png';
        $title = "Agrume";
       break;
   case 'epicerie':
       $img = 'http://goubellattrading.com/wp-content/uploads/2017/10/huile.png';
        $title = "Epicerie";
       break;
   default :
       $img = 'http://goubellattrading.com/wp-content/uploads/2017/10/Artboard-1.png';
        $title = "<!--fr:-->Fruits<!--:--><!--en:-->Fruits<!--:--><!--it:-->frutta<!--:-->";
       break;
}
?>
<?php 
    $args  = array(
            'p' => 183,
            'post_type' => 'page',
            'posts_per_page'=> 1
        );
        $the_query = new WP_Query( $args ); 
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post(); 
?>
<div class="background-image">
    <figure class="uk-overlay">
        <img src="<?php the_field('image_background_'.$typeLink)?>" alt="<?php echo $typeLink;?>"/>
        <figcaption class="uk-overlay-panel uk-flex uk-flex-middle uk-text-center uk-flex-center">
            <div class="background-image-text" data-uk-scrollspy="{cls:'uk-animation-slide-left',delay:300}"><?php the_field('text_image_background_'.$typeLink)?></div>
        </figcaption>
    </figure>
    <figure class="uk-overlay sub-background">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/f_1-8.png" class="mask-img"/>
        <figcaption class="uk-overlay-panel uk-flex uk-flex-center uk-flex-middle uk-text-center">
            <div class="background-image-text-description" data-uk-scrollspy="{cls:'uk-animation-scale-down',delay:300}"><?php the_field('text_sub_image_background_'.$typeLink)?></div>
        </figcaption>
    </figure>
</div>
<?php
    endwhile;
        wp_reset_postdata(); 
            endif; 
?>
<div class="products">
    <div class="text-center img-logo-product">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo-product.png"/>   
    </div>
    <div class="container" data-uk-scrollspy="{cls:'uk-animation-fade',delay:300,target:'.box-item'}">
        
        <div class="title-product text-center"><?php echo __($title);?></div>
        <ul id="my-id" class="uk-subnav filter-fruits">
            <li data-uk-filter=""><a href="">Tout</a></li>
            <li data-uk-filter="exautique"><a href="">Exautique</a></li>
            <li data-uk-filter="mediteraneens"><a href="">Méditeranéens</a></li>
        </ul>
        <div class="row" data-uk-grid="{controls: '#my-id'}" >
        <?php 

        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); 
?>
            <div class="col-lg-3" data-uk-filter="<?php the_field('type')?>" >
                <div class="box-item" data-id="<?php the_ID();?>" data-post_type="<?php echo $typeLink;?>">
                    <figure class="uk-overlay uk-overlay-hover">
                        <img src="<?php the_field('image_de_fond')?>" alt="" class="uk-overlay-spin">
                    </figure>
                    <div class="title"><?php the_title();?></div>
                </div>
            </div>          
<?php
    endwhile;
        wp_reset_postdata(); 
            endif; 
?>
        </div>
    </div>
    
</div>
<?php get_footer(); ?>
