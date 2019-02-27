

<?php 
/*
 * Template Name: FRONTPAGE NEWS
 */

get_header(); 


function return_ids($post_type, $limit){

    $args = array(
        'post_type'=> $post_type,
        ‘orderby’ =>’menu_order’,
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'fields' => 'ids'
    );
  
    // The Query
    $result_query = new WP_Query( $args );
  
    $ID_array = $result_query->posts;
  
    // Restore original Post Data
    wp_reset_postdata();
  
    return $ID_array;
  
  }

?>

<div class="container-fluid no_padding">
        <?= the_post_thumbnail('full', array('class' => 'img-responsive cover_image')); ?>
</div>
<div class="container no_padding">

    <div class="news_listed col-xs-12 col-md-8 col-lg-9">
    <!-- NEWS -->
    <?php
    
    $editorial_mob_ids = return_ids('editorial', '2');
    $photo_mob_ids = return_ids('photographers', '2');
    $video_mob_ids = return_ids('videos', '2');

    $args = array(
        'post_type'=>'post',
        ‘orderby’ =>’menu_order’,
        'posts_per_page' => 6,
        'post_status' => 'publish'
        );              
                
        $the_query = new WP_Query( $args );
        $i = 0;
        if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="news_single col-xs-12 no_padding">
            
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('news-size', array('class' => 'img-responsive')); ?>
                </a>
                <a href="<?php the_permalink(); ?>">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                    
                </a>
                <p><?= get_excerpt(300); ?></p>
        </div>
        
        <?php
        $i++;

        if ($i == 2){
            $html = '';
            $html .= '<div class="blog_section_wrapper col-xs-12 no_padding">';
            $html .= '<h2 class="side_panel_title">Editorial</h2>';
            $html .= '<div class="blog_section col-xs-12 no_padding">';
            foreach ($editorial_mob_ids as $id) {
                $html .= '<div class="blog_listed_single  col-xs-6">';
                $html .= '<div class="col-xs-12 no_padding">';
                $html .= '<a href="'.get_the_permalink($id).'">';
                $html .= get_the_post_thumbnail($id, 'full', array('class' => 'img-responsive col-xs-12'));
                $html .= '<h5 class="col-xs-12">';
                $html .= get_the_title($id);
                $html .= '</h5>';
                $html .= '</a>';
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
            echo $html;
        }

        if ($i == 4){
            $html = '';
            $html .= '<div class="blog_section_wrapper col-xs-12 no_padding">';
            $html .= '<h2 class="side_panel_title">Photographers</h2>';
            $html .= '<div class="blog_section col-xs-12 no_padding">';
            foreach ($photo_mob_ids as $id) {
                $html .= '<div class="blog_listed_single  col-xs-6">';
                $html .= '<div class="col-xs-12 no_padding">';
                $html .= '<a href="'.get_the_permalink($id).'">';
                $html .= get_the_post_thumbnail($id, 'full', array('class' => 'img-responsive col-xs-12'));
                $html .= '<h5 class="col-xs-12">';
                $html .= get_the_title($id);
                $html .= '</h5>';
                $html .= '</a>';
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
            echo $html;
        }

        if ($i == 6){
            $html = '';
            $html .= '<div class="blog_section_wrapper col-xs-12 no_padding video_wrapper">';
            $html .= '<h2 class="side_panel_title">Videos</h2>';
            $html .= '<div class="blog_section col-xs-12 no_padding">';
            foreach ($video_mob_ids as $id) {
                $html .= '<div class="blog_listed_single  col-xs-6">';
                $html .= '<div class="col-xs-12 no_padding">';
                $html .= '<a href="'.get_the_permalink($id).'">';
                $html .= '<div class="blog_listed_single_img_wrapper col-xs-12 no_padding">';
                $html .= get_the_post_thumbnail($id, 'full', array('class' => 'img-responsive col-xs-12'));
                $html .= '<i class="fa fa-play-circle-o fa-2x video_play" aria-hidden="true"></i>';
                $html .= '</div>';
                $html .= '<h5 class="col-xs-12">';
                $html .= get_the_title($id);
                $html .= '</h5>';
                $html .= '</a>';
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
            echo $html;
        }

        endwhile;
        endif;
            // Reset Query
            wp_reset_query();
        ?>
    
    </div>
    <!-- END NEWS -->

    <!-- EDITORIAL -->
    <div class="side_panel col-xs-12 col-md-4 col-lg-3">
        <div class="blog_section_wrapper col-xs-12 no_padding">
        <h2 class="side_panel_title">Editorial</h2>
        <div class="blog_section col-xs-12 no_padding">
            
            
            <?php
            $args = array(
                'post_type'=>'editorial',
                ‘orderby’ =>’menu_order’,
                'posts_per_page' => 3,
                'post_status' => 'publish'
            );              
                        
            $the_query = new WP_Query( $args );
            if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
            <div class="blog_listed_single col-xs-12">
                <div class="col-xs-12 no_padding">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', array('class' => 'img-responsive col-xs-6')); ?>
                
                        <h5 class="col-xs-6">
                            <?php the_title(); ?>
                        </h5>
                    </a>
                </div>
                
            </div>
            <?php
            endwhile;
            endif;
                // Reset Query
                wp_reset_query();
            ?>
            
        </div>
        </div>
        <!-- END EDITORIAL -->


        <!-- SIDEPANEL BANNER 1 -->
        <?php 

        $image1 = get_field('sidepanel_banner_1');

        if( !empty($image1) ): ?>

            <img class="img-responsive sidepanel_banner" src="<?php echo $image1['url']; ?>" alt="<?php echo $image1['alt']; ?>" />

        <?php endif; ?>
        <!-- END SIDEPANEL BANNER 1 -->


        <!-- PHOTOGRAPHERS -->
        <div class="blog_section_wrapper col-xs-12 no_padding">
        <h2 class="side_panel_title">Photographers</h2>
        <div class="blog_section col-xs-12 no_padding">
            
            
            <?php
            $args = array(
                'post_type'=>'photographers',
                ‘orderby’ =>’menu_order’,
                'posts_per_page' => 3,
                'post_status' => 'publish'
            );              
                        
            $the_query = new WP_Query( $args );
            if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
            <div class="blog_listed_single col-xs-12">
                <div class="col-xs-12 no_padding">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', array('class' => 'img-responsive col-xs-6')); ?>
                
                        <h5 class="col-xs-6">
                            <?php the_title(); ?>
                        </h5>
                    </a>
                </div>
                
            </div>
            <?php
            endwhile;
            endif;
                // Reset Query
                wp_reset_query();
            ?>
            
        </div>
        </div>
        <!-- END PHOTOGRAPHERS -->
        
        <!-- SIDEPANEL BANNER 2 -->
        <?php 

        $image2 = get_field('sidepanel_banner_2');

        if( !empty($image2) ): ?>

            <img class="img-responsive sidepanel_banner" src="<?php echo $image2['url']; ?>" alt="<?php echo $image2['alt']; ?>" />

        <?php endif; ?>
        <!-- END SIDEPANEL BANNER 1 -->

        <!-- VIDEOS -->
        <div class="blog_section_wrapper col-xs-12 no_padding video_wrapper">
        <h2 class="side_panel_title">Videos</h2>
        <div class="blog_section col-xs-12 no_padding">
            
            
            <?php
            $args = array(
                'post_type'=>'videos',
                ‘orderby’ =>’menu_order’,
                'posts_per_page' => 2,
                'post_status' => 'publish'
            );              
                        
            $the_query = new WP_Query( $args );
            if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
            <div class="blog_listed_single col-xs-12">
                <div class="col-xs-12 no_padding">
                    <a href="<?php the_permalink(); ?>">
                        <div class="blog_listed_single_img_wrapper col-xs-12 no_padding">
                            <?php the_post_thumbnail('full', array('class' => 'img-responsive col-xs-6')); ?>
                            <i class="fa fa-play-circle-o fa-2x video_play" aria-hidden="true"></i>
                        </div>
                        <h5 class="col-xs-6">
                            <?php the_title(); ?>
                        </h5>
                    </a>
                </div>
                
            </div>
            <?php
            endwhile;
            endif;
                // Reset Query
                wp_reset_query();
            ?>
            
        </div>
        </div>
        <!-- END VIDEOS -->
    </div>
</div>

<?php get_footer(); ?>
