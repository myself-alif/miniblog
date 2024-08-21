<?php get_header() ?>
<div class="site-section bg-light">
    <div class="container">
        <h1 class="text-center">
            <?php
            echo get_the_archive_title();
            ?>
        </h1>
        <hr>
    </div>
</div>

<div class="site-section">
    <div class="container">

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