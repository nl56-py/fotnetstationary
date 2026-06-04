<?php
function woocommerce_template_loop_add_to_cart( $args = array() ) { 
    global $product; 

    if ( !empty($product) && method_exists($product, 'get_type')) {
        $defaults = array( 
            'quantity' => 1,  
            'class' => implode( ' ', array_filter(
                array(
                    'button',
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',  
                    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',  
                )
            )
        )); 
        $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product ); 
        wc_get_template( 'loop/add-to-cart.php', $args ); 
    } 
} 