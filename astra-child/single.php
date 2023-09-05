<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
$postCategories = get_the_terms(get_the_ID(), 'category');

if ( $postCategories[0]->slug == "oi-anthropoi-mas" ||  $postCategories[0]->slug == "our-people" ) {
    get_template_part('oi-anthropoi-mas');
} else { ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

		<?php astra_content_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div>

<?php } 
get_footer(); ?>