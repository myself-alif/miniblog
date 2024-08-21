<?php get_header();
if (have_posts()) {
    the_post(); ?>


    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url(<?php the_post_thumbnail_url('large') ?>);">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="post-entry text-center">
                        <?php
                        $categories = wp_get_post_categories(get_the_ID(), ['fields' => 'names']);
                        if ($categories) {
                            foreach ($categories as $category) { ?>
                                <span class="post-category text-white mb-3" style="background-color:<?php colors($selectedColor) ?>"><?php echo $category ?></span>
                        <?php
                            }
                        }
                        ?>
                        <h1 class="mb-4"><a href="#"><?php the_title(); ?></a></h1>
                        <div class="post-meta align-items-center text-center">
                            <figure class="author-figure mb-0 mr-3 d-inline-block"><img src="<?php echo get_avatar_url(get_the_author_meta('ID')) ?>" alt="Image" class="img-fluid"></figure>
                            <span class="d-inline-block mt-1">By <?php the_author() ?>&nbsp;-&nbsp;</span>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="site-section py-lg">
        <div class="container">

            <div class="row blog-entries element-animate">

                <div class="col-md-12 col-lg-8 main-content">

                    <div class="post-content-body">

                        <?php the_content(); ?>

                    </div>





                    <?php

                    if (!post_password_required()) {
                        comments_template();
                    }

                    ?>

                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box search-form-wrap">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon fa fa-search"></span>
                                <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                            </div>
                        </form>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div class="bio text-center">
                            <img src="<?php echo get_avatar_url(get_the_author_meta('ID')) ?>" alt="Image Placeholder" class="img-fluid mb-3">
                            <div class="bio-body">
                                <h2><?php echo get_the_author_posts_link() ?></h2>
                                <p class="mb-4"><?php echo get_the_author_meta('description') ?></p>
                                <p><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" class="btn btn-primary btn-sm rounded px-4 py-2">My Posts</a></p>
                                <p class="social">
                                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <?php

                            $topPosts = new WP_Query([
                                'orderby' => 'comment_count',
                                'posts_per_page' => 3
                            ]);

                            if ($topPosts->have_posts()) {
                                $topPostsContainer = [];
                                while ($topPosts->have_posts()) {
                                    $topPosts->the_post();
                                    $topPostsContainer[] = [
                                        'permalink' => get_the_permalink(),
                                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'tiny'),
                                        'title' => get_the_title(),
                                        'date' => get_the_date()

                                    ];
                                }
                                wp_reset_query();
                            }

                            if ($topPostsContainer) { ?>



                                <ul>
                                    <li>
                                        <a href="<?php echo $topPostsContainer[0]['permalink'] ?>">
                                            <img src="<?php echo $topPostsContainer[0]['img'] ?>" alt="Image placeholder" class="mr-4">
                                            <div class="text">
                                                <h4><?php echo $topPostsContainer[0]['title'] ?></h4>
                                                <div class="post-meta">
                                                    <span class="mr-2"><?php echo $topPostsContainer[0]['date'] ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php

                                    if (isset($topPostsContainer[1])) { ?>

                                        <li>
                                            <a href="<?php echo $topPostsContainer[1]['permalink'] ?>">
                                                <img src="<?php echo $topPostsContainer[1]['img'] ?>" alt="Image placeholder" class="mr-4">
                                                <div class="text">
                                                    <h4><?php echo $topPostsContainer[1]['title'] ?></h4>
                                                    <div class="post-meta">
                                                        <span class="mr-2"><?php echo $topPostsContainer[1]['date'] ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                    <?php

                                    }

                                    ?>
                                    <?php

                                    if (isset($topPostsContainer[2])) { ?>

                                        <li>
                                            <a href="<?php echo $topPostsContainer[2]['permalink'] ?>">
                                                <img src="<?php echo $topPostsContainer[2]['img'] ?>" alt="Image placeholder" class="mr-4">
                                                <div class="text">
                                                    <h4><?php echo $topPostsContainer[2]['title'] ?></h4>
                                                    <div class="post-meta">
                                                        <span class="mr-2"><?php echo $topPostsContainer[2]['date'] ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                    <?php

                                    }

                                    ?>
                                </ul>


                            <?php

                            }
                            ?>

                        </div>
                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <?php

                        $categories = get_categories([
                            'orderby' => 'name',
                            'order' => 'ASC'
                        ]);

                        if ($categories) { ?>
                            <h3 class="heading">Categories</h3>
                            <ul class="categories">
                                <?php
                                foreach ($categories as $category) { ?>
                                    <li><a href="<?php echo get_category_link($category->term_id) ?>"><?php echo $category->name ?> <span>(<?php echo $category->count ?>)</span></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        }
                        ?>

                    </div>
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <?php

                        $tags = get_the_tags();

                        if ($tags) { ?>

                            <h3 class="heading">Tags</h3>
                            <ul class="tags">

                                <?php
                                foreach ($tags as $tag) { ?>
                                    <li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo $tag->name ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                    </div>
                </div>
                <!-- END sidebar -->

            </div>
        </div>
    </section>


<?php
}
?>




<div class="site-section bg-light">
    <div class="container">



        <?php

        $post_id = get_the_ID();
        $cat_ids = array();
        $categories = get_the_category($post_id);

        if (!empty($categories) && !is_wp_error($categories)) :
            foreach ($categories as $category) :
                array_push($cat_ids, $category->term_id);
            endforeach;
        endif;


        $query_args = array(
            'category__in'   => $cat_ids,

            'post__not_in'    => array($post_id),
            'posts_per_page'  => '4',
        );

        $related_cats_post = new WP_Query($query_args);
        if ($related_cats_post->have_posts()) {
            $relatedPosts = [];
            $i = 0;
            while ($related_cats_post->have_posts()) {
                $related_cats_post->the_post();
                if ($i == 0) {
                    $relatedPosts[] = [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'portrait-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ];
                } elseif ($i == 1) {
                    $relatedPosts[] = [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'ultra-landscape-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ];
                } else {
                    $relatedPosts[] = [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'large-landscape-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ];
                }
                $i++;
            }
        }

        ?>



        <?php

        if (isset($relatedPosts)) { ?>

            <div class="row mb-5">
                <div class="col-12">
                    <h2>More Related Posts</h2>
                </div>
            </div>
            <div class="row align-items-stretch retro-layout">

                <div class="col-md-5 order-md-2">
                    <a href="<?php echo $relatedPosts[0]['permalink'] ?>" class="hentry img-1 h-100 gradient" style="background-image: url('<?php echo $relatedPosts[0]['img'] ?>');">

                        <div class="text">
                            <h2><?php echo $relatedPosts[0]['title'] ?></h2>
                            <span><?php echo $relatedPosts[0]['date'] ?></span>
                        </div>
                    </a>
                </div>

                <?php

                if ($relatedPosts[1]) { ?>

                    <div class="col-md-7">

                        <a href="<?php echo $relatedPosts[1]['permalink'] ?>" class="hentry img-2 v-height mb30 gradient" style="background-image: url('<?php echo $relatedPosts[1]['img'] ?>');">

                            <div class="text text-sm">
                                <h2><?php echo $relatedPosts[1]['title'] ?></h2>
                                <span><?php echo $relatedPosts[1]['date'] ?></span>
                            </div>
                        </a>

                        <?php

                        if ($relatedPosts[2]) { ?>

                            <div class="two-col d-block d-md-flex">
                                <a href="<?php echo $relatedPosts[2]['permalink'] ?>" class="hentry v-height img-2 gradient" style="background-image: url('<?php echo $relatedPosts[2]['img'] ?>');">

                                    <div class="text text-sm">
                                        <h2><?php echo $relatedPosts[2]['title'] ?></h2>
                                        <span><?php echo $relatedPosts[2]['date'] ?></span>
                                    </div>
                                </a>
                                <?php

                                if ($relatedPosts[3]) { ?>

                                    <a href="<?php echo $relatedPosts[3]['permalink'] ?>" class="hentry v-height img-2 ml-auto gradient" style="background-image: url('<?php echo $relatedPosts[3]['img'] ?>');">

                                        <div class="text text-sm">
                                            <h2><?php echo $relatedPosts[3]['title'] ?></h2>
                                            <span><?php echo $relatedPosts[3]['date'] ?></span>
                                        </div>
                                    </a>

                                <?php } ?>
                            </div>

                        <?php } ?>

                    </div>

                <?php } ?>
            </div>


        <?php } ?>





    </div>
</div>


<div class="site-section bg-lightx">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-5">
                <div class="subscribe-1 ">
                    <h2>Subscribe to our newsletter</h2>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt error illum a explicabo, ipsam nostrum.</p>
                    <form action="#" class="d-flex">
                        <input type="text" class="form-control" placeholder="Enter your email address">
                        <input type="submit" class="btn btn-primary" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer() ?>