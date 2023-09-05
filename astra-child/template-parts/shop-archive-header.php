<?php
$bodyClasses = get_body_class(); 
$shop_header = get_field('archive_page_header', 'options');

// After Menu for ShopPage
if (in_array('post-type-archive-product',$bodyClasses) || in_array('tax-product_cat',$bodyClasses)) { ?>
<div class="woocommerce_before_main_content"  style="background-color: #e6e6e7;">
	<div class="content">
		<div class="left">
			<div class="title"><?php echo $shop_header['title']; ?></div>
			<div class="description"><?php echo $shop_header['subtitle']; ?></div>
			<div class="minidescription"><?php echo $shop_header["description"]; ?></div>
		</div>
		<div class="right"><img src="<?php echo $shop_header["image"]["sizes"]["large"]; ?>" alt="<?php echo $shop_header["image"]["alt"]; ?>"></div>
	</div>
</div>
<?php } 


// After Menu for SingleProduct
if (in_array('single-product',$bodyClasses)) { 
?>
<?php
$product_id = get_the_ID();
?>
<div class="after_header"  style="background-color: #001737;">
	<div class="content_product">
		<div class="left">
			<div class="title"><?php the_title(); ?></div>
			<div class="description">
				<?php 
					$currentProduct = wc_get_product();
					$shortDesc = $currentProduct->get_short_description();
					$desc = !empty($shortDesc) ? $shortDesc : strip_tags($currentProduct->get_description());
					$tags = !empty($shortDesc) ? '' : '...';
					echo implode(' ', array_slice(explode(' ', $desc), 0, 20)); echo $tags; 
				?>
			</div>
		</div>
		<div class="right">
			<?php
				if ( has_post_thumbnail() ) {
					$img_url = get_the_post_thumbnail_url(get_the_ID(), 'custom-size');
					echo '<img src="'.$img_url.'" class="custom-class">';
				}
			?>
		</div>
	</div>
</div>
<?php } ?>  