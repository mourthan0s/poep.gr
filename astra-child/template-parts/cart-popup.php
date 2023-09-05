<?php
global $woocommerce;
$items = $woocommerce->cart->get_cart();
// $cart = WC()->cart;
?>

<div class="content testme">
    <div class="popup_header popup_row">
        <div class="popup_title popup_fonts">Καλάθι</div>
        <div class="popup_delete popup_right">x</div>
    </div>
    <div class="popup_pr_allpr">
        <?php foreach ( $items as $cart_item_key => $cart_item ) {
                $product = $cart_item['data'];
                $product_id = $cart_item['product_id'];
                $quantity = $cart_item['quantity'];
                // var_dump( $cart_item_key );
                $nonce = wp_create_nonce( 'woocommerce-cart' );
                $delete = add_query_arg( array('remove_item' => $cart_item_key,'_wpnonce' => $nonce), wc_get_cart_url() );
                $delete_src = '<span class="ahfb-svg-iconset ast-inline-flex"><svg class="ast-mobile-svg ast-close-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.293 6.707l5.293 5.293-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l5.293-5.293 5.293 5.293c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414l-5.293-5.293 5.293-5.293c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-5.293 5.293-5.293-5.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path></svg></span>';

                $price = WC()->cart->get_product_price( $product );
                $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
                $link = $product->get_permalink( $cart_item );  
                // $attributes = $product->get_attributes();
                // $whatever_attribute = $product->get_attribute( 'whatever' );
                // $whatever_attribute_tax = $product->get_attribute( 'pa_whatever' );
                // $any_attribute = $cart_item['variation']['attribute_whatever']; ?>
                    <div class="popup_pr_single popup_row">
                    <div class="popup_pr_photo"><a href="<? echo $link; ?>"><img src="' . wp_get_attachment_url( $product->get_image_id()) . '"></a></div>
                    <div class="popup_pr_attributes">
                        <div class="popup_pr_title"><a href="' . $link .'"> <?php  echo $product->name; ?></a></div>
                        <div class="popup_pr_count_price popup_fonts"><?php echo $quantity;?> x <?php echo $price; ?></div>
                    </div>
                    <div class="popup_pr_delete popup_right"><a href="' . $delete . '" class="remove" aria-label="Remove this product"><?php echo $delete_src; ?></a></div>
                </div>
        <?php } ?>
        <div class="popup_pr_subset popup_row">
            <div class="popup_pr_total popup_fonts">Υποσύνολο:</div>
            <div class="popup_pr_allprice popup_right"> <?php echo $subtotal; ?></div>
            </div>
        </div>
        <div class="popup_footer popup_row">
            <div class="intresting">Προβολή καλαθιού</div>
            <div class="purchase">Ταμείο</div>
        </div>
    </div>


