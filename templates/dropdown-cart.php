<div class="cart-header">
  <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
    <span class="icon icon-basket"></span>
    <span class="cart-count-total">
    <?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
    </span>
  </a>

  <div class="cart-dropdown">
    <div class="cart-dropdown-inner">
      <?php $items = WC()->cart->get_cart();

    if ($items) { ?>
      <h4>Shopping Bag</h4>

      <?php foreach($items as $item => $values) { 
        $_product = $values['data']->post; ?>
        
        <div class="dropdown-cart-wrap">
          <div class="dropdown-cart-left">
            <?php echo get_the_post_thumbnail( $values['product_id'], 'thumbnail' ); ?>
          </div>

          <div class="dropdown-cart-right">
            <h5><?php echo $_product->post_title; ?></h5>
            <p>Quantity: <?php echo $values['quantity']; ?></p>
            <p>Price: £ <?php echo get_post_meta($values['product_id'] , '_price', true); ?></p>
          </div>

          <div class="clear"></div>
        </div>
      <?php } ?>

      <div class="dropdown-cart-wrap">
        <div class="dropdown-cart-left">
          <h6>Subtotal</h6>
        </div>

        <div class="dropdown-cart-right">
          <h6><?php echo WC()->cart->get_cart_total(); ?></h6>
        </div>

        <div class="clear"></div>
      </div>

      <div class="dropdown-cart-wrap dropdown-cart-last">
        <div class="dropdown-cart-left dropdown-cart-link">
          <a href="/cart/">View Basket</a>
        </div>

        <div class="dropdown-cart-right dropdown-checkout-link">
          <a href="/checkout/">Checkout</a>
        </div>

        <div class="clear"></div>
      </div>
    <?php } else { ?>
      <h4>Shopping Bag</h4>

      <div class="dropdown-cart-wrap">
        <p>Your cart is empty.</p>
      </div>

      <div class="dropdown-cart-wrap">
        <div class="dropdown-cart-left">
          <h6>Subtotal</h6>
        </div>

        <div class="dropdown-cart-right">
          <h6><?php echo WC()->cart->get_cart_total(); ?></h6>
        </div>

        <div class="clear"></div>
      </div>

      <div class="dropdown-cart-wrap dropdown-cart-last">
        <div class="dropdown-cart-left dropdown-cart-link">
          <a href="/cart/">View Basket</a>
        </div>

        <div class="dropdown-cart-right dropdown-checkout-link">
          <a href="/checkout/">Checkout</a>
        </div>

        <div class="clear"></div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>
