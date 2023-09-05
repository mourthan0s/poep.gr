<?php
/**
 * poep Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package poep
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_POEP_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'poep-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_POEP_VERSION, 'all' );
    wp_register_style('slick-css', get_template_directory_uri() .'-child/css/slick.css');
	wp_register_style('slick-theme-css', get_template_directory_uri() .'-child/css/slick-theme.css');
	// wp_enqueue_script('jquery-min-js', get_template_directory_uri().'-child/js/jquery-1.11.0.min.js', array(), '1.11.0');		
	wp_enqueue_script('slick-min-js', get_template_directory_uri().'-child/js/slick.min.js');		

	// Our Custom JS (we'll initialize slick here)
	wp_enqueue_script('custom-js', get_template_directory_uri().'-child/js/custom-js.js', array(), '1.0.0');

	// Enqueue all CSS & JS files
	wp_enqueue_style('slick-css');
	wp_enqueue_style('slick-theme-css');
	wp_enqueue_script('jquery-min-js');
	wp_enqueue_script('slick-min-js');
	wp_enqueue_script('custom-js');

}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


//create theme options page
if( function_exists('acf_add_options_page') ) {   
    acf_add_options_page();
}

//create and save acf json
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;   
}

include('custom-shortcodes.php');



//Woocommerce shop archive page
add_action( 'after_header', 'add_shopage_header');
function add_shopage_header(){
 get_template_part('template-parts/shop-archive-header');
}

add_action( 'before_footer', 'add_shopage_footer' );
	function add_shopage_footer(){
	 get_template_part('template-parts/shop-archive-footer');
}
// Single Product pre-footer.php
add_action( 'before_footer', 'add_pre_footer' );
	function add_pre_footer(){
	 get_template_part('template-parts/product-pre-footer');
}
 
//Display product attributes to shop page 
add_action( 'astra_woo_shop_title_after', 'display_product_attributes', 10 );

function display_product_attributes() {
    $currentProduct = wc_get_product();
    $desc = !empty($currentProduct->get_short_description()) ? $currentProduct->get_short_description() : $currentProduct->get_description();
    $attr_location = explode(',', $currentProduct->get_attribute("topothesia"));
    $locations .= '<div class="location-list">';
    foreach ($attr_location as $attr){
        $locations .= $attr .'<span></span>';
    }
    $locations .= '</div>';
    echo '
    <div class="custom-shop-product-description">'. implode(' ', array_slice(explode(' ', $desc ), 0, 10)) .'...</div>
    <div class="product-attributes"><img src="' . get_template_directory_uri() .'-child/images/product-duration.png" class="" alt="'. get_the_title($currentProduct->get_id()) .' Διάρκεια">' . $currentProduct	->get_attribute("diarkeia") .'</div>
    <div class="product-attributes"><img src="' . get_template_directory_uri() .'-child/images/product-location.png" class="" alt="'. get_the_title($currentProduct->get_id()) .' Τοποθεσία">' . $locations .'</div>';
}

add_action( 'astra_woo_shop_title_before', 'add_big_circle_on_products', 10 );

function add_big_circle_on_products() {
   	$currentProduct = wc_get_product();
   	$img_text = get_field('pr_image_text', $currentProduct->get_id());
   	if(!empty($img_text)){
		echo '<img src="' . get_template_directory_uri() .'-child/images/product-circles.png" class="big-circle" alt="product circles">
		<div class="image-text">' . $img_text .'</div>';
	}
	echo '<a class="make-full" href="' .  get_permalink($currentProduct->get_id()) .'"></a>';
}

/////////////////////////     menu bar SEMINARIA     ///////////////////////////////////////////

add_action( 'woocommerce_before_main_content', 'display_seminaria', 10 );
function display_seminaria() {
    $catSlug = get_queried_object()->slug;
    if($catSlug === "seminaria" || $catSlug === "seminars") {
        $archiveContent['title'] = pll__('SEMINARIA_TITLE_TEXT','astra-child');
        $archiveContent['small_description'] = pll__('SEMINARIA_DESCRIPTION_TEXT','astra-child');
    } else {
        $archiveContent['title'] = pll__('TOMEIS_EKPAIDEUSIS_TITLE_TEXT','astra-child');
        $archiveContent['small_description'] = pll__('TOMEIS_EKPAIDEUSIS_DESCRIPTION_TEXT','astra-child');
        if($catSlug === "alles-eidikotites" || $catSlug === "other-specialties"){
            echo '
            <div class="alles-eidikotites-text">
                <img src="' . get_template_directory_uri() .'-child/images/square.png">
                <div class="text">' . pll__('ALLES_EIDIKOTITES_TEXT','astra-child') .'</div>
            </div>';
        }   
    }
    echo '<div class="archive-shop-subheader">
            <div class="titles-wrapper">
                <h1 class="before-filters-title">' . $archiveContent['title'] .'</h1>
                <div class="before-filters-subtitle">' . $archiveContent['small_description'] .'</div>
            </div>
        </div>';
    echo do_shortcode( '[custom_search_form]' );
}


function my_custom_search_shortcode() {
    $output = '<form role="search" method="get" class="woocommerce-product-search" action="' . esc_url( home_url( '/' ) ) . '">';
    $output .= '<label class="screen-reader-text" for="woocommerce-product-search-field">' . _x( 'Search for:', 'label', 'woocommerce' ) . '</label>';
    $output .= '<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="' .  pll__('SEARCH_STRING','astra-child') . '" value="' . get_search_query() . '" name="s" />';
    $output .= '<button type="submit" class="search-submit">';
    $output .= '<img src="' . get_template_directory_uri() . '-child/images/search2.png" alt="Search" width="30" height="30">';
    $output .= '</button>';
    $output .= '<input type="hidden" name="post_type" value="product" />';
    $output .= '</form>';
    
    return $output;
}
add_shortcode( 'custom_search_form', 'my_custom_search_shortcode' );

//Add product to cart //
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');  
function woocommerce_ajax_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX :: get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
        echo wp_send_json($data);
    }
    wp_die();
}


// add_action( 'wp_ajax_show_popup_cart', 'show_popup_cart' );
// add_action( 'wp_ajax_nopriv_show_popup_cart', 'show_popup_cart' );
// function show_popup_cart(){
//     $cart = WC()->cart;
// // Loop over $cart items

// $cart_content .= '
// <div class="content">
//     <div class="popup_header popup_row">
//         <div class="popup_title popup_fonts">Καλάθι</div>
//         <div class="popup_delete popup_right">x</div>
//     </div>
//     <div class="popup_pr_allpr">';
// foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
//     $product = $cart_item['data'];
//     $product_id = $cart_item['product_id'];
//     $quantity = $cart_item['quantity'];
//     // var_dump( $cart_item_key );
//     $nonce = wp_create_nonce( 'woocommerce-cart' );
//     $delete = add_query_arg( array('remove_item' => $cart_item_key,'_wpnonce' => $nonce), wc_get_cart_url() );
//     $delete_src = '<span class="ahfb-svg-iconset ast-inline-flex"><svg class="ast-mobile-svg ast-close-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.293 6.707l5.293 5.293-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l5.293-5.293 5.293 5.293c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414l-5.293-5.293 5.293-5.293c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-5.293 5.293-5.293-5.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path></svg></span>';

//     $price = WC()->cart->get_product_price( $product );
//     $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
//     $link = $product->get_permalink( $cart_item );
//     // $attributes = $product->get_attributes();
//     // $whatever_attribute = $product->get_attribute( 'whatever' );
//     // $whatever_attribute_tax = $product->get_attribute( 'pa_whatever' );
//     // $any_attribute = $cart_item['variation']['attribute_whatever'];
//     $cart_content .= '
//                     <div class="popup_pr_single popup_row">
//                     <div class="popup_pr_photo"><a href="' . $link .'"><img src="' . wp_get_attachment_url( $product->get_image_id()) . '"></a></div>
//                     <div class="popup_pr_attributes">
//                         <div class="popup_pr_title"><a href="' . $link .'">' . $product->name .'</a></div>
//                         <div class="popup_pr_count_price popup_fonts">' . $quantity . ' x ' . $price .'</div>
//                     </div>
//                     <div class="popup_pr_delete popup_right"><a href="' . $delete . '" class="remove" aria-label="Remove this product">' . $delete_src . '</a></div>
//                 </div>';
//  }
//  $cart_content .= '<div class="popup_pr_subset popup_row">
//                         <div class="popup_pr_total popup_fonts">Υποσύνολο:</div>
//                         <div class="popup_pr_allprice popup_right">' . $subtotal . '</div>
//                         </div>
//                     </div>
//                     <div class="popup_footer popup_row">
//                         <div class="intresting">Προβολή καλαθιού</div>
//                         <div class="purchase">Ταμείο</div>
//                     </div>
//                 </div>';
// echo $cart_content;
// }


add_filter( 'woocommerce_price_trim_zeros', '__return_true' );


// Checkout Page //

add_action( 'woocommerce_after_order_notes', 'display_message_for_required_account');
function display_message_for_required_account() {
    if(is_user_logged_in()){
        return;
    }
    $displayMessage = false;
    foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
        $product = $cart_item['data'];
        $attribute = $product->get_attribute( 'topothesia' );
        if(($attribute === 'Online') || ($attribute ==='E-Learning') ) {
            $displayMessage = true;
            $product_names[$key] .= $product->name;
        }
    }
    if ($displayMessage) echo '<div class="checkout-alert-box"> Η δημιουργία λογαριασμού είναι υποχρεωτική για να παρακολουθήσετε τα παρακάτω μαθήματα: <strong>' . implode(', ', $product_names) .'</strong></div>';
}


//add_filter( 'get_product_search_form', 'custom_search_form' );
//function custom_search_form( $html ) {
	//$html = str_replace( 'placeholder="Αναζήτηση προϊόντων… ', 'placeholder="Press ENTER to search ', $html );
	//return $html;
//}
add_action('init', function() {
    if( function_exists('pll_register_string')) { 
    pll_register_string('astra', 'LEGAL_TEXT');
    }
});


function uc_without_accents($string, $enc = "utf-8") {
    return strtr(mb_strtoupper($string, $enc),
      array('Ά' => 'Α', 'Έ' => 'Ε', 'Ί' => 'Ι', 'Ή' => 'Η', 'Ύ' => 'Υ',
        'Ό' => 'Ο', 'Ώ' => 'Ω', 'A' => 'A', 'A' => 'A', 'A' => 'A', 'A' => 'A',
        'Y' => 'Y','ΐ' => 'Ϊ'
      ));
}

add_action( 'woocommerce_before_thankyou', 'custom_content_thankyou', 10, 1 );
function custom_content_thankyou( $order_id ) {
    
    $order = new WC_Order($order_id);

    foreach ( $order->get_items() as $item ) {   
        $variation = wc_get_product($item->get_variation_id());
        $attribute = $variation->get_attribute( 'topothesia' );


        if($attribute === 'Online') {
            $message1 =  '<div class="order_message_online"><img class="checkout-arrow" src="' . get_template_directory_uri() .'-child/images/checkout-arrow.png"><h3>'. pll__('ORDER_DETAILS_PAGE_ONLINE_MESSAGE','astra-child') .'</h3></div>';
        }
        
        if ($attribute ==='E-Learning') {
            $message2 =  '<div class="order_message_online"><img class="checkout-arrow" src="' . get_template_directory_uri() .'-child/images/checkout-arrow.png"><h3>'. pll__('ORDER_DETAILS_PAGE_ELEARNING_MESSAGE','astra-child') .'</h3></div>';
        }

        if(($attribute === 'Δια ζώσης - Αθήνα') || ($attribute ==='Δια ζώσης - Θεσσαλονίκη') ) {
            $message3 = '<div class="order_message_online"><img class="checkout-arrow" src="' . get_template_directory_uri() .'-child/images/checkout-arrow.png"><h3>'. pll__('ORDER_DETAILS_PAGE_DIA_ZOSIS_MESSAGE','astra-child') .'</h3></div>';
        }
    }

    if(!empty($message1)){
        echo $message1;
    } 
    if(!empty($message2)){ 
        echo $message2;
    } 
    if(!empty($message3)){
        echo $message3;
    } 
    
}


add_action('init', function() {
    if( function_exists('pll_register_string')) {
      pll_register_string('astra-child', 'ORDER_DETAILS_PAGE_ONLINE_MESSAGE');
      pll_register_string('astra-child', 'ORDER_DETAILS_PAGE_ELEARNING_MESSAGE');
      pll_register_string('astra-child', 'ORDER_DETAILS_PAGE_DIA_ZOSIS_MESSAGE');
      pll_register_string('astra-child', 'PLAIN_RECEIPT');
      pll_register_string('astra-child', 'INVOICE');
      pll_register_string('astra-child', 'VAT_NUMBER');
      pll_register_string('astra-child', 'TAX_OFFICE');
      pll_register_string('astra-child', 'COMPANY_ACTIVITY');
      pll_register_string('astra-child', 'RECEIPT_TYPE');
      pll_register_string('astra-child', 'COMPANY_NAME');
	  pll_register_string('astra-child', 'ENOTITES_EKPAIDEFISIS');
	  pll_register_string('astra-child', 'PRAKTIKI EKSASKISI');
	  pll_register_string('astra-child', 'EKPAIDEGTIKO YLIKO');
	  pll_register_string('astra-child', 'PISTOPOISEIS');
	  pll_register_string('astra-child', 'OROI_SIMETOXIS');
	  pll_register_string('astra-child', 'PLIROFORIES');
	  pll_register_string('astra-child', 'ATHINA');
	  pll_register_string('astra-child', 'THESSALONIKI');
	  pll_register_string('astra-child', 'VOULIAGMENIS');
	  pll_register_string('astra-child', 'TSALOUXIDI');
	  pll_register_string('astra-child', 'EPIKINONISTE');
   	  pll_register_string('astra-child', 'DINATOTITA_PLIROMIS');
	  pll_register_string('astra-child', 'EPILOGI_PARAKOLOUTHISIS');
	  pll_register_string('astra-child', 'METHODO_PARAKOLOUTHISIS');
	  pll_register_string('astra-child', 'AGORA_TWRA');
	  pll_register_string('astra-child', 'EKDILOSI_ENDIAFERONTOS');
	  pll_register_string('astra-child', 'FOTOGRAFIES');
	  pll_register_string('astra-child', 'VIDEO');
	  pll_register_string('astra-child', 'OTHER_SEMINARS');
	  pll_register_string('astra-child', 'ARCHIVE_FOOTER_TITLE');
	  pll_register_string('astra-child', 'ARCHIVE_FOOTER_DESC');
	  pll_register_string('astra-child', 'BOX_TITLE1');
      pll_register_string('astra-child', 'BOX_TITLE2');
	  pll_register_string('astra-child', 'BOX_TITLE3'); 
      pll_register_string('astra-child', 'BOX_DESCRIPTION1');
      pll_register_string('astra-child', 'BOX_DESCRIPTION2');
	  pll_register_string('astra-child', 'BOX_DESCRIPTION3'); 
	  pll_register_string('astra-child', 'BOX_CONTENT');
      pll_register_string('astra-child', 'ALLES_EIDIKOTITES_TEXT');	
      pll_register_string('astra-child', 'SEMINARIA_TITLE_TEXT');	
      pll_register_string('astra-child', 'TOMEIS_EKPAIDEUSIS_TITLE_TEXT');	
      pll_register_string('astra-child', 'SEMINARIA_DESCRIPTION_TEXT');	
      pll_register_string('astra-child', 'TOMEIS_EKPAIDEUSIS_DESCRIPTION_TEXT');	
      pll_register_string('astra-child', 'SEARCH_STRING');	
      pll_register_string('astra-child', 'COURSES_INTRO_TITLE');	
      pll_register_string('astra-child', 'COURSES_INTRO_DESCRIPTION');
      pll_register_string('astra-child', 'COURSES_INTRO_BUTTON_TEXT');	
      pll_register_string('astra-child', 'COURSES_TERMS_TEXT');	
      pll_register_string('astra-child', 'COURSES_INTRO_BUTTON_LINK'); 	
    }
});


// add_action( 'woocommerce_before_customer_login_form', 'add_account_header');
// function add_account_header( ) {
//     get_template_part('template-parts/content', 'account-header');
// }


/** Translate a String in WooCommerce (English to English) **/
add_filter( 'gettext', 'bbloomer_translate_woocommerce_strings', 999, 3 );
function bbloomer_translate_woocommerce_strings( $translated, $untranslated, $domain ) {
   if ( ! is_admin() && 'woocommerce' === $domain ) {
      switch ( $translated ) {
         case 'Παραγγελίες':
            $translated = 'Αγορές';
            break;  
         case 'Παραγγελία':
            $translated = 'Αγορά';
            break;
      }
   }
   return $translated;
}


