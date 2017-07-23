<?php
/*
PLUGIN NAME: Add Action Hooks

DESCRIPTION: Add action hooks and filters to Woocommerce products. This plugin requires Woocommerce to be installed and activated. And other customizations.
AUTHOR: Joseph Reilly
AUTHOR URI: https://github.com/Jreilly8
VERSION: 0.1 &beta;
*/

/*
Add Action Hooks
by Joseph Reilly
Add action hooks and filters to Woocommerce products. This plugin requires Woocommerce to be installed and activated. And other customizations.

*/

//No public access!
if ( ! defined( 'ABSPATH' ) ) // Or some other WordPress constant
     exit;

// Check woocommerce plugin is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

 // Function for promo added to product page
	function aah_promo_text(){
	echo '<div class="promos">20% Off First Purchase! Coupon Code: <input type="text" id="coupon" value="WOW-ME-16" readonly><button id="button2" data-copytarget="#coupon">copy</button></div>';	
}

// Add action hook that executes promo function
	add_action('woocommerce_before_single_product','aah_promo_text');

    // Function for buttons added to product page
	function aah_view_cart_text(){	    
	    echo do_shortcode( '[sg_popup id=3]<button class="btn-success resp-tab-item"><i class="fa fa-support"></i> TEXT</button>[/sg_popup]' );
      echo do_shortcode( '[sg_popup id=5]<button class="btn-info resp-tab-item"><i class="fa fa-edit "></i> TEXT</button>[/sg_popup]' );
      echo do_shortcode( '[sg_popup id=4]<button class="btn-warning resp-tab-item"><i class="fa fa-truck "></i> TEXT</button>[/sg_popup]' ); 	    	
  }

	// Add action hook that executes button function
	add_action('woocommerce_product_meta_end','aah_view_cart_text');

  // Function to echo shipping message
  function aah_ships_text(){
        echo '<i class="fa  fa-rocket" aria-hidden="true" style="margin-top:6px;color:#3273f4;">TEXT</i>';
        echo '<i class="fa  fa-money" aria-hidden="true" style="margin-top:6px;color:#216C2A;"> TEXT</i>';              
  }

  // Add action hook that executes shipping message function
  add_action('woocommerce_share','aah_ships_text');

  //Function to add phone number to end of product price
	function ahh_custom_sales_price( $price, $product ) {
		if ( is_product() ) {
			return $price . sprintf( __('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="product-phone"><a class="pro-phone" href="tel:#"><i class="fa fa-phone"></i>&nbsp;(916) #</a></span>', 'woocommerce' ) );
		}
	}

  // Add filter hook that adds phone number to end of price
  add_filter( 'woocommerce_get_price_html', 'ahh_custom_sales_price', 10, 2 );

  // Function to get the absolute path to this plugin directory for importing WooCommerce product layout
  function aah_plugin_path() { 
    return untrailingslashit( plugin_dir_path( __FILE__ ) ); 
  } 

  //Function to find the available Woocommerce product layout in the plugin folder
  function aah_woocommerce_locate_template( $template, $template_name, $template_path ) {
   
    global $woocommerce; 
   
    $_template = $template;
   
    if ( ! $template_path ) $template_path = $woocommerce->template_url;
   
    $plugin_path  = aah_plugin_path() . '/woocommerce/'; 
   
   
    // Look within passed path within the theme - this is priority
   
    $template = locate_template(
   
      array(
   
        $template_path . $template_name,
   
        $template_name
   
      )
   
    );
    
    // Modification: Get the template from this plugin, if it exists
   
    if ( ! $template && file_exists( $plugin_path . $template_name ) )
   
      $template = $plugin_path . $template_name; 
   
    // Use default template 
    if ( ! $template )
   
      $template = $_template;
   
   
   
    // Return what we found 
    return $template;
   
  }
  // Add filter hook that imports WooCommerce product layout
  add_filter( 'woocommerce_locate_template', 'aah_woocommerce_locate_template', 10, 3 ); 
  //Allow Duplicate SKU's
  add_filter( 'wc_product_has_unique_sku', '__return_false', PHP_INT_MAX );
}
 
?>