<div class="site-footer">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <!-- <h3 class="footer-heading mb-4">About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat reprehenderit magnam deleniti quasi saepe, consequatur atque sequi delectus dolore veritatis obcaecati quae, repellat eveniet omnis, voluptatem in. Soluta, eligendi, architecto.</p> -->
                <?php

                if (is_active_sidebar("about-us")) {
                    dynamic_sidebar("about-us");
                }

                ?>
            </div>
            <div class="col-md-3 ml-auto">


                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-menu',
                    'container' => '',
                    'menu_class' => 'list-unstyled float-left mr-5'

                ]);

                if (is_active_sidebar('footer-category')) {
                    dynamic_sidebar('footer-category');
                }
                ?>

            </div>
            <div class="col-md-4">


                <div>

                    <?php

                    if (is_active_sidebar('social-links')) {
                        dynamic_sidebar('social-links');
                    }


                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>



<?php wp_footer() ?>
</body>

</html>