/* Change the breakpoint of the Astra Header Menus */
add_filter( 'astra_tablet_breakpoint', function() {
    return 1023;
});



////////////////////////

/** Add Billing fields **/

add_filter( 'woocommerce_checkout_fields' , 'pms_override_checkout_fields' );

function pms_override_checkout_fields( $fields ) {
	$fields['billing']['billing_receipt_type'] = array(
        'label'     => pll__('RECEIPT_TYPE','astra-child'),
		'placeholder'   => '',
		'required'  => false,
		'class'     => array('form-row-wide'),
		'clear'     => true,
		'type' => 'select',
		'options'     => array(
			'plain' => pll__('PLAIN_RECEIPT','astra-child'),
			'bussiness' => pll__('INVOICE','astra-child')
        ),
    );
	return $fields;
	
}

add_action( 'woocommerce_after_checkout_billing_form', 'pms_bussiness_checkout_fields' );

function pms_bussiness_checkout_fields( $checkout ) {

    echo '<div id="bussiness_checkout_field" style="display:none;">';

    woocommerce_form_field( 'bussiness_vat_number', array(
        'type'          => 'text',
        'class'         => array('bsfields form-row-wide'),
        'label'         => pll__('VAT_NUMBER','astra-child'),
        'placeholder'   => '',
        ), $checkout->get_value( 'bussiness_vat_number' ));
		
	woocommerce_form_field( 'bussiness_tax_agency', array(
        'type'          => 'text',
        'class'         => array('bsfields form-row-wide'),
        'label'         => pll__('TAX_OFFICE','astra-child'),
        'placeholder'   => '',
        ), $checkout->get_value( 'bussiness_tax_agency' ));
		
	woocommerce_form_field( 'bussiness_occupation', array(
        'type'          => 'text',
        'class'         => array('bsfields form-row-wide'),
        'label'         => pll__('COMPANY_ACTIVITY','astra-child'),
        'placeholder'   => '',
        ), $checkout->get_value( 'bussiness_occupation' ));

    woocommerce_form_field( 'bussiness_name', array(
        'type'          => 'text',
        'class'         => array('bsfields form-row-wide'),
        'label'         => pll__('COMPANY_NAME','astra-child'),
        'placeholder'   => '',
        ), $checkout->get_value( 'bussiness_name' ));
    echo '</div>';

}


