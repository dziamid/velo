<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * ON-OFF Plugin Admin View
 *
 * @package    Yithemes
 * @author     Emanuela Castorina <emanuela.castorina@yithemes.it>
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

$id = $this->get_id_field( $option['id'] );
$name = $this->get_name_field( $option['id'] );

?>
<div id="<?php echo $id ?>-container" <?php if ( isset( $option['deps'] ) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $this->get_id_field( $option['deps']['ids'] ) ?>" data-value="<?php echo $option['deps']['values'] ?>" <?php endif ?> class="onoff_container yit_options rm_option rm_input rm_onoff">
    <div class="option">
        <input type="checkbox" name="<?php echo $name ?>" id="<?php echo $id ?>" value="<?php echo esc_attr( $db_value ) ?>" <?php checked( $db_value, 'yes' ); ?> class="on_off<?php if ( $db_value == 'yes' ): ?> onoffchecked<?php endif ?>" />
        <span>&nbsp;</span>
    </div>
    <span class="description"><?php echo $option['desc'] ?></span>
</div>

