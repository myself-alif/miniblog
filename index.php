<?php get_header() ?>
<div class="site-section bg-light">
    <div class="container">
        <?php
        $featurePostsContainer = [];

        $featuredPosts = new WP_Query([
            'meta_key' => 'featured',
            'meta_value' => '1',
            'posts_per_page' => '5',
        ]);



        if ($featuredPosts->have_posts()) {
            $i = 0;
            while ($featuredPosts->have_posts()) {
                $featuredPosts->the_post();

                if ($i != 2) {
                    array_push($featurePostsContainer, [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'landscape-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ]);
                } else {
                    array_push($featurePostsContainer, [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'portrait-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ]);
                }


                $i++;
            }
            wp_reset_query();
        }


        if ($featurePostsContainer) { ?>
            <div class="row mb-5">
                <div class="col-12">
                    <h2>Featured Posts</h2>
                </div>
            </div>

            <div class="row align-items-stretch retro-layout-2">

                <div class="col-md-4">
                    <?php

                    if ($featurePostsContainer[0]) { ?>
                        <a href="<?php echo $featurePostsContainer[0]['permalink'] ?>" class="h-entry mb-30 v-height gradient" style="background-image: url(<?php echo $featurePostsContainer[0]['img'] ?>);">

                            <div class="text">
                                <h2><?php echo $featurePostsContainer[0]['title'] ?></h2>
                                <span class="date"><?php echo $featurePostsContainer[0]['date'] ?></span>
                            </div>
                        </a>

                    <?php
                    }

                    if ($featurePostsContainer[1]) { ?>

                        <a href="<?php echo $featurePostsContainer[1]['permalink'] ?>" class="h-entry v-height gradient" style="background-image: url(<?php echo $featurePostsContainer[1]['img'] ?>);">

                            <div class="text">
                                <h2><?php echo $featurePostsContainer[1]['title'] ?></h2>
                                <span class="date"><?php echo $featurePostsContainer[1]['date'] ?></span>
                            </div>
                        </a>

                    <?php

                    }

                    ?>
                </div>
                <?php

                if ($featurePostsContainer[2]) { ?>

                    <div class="col-md-4">
                        <a href="<?php echo $featurePostsContainer[2]['permalink'] ?>" class="h-entry img-5 h-100 gradient" style="background-image: url(<?php echo $featurePostsContainer[2]['img'] ?>);">

                            <div class="text">

                                <h2><?php echo $featurePostsContainer[2]['title'] ?></h2>
                                <span class="date"><?php echo $featurePostsContainer[2]['date'] ?></span>
                            </div>
                        </a>
                    </div>
                <?php
                }
                if ($featurePostsContainer[3]) { ?>
                    <div class="col-md-4">
                        <?php
                        if ($featurePostsContainer[3]) { ?>
                            <a href="<?php echo $featurePostsContainer[3]['permalink'] ?>" class="h-entry mb-30 v-height gradient" style="background-image: url(<?php echo $featurePostsContainer[3]['img'] ?>);">
                                <div class="text">
                                    <h2>"<?php echo $featurePostsContainer[3]['title'] ?></h2>
                                    <span class="date">"<?php echo $featurePostsContainer[3]['date'] ?></span>
                                </div>
                            </a>
                        <?php
                        }
                        if ($featurePostsContainer[4]) { ?>
                            <a href="<?php echo $featurePostsContainer[4]['permalink'] ?>" class="h-entry v-height gradient" style="background-image: url(<?php echo $featurePostsContainer[4]['img'] ?>);">
                                <div class="text">
                                    <h2><?php echo $featurePostsContainer[4]['title'] ?></h2>
                                    <span class="date"><?php echo $featurePostsContainer[4]['date'] ?></span>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php } ?>


    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h2>Recent Posts</h2>
            </div>
        </div>
        <div class="row">
            <?php

            while (have_posts()) {
                the_post(); ?>


                <div class="col-lg-4 mb-4">
                    <div class="entry2">
                        <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url() ?>" alt="Image" class="img-fluid rounded"></a>
                        <div class="excerpt">
                            <?php
                            $categories = wp_get_post_categories(get_the_ID(), ['fields' => 'names']);
                            if ($categories) {
                                foreach ($categories as $category) { ?>
                                    <span class="post-category text-white mb-3" style="background-color:<?php colors($selectedColor) ?>"><?php echo $category ?></span>
                            <?php
                                }
                            }
                            ?>


                            <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                            <div class="post-meta align-items-center text-left clearfix">
                                <figure class="author-figure mb-0 mr-3 float-left"><img src="<?php echo get_avatar_url(get_the_author_meta("ID")) ?>" alt="Image" class="img-fluid"></figure>
                                <span class="d-inline-block mt-1">By &nbsp; <?php the_author_posts_link() ?></span>
                                <span>&nbsp;-&nbsp; <?php echo get_the_date() ?></span>
                            </div>

                            <p><?php
                                echo wp_trim_words(get_the_content(), 45, '...');

                                ?></p>
                            <p><a href="<?php the_permalink() ?>">Read More</a></p>
                        </div>
                    </div>
                </div>


            <?php
            }
            ?>

        </div>
        <div class="row text-center pt-5 border-top">
            <div class="col-md-12">
                <div class="custom-pagination">
                    <?php
                    echo paginate_links([
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages,
                        'prev_next' => false,
                        'mid_size' => 3
                    ]);
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>






<div class="site-section bg-light">
    <div class="container">

        <?php

        $topPosts = new WP_Query([
            'orderby' => 'comment_count',
            'posts_per_page' => 4
        ]);

        if ($topPosts->have_posts()) {
            $topPostsContainer = [];
            $i = 0;
            while ($topPosts->have_posts()) {
                $topPosts->the_post();


                if ($i == 0) {
                    $topPostsContainer[] = [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'portrait-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ];
                } elseif ($i == 1) {
                    $topPostsContainer[] = [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'ultra-landscape-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ];
                } else {
                    $topPostsContainer[] = [
                        'permalink' => get_the_permalink(),
                        'img' => get_the_post_thumbnail_url(get_the_ID(), 'large-landscape-card'),
                        'title' => get_the_title(),
                        'date' => get_the_date()
                    ];
                }

                $i++;
            }
            wp_reset_query();
        }
        ?>
        <div class="row mb-5">
            <div class="col-12">
                <h2>Top Posts</h2>
            </div>
        </div>
        <?php

        if ($topPostsContainer) { ?>

            <div class="row align-items-stretch retro-layout">

                <div class="col-md-5 order-md-2">
                    <a href="<?php echo $topPostsContainer[0]['permalink'] ?>" class="hentry img-1 h-100 gradient" style="background-image: url(<?php echo $topPostsContainer[0]['img'] ?>);">

                        <div class="text">
                            <h2><?php echo $topPostsContainer[0]['title'] ?></h2>
                            <span><?php echo $topPostsContainer[0]['date'] ?></span>
                        </div>
                    </a>
                </div>

                <div class="col-md-7">

                    <?php

                    if (isset($topPostsContainer[1])) { ?>

                        <a href="<?php echo $topPostsContainer[1]['permalink'] ?>" class="hentry img-2 v-height mb30 gradient" style="background-image: url(<?php echo $topPostsContainer[1]['img'] ?>);">

                            <div class="text text-sm">
                                <h2><?php echo $topPostsContainer[1]['title'] ?></h2>
                                <span><?php echo $topPostsContainer[1]['date'] ?></span>
                            </div>
                        </a>

                    <?php

                    }

                    ?>

                    <div class="two-col d-block d-md-flex">
                        <?php

                        if (isset($topPostsContainer[2])) { ?>

                            <a href="<?php echo $topPostsContainer[2]['permalink'] ?>" class="hentry v-height img-2 gradient" style="background-image: url(<?php echo $topPostsContainer[2]['img'] ?>);">

                                <div class="text text-sm">
                                    <h2><?php echo $topPostsContainer[2]['title'] ?></h2>
                                    <span><?php echo $topPostsContainer[2]['date'] ?></span>
                                </div>
                            </a>

                        <?php

                        }

                        ?>
                        <?php
                        if (isset($topPostsContainer[3])) { ?>

                            <a href="<?php echo $topPostsContainer[3]['permalink'] ?>" class="hentry v-height img-2 ml-auto gradient" style="background-image: url(<?php echo $topPostsContainer[3]['img'] ?>);">

                                <div class="text text-sm">
                                    <h2><?php echo $topPostsContainer[3]['title'] ?></h2>
                                    <span><?php echo $topPostsContainer[3]['date'] ?></span>
                                </div>
                            </a>

                        <?php

                        }

                        ?>
                    </div>

                </div>
            </div>


        <?php

        }

        ?>



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