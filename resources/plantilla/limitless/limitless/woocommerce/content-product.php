<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop,$helper,$ioa_meta_data;

if(!isset($ioa_meta_data['woo_height'])) $ioa_meta_data['woo_height'] = 400;
if(!isset($ioa_meta_data['woo_width'])) $ioa_meta_data['woo_width'] = 400;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>
	<i class="ioa-front-icon ok-2icon- icon-cart-added"></i>
	<span class="cart-loader"></span>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<a class='product-data' href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<?php 

			$id = get_post_thumbnail_id(get_the_ID());
		    $ar = wp_get_attachment_image_src( $id, array(9999,9999) );

			echo $helper->imageDisplay( array( "src"=> $ar[0] ,"height" =>  $ioa_meta_data['woo_height'] , "width" =>  $ioa_meta_data['woo_width'] , "parent_wrap" => false ) );   

		 ?>

		<h3><?php the_title(); ?></h3>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</li>