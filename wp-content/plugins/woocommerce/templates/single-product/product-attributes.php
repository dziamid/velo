<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wpdb;

$has_row    = false;
$alt        = 1;
$attributes = $product->get_attributes();

$keys = array_keys($attributes);
$keys = array_map(function ($key) {
	return '"' + preg_replace("/^pa_/", '', $key) + '"';
}, $keys);

$keysList = join(', ', $keys);

$query = "SELECT t.attribute_name, t.attribute_label, s.id as section_id, s.name as section_name
			FROM `wp_woocommerce_attribute_section` as s
			LEFT JOIN `wp_woocommerce_attribute_taxonomies` AS t ON (t.attribute_section = s.id)
			WHERE t.attribute_name IN ($keysList)
			ORDER BY s.id";

$results = $wpdb->get_results($query);
$sections = array();
foreach ($results as $result) {
	$section = $result->section_name;
	if (!isset($sections[$section])) {
		$sections[$section] = array();
	}

	$sections[$section][] = $result;
}

ob_start();
?>
<table class="shop_attributes">

	<?php if ( $product->enable_dimensions_display() ) : ?>

		<?php if ( $product->has_weight() ) : $has_row = true; ?>
			<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
				<th><?php _e( 'Weight', 'woocommerce' ) ?></th>
				<td class="product_weight"><?php echo $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $product->has_dimensions() ) : $has_row = true; ?>
			<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
				<th><?php _e( 'Dimensions', 'woocommerce' ) ?></th>
				<td class="product_dimensions"><?php echo $product->get_dimensions(); ?></td>
			</tr>
		<?php endif; ?>

	<?php endif; ?>

	<?php foreach ( $sections as $sectionName => $sectionAttributes):
		?>
		<tr class="section">
			<th><?php echo $sectionName ?></th>
		</tr>
		<?php foreach ($sectionAttributes as $sectionAttribute):
			$attribute = $attributes['pa_' . $sectionAttribute->attribute_name];
		if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
			continue;
		} else {
			$has_row = true;
		}
		?>
		<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
			<th><?php echo wc_attribute_label( $attribute['name'] ); ?></th>
			<td><?php
				if ( $attribute['is_taxonomy'] ) {

					$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				} else {

					// Convert pipes to commas and display values
					$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				}
			?></td>
		</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>

</table>
<?php
if ( $has_row ) {
	echo ob_get_clean();
} else {
	ob_end_clean();
}