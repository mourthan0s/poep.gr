<?php 
if(!is_user_logged_in()){
    $images = get_field('courses_images', 'options');
?>
    <div class="courses-custom-header">
        <div class="courses-custom-header-inner">
            <div class="cols"> 
                <div class="content-wrapper">
                    <div class="title"><?php echo pll__('COURSES_INTRO_TITLE','astra-child'); ?></div>
                    <div class="desc"><?php echo pll__('COURSES_INTRO_DESCRIPTION','astra-child'); ?></div> 
                    <div class="btn">
                        <div class="btn_text"><?php echo pll__('COURSES_INTRO_BUTTON_TEXT','astra-child'); ?></div>
                        <img class="slide_arrow" src="<?php echo get_template_directory_uri();?>-child/images/right.png">
                        <a class="make-full" href="<?php echo pll__('COURSES_INTRO_BUTTON_LINK','astra-child'); ?>"></a>
                    </div>
                </div> 
            </div>
            <div class="cols images">
                <?php foreach ($images as $image) { ?>
                    <div class="image-wrapper"><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['sizes']['alt']?>"></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <span class="js-terms"><?php echo pll__('COURSES_TERMS_TEXT', 'astra-child'); ?></span>
<?php } 