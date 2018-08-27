
<?php 
/*
 * Template Name: PHOTOGRAPHERS ALL
 */

get_header(); 
?>

<!-- PHOTOGRAPHERS -->
<div class="container">
    <div class="row">
        <div class="section_title main_title">
                <h1>
                    <?php the_title(); ?>
                </h1>
        </div>
    </div>
</div>
<div class="container all_post_listed">
<div class="row">
   
    <?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$news= new WP_Query(array(
    'post_type'=>'photographers',
    'posts_per_page' => 8,
    'paged' => $paged,
));
$i=0;
if($news->have_posts()) :
    while($news->have_posts())  : $news->the_post();?>
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
                    wp_reset_query();
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

    $total_pages = $news->max_num_pages;

    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));
        echo ('<div class="pagination col-xs-12">');
       
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('PREV'),
            'next_text'    => __('NEXT'),
        ));

        echo ('</div>');
    }
    ?>    
<?php else :?>
<h3><?php _e('404 Error&#58; Not Found', ''); ?></h3>
<?php endif; ?>
<?php wp_reset_postdata();?>

</div>
</div>
<!-- END PHOTOGRAPHERS -->

<?php get_footer(); ?>