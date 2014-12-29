<?php if(isset($cart_messages) && count($cart_messages) > 0) { ?>
	<?php foreach((array)$cart_messages as $cart_message) { ?>
	  <span class="cart_message"><?php echo esc_html( $cart_message ); ?></span>
	<?php } ?>
<?php } ?>

<?php if(wpsc_cart_item_count() > 0): ?>
    <div class="shoppingcart">
	<table>
		<thead>
			<tr>
				<th id="product" colspan='2'><?php _e('<center>Товар</center>', 'wpsc'); ?></th>
				<th id="quantity"><?php _e('<center>Кол.</center>', 'wpsc'); ?></th>
				<th id="price"><?php _e('<center>Цена</center>', 'wpsc'); ?></th>
	           		 <th id="remove"><?php _e('<center>-</center>', 'wpsc'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php while(wpsc_have_cart_items()): wpsc_the_cart_item(); ?>
			<tr>
					<td colspan='2' class='product-name'><?php do_action ( "wpsc_before_cart_widget_item_name" ); ?><a href="<?php echo wpsc_cart_item_url(); ?>"><?php echo wpsc_cart_item_name(); ?></a><?php do_action ( "wpsc_after_cart_widget_item_name" ); ?></td>
					<td><?php echo wpsc_cart_item_quantity(); ?></td>
					<td><?php echo wpsc_cart_item_price(); ?></td>
                    <td class="cart-widget-remove"><form action="" method="post" class="adjustform">
					<input type="hidden" name="quantity" value="0" />
					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
					<input type="hidden" name="wpsc_update_quantity" value="true" />
					<center><input class="remove_button" type="submit"/></center>
				</form></td>
			</tr>	
		<?php endwhile; ?>
		</tbody>


<style>
input.remove_button
{
  background: url("delete.png");
  border:medium none;
  height:24px;
  margin:0;
  padding:0 0 4px;

  
}
input.remove_button:hover
{

background: url("delete.png") no-repeat;
border:medium none;
  height:16px;
  margin:0;
  padding:0 0 4px;
   height: 
  
 
}


</style>
		<tfoot>
			<tr class="cart-widget-total">
				<td class="cart-widget-count">
					<?php printf( _n('%d item', '%d items', wpsc_cart_item_count(), 'wpsc'), wpsc_cart_item_count() ); ?>
				</td>
				<td class="pricedisplay checkout-total" colspan='4'>
					<?php _e('Сумма', 'wpsc'); ?>: <?php echo wpsc_cart_total_widget( false, false ,false ); ?><br />
					<small><?php _e( '', 'wpsc' ); ?></small>
				</td>
			</tr>
			<tr>
				<td id='cart-widget-links' colspan="5">
					<a target="_parent" href="<?php echo get_option('shopping_cart_url'); ?>" title="<?php _e('Оформить заказ', 'wpsc'); ?>" class="gocheckout"><?php _e('<b>Купить</b>', 'wpsc'); ?></a>
					<form action="" method="post" class="wpsc_empty_the_cart">
						<input type="hidden" name="wpsc_ajax_action" value="empty_cart" />
							<a target="_parent" href="<?php echo htmlentities(add_query_arg('wpsc_ajax_action', 'empty_cart', remove_query_arg('ajax')), ENT_QUOTES, 'UTF-8'); ?>" class="emptycart" title="<?php _e('Удалить заказ', 'wpsc'); ?>"><?php _e('Очистить', 'wpsc'); ?></a>                                                                                    
					</form>
				</td>
			</tr>
		</tfoot>
	</table>
	</div><!--close shoppingcart-->		
<?php else: ?>
	<p class="empty">
		<?php _e('Ваша корзина пуста', 'wpsc'); ?><br />
		<a target="_parent" href="http://veloman.by/velomagazin" class="visitshop" title="<?php _e('Посетите наш магазин', 'wpsc'); ?>"><?php _e('Посетите наш магазин', 'wpsc'); ?></a>	
	</p>
<?php endif; ?>

<?php
wpsc_google_checkout();


?>
