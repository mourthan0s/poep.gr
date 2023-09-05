<?php
$bodyClasses = get_body_class();
$shop_footer = get_field('archive_page_footer', 'options');

// Before Menu for Shop Page
if (in_array('post-type-archive-product',$bodyClasses) || in_array('tax-product_cat',$bodyClasses)) {  ?>
<div class="shop-after-loop-row"  style="background-attachment:fixed;background-image: url('<?php echo $shop_footer["background_image"]["sizes"]["2048x2048"]; ?>');">
	<div class="content">
		<div class="left">
			<div class="title"><?php echo pll__('ARCHIVE_FOOTER_TITLE','astra-child'); ?></div>
			<div class="subtitle"><?php echo pll__('ARCHIVE_FOOTER_DESC','astra-child'); ?></div>
		</div>
		<div class="right"><img src="<?php echo $shop_footer["image"]["sizes"]["large"]; ?>" alt="<?php echo $shop_header["background_image"]["alt"]; ?>"></div>
	</div>		
</div>
<?php } ?>