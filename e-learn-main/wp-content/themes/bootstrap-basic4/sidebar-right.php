
<style>
body {
    overflow-x: hidden;
}

#sidebar-wrapper {
    min-height: 100vh;
    margin-left: -15rem;
    -webkit-transition: margin .25s ease-out;
    -moz-transition: margin .25s ease-out;
    -o-transition: margin .25s ease-out;
    transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
    padding: 0.875rem 1.25rem;
    font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
    width: 15rem;
}

#page-content-wrapper {
    min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
    margin-left: 0;
}

@media (min-width: 768px) {
    #sidebar-wrapper {
        margin-left: 0;
    }

    #page-content-wrapper {
        min-width: 0;
        width: 100%;
    }

    #wrapper.toggled #sidebar-wrapper {
        margin-left: -15rem;
    }
}
</style>






<?php
/**
 * The right sidebar.
 *
 * @package bootstrap-basic4
 */


global $bootstrapbasic4_sidebar_right_size;
if (null == $bootstrapbasic4_sidebar_right_size || !is_numeric($bootstrapbasic4_sidebar_right_size)) {
    $bootstrapbasic4_sidebar_right_size = 3;
}

if (is_active_sidebar('sidebar-right')) {
?>
                <div id="sidebar-right" class="col-md-<?php echo $bootstrapbasic4_sidebar_right_size; ?>">
                
    
    
    <div class="bg-light border-right vh-100" id="sidebar-wrapper">
        <div class="sidebar-heading">Dersler</div>
        <div class="list-group list-group-flush overflow-auto h-100">

    <?php
    // get all of the custom taxonomy terms
    $taxonomy = 'stnc_babone_eng_cat';
    $args = array(
        'orderby' => 'id',
        'order' => 'Desc',
                  'posts_per_page' => -1,
    );
    $taxonomy_terms = get_terms($taxonomy, $args);

    // if there are some taxonomy terms, loop through each one and get the posts in that term
    if($taxonomy_terms) {
        foreach($taxonomy_terms as $taxonomy_term) {

            $args = array(
                          'orderby' => 'id',
                          'order' => 'ASC',
                'post_type' => 'stnc-babone-eng',
                "$taxonomy" => $taxonomy_term->slug,
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) : ?>

          
                <h4><?php echo $taxonomy_term->name; ?></h4>

             

         
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                 
            <a class="list-group-item list-group-item-action bg-light" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                <?php endwhile; ?>

          

            <?php wp_reset_postdata(); // so nothin' weird happens to other loops
            endif;

        }
    }
    ?>



        

        </div>
    </div>
    
    
    
                </div>
<?php
}
