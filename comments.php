<div class="pt-5">

    <?php

    $commentsNum = get_comments_number();
    if ($commentsNum < 2) { ?>

        <h3 class="mb-5"><?php echo $commentsNum ?> Comment</h3>
    <?php

    } else { ?>
        <h3 class="mb-5"><?php echo $commentsNum ?> Comments</h3>
    <?php

    }

    ?>

    <ul class="comment-list">
        <?php wp_list_comments([
            'type' => 'comment',
            'callback' => 'mytheme_comment',
            'max_depth' => 2

        ]); ?>
    </ul>
    <?php paginate_comments_links() ?>
    <!-- END comment-list -->

    <div class="comment-form-wrap pt-5">
        <h3 class="mb-5">Leave a comment</h3>
        <?php

        $comment_send = 'Send';



        $comment_author = 'Name';
        $comment_email = 'E-Mail';
        $comment_body = 'Comment';



        $comment_cancel = 'Cancel Reply';

        //Array
        $comments_args = array(
            //Define Fields
            'fields' => array(
                //Author field
                'author' => '<div class="form-group"><input class="form-control" id="author" name="author" aria-required="true" placeholder="' . $comment_author . '"></input></div>',
                //Email Field
                'email' => '<div class="form-group"><input class="form-control" id="email" name="email" placeholder="' . $comment_email . '"></input></div>',
                //URL Field

            ),
            // Change the title of send button
            'label_submit' => __($comment_send),
            // Change the title of the reply section

            // Change the title of the reply section

            //Cancel Reply Text
            'cancel_reply_link' => __($comment_cancel),
            // Redefine your own textarea (the comment body).
            'comment_field' => '<div class="form-group"><textarea rows="10" class ="form-control"  id="comment" name="comment" aria-required="true" placeholder="' . $comment_body . '"></textarea></div>',
            //Message Before Comment
            // 'comment_notes_before' => __($comment_before),
            // Remove "Text or HTML to be displayed after the set of comment fields".
            'comment_notes_after' => '',
            //Submit Button ID
            'id_submit' => __('comment-submit'),
            'class_form' => 'p-5 bg-light',
            'submit_button' => '<input class="%3$s btn btn-primary" name="%1$s" type="submit" id="%2$s" value="%4$s" />.',
            'submit_field' => '<div class="form-group">%1$s %2$s</div>',
            'title_reply' => ''
        );
        comment_form($comments_args);

        ?>
        <!-- <form action="#" class="p-5 bg-light">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" class="form-control" id="website">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Post Comment" class="btn btn-primary">
            </div>

        </form> -->
    </div>
</div>