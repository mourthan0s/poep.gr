	<?php
	/**
	 * The template for displaying the footer.
	 *
	 * Contains the closing of the #content div and all content after.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Astra
	 * @since 1.0.0
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	?>
	<?php astra_content_bottom(); ?>
		</div> <!-- ast-container -->
		</div><!-- #content -->

		<?php 
		do_action( 'before_footer' );
		$aboveFooterLogo = get_field('poep_logo', 'options');
		$aboveFooter = get_field('boxes', 'options'); 
		if(!empty($aboveFooter)) { ?>
			<section class="above-footer-section">	
				<div class="inner">
					<div class="elementor-column elementor-col-30 elementor-top-column elementor-element elementor-element-e2a173e column_shadow" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<img src="<?php echo $aboveFooterLogo["sizes"]["medium"] ?>" class="above-footer-img" alt="<?php echo $aboveFooterLogo["alt"] ?>">
					</div>
					<?php $i=1; foreach ($aboveFooter as $box) { ?> 
					<div class="elementor-column elementor-col-30 elementor-top-column elementor-element elementor-element-e2a173e column_shadow">
							<div class="above-footer-box">
								<div class="above-footer-icon"><img src="<?php echo $box["icon"]["sizes"]["large"];?>" alt="<?php echo $box["alt"];?>"></div>
								<div class="elementor-element elementor-widget elementor-widget-heading">
									<?php $name = 'BOX_TITLE' . $i;  $desc = 'BOX_DESCRIPTION' . $i;  ?>
									<div class="above-footer-section-title"><?php echo pll__( $name,'astra-child');?></div>
								</div>
								<div class="elementor-element elementor-widget elementor-widget-text-editor">
									<div class="above-footer-section-desc"><p><?php echo pll__( $desc,'astra-child');?></p></div> 
								</div>
							</div>
					</div>
					<?php $i++; } ?>
				</div>
			</section>
		<?php } ?>
		<div class="js-mobile-filter">
			<div class="js-mobile-filter-inner">
				<img class="show" src="<?php echo get_template_directory_uri();?>-child/images/filters.png" alt="Mobile Filters">
				<img src="<?php echo get_template_directory_uri();?>-child/images/close-popup-black.png" alt="filter close">
			</div>
		</div>
		<?php 
			astra_content_after();
				
			astra_footer_before();
				
			astra_footer();
				
			astra_footer_after(); 
		?>
			</div><!-- #page -->
		<?php 
			astra_body_bottom();    
			wp_footer(); 
		?>
	</body>

</html>