/** Save custom fields **/
add_action( 'woocommerce_checkout_update_order_meta', 'pms_custom_checkout_field_update_order_meta' );

function pms_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['bussiness_vat_number'] ) ) {
        update_post_meta( $order_id, '_bussiness_vat_number', sanitize_text_field( $_POST['bussiness_vat_number'] ) );
    }
	if ( ! empty( $_POST['bussiness_tax_agency'] ) ) {
        update_post_meta( $order_id, '_bussiness_tax_agency', sanitize_text_field( $_POST['bussiness_tax_agency'] ) );
    }
	if ( ! empty( $_POST['bussiness_occupation'] ) ) {
        update_post_meta( $order_id, '_bussiness_occupation', sanitize_text_field( $_POST['bussiness_occupation'] ) );
    }
    if ( ! empty( $_POST['bussiness_name'] ) ) {
        update_post_meta( $order_id, '_bussiness_name', sanitize_text_field( $_POST['bussiness_name'] ) );
    }
}


/** add new fields to order meta **/
add_action( 'woocommerce_admin_order_data_after_billing_address', 'pms_custom_checkout_field_display_admin_order_meta', 10, 1 );

function pms_custom_checkout_field_display_admin_order_meta($order){
	$parastatiko = get_post_meta( $order->id, '_billing_receipt_type', true );
	$pText = pll__('PLAIN_RECEIPT','astra-child');
	if ($parastatiko == 'bussiness'){
		$pText = pll__('INVOICE', 'astra-child' );
	}
    echo '<p><strong>'.__('Receipt Type','pms').':</strong> ' . $pText . '</p>';
	$vat_number = get_post_meta( $order->get_id(), '_bussiness_vat_number', true );
	$doi = get_post_meta( $order->get_id(), '_bussiness_tax_agency', true );
	$occu = get_post_meta( $order->get_id(), '_bussiness_occupation', true );
    $com_name = get_post_meta( $order->get_id(), '_bussiness_name', true );
	if (!empty($vat_number)){
		echo '<p><strong>'. pll__('VAT_NUMBER','astra-child').':</strong> ' . $vat_number . '</p>';
	}
	if (!empty($doi)){
		echo '<p><strong>'. pll__('TAX_OFFICE','astra-child').':</strong> ' . $doi . '</p>';
	}
	if (!empty($occu)){
		echo '<p><strong>'. pll__('COMPANY_ACTIVITY','astra-child').':</strong> ' . $occu . '</p>';
	}
    if (!empty($com_name)){
		echo '<p><strong>'. pll__('COMPANY_NAME','astra-child').':</strong> ' . $com_name . '</p>';
	}
}

