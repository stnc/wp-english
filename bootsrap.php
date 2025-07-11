<?php
/*
Plugin Name:  Kelimator 3
Plugin URI:	https://github.com/stnc/wp-kat-planlari		
Description: Kelimator ; kelime islemci 
Version: 0.60
Author: Selman TUNC
Text Domain: the-stnc-map
Domain Path: /languages/


*/



// if (file_exists(__DIR__.'/../../vendor/autoload.php')) {
//     require __DIR__.'/../../vendor/autoload.php';
// } else {
//     echo "<h1>Lütfen composer.json ı yükleyin </h1>";
//     echo "<p>Örnekler <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
//     echo "<p> terminal yada cmd yi açarak  'composer install' yazınız</p>";
//     echo "<p> eğer yuklü ise terminal yada cmd yi açarak  'composer update' yazınız</p>";
//     exit();
// }



// if (! is_readable('vendor/stnc/framework/src/Core/Config.php')) {
//     die('config.php bulunamadı, config.example.php dosyasının ismini değiştirip config.php yapınız ve  app/core. içine atınız ');
// }




 require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload


// use Nette\Utils\Arrays;


//   use HelloWorld\SayHello;
//  echo SayHello::world();


use Helix\Loader\Loading;
  use Helix\Api\Menus\Menu;
  use Helix\Api\Generals\General;
 $load = new Loading();
//  echo $load->database();

 $m = new Menu();
// // //  $m->get_registered_menus();
 
//    $m2 = new General();

// //  $m2->add_endpoint();
// curl --user stnc:cansuyum http://english.test/wp-json/wp/v2/categoriesAndDepencyPostList


add_filter( 'wp_is_application_passwords_available', '__return_true' );


add_action('rest_api_init', 'register_categoriesAndDepencyPostList');
function register_categoriesAndDepencyPostList()
{
    register_rest_route('wp/v2', 'categoriesAndDepencyPostList',
        array(
            'methods' => 'GET',
            'callback' => 'categoriesAndDepencyPostList',
            // 'permission_callback' => function ($request) {
            //     return is_user_logged_in();
            // },
        )
    );

}

//////////////////////////




/**
 * Gets categories and depency post list
 *
 * @since 6.2.0
 * @param WP_REST_Request $request The request sent from WP REST API.
 * @return array Gets quiz list
 */
function categoriesAndDepencyPostList(WP_REST_Request $request)
{

//   print_r($request->get_params());
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



















add_action('rest_api_init',function () {

    //    register route
        register_rest_route('page', 'slug/(?P<slug>[-\w]{1,255})', array(
            'method' => 'GET',
            'callback' => 'GET_ALL_PAGE_BY_SLUG',
            'args' => array(
                'id' => array(
                    //call back function
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param);
                    }
                ),
            ),
            'permission_callback' => function () {
                return true;
            }
        ));
    
    });



    function GET_ALL_PAGE_BY_SLUG($request)
{
    $args = array(
        'name' => $request->params['slug'],
        'post_type' => 'page',
        'post_status' => 'publish',
        'numberposts' => 1
    );


    $myposts = get_posts($args);


    foreach ($myposts as $single) : setup_postdata($single);


        $meta = get_post_meta($single->ID);

        $src = wp_get_attachment_url(get_post_thumbnail_id($single->ID), 'full', true);






        $array = array(
            'ID' => $single->ID,
            'post_author' => $single->post_author,
            'post_date' => $single->post_date,
            'post_feature_image' => $src,
            'post_date_gmt' => $single->post_date_gmt,
            'post_content' => $single->post_content,
            'post_title' => $single->post_title,
            'post_excerpt' => $single->post_excerpt,
            'post_status' => $single->post_status,
            'comment_status' => $single->comment_status,
            'ping_status' => $single->ping_status,
            'post_password' => $single->post_password,
            'post_name' => $single->post_name,
            'to_ping' => $single->to_ping,
            'post_modified' => $single->post_modified,
            'post_modified_gmt' => $single->post_modified_gmt,
            'post_content_filtered' => $single->post_content_filtered,
            'post_parent' => $single->post_parent,
            'guid' => $single->guid,
            'menu_order' => $single->menu_order,
            'post_type' => $single->post_type,
            'post_mime_type' => $single->post_mime_type,
            'comment_count' => $single->comment_count,
            'filter' => $single->filter,
        );


        // return $array;
        $op[] = $array;

        wp_reset_postdata(); endforeach;


    header('Content-type: application/json');
    echo json_encode($op, JSON_PRETTY_PRINT);


}



add_action('rest_api_init', function () {
    register_rest_route( 'api/v1', '/cities', array(
        'methods' => 'POST',
        'callback' => 'create_city_from_data'
    ));
});
function create_city_from_data($req) {
    $response['name'] = $req['name'];
    $response['population'] = $req['population'];

    $res = new WP_REST_Response($response);
    $res->set_status(200);

    return ['req' => $res];
}




add_action( 'rest_api_init', 'register_delete_image_endpoint' );


function register_delete_image_endpoint() {

    register_rest_route( 'assignment/v1', '/image/delete/(?P<id>\d+)', array(

        'methods'  => 'GET',

        'callback' => 'delete_image',

        'args'     => array(

            'id' => array(

                'validate_callback' => 'is_numeric',

                'required'          => true,

                'description'       => 'This is the ID of the Attached Image'

            )

        )

    ) );

}


function delete_image( $request ) {

    $id = $request->get_param( 'id' );

    if ( ! is_numeric( $id ) ) {

        return new WP_Error( 'invalid_id', 'Invalid ID provided', array( 'status' => 400 ) );

    }


    $attachment = get_post( $id );

    if ( ! $attachment || $attachment->post_type !== 'attachment' ) {

        return new WP_Error( 'invalid_attachment', 'Invalid attachment provided', array( 'status' => 404 ) );

    }


    if ( wp_delete_attachment( $id ) ) {

        return array( 'success' => true );

    } else {

        return new WP_Error( 'delete_failed', 'Failed to delete attachment', array( 'status' => 500 ) );

    }

}