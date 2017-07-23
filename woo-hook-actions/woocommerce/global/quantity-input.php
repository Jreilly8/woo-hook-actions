<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="quantity">
  <input class="minus" type="button" value="-">
  <input type="text" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" />
  <input class="plus" type="button" value="+">
</div>
	<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.quantity').on('click', '.plus', function(e) {
            $input = $(this).prev('input.qty');
            var val = parseInt($input.val());
            $input.val( val+1 ).change();
        });
 
        $('.quantity').on('click', '.minus', 
            function(e) {
            $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 0) {
                $input.val( val-1 ).change();
            } 
        });
    });
    </script>
    <style>
    input[type="text"] {
    -moz-appearance: textfield !important;
}
.minus{
    border:none;
    color:#fff;
    background-color:#3273f4 !important;
    height:30px;
    width:30px;
}
.plus {
    border:none;
    color:#fff;
    background-color:#3273f4 !important;
    height:30px;
    width:30px;
}
.qty {
    border:1px solid #3273f4 !important;
    color:#3273f4;
    height:30px;
     
}
    </style>

