

<?php 
/*
 * Template Name: FRONTPAGE
 */

get_header(); 

?>

<div class="container no_padding">
    <div class="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php 
                $args = array(
                    'post_type'=>array('post', 'editorial', 'photographers', 'videos'),
                    'featured'=>'yes',
                    'order'    => 'DESC'
                    );              
                
                $the_query = new WP_Query( $args );
                if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 
                $post_type = get_post_type();
                ?>
                <div class="swiper-slide">
                
                <?php if (class_exists('MultiPostThumbnails')
&& MultiPostThumbnails::has_post_thumbnail(array('post','editorial','photographers','videos'), 'secondary-image')) :
MultiPostThumbnails::the_post_thumbnail(array('post','editorial','photographers','videos'), 'secondary-image', NULL, 'post-secondary-image-full img-responsive'); endif; ?>
                <div class="post_link">
                        <?php 
                            $id = get_the_ID(); 
                            $author = get_post_meta($id, 'author', true);
                            
                            if ($author) { ?>
                            
                            <h2><?php echo $author ?></h2>
                            
                            <?php 
                            wp_reset_query();
                            } else { 
                            // do nothing; 
                            }
                        ?>
                        <a href="<?php the_permalink(); ?>">
                        <h1>
                            <?php the_title(); ?>
                        </h1>
                        </a>
                        <h3 class="post_type"><?php the_category(', '); ?></h3>
                        <?php
                        $type = get_post_type(); 
                        if($type!='post'){
                            ?>
                            <h3 class="post_type">
                            <a href="<?php echo get_post_type_archive_link( $type ); ?>">
                                <?php 
                                echo $type;
                                ?>
                                </a>
                            </h3>
                            <?php
                        }
                        ?>
                    
                </div>
                
                </div>
                <?php 
                endwhile;
                endif;

                    // Reset Query
                    wp_reset_query();
                ?>
               
            </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
<!-- EDITORIAL -->
<div class="container no_padding">
    <div class="section_title">
    
            <h1>
                 <a href="<?php echo site_url(); ?>/editorials">
                    EDITORIAL
                </a>
            </h1>
    </div>
    <div class="four_columns">
    <?php
    $editorial_num = get_post_meta( get_the_id(), 'editorial_listing_number', true );
    $args = array(
        'post_type'=>'editorial',
        ‘orderby’ =>’menu_order’,
        'posts_per_page' => $editorial_num
        );              
                
        $the_query = new WP_Query( $args );
        if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="post_listed col-lg-3 col-sm-3 col-xs-6">
            <div>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('', array('class' => 'img-responsive')); ?>
                </a>
                <a href="<?php the_permalink(); ?>">
                    <h4>
                        <?php the_title(); ?>
                    </h4>
                    <?php 
                        $id = get_the_ID(); 
                        $author = get_post_meta($id, 'author', true);
                        
                        if ($author) { ?>
                        
                        <h5><?php echo $author ?></h5>
                        
                        <?php 
                        } else { 
                        // do nothing; 
                        }
                    ?>
                </a>
            </div>
        </div>
        <?php
        $i++;
        $j++;
        if($j == "2"){
            echo ('<div class="hidden-sm hidden-md hidden-lg clearfix"></div>');
            $j=0;
        }
        if($i == "4"){
            echo ('<div class="hidden-xs clearfix"></div>');
            $i=0;
        }
        endwhile;
        endif;
            // Reset Query
            wp_reset_query();
        ?>
    </div>
</div>
<!-- END EDOTORIAL -->

<!-- PHOTOGRAPHERS -->
<div class="container no_padding">
    <div class="section_title">
        <h1>
            <a href="<?php echo site_url(); ?>/photographers">
                PHOTOGRAPHERS
            </a>
        </h1>
    </div>
    <div class="four_columns">
    <?php
    $photographers_num = get_post_meta( get_the_id(), 'photographers_listing_number', true );
    $args = array(
        'post_type'=>'photographers',
        ‘orderby’ =>’menu_order’,
        'posts_per_page' => $photographers_num
        );              
                
        $the_query = new WP_Query( $args );
        if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="post_listed col-lg-3 col-sm-3 col-xs-6">
            <div>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('', array('class' => 'img-responsive')); ?>
                </a>
                <a href="<?php the_permalink(); ?>">
                    <h4>
                        <?php the_title(); ?>
                    </h4>
                    <?php 
                        $id = get_the_ID(); 
                        $author = get_post_meta($id, 'author', true);
                        
                        if ($author) { ?>
                        
                        <h5><?php echo $author ?></h5>
                        
                        <?php 
                        } else { 
                        // do nothing; 
                        }
                    ?>
                    
                </a>
            </div>
        </div>
        <?php
         $i++;
         $j++;
         if($j == "2"){
             echo ('<div class="hidden-sm hidden-md hidden-lg clearfix"></div>');
             $j=0;
         }
         if($i == "4"){
             echo ('<div class="hidden-xs clearfix"></div>');
             $i=0;
         }
        endwhile;
        endif;

            // Reset Query
            wp_reset_query();
        ?>
    </div>
</div>

<!-- VIDEOS -->
<div class="container no_padding">
    <div class="section_title">
        <h1>
            <a href="<?php echo site_url(); ?>/videos">
                VIDEOS
            </a>
        </h1>
    </div>
    <div class="two_columns">
    <?php
    $video_num = get_post_meta( get_the_id(), 'video_listing_number', true );
    $args = array(
        'post_type'=>'videos',
        'order'   => 'DESC',
        'posts_per_page' => $video_num
        );              
                
        $the_query = new WP_Query( $args );
        if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="post_listed col-lg-6 col-sm-6 col-xs-12">
            <div>
                <a href="<?php the_permalink(); ?>">
                    <div class="video_link">
                        <?php the_post_thumbnail('', array('class' => 'img-responsive')); ?>
                        <i class="fa fa-play-circle-o fa-2x video_play" aria-hidden="true"></i>
                    </div>
                </a>
                <a href="<?php the_permalink(); ?>">
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                    <?php 
                        $id = get_the_ID(); 
                        $author = get_post_meta($id, 'author', true);
                        
                        if ($author) { ?>
                        
                        <h5><?php echo $author ?></h5>
                        
                        <?php 
                        } else { 
                        // do nothing; 
                        }
                    ?>
                </a>
            </div>
        </div>
        <?php
        $i++;
        $j++;
        if($j == "2"){
            echo ('<div class="clearfix"></div>');
            $j=0;
        }
        endwhile;
        endif;

            // Reset Query
            wp_reset_query();
        ?>
    </div>
</div>

<?php get_footer(); ?>
