<?php
function load_assets()
{

    //CSS
    wp_enqueue_style("playfair-font", "//fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900");
    wp_enqueue_style("icomoon", get_template_directory_uri() . "/assets/fonts/icomoon/style.css");
    wp_enqueue_style("bootstrap", get_template_directory_uri() . "/assets/css/bootstrap.min.css");
    wp_enqueue_style("magnific", get_template_directory_uri() . "/assets/css/magnific-popup.css");
    wp_enqueue_style("jquery-ui", get_template_directory_uri() . "/assets/css/jquery-ui.css");
    wp_enqueue_style("owl-carousel", get_template_directory_uri() . "/assets/css/owl.carousel.min.css");
    wp_enqueue_style("owl-carousel-default", get_template_directory_uri() . "/assets/css/owl.theme.default.min.css");
    wp_enqueue_style("bootstrap-datepiker", get_template_directory_uri() . "/assets/css/bootstrap-datepicker.css");
    wp_enqueue_style("flat-icons", get_template_directory_uri() . "/assets/fonts/flaticon/font/flaticon.css");
    wp_enqueue_style("aos", get_template_directory_uri() . "/assets/css/aos.css");
    wp_enqueue_style("style", get_template_directory_uri() . "/assets/css/style.css");
    wp_enqueue_style("styleSheet", get_stylesheet_uri());

    //JS

    wp_enqueue_script("j-query", get_template_directory_uri() . "/assets/js/jquery-3.3.1.min.js", [], 1.0, true);
    wp_enqueue_script("jquery-migrate", get_template_directory_uri() . "/assets/js/jquery-migrate-3.0.1.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("jquery-ui-js", get_template_directory_uri() . "/assets/js/jquery-ui.js", ["j-query"], 1.0, true);
    wp_enqueue_script("popper", get_template_directory_uri() . "/assets/js/popper.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("bootstrap-js", get_template_directory_uri() . "/assets/js/bootstrap.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("owl-carousel-js", get_template_directory_uri() . "/assets/js/owl.carousel.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("stellar", get_template_directory_uri() . "/assets/js/jquery.stellar.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("countdown", get_template_directory_uri() . "/assets/js/jquery.countdown.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("magnific-js", get_template_directory_uri() . "/assets/js/jquery.magnific-popup.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("datepiker-js", get_template_directory_uri() . "/assets/js/bootstrap-datepicker.min.js", ["j-query"], 1.0, true);
    wp_enqueue_script("aos-js", get_template_directory_uri() . "/assets/js/aos.js", ["j-query"], 1.0, true);
    wp_enqueue_script("main-js", get_template_directory_uri() . "/assets/js/main.js", ["j-query"], 1.0, true);
    wp_enqueue_script("script-js", get_template_directory_uri() . "/assets/js/script.js", ["j-query"], 1.0, true);
}


add_action("wp_enqueue_scripts", "load_assets");

function add_support()
{
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    add_image_size('landscape-card', 369.984, 200, true);
    add_image_size('large-landscape-card', 319.984, 300, true);
    add_image_size('ultra-landscape-card', 669.984, 300, true);
    add_image_size('portrait-card', 470, 630, true);
    add_image_size('tiny', 90, 61.750, true);
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form'));
}
add_action("after_setup_theme", "add_support");


function register_navigation_menus()
{
    register_nav_menus([
        "primary-menu" => "Primary Menu",
        "footer-menu" => "Footer Menu"
    ]);
}
add_action("init", "register_navigation_menus");



function register_navwalker()
{
    require_once get_template_directory() . '/assets/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');


function add_widgets()
{
    register_sidebar(array(
        'name'          => "Footer Category",
        'id'            => 'footer-category',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<strong><b>',
        'after_title'   => '</b></strong>',
    ));
    register_sidebar(array(
        'name'          => "About Us",
        'id'            => 'about-us',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="footer-heading mb-4">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => "Social Links",
        'id'            => 'social-links',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="footer-heading mb-4">',
        'after_title'   => '</h3>',
    ));
}
add_action("widgets_init", "add_widgets");

$selectedColor;
function colors(&$selectedColor)
{
    $clrs = ['#6c757d', '#8bc34a', ' #f89d13', '#f23a2e', '#0d6efd', '#0dcaf0', '#6610f2'];
    $index = mt_rand(0, 6);
    $firstColor = $clrs[$index];
    if ($firstColor != $selectedColor) {
        echo $firstColor;
        $selectedColor = $firstColor;
    } else {
        colors($selectedColor);
    }
}



add_filter('comment_form_fields', 'mo_comment_fields_custom_order');
function mo_comment_fields_custom_order($fields)
{
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];


    unset($fields['comment']);
    unset($fields['author']);
    unset($fields['email']);


    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;

    $fields['comment'] = $comment_field;

    // done ordering, now return the fields:
    return $fields;
}





function mytheme_comment($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    } ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>">
        <?php
        if ('div' != $args['style']) { ?>
            <div class="vcard"><?php
                                if ($args['avatar_size'] != 0) {
                                    echo get_avatar($comment, $args['avatar_size']);
                                } ?>
            </div>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
                                                                            } ?>
            <?php
            if ($comment->comment_approved == '0') { ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em><br /><?php
                                                                                                                    } ?>
            <h3><?php echo get_author_name(); ?></h3>
            <div class="meta">

                <?php
                /* translators: 1: date, 2: time */
                printf(
                    __('%1$s at %2$s'),
                    get_comment_date(),
                    get_comment_time()
                ); ?>
                <?php
                edit_comment_link(__('(Edit)'), '  ', ''); ?>
            </div>

            <p><?php comment_text(); ?></p>


            <p>

                <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => $add_below,
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth']
                        )
                    )
                ); ?>


            </p>


            <?php
            if ('div' != $args['style']) : ?>
            </div><?php
                endif;
            }
