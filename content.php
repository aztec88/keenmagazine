<?php get_header(); 
$id = get_the_ID(); 
$type = get_post_type( $id );
?>
<div class="container">
    <div class="row">
        <div class="section_title main_title_post col-xs-12">
                <h1>
					<?php the_title(); ?>
				</h1>
				<div class="author_post">
                <?php 
                    $author = get_post_meta($id, 'author', true);
                    
                    if ($author) { ?>
                    
                    <h2><?php echo $author ?></h2>
                    
                    <?php 
                    wp_reset_query();
                    } else { 
                    // do nothing; 
                    }
                ?>
					
					<div class="post_author_lines"></div>
				</div>
		</div>
		<div class="container">
			<div class="row">
				<div id="post_content" class="post_content col-xs-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
    </div>
</div>
<?php 

$i=0;
$j=0;
?>

<div class="container">
    <div class="row">
		<div class="share col-xs-12">
            <?php echo do_shortcode("[social_warfare]"); ?>
		</div>
	</div>
</div>

<div class="container no_padding ">
    <div class="section_title">
        <h3>
			Latest from <?php 
			if ($type == 'post'){
				echo 'news';
			}
			else{
				echo $type;
			}
			?>
        </h3>
    </div>
    <div class="four_columns">
    <?php
    $args = array(
        'post_type'=> $type,
        'order'   => 'DESC',
        'posts_per_page' => '4'
        );              
                
        $the_query = new WP_Query( $args );
        if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="post_listed col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('', array('class' => 'img-responsive')); ?>
                </a>
                <a href="<?php the_permalink(); ?>">
                    <h4>
                        <?php the_title(); ?>
                    </h4>
                </a>
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


<?php get_footer(); ?>
<script>
	(function( $ ){
		//ADD IMG_RESPONSIVE TO IMAGES
		$( document ).ready(function() {
			$('#post_content').find('img').addClass('img-responsive centered');
		});
	})(jQuery);
</script>