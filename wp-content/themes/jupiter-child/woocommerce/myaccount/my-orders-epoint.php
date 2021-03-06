<?php
/**
 * My Orders - Deprecated
 *
 * @deprecated 2.6.0 this template file is no longer used. My Account shortcode uses orders.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$my_orders_columns = apply_filters( 'woocommerce_my_account_my_orders_columns', array(
	'order-date'    => __( 'Date', 'woocommerce' ),
        'order-number'  => __( 'Order', 'woocommerce' ),
	'order-point'   => __( 'Point', 'woocommerce'),
	//'order-total'   => __( 'Amount', 'woocommerce' ),
	//'order-status'  => __( 'Status', 'woocommerce' ),
	//'order-actions' => '&nbsp;',
) );

$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => $order_count,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => array_keys( wc_get_order_statuses() ),
        
) ) );

if ( $customer_orders ) { ?>

	<h2><?php //echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent orders', 'woocommerce' ) ); ?></h2>

        <table class="shop_table shop_table_responsive my_account_orders" >

		<thead >
			<tr>
				<?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
					<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ( $customer_orders as $customer_order ) :
                              // print_r($customer_order);
				$order      = wc_get_order( $customer_order );
                              // print_r($order);
				$item_count = $order->get_item_count();
                                
                               

// The loop to get the order items which are WC_Order_Item_Product objects since WC 3+
foreach( $order->get_items() as $item_id => $item_product ){
    //Get the product ID
    $item_product->get_product_id();
    //Get the WC_Product object
    //echo '<p>hhhh'.get_the_term_list( $item_product->get_product_id(), 'product_cat').'</p>';
    $product_term=get_the_term_list( $item_product->get_product_id(), 'product_cat');
    //echo $product_term;
  //  $item_product->get_product();
    
   if (strpos($product_term, 'E分卡') !== false) {
   //echo 'true';




                                
                                
				?>
				<tr class="order">
					<?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
						<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>" >
							<?php 
                                                        
                                                      
                                                         // echo get_the_category($order->id);  //$order->get_category();
                                                        if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
									<?php echo _x( '', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
							<?php 
								$date_val = wc_format_datetime( $order->get_date_created() );
								//echo "RR".$date_val;
								//$originalDate = "2010-03-21";
								$newDate = date("m/d/Y", strtotime($date_val));
								//echo "  New".$newDate;
							?>
							
							
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo $newDate; ?></time>

							<?php //elseif ( 'order-status' === $column_id ) : ?>
								<?php //echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
								
								
							<?php elseif ( 'order-point' === $column_id ) : ?>
								<?php							
								$order_id = $order->id;
								$earn_points = get_post_meta( $order_id , '_wc_points_earned', true );
								if ($earn_points){
									echo $earn_points;
								}

								?>			

							<?php// elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								//printf( _n( '%1$s ', '%1$s ', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );
								//printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );
								?>

							<?php// elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								//$actions = wc_get_account_orders_actions( $order );
								
								//if ( ! empty( $actions ) ) {
								//	foreach ( $actions as $key => $action ) {
								//		echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
								//	}
								//}
								?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
<?php }} endforeach; ?>
		</tbody>
	</table>
<?php }
else
{
?>
<h2><?php //echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent orders', 'woocommerce' ) ); ?></h2>
<style>
    .blank-tb tr td
    {
        font-size: 20px !important;
    }
</style>
        <table class="shop_table shop_table_responsive my_account_orders" >

		<thead >
			<tr>
				<?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
					<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody class="blank-tb">
                    <tr>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                     <tr>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                     <tr>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                     <tr>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                     <tr>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                     <tr>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                     <tr>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                    </tr>
                    
                   
                     
                    </tbody>
	</table>
        
        <?php }?>

        

