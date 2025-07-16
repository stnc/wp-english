<?php
function hstngr_register_widget()
{
    register_widget("hstngr_widget");
}

add_action("widgets_init", "hstngr_register_widget");
class hstngr_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // widget ID
            "hstngr_widget",
            // widget name
            __("Englihs Learn Sidebar", " hstngr_widget_domain"),
            // widget description
            [
                "description" => __(
                    "Englihs Learn Sidebar",
                    "hstngr_widget_domain"
                ),
            ]
        );
    }
    public function widget($args, $instance)
    {
        $title = apply_filters("widget_title", $instance["title"]);
        echo $args["before_widget"];
        //if title is present
 
        //output
        // echo __("Greetings from Hostinger.com!", "hstngr_widget_domain");
?>
         <?php //stnc widget start   ?>


         <style>
body {
    overflow-x: hidden;
}

#sidebar-wrapper-stnc {
    width: 350px;
height: 980px;
padding: 16px;
border: 1px solid #000;
/* line-height: 21px; */
background-color: #EEEEEE;
margin: 0 auto;
  margin-left: auto;
overflow: auto;
-webkit-transition: margin .25s ease-out;
-moz-transition: margin .25s ease-out;
-o-transition: margin .25s ease-out;
transition: margin .25s ease-out;
}

#sidebar-wrapper-stnc .sidebar-heading {
    padding: 0.875rem 1.25rem;
    font-size: 1.2rem;
}

#sidebar-wrapper-stnc .list-group {
    width: 15rem;
}

#page-content-wrapper {
    min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper-stnc {
    margin-left: 0;
}

@media (min-width: 768px) {
    #sidebar-wrapper-stnc {
        margin-left: 0;
    }

    #page-content-wrapper {
        min-width: 0;
        width: 100%;
    }

    #wrapper.toggled #sidebar-wrapper-stnc {
        margin-left: -15rem;
    }
}
</style>

<?php    if (!empty($title)) {
           ?>
        <div  id="<?php echo $this->get_field_id(  "title"); ?>" att-title="<?php echo $this->get_field_name("title"); ?>" class="sidebar-heading"><?php echo esc_attr($title); ?></div>

        <?php   }  ?>

<div class="bg-light border-right vh-100" id="sidebar-wrapper-stnc">
 
        <ul class="list-group list-group-flush overflow-auto h-100">
    <?php
    // get all of the custom taxonomy terms
    $taxonomy = "stnc_babone_eng_cat";
    $args = [
        "orderby" => "id",
        "order" => "Desc",
        "posts_per_page" => -1,
    ];
    $taxonomy_terms = get_terms($taxonomy, $args);
    // if there are some taxonomy terms, loop through each one and get the posts in that term
    if ($taxonomy_terms) {
        foreach ($taxonomy_terms as $taxonomy_term) {
            $args = [
                "orderby" => "id",
                "order" => "ASC",
                "post_type" => "stnc-babone-eng",
                "$taxonomy" => $taxonomy_term->slug,
                "post_status" => "publish",
                "posts_per_page" => -1,
            ];

            $query = new WP_Query($args);

            if ($query->have_posts()): ?>

                <h4><?php echo $taxonomy_term->name; ?></h4>
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
               <li>  
            <a class="list-group-item list-group-item-action bg-light" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>  
                <?php
                endwhile; ?>

            <?php 
             wp_reset_postdata();
            endif; // so nothin' weird happens to other loops
        }
    }
    ?>
        </ul>
        </div>





        
        <?php //stnc widget end   ?>

    <?php 
       // echo $args["after_widget"];
    }



    public function form($instance)
    {
        if (isset($instance["title"])) {
            $title = $instance["title"];
        } else {
            $title = __("Default Title", "hstngr_widget_domain");
        } ?>
    <p>
    <label for="<?php echo $this->get_field_id(
        "title"
    ); ?>"><?php _e("Title:"); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id(
        "title"
    ); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <?php
    }
    public function update($new_instance, $old_instance)
    {
        $instance = [];
        $instance["title"] = !empty($new_instance["title"])
            ? strip_tags($new_instance["title"])
            : "";
        return $instance;
    }
}

