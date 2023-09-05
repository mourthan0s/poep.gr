jQuery(document).ready(function(){

    jQuery('.products-carousel').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        arrows: false,
        autoplay: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    jQuery(".products-infinite-carousel").slick({
        speed: 5000,
        autoplay: true,
        autoplaySpeed: 0,
        cssEase: 'linear',
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        swipeToSlide: true,
        centerMode: true,
        focusOnSelect: true,
        pauseOnHover:true,
        rows: 2,
        responsive: [
            {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    rows: 2,
                }
            },
            // {
            //     breakpoint: 480,
            //     settings: {
            //     slidesToShow: 2,
            //     }
            // }
        ]
    });

    
    let $slickLogosCarousel = jQuery('.logos-carousel .gallery-columns-1');


    $slickLogosCarousel.slick({
        centerMode: false,
        centerPadding: '60',
        slidesToShow: 1,
        infinite: false,
        prevArrow:"<img class='slick-prev' src='../wp-content/themes/astra-child/images/slick-left-arrow.png'>",
        nextArrow:"<img class='slick-next' src='../wp-content/themes/astra-child/images/slick-right-arrow.png'>",
        // responsive: [
        // {
        //     breakpoint: 768,
        //     settings: {
        //     arrows: false,
        //     centerMode: true,
        //     centerPadding: '40px',
        //     slidesToShow: 3
        //     }
        // },
        // {
        //     breakpoint: 480,
        //     settings: {
        //     arrows: false,
        //     centerMode: true,
        //     centerPadding: '40px',
        //     slidesToShow: 1
        //     }
        // }
        // ]
     });
     

    //////////////////////////////////////////////////////////////////////


     jQuery('.product-gallery').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        prevArrow: jQuery('.slick-prev'),
        nextArrow: jQuery('.slick-next'),
        responsive: [
            {
                breakpoint: 767,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1
                }
            }
        ]
    });


    //////////////////////////// Popups /////////////////////////
    jQuery( ".popup-trigger.js-gallery" ).click(function() {
        jQuery( ".popup-wrapper.popup-gallery" ).addClass('active');
        jQuery( "body" ).addClass('popup-activated');
    });

    jQuery( ".popup-trigger.js-video" ).click(function() {
        jQuery( ".popup-wrapper.popup-video" ).addClass('active');
        jQuery( "body" ).addClass('popup-activated');
    });

    jQuery( ".close-popup" ).click(function() {
        jQuery( ".popup-wrapper" ).removeClass('active');
        jQuery( "body" ).removeClass('popup-activated');
    });

    jQuery( ".popup-trigger.js-form" ).click(function() {
        jQuery( ".popup-wrapper.popup-form" ).addClass('active');
        jQuery( "body" ).addClass('popup-activated');
    });

    //scroll to section after button click
    jQuery(".js-scroll-to").click(function() {
        jQuery('html,body').animate({
            scrollTop: jQuery("#scroll-section").offset().top -50}, 'slow');
    });


    //////////////////////////// Display Product Fixed Bar /////////////////////////
    elem = jQuery('#js-display-bar');
    if( elem.length > 0 ) {
        window.addEventListener('scroll', function(e) {
            var $window = jQuery(window);
            var $elem = jQuery(elem);
            var viewport_top = $window.scrollTop();
            var elementTop = $elem.offset().top
            if(viewport_top > (elementTop + elementTop) ){
                jQuery('.pre_footer_purchase').addClass('active');
            }
            else{
                jQuery('.pre_footer_purchase').removeClass('active');
            }
        });
    }

    //////////////////////////// Mobile Filters /////////////////////////
    jQuery( ".js-mobile-filter" ).click(function() {
        jQuery('.ast-left-sidebar #secondary').toggleClass('active');
        jQuery('.js-mobile-filter img').toggleClass('show');
    });


    //////////////////////////// Hide Empty Filters /////////////////////////
    setTimeout(function(){
        let $hideFilters = jQuery('.icheckbox_minimal-blue.disabled');
        $hideFilters.each(function(index, item) {
            jQuery(this).parent().addClass('hide');
        });
    }, 500)
       

    ///////////////////////// Product Checkboxes /////////////////////////
    // Old Backup
    // jQuery('.js-check-mandatory .checkbox_text').each(function(){
    //     jQuery(this).click(function(){
    //         jQuery(this).parent('.checkbox_wrapper').find('input').trigger('click');
    //     })
    // });

    setTimeout(function(){
        jQuery('.js-check-mandatory .checkbox_text').each(function(){
            jQuery(this).click(function(){
                jQuery(this).parent('.checkbox_wrapper').find('input').trigger('click');
                if(jQuery.trim(jQuery(this).text()) == "E-Learning"){
                    jQuery('.add-to-cart-wrapper .js_add_to_cart_button').removeClass('hide');
                } else {
                    jQuery('.add-to-cart-wrapper .js_add_to_cart_button').addClass('hide');
                }
            }) 
        })
        , 1000})

    jQuery('.js-check-mandatory input').each(function(){
        jQuery(this).click(function(){
            jQuery('.js-check-mandatory input').prop('checked', false); 
            jQuery(this).prop('checked',true);
            jQuery('.add-to-cart-wrapper').removeClass("disabled");
            jQuery('.add-to-cart-wrapper a').attr("var_product_id" ,jQuery(this).attr('data-var-id'));
            jQuery('.js-dynamic-price').html(jQuery(this).attr('data-var-price') + '€');
        })
    });


    ////////////////////// Menu Hover ////////////////////////////

    jQuery('.menu-item-has-children').mouseenter(function() {
        jQuery(this).blur();
        jQuery('.submenu-slide').addClass('active');
        jQuery(this).find('svg').addClass('rotateme');
        setTimeout(function(){
            jQuery('.main-navigation .sub-menu').addClass('show');
        }, 500);
    });

    jQuery('.menu-item-has-children').mouseleave(function() {
        jQuery('.submenu-slide').removeClass('active');
        jQuery('.menu-item-has-children').find('svg').removeClass('rotateme');
        jQuery('.main-navigation .sub-menu').removeClass('show');
    });
  

    /////////////////////////// Checkout page - Create account ///////////////////////////////////
    if(jQuery('.checkout-alert-box').length > 0){
        jQuery('#createaccount.woocommerce-form__input').trigger('click');
    }
      
    /////////////////////////// Add product to cart ///////////////////////////////////

    jQuery(document).on('click', '.js_add_to_cart_button', function (e) {
        e.preventDefault();
        var $thisbutton = jQuery(this),
                $form = $thisbutton,
                id = $thisbutton.attr( "product_id" ),
                product_qty = 1,
                product_id = $thisbutton.attr( "product_id" );  
                variation_id = $thisbutton.attr( "var_product_id" ) || 0;      
        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            variation_id: variation_id,
            product_sku: '',
            quantity: product_qty
        };
        jQuery(document.body).trigger('adding_to_cart', [$thisbutton, data]);
        jQuery.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                // $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                // $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {
                if (response.error && response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });
        return false;
    });


    ////////////////////////// About us page - Load More Button /////////////////////////
    var loadMoreBtn = jQuery('.js-load-more button.eael-load-more-button');
    var triggered = false;
    if( loadMoreBtn.length > 0 ) {
        window.addEventListener('scroll', function(e) {
            var $window = jQuery(window);
            var btn_viewport_top = $window.scrollTop();
            var btnElementTop = loadMoreBtn.offset().top;
            if(btnElementTop == 0) return;
            if(btn_viewport_top > (btnElementTop - 800)){
                if(triggered==false) {
                    loadMoreBtn.trigger('click');
                    triggered = true;
                    jQuery('.spining-wrapper .spining').addClass('show');
                    jQuery('html, body').css({ 'overflow-y': 'hidden'});
                    setTimeout(function(){
                        jQuery('html, body').css({ 'overflow-y': 'visible'});
                        jQuery('.spining-wrapper .spining').removeClass('show');
                    }, 1000);
                }  
            }
        });
    }


    //////////  shop subheader search //////////

    jQuery('.widget.woocommerce.widget_product_search').appendTo(jQuery(".archive-shop-subheader"));
    jQuery('.woocommerce-product-search').appendTo(jQuery(".archive-shop-subheader"));
    jQuery('.woocommerce-ordering').appendTo(jQuery(".archive-shop-subheader"));
    jQuery('.order_message_online').appendTo(jQuery(".ast-breadcrumbs-inner"));
    jQuery('.js-terms').insertBefore(jQuery("form.register .button"));


        //////////  make sidebar filters sticky   //////////
        var $filterSidebar = jQuery('.ast-woo-sidebar-widget.widget.WOOF_Widget'); 
        if($filterSidebar.length > 0 && jQuery(window).width() > 921){
            var isSticky = false;
            jQuery(window).scroll(function(e){ 
                var $window = jQuery(window);
                var viewport_top = $window.scrollTop();
                var elementTop = $filterSidebar.offset().top;
                var elementBottom = $filterSidebar.offset().top + $filterSidebar.outerHeight();
                var elementWrapperTop = jQuery('.sidebar-main').offset().top;
                var containerBottom = jQuery('#content .ast-container').outerHeight();
                
                if((viewport_top > elementWrapperTop) && (isSticky === false)){
                    $filterSidebar.removeClass('bottom');
                    $filterSidebar.addClass('issticky');
                    isSticky = true;
                }

                if((elementBottom > (containerBottom + ($filterSidebar.outerHeight()/2))) && ( isSticky === true)){
                    $filterSidebar.removeClass('issticky');
                    $filterSidebar.addClass('bottom');
                }

                if(viewport_top < elementWrapperTop){
                    $filterSidebar.removeClass('issticky');
                }

                if(viewport_top+30 < elementTop ){
                    isSticky = false;
                }
                
            });
        }   


        if (jQuery('select#billing_receipt_type').length){
            jQuery('select#billing_receipt_type').select2({
                minimumResultsForSearch: -1,
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Select an option'
                  },
                allowClear: true
            });
            jQuery(document).on('change','#billing_receipt_type',function(){
                if (jQuery(this).val() == 'bussiness'){
                    jQuery('div#bussiness_checkout_field').show();
                } else{
                    jQuery('div#bussiness_checkout_field').hide();
                }
            })
        }


        //add hidden input field to header search //
        jQuery('form.search-form').append('<input type="hidden" name="post_type" value="product" />');


        // Translate Filters  //
        let $filtersText = jQuery('html[lang=en-GB] .woof_container_inner.woof_container_inner_ h4');
        $filtersText.each(function( index ) {
            var $this = jQuery(this);
            if( jQuery.trim($this.text().replace('-', '')) === "ΤΟΠΟΘΕΣΙΑ"){
                $this.text('LOCATION');
            }
            if( jQuery.trim($this.text().replace('-', '')) === "ΔΙΑΡΚΕΙΑ"){
                $this.text('DURATION');
            }
        });

});


