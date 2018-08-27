
<?php 
get_header(); 
?>


<!-- CATEGORY -->
<div class="container">
    <div class="row">
        <div class="section_title main_title col-xs-12">
                <h1>
                    <?php printf( __( 'Category: %s' ), single_cat_title( '', false ) ); ?>
                </h1>
        </div>
    </div>
</div>
<div class="container all_post_listed">
<div class="grid">  
    <?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$news= new WP_Query(array(
    'post_type'=>'post',
    'posts_per_page' => 16,
    'paged' => $paged,
));
$i=0;
if($news->have_posts()) :
    while($news->have_posts())  : $news->the_post();?>
    <div class="grid-item">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('', array('class' => 'img-responsive')); ?>
        </a>
        <a href="<?php the_permalink(); ?>">
            <h5><?php the_title(); ?></h5>
        </a>
</div>
<?php endwhile; ?>
</div>
<?php
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
<!-- END CATEGORY -->

<?php get_footer(); ?>
<script>
(function( $ ){

$(window).load(function()
  {
    var elem = document.querySelector('.grid');
var msnry = new Masonry( elem, {
  // options
  itemSelector: '.grid-item',
  columnWidth: 300
});

// element argument can be a selector string
//   for an individual element
var msnry = new Masonry( '.grid', {
  // options
});
  });

})(jQuery);
</script>
