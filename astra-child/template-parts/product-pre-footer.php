<?php
$bodyClasses = get_body_class(); 
$pre_footer = get_field('product_footer_section', 'options');

// Before Menu for Single Product
if (in_array('single-product', $bodyClasses)) { ?>
	<div class="pre_footer_purchase"  style="background-color: #001737;">
		<div class="purchase_product">
			<div class="left"><?php echo get_the_title(); ?></div>
			<div class="right">
				<div class="purchase js-scroll-to">
					<div class="purchase_text"><?php echo pll__('AGORA_TWRA','astra-child'); ?></div>
					<img class='slide_arrow' src='<?php echo get_template_directory_uri();?>-child/images/right.png'>
				</div>
				<div class="intresting popup-trigger js-form"><?php echo pll__('EKDILOSI_ENDIAFERONTOS','astra-child'); ?></div>
			</div>
		</div>
	</div>
	<div class="pre_footer_content" style="background-image: url('<?php echo $pre_footer["background_image"]["sizes"]["2048x2048"]; ?>'); background-attachment:fixed; background-position:center;">
		<div class="content">
			<div class="left">
				<div class="title"><?php echo $pre_footer['title']; ?></div>
				<div class="subtitle"><?php echo $pre_footer["description"]; ?></div>
			</div>
			<div class="right"><img src="<?php echo $pre_footer["image"]["sizes"]["large"]; ?>" alt="<?php echo $shop_header["background_image"]["alt"]; ?>"></div>
		</div>
	</div>
	<div class="recommended">
		<h1 class="seminars"><?php echo pll__('OTHER_SEMINARS','astra-child'); ?></h1>
		<p class="subseminars"></p>
		<?php echo do_shortcode('[product_carousel number="9"]'); ?>
	</div>
<?php } ?>