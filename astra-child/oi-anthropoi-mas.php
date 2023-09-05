<div class="post-row">
    <div class="post-column-left">
        <div class="post-column-left-image">
        <?
            echo get_the_post_thumbnail();
        ?>
        </div>
    </div>
    <div class="post-column-right">
        <div class="post-column-right-title">
        <?php
            the_title();
        ?>
        </div>
        <div class="post-column-right-content">
        <?php
            the_content();
        ?>
        </div>
    </div>
</div>