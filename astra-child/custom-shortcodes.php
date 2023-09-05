<?php

// Products Carousel

function show_product_carousel($atts) {
    $allTerms = get_terms( 'product_cat', array( 'hide_empty' => false));
    $i=0;
    foreach($allTerms as $term){
        $i++;
        $terms [$i] = $term->slug;
    }
    extract(shortcode_atts(array(
        'number' => !empty($atts['number']) ? $atts['number'] : -1,
        'category' => $terms
     ), $atts));

    $productsQuery = new WP_Query([
        'orderby' => 'date', 
        'order' => 'DESC' ,
        'post_type'      => 'product',
        'posts_per_page' => $number,
        'post_status'    => 'publish',
        'suppress_filters' => false,
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category, 
            ),
            array(
                'taxonomy' => 'product_visibility',
                'field' => 'slug',
                'terms' => $category,
                'operator' => 'IN', // or 'NOT IN' to exclude feature products
            )
        )
    ]); 

    $productsCarousel = '<div class="products-carousel">';

    while ( $productsQuery->have_posts() ) : $productsQuery->the_post();
        global $product;
        $image_text = get_field("pr_image_text", $product->ID);
        $attr_location = explode(',', $product->get_attribute("topothesia"));
        $locations .= '<div class="location-list">';
        foreach ($attr_location as $attr){
            $locations .= $attr .'<span></span>';
        }
        $locations .= '</div>';
        $productsCarousel .= 
        '<div class="product-wrapper">
            <div class="products-carousel-img-wrapper">';
            if(!empty($image_text)){
                $productsCarousel .= '<img src="' . get_template_directory_uri() .'-child/images/product-circles.png" class="big-circle" alt="product circles">
                <div class="image-text">' . get_field("pr_image_text", $product->ID) .'</div>';
            }  
                $productsCarousel .= '<img class="main" src="' . get_the_post_thumbnail_url($product->ID) .'" alt="'. get_the_title() .'">
            </div>
            <div class="product-content-wrapper">
                <h2 class="product-title">'. get_the_title() .'</h2>
                <div class="product-short-desc">'. implode(' ', array_slice(explode(' ', get_the_excerpt( $product->$product->ID)), 0, 10)) .'...</div>
                <div class="product-attributes"><img src="' . get_template_directory_uri() .'-child/images/product-duration.png" class="" alt="'. get_the_title() .' Διάρκεια">' . $product->get_attribute("diarkeia") .'</div>
                <div class="product-attributes"><img src="' . get_template_directory_uri() .'-child/images/product-location.png" class="" alt="'. get_the_title() .' Τοποθεσία">' . $locations .'</div>
            </div>
            <a class="product-link" href="'. get_permalink() .'"></a>
        </div>';
        $locations = '';
    endwhile;
    wp_reset_query();
    $productsCarousel .= '</div>';
    return $productsCarousel; 
      
}
add_shortcode('product_carousel', 'show_product_carousel');

//***************************************************************************************************/


// Products Carousel
function show_product_infinite_carousel($atts) {
    $allTerms = get_terms( 'product_cat', array( 'hide_empty' => false));
    $i=0;
    foreach($allTerms as $term){
        $i++;
        $terms [$i] = $term->slug;
    }
    extract(shortcode_atts(array(
        'number' => -1,
        'category' => $terms
        ), $atts));

    $productsQuery = new WP_Query([
        'orderby' => 'date', 
        'order' => 'DESC' ,
        'post_type'      => 'product',
        'posts_per_page' => $number,
        'post_status'    => 'publish',
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            ),
            array(
                'taxonomy' => 'product_visibility',
                'field' => 'slug',
                'terms' => $category,
                'operator' => 'IN',
            )
        )
    ]); 

   $productsInfiniteCarousel = '<div class="products-infinite-carousel">';

   while ( $productsQuery->have_posts() ) : $productsQuery->the_post();
       global $product;
        $productsInfiniteCarousel .= 
        '<div class="product-wrapper">
            <div class="product-content">
                <div class="products-carousel-img-wrapper"><img src="' . get_the_post_thumbnail_url($product->ID) .'" alt="'. get_the_title() .'"></div>
                <div class="overlay"></div>
                <h2 class="product-title">'. get_the_title() .'</h2>
                <a class="product-link" href="'. get_permalink() .'"></a>
            </div>
        </div>';

    endwhile;
    wp_reset_query();
    $productsInfiniteCarousel .= '</div>';
    return $productsInfiniteCarousel; 
}

add_shortcode('product_infinite_carousel', 'show_product_infinite_carousel');



// Shortcode Language Switcher
function custom_polylang_langswitcher() {
	$output = '';
	if ( function_exists( 'pll_the_languages' ) ) {
		$args   = [
			'show_flags' => 1,
			'show_names' => 0,
			'echo'       => 0,
            // 'hide_current' => false,
            // 'dropdown' => 1,
            // 'display_names_as'=>'slug'
		];
		$output = '<ul class="custom-polylang_langswitcher">'.pll_the_languages( $args ). '</ul>';
	}
	return $output;


}

add_shortcode( 'polylang_langswitcher', 'custom_polylang_langswitcher' );
    
?>