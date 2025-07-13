<?php
namespace Helix\Api\General;

class CategoriesAndDepencyPost {

    /**
    * Construct Function
    * @since 2.0.0
    */
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'add_endpoint' ] );
    }

    /**
    * Add Custom Endpoint ( General )
    * @since 2.0.0
    */
    public function add_endpoint() {
        register_rest_route('wp/v2', 'categoriesAndPostList', [
            'methods' => 'GET',
            'callback' => [ $this, 'categoriesAndDepencyPostList' ]
        ]);
    }
    

//http://english.test/wp-json/wp/v2/categoriesAndPostList/?uncategorized=62

/**
 * Gets categories and depency post list
 *
 * @since 6.2.0
 * @param WP_REST_Request $request The request sent from WP REST API.
 * @return array Gets quiz list
 */
public function categoriesAndDepencyPostList( $request)
{

//    print_r($request->get_params());
    $categories = get_categories(array(
        'orderby' => 'id',
        'order' => 'ASC',
    ));

    // $uncategorized = 1;

    if (isset($request['uncategorized'])) {
        $uncategorized = $request['uncategorized'];
    } else {
        $uncategorized = 0;
    }

    $data = [];
    // $catPost= query_posts( array( 'category__and' => array(210), 'posts_per_page' => 2, 'orderby' => 'title', 'order' => 'DESC' ) );
    $i = 0;
    foreach ($categories as $key_ => $category) {

        if ($uncategorized == 0) {
            if ($category->name != "Uncategorized") {

                $posts_args = array(
                    'category__and' => array($category->term_id),
                    'post_status' => 'publish',
                    'orderby' => 'id',
                    'order' => 'ASC',
                    'no_found_rows' => true,
                );

                // The Featured Posts query.
                $posts = new WP_Query($posts_args);

                $posts = $posts->get_posts();

                foreach ($posts as $key2 => $post) {
                    $random = substr(md5(mt_rand()), 0, 5);
                    $data[$i]['catId'] = $category->term_id;
                    $data[$i]['catTitle'] = $category->name;
                    $data[$i]['key'] = 'st' . $random;
                    $data[$i]['posts'][$key2]['postId'] = $post->ID;
                    $data[$i]['posts'][$key2]['title'] = get_the_title($post->ID);
                }

                // Reset the post data
                wp_reset_postdata();
                $i++;

            }
        } else {
            $posts_args = array(
                'category__and' => array($category->term_id),
                'post_status' => 'publish',
                'orderby' => 'id',
                'order' => 'ASC',
                'no_found_rows' => true,
            );

            // The Featured Posts query.
            $posts = new WP_Query($posts_args);

            $posts = $posts->get_posts();

            foreach ($posts as $key2 => $post) {
                $random = substr(md5(mt_rand()), 0, 3);
                $data[$i]['catId'] = $category->term_id;
                $data[$i]['catTitle'] = $category->name;
                $data[$i]['key'] = 'st' . $random;
                $data[$i]['posts'][$key2]['postId'] = $post->ID;
                $data[$i]['posts'][$key2]['title'] = get_the_title($post->ID);
            }

            // Reset the post data
            wp_reset_postdata();
            $i++;
        }

    }

    return $data;
}





}