/*** add new fields to emails ***/
function custom_show_email_order_meta( $order, $sent_to_admin, $plain_text ) {
	
    $parastatiko = get_post_meta( $order->id, '_billing_receipt_type', true );
	$vat_number = get_post_meta( $order->id, '_bussiness_vat_number', true );
	$doi = get_post_meta( $order->id, '_bussiness_tax_agency', true );
	$occu = get_post_meta( $order->id, '_bussiness_occupation', true );
    $com_name = get_post_meta( $order->id, '_bussiness_name', true );
	$pText = pll__('PLAIN_RECEIPT', 'astra-child' );
	if ($parastatiko == 'bussiness'){
		$pText = pll__('INVOICE', 'astra-child' );
	}
    if( $plain_text ){
        echo pll__('RECEIPT_TYPE','astra-child').':'.$pText;
    } else {
        echo '<p><strong>'. pll__('RECEIPT_TYPE','astra-child').'</strong> : '.$pText.'</p>';
		if (!empty($vat_number)){
			echo '<p><strong>'. pll__('VAT_NUMBER','astra-child').':</strong> ' . $vat_number . '</p>';
		}
		if (!empty($doi)){
			echo '<p><strong>'. pll__('TAX_OFFICE','astra-child').':</strong> ' . $doi . '</p>';
		}
		if (!empty($occu)){
			echo '<p><strong>'. pll__('COMPANY_ACTIVITY','astra-child').':</strong> ' . $occu . '</p>';
		}
        if (!empty($com_name)){
			echo '<p><strong>'. pll__('COMPANY_NAME','astra-child').':</strong> ' . $com_name . '</p>';
		}
    }
}

add_action('woocommerce_email_customer_details', 'custom_show_email_order_meta', 30, 3 );



add_action( 'wp_head', 'my_own_analytics', 20 );
function my_own_analytics() { ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-R9BLG4FQXM"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-R9BLG4FQXM');
    </script>
<?php
}

function add_gtm_head(){ ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NVCLWB4');</script>
    <!-- End Google Tag Manager -->
<?php
}
add_action( 'wp_head', 'add_gtm_head', 10 );

function add_gtm_body(){ ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NVCLWB4"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
add_action( 'body_top', 'add_gtm_body' );


//Only show products in the front-end search results
function lw_search_filter_pages($query) {
    if ($query->is_search) {
        $query->set('post_type', 'product');
        $query->set( 'wc_query', 'product_query' );
    }
    return $query;
}
     
add_filter('pre_get_posts','lw_search_filter_pages');
    

# Remove Woocommerce Category Title from the product archive page
add_filter( 'woocommerce_show_page_title', 'remove_category_title_from_product_archive' );
function remove_category_title_from_product_archive( $title ) {
    if ( is_product_category() ) {
    $title = false;
    }
    return $title;
}





