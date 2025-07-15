<?php
/*
 * Template Name: BAB
 * Description: bab page
* @package WordPress
 *@subpackage stnc-bab
 *@since stnc-bab 2.0
 */

// https://stackoverflow.com/questions/28249774/add-custom-css-to-a-page-template-in-wordpress
//https://stackoverflow.com/questions/20780422/wordpress-get-plugin-directory
// https://stackoverflow.com/questions/39652122/how-to-list-all-category-from-custom-post-type
//search wordpress plugin page path


//https://code.tutsplus.com/tutorials/wp_query-arguments-categories-and-tags--cms-23070

/*
$args  = array(
    'posts_per_page'  => 5000,
    'offset'          => 0,
    'category_name'        => '1-gun',
    'orderby'         => 'post_date',
    'order'           => 'ASC',
    'include'         => "",
    'exclude'         => "",
    'meta_key'        => "",
    'meta_value'      => "",
    'post_type'       => 'post',
    'post_mime_type'  => "",
    'post_parent'     => "",
    'post_status'     => 'publish',
    'suppress_filters' => true ); 
$posts = get_posts($args);
    foreach ($posts as $post) :
    ?><div class="">
        <a href="<?php the_permalink();?>">
          <?php 
               echo the_title();
               echo the_post_thumbnail(array(360,360));
               the_excerpt('more text');
          ?></a></div>
    <?php endforeach; ?>
*/




// get all of the custom taxonomy terms
$taxonomy = 'video_cat';
$args = array(
	'orderby' => 'id',
	'order' => 'ASC',
);
$taxonomy_terms = get_terms($taxonomy, $args);

// if there are some taxonomy terms, loop through each one and get the posts in that term
if($taxonomy_terms) {
	foreach($taxonomy_terms as $taxonomy_term) {

		$args = array(
			'post_type' => 'video',
			"$taxonomy" => $taxonomy_term->slug,
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : ?>

      
			<h2><?php echo $taxonomy_term->name; ?></h2>

			<div class="cpts-wrap">

     
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<h3><?php the_title(); ?></h3>
			<?php endwhile; ?>

			</div><!-- .cpts-wrap -->

		<?php wp_reset_postdata(); // so nothin' weird happens to other loops
		endif;

	}
}
?>
</ul>