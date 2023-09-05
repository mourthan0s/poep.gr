<?php
    get_header();
    $product_id = get_the_ID();
    the_post();
    global $product;
    $gallery_attachment_ids = $product->get_gallery_image_ids(); 
    if( $product->is_type( 'variable' ) ){    
        $variations = $product->get_available_variations();
        $variations_id = wp_list_pluck( $variations, 'variation_id' );                     
        foreach ($variations_id as $key=>$variationID){
            $prices[$key] .= get_post_meta($variationID, '_price', true); 
        }
        if(min($prices) != max($prices)){
            $price = min($prices) . '-'. max($prices); 
        } else{
            $price = min($prices);
        }
    } else {
        $price = $product->get_price();
    }
 
?>
<div class="product_body">
    <div class="left">
        <div class="description"><?php the_content(); ?></div>
        <?php if(get_field('product_education_units')): ?>
            <div class="product-section">
                <div class="product-section-header">
                    <img src="<?php echo get_template_directory_uri() ?>-child/images/education_units1.png" class="product-section-icon" />
                    <h4 class="product-section-title"><?php echo pll__('ENOTITES_EKPAIDEFISIS','astra-child'); ?></h4>
                </div>
                <div class="product-section-content">
                    <?php echo get_field('product_education_units'); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(get_field('product_workshop')): ?>
            <div class="product-section">
                <div class="product-section-header">
                    <img src="<?php echo get_template_directory_uri() ?>-child/images/workshop1.png" class="product-section-icon" />
                    <h4 class="product-section-title"><?php echo pll__('PRAKTIKI EKSASKISI','astra-child'); ?></h4>
                </div>
                <div class="product-section-content">
                    <?php echo get_field('product_workshop'); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(get_field('product_educational_material')): ?>
            <div class="product-section">
                <div class="product-section-header">
                    <img src="<?php echo get_template_directory_uri() ?>-child/images/educational_material1.png" class="product-section-icon" />
                    <h4 class="product-section-title"><?php echo pll__('EKPAIDEGTIKO YLIKO','astra-child'); ?></h4>
                </div>
                <div class="product-section-content">
                    <?php echo get_field('product_educational_material'); ?>
                </div>
            </div>
        <?php endif; ?>
        <!--  -->
        <?php if(get_field('product_certificates')): ?>
            <div class="product-section">
                <div class="product-section-header">
                    <img src="<?php echo get_template_directory_uri() ?>-child/images/certificates.png" class="product-section-icon" />
                    <h4 class="product-section-title"><?php echo pll__('PISTOPOISEIS','astra-child'); ?></h4>
                </div>
                <div class="product-section-content">
                    <div class="certificates_column">
                        <?php foreach( get_field('product_certificates') as $certificate ) { ?>
                            <div class="certificates_row">
                                <img src="<?php echo $certificate['certificate_image']['sizes']['medium'] ?>" alt="<?php echo $certificate['certificate_image']['alt'] ?>">
                                <?php echo $certificate['certificate_text'] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!--  -->
        <?php if(get_field('product_terms_of_use')): ?>
            <div class="product-section-terms" style="background-color: #F5F5F5;">
                <img src="<?php echo get_template_directory_uri() ?>-child/images/terms1.png" class="product-section-icon-terms" />
                <div class="product-section-header">
                <h4 class="product-section-title"><?php echo pll__('OROI_SIMETOXIS','astra-child'); ?></h4></h4>
                </div>
                <div class="product-section-content-terms">
                    <?php echo get_field('product_terms_of_use'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="right">
        <div id="js-display-bar" class="product_info">
            <div class="information">
                <div class="title product_info_padding"><?php echo pll__('PLIROFORIES','astra-child'); ?></div>
                <div class="product_info_separator"></div>
                <div class="content product_info_padding">
                    <div class="pr_title"><?php the_title(); ?></div>
                    <div class="product-attributes"><img src=" <?php echo get_template_directory_uri() ?>-child/images/product-duration.png" class="" alt="<?php the_title() ?> Διάρκεια"> <?php echo $product->get_attribute("diarkeia") ?> </div>
                    <div class="product-attributes"><img src=" <?php echo get_template_directory_uri() ?>-child/images/product-location.png" class="" alt="<?php the_title() ?> Τοποθεσία"> <?php echo $product->get_attribute("topothesia") ?> </div>
                    <div class="athens"><img src=" <?php echo get_template_directory_uri() ?>-child/images/location.png" class=""><?php echo pll__('ATHINA','astra-child'); ?></div>
                    <div class="loc_text"><?php echo pll__('VOULIAGMENIS','astra-child'); ?></div>
                    <div class="loc_text">(+30) 211 012 1272</div>
                    <div class="saloniki"><?php echo pll__('THESSALONIKI','astra-child'); ?></div>
                    <div class="loc_text"><?php echo pll__('TSALOUXIDI','astra-child'); ?></div>
                    <div class="loc_text">(+30) 231 040 2360</div>
                    <div class="contact_text"><img src=" <?php echo get_template_directory_uri() ?>-child/images/info.png" class=""><?php echo pll__('EPIKINONISTE','astra-child'); ?></div>
                </div>
                <div class="product_info_separator"></div>
                <?php  ?>
                <div id="scroll-section" class="pr_price product_info_padding <?php if( $product->is_type( 'variable' ) ){ echo 'js-dynamic-price'; } ?>"><?php echo $price;?>€</div>
                <div class="press_purchase product_info_padding">
                    <div id="pay_per_lesson"><?php echo pll__('DINATOTITA_PLIROMIS','astra-child'); ?></div>
                    <div><?php echo pll__('EPILOGI_PARAKOLOUTHISIS','astra-child'); ?></div>
                    <div class="contact_text"><?php echo pll__('METHODO_PARAKOLOUTHISIS','astra-child'); ?></div>
                    <div class="contact_text js-check-mandatory">
                        <?php
                        if( $product->is_type( 'variable' ) ){                         
                            if( !empty( $variations_id ) ) { 
                                foreach( $variations_id as $variationID ) { 
                                    $v_product = wc_get_product($variationID);
                                    $product_attributes = wc_get_formatted_variation( $v_product, true, false, false );
                                    //$checkboxes = $product_attributes . wc_price( $v_product->get_price() );
                                    ?>
                                    <div class="checkbox_wrapper">
                                        <input type="checkbox" name="topothesia" data-var-price="<?php echo $v_product->get_price(); ?>" data-var-id="<?php echo $variationID; ?>">
                                        <div class="checkbox_text"> 
                                            <?php echo $product_attributes; ?>
                                            <br>
                                        </div>
                                    </div>
                                <?php }
                            }
                        }else{
                            $attribute_values = $product->get_attribute( 'topothesia' );
                            if( ! empty( $attribute_values ) ) { ?>
                                <?php $options = explode(',', $attribute_values);
                                foreach( $options as $option ) { ?>
                                    <div class="checkbox_wrapper">
                                        <input type="checkbox" name="topothesia" value="<?php echo trim($option) ?>">
                                        <div class="checkbox_text"> 
                                            <?php echo trim($option) ?>
                                            <br>
                                        </div>
                                    </div>
                                <?php }
                            } 
                        }  ?>
                    </div>
                </div>
                <?php if( $product->is_type( 'variable' ) ){ ?>
                    <div class="add-to-cart-wrapper disabled">
                        <a href="?add-to-cart" class="purchase woo-main js_add_to_cart_button" product_id="<?php echo $product_id; ?>" var_product_id="<?php echo $product_id; ?>">
                            <span class="purchase_text"><?php echo pll__('AGORA_TWRA','astra-child'); ?></span>
                            <img class='slide_arrow' src='<?php echo get_template_directory_uri();?>-child/images/right.png'>
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="add-to-cart-wrapper disabled">
                        <a href="?add-to-cart=<?php echo $product_id; ?>" class="purchase woo-main js_add_to_cart_button" product_id="<?php echo $product_id; ?>">
                            <span class="purchase_text"><?php echo pll__('AGORA_TWRA','astra-child'); ?></span>
                            <img class='slide_arrow' src='<?php echo get_template_directory_uri();?>-child/images/right.png'>
                        </a>
                    </div>
                <?php } ?>
                
                <div class="intresting popup-trigger js-form"><?php echo pll__('EKDILOSI_ENDIAFERONTOS','astra-child'); ?></div>
            </div>
        </div>
        <?php if(!empty($gallery_attachment_ids)) { ?>
            <div class="pr_media"><?php echo pll__('FOTOGRAFIES','astra-child'); ?></div>
            <div class="popup-trigger js-gallery">
                <div class="pr_gallery">
                    <img src="<?php echo wp_get_attachment_url( $gallery_attachment_ids[0] );?>" alt="">
                    <div class="overlay make-full"></div>
                    <div class="counter_images">+ <?php echo count($gallery_attachment_ids); ?></div>
                </div>
            </div>
        <?php } ?>
        <?php if(!empty(get_field('videothumbnail'))) { ?>
            <div class="pr_media"><?php echo pll__('VIDEO','astra-child'); ?></div>
            <div class="popup-trigger js-video">
                <div class="pr_video">  
                    <?php $video = get_field('product_video'); ?>
                    <img src="<?php echo get_field('videothumbnail', $product->get_id())["url"];?>" alt="" class="thub">
                    <img src=" <?php echo get_template_directory_uri() ?>-child/images/play_video.png" class="play_video">
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="product-social">
    <p>share this</p>
    <div class="product-social-icons">
        <a target="_blank" rel="noopener noreferrer" data-cat="Product" data-social="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $product->get_permalink(); ?>">
            <img src="<?php echo get_template_directory_uri() ?>-child/images/fb.png" />
        </a>
        <a target="_blank" rel="noopener noreferrer" data-cat="Product" data-social="twitter" href="https://twitter.com/intent/tweet?url=<?php echo $product->get_permalink(); ?>">
            <img src="<?php echo get_template_directory_uri() ?>-child/images/twitter.png" />
        </a>
        <a target="_blank" rel="noopener noreferrer" data-cat="Product" data-social="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $product->get_permalink(); ?>&title=<?php echo $product->name; ?>">
            <img src="<?php echo get_template_directory_uri() ?>-child/images/linkdin.png" />
        </a>
    </div>
</div>
<?php get_footer(); ?>
<div class="popup-wrapper popup-gallery">
    <div class="popup-inner">
        <div class="close-popup"><img src="<?php echo get_template_directory_uri();?>-child/images/close-popup.png" alt="close popup"></div>
        <div class="popup-content">
            <div class="product-gallery-wrapper">
                <div class="product-gallery">
                    <?php 
                        foreach( $gallery_attachment_ids as $attachment_id ) { ?>
                            <div><img src="<?php echo wp_get_attachment_url( $attachment_id );?>" alt=""></div>
                        <?php } ?>
                </div>
                <img class='slick-prev' src='<?php echo get_template_directory_uri();?>-child/images/slick-left-arrow.png'>
                <img class='slick-next' src='<?php echo get_template_directory_uri();?>-child/images/slick-right-arrow.png'>
            </div>
        </div>
    </div>
</div>

<div class="popup-wrapper popup-video">
    <div class="popup-inner">
        <div class="close-popup"><img src="<?php echo get_template_directory_uri();?>-child/images/close-popup.png" alt="close popup"></div>
        <div class="popup-content">
          <div class="product-video-wrapper">
                <div class="product-video">
                    <?php
                        $video = get_field('product_video');
                        if( $video ){
                            $url_parts = parse_url($video);
                            if (substr($video, 0, 12) === "https://www.") {
                        ?>
                        <div class="pr_container_video">
                            <iframe src="<?php echo $video; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <?php } else { ?>
                        <div class="pr_container_video">
                            <video controls>
                                <source src="<?php echo $video; ?>" type="video/mp4">
                            </video>
                        </div>
                        <?php }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="popup-wrapper popup-form">
    <div class="popup-inner"> 
        <div class="popup-content_intresting">
            <div class="close-popup"><img src="<?php echo get_template_directory_uri();?>-child/images/close-popup-black.png" alt="close popup"></div>
                <?php echo (pll_current_language('slug') === 'el') ? do_shortcode('[contact-form-7 id="2454" title="Ekdilosi Endiaferontos"]') : do_shortcode('[contact-form-7 id="12455" title="Ekdilosi Endiaferontos_en"]') ?>
        </div>
    </div>
</div>


<div class="popup_cart"><?php get_template_part('template-parts/cart-popup'); ?></div>