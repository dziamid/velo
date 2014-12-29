<?php
extract( $args );

$types = array(
    'text'     => __( 'Text Input', 'yit' ),
    'checkbox' => __( 'Checkbox', 'yit' ),
    'select'   => __( 'Select', 'yit' ),
    'textarea' => __( 'Textarea', 'yit' ),
    'radio'    => __( 'Radio Input', 'yit' ),
    'password' => __( 'Password Field', 'yit' ),
    'file'     => __( 'File Upload', 'yit' ),
);

$defaults = array(
    'order'           => 0,
    'title'           => '',
    'data_name'       => '',
    'type'            => 'text',
    'already_checked' => '',
    'options'         => array(),
    'option_selected' => '',
    'error'           => '',
    'required'        => '',
    'is_email'        => '',
    'reply_to'        => '',
    'class'           => '',
    'select-icon'     => 'none',
    'icon'            => '',
    'custom-icon'     => ''
);

if ( ! is_array( $value ) ) {
    $value = array();
}
foreach ( $value as $i => $v ) {
    $value[$i] = wp_parse_args( $value[$i], $defaults );
}

$index = 1;


/* Select Font Awesome */

$options["select"]=array(
    'icon'   => __( 'Theme Icon', 'yit' ),
    'custom' => __( 'Custom Icon', 'yit' ),
    'none'   => __( 'None', 'yit' )
);

$options["icon"] = YIT_Plugin_Common::get_awesome_icons();

/* End select Font Awesome */
?>


<p class="field-row">
    <a href="" class="button-secondary add-items"><?php _e( 'Add field', 'yit' ) ?></a>
    <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading" alt="" />
</p>


<div class="contactform_items panel" id="panel_form">
    <?php while ( $index <= count( $value ) ): ?>
        <div class="contactform_item closed">
            <h3>
                <button type="button" class="remove_item button" rel=""><?php _e( 'Remove', 'yit' ) ?></button>
                <div class="handlediv" title="<?php _e( 'Click to toggle', 'yit' ) ?>"></div>
                <strong><?php echo $value[$index]['title'] ?> <?php yit_string( '(', $types[$value[$index]['type']], ')' ) ?></strong>
                <input type="hidden" class="contactform_menu_order" name="<?php echo $name ?>[<?php echo $index ?>][order]" value="<?php echo $index ?>" />
            </h3>
            <div class="inside">

                <div class="the-metabox text clearfix">
                    <label for="<?php echo $id ?>_title_<?php echo $index ?>"><?php _e( 'Title Field', 'yit' ) ?></label>

                    <p>
                        <input type="text" value="<?php echo $value[$index]['title'] ?>" id="<?php echo $id ?>_title_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][title]" />
                        <span class="desc inline"><?php _e( 'Insert the title of field.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox text clearfix">
                    <label for="<?php echo $id ?>_data_name_<?php echo $index ?>"><?php _e( 'Data Name', 'yit' ) ?></label>

                    <p>
                        <input type="text" value="<?php echo $value[$index]['data_name'] ?>" id="<?php echo $id ?>_data_name_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][data_name]" />
                        <span class="desc inline"><?php _e( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. <strong>Note:</strong>Use only lowercase characters and underscores.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox select clearfix text-field-type">
                    <label for="<?php echo $id ?>_type_<?php echo $index ?>"><?php _e( 'Type field', 'yit' ) ?></label>

                    <p>
                        <select id="<?php echo $id ?>_type_<?php echo $index ?>" name="<?php echo $name . '[' . $index . ']' ?>[type]">
                            <?php foreach ( $types as $type => $name_type ) : ?>
                                <option value="<?php echo $type ?>"<?php selected( $type, $value[$index]['type'] ) ?>><?php echo $name_type ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="desc inline"><?php _e( 'Select the type of this field.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox checkbox clearfix deps_checkbox deps">
                    <label for="<?php echo $id ?>_already_checked_<?php echo $index ?>"><?php _e( 'Checked', 'yit' ) ?></label>

                    <p>
                        <input type="checkbox" id="<?php echo $id ?>_already_checked_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][already_checked]" value="1"<?php checked( $value[$index]['already_checked'] ) ?> />
                        <span class="desc inline"><?php _e( 'Select this if you want this field already checked.', 'yit' ) ?></span>
                    </p>
                </div>

                <div id="<?php echo $id ?>_addoptions" class="the-metabox addoptions clearfix deps_radio deps_select deps">
                    <label for=""><?php _e( 'Add options ', 'yit' ) ?></label>
                    <a href="#" class="add-field-option button-secondary" data-index="<?php echo $index ?>"><?php _e( 'Add option', 'yit' ) ?></a><br /><br />
                    <?php foreach ( $value[$index]['options'] as $key => $option ) : ?>
                        <p class="option">
                            <label><input type="radio" name="<?php echo $name ?>[<?php echo $index ?>][option_selected]" value="<?php echo $key ?>"<?php checked( $value[$index]['option_selected'], $key ) ?> /> <?php _e( 'Selected', 'yit' ) ?>
                            </label>
                            <input type="text" name="<?php echo $name ?>[<?php echo $index ?>][options][]" value="<?php echo $option ?>" style="width:200px" />
                            <a href="#" class="del-field-option button-secondary"><?php _e( 'Delete option', 'yit' ) ?></a>
                        </p>
                    <?php endforeach; ?>
                </div>

                <div class="the-metabox text clearfix">
                    <label for="<?php echo $id ?>_error_<?php echo $index ?>"><?php _e( 'Message Error', 'yit' ) ?></label>

                    <p>
                        <input type="text" value="<?php echo $value[$index]['error'] ?>" id="<?php echo $id ?>_error_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][error]" />
                        <span class="desc inline"><?php _e( 'Insert the error message for validation.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox checkbox clearfix">
                    <label for="<?php echo $id ?>_required_<?php echo $index ?>"><?php _e( 'Required', 'yit' ) ?></label>

                    <p>
                        <input type="checkbox" id="<?php echo $id ?>_required_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][required]" value="1"<?php checked( $value[$index]['required'] ) ?> />
                        <span class="desc inline"><?php _e( 'Select this if it must be required.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox checkbox clearfix">
                    <label for="<?php echo $id ?>_is_email_<?php echo $index ?>"><?php _e( 'Email', 'yit' ) ?></label>

                    <p>
                        <input type="checkbox" id="<?php echo $id ?>_is_email_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][is_email]" value="1"<?php checked( $value[$index]['is_email'] ) ?> />
                        <span class="desc inline"><?php _e( 'Select this if it must be a valid email.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox checkbox clearfix">
                    <label for="<?php echo $id ?>_reply_to_<?php echo $index ?>"><?php _e( 'Reply To', 'yit' ) ?></label>

                    <p>
                        <input type="checkbox" id="<?php echo $id ?>_reply_to_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][reply_to]" value="1"<?php checked( $value[$index]['reply_to'] ) ?> />
                        <span class="desc inline"><?php _e( 'Select this if it\'s the email where you can reply.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox text clearfix">
                    <label for="<?php echo $id ?>_class_<?php echo $index ?>"><?php _e( 'Class', 'yit' ) ?></label>

                    <p>
                        <input type="text" value="<?php echo $value[$index]['class'] ?>" id="<?php echo $id ?>_class_<?php echo $index ?>" name="<?php echo $name ?>[<?php echo $index ?>][class]" />
                        <span class="desc inline"><?php _e( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox text clearfix">
                    <label for="<?php echo $id ?>_icon_<?php echo $index ?>"><?php _e( 'Icon', 'yit' ) ?></label>

                    <p>

                    <div class="option">

                        <div class="icon_type">
                            <select name="<?php echo $name ?>[<?php echo $index ?>][select-icon]" id="<?php echo $id ?>_icon_<?php echo $index ?>">
                                <?php foreach ( $options['select'] as $val => $option ) { ?>
                                    <option value="<?php echo $val ?>"<?php selected( $value[$index]['select-icon'], $val ) ?>><?php echo $option; ?></option>
                                <?php } ?>
                            </select>
                        </div>



                        <div class="awesome_icon" style="font-family: 'FontAwesome'">
                            <select style="font-family: 'FontAwesome'" name="<?php echo $name ?>[<?php echo $index ?>][icon]" id="<?php echo $id ?>_icon_<?php echo $index ?>[icon]">
                                <?php foreach ( $options['icon'] as $option => $val ) { ?>
                                    <option value="<?php echo $val ?>"<?php selected( $value[$index]['icon'], $val ); ?>>
                                        <?php echo '&#x' . $option . '; ' . $val; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="input_wrapper custom_icon">
                            <input type="text" name="<?php echo $name ?>[<?php echo $index ?>][custom]" id="<?php echo $id ?>_icon_<?php echo $index ?>[custom-icon]" value="<?php echo $value[$index]['custom']; ?>" class="upload_img_url upload_custom_icon" />
                            <input type="button" name="<?php echo $name ?>[<?php echo $index ?>][custom]-button" value="<?php _e( 'Upload', 'yit' ) ?>" id="<?php echo $id ?>_icon_<?php echo $index ?>[custom-icon]-button" class="upload_button button" />

                            <div class="upload_img_preview" style="margin-top:10px;">
                                <?php
                                $file = $current_options['custom'];
                                if ( preg_match( '/(jpg|jpeg|png|gif|ico)$/', $file ) ) {
                                    echo __('Image preview', 'yit') . ': ' . "<img src=\"" . YIT_CORE_ASSETS_URL . "/images/sleep.png\" data-src=\"$file\" />";
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                        <span class="desc inline"><?php _e( 'Insert an icon for more personalization.', 'yit' ) ?></span>
                    </p>
                </div>

                <div class="the-metabox text clearfix">
                    <label for="<?php echo $id ?>_width_<?php echo $index ?>"><?php _e( 'Width', 'yit' ) ?></label>

                    <p>
                        <select id="<?php echo $id ?>_width_<?php echo $index ?>" name="<?php echo $name . '[' . $index . ']' ?>[width]">
                            <?php
                            for ( $i = 1; $i < 13; $i ++ ) {
                                ?>
                                <option value="col-sm-<?php echo $i ?>"
                                    <?php
                                    if ( isset( $value[$index]['width'] ) ) {
                                        selected( 'col-sm-' . $i, $value[$index]['width'] );
                                    }
                                    else {
                                        if ( $value['type'] == 'textarea' ) {
                                            selected( 'col-sm-' . $i, 'col-sm-9' );
                                        }
                                        else {
                                            selected( 'col-sm-' . $i, 'col-sm-3' );
                                        }
                                    }
                                    ?>><?php echo $i ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <span class="desc inline"><?php _e( 'Choose how much long will be the field.', 'yit' ) ?></span>
                    </p>
                </div>
            </div>
        </div>
        <?php
        $index ++;
    endwhile;
    ?>

</div>

<div class="contactform_item closed" id="stamp_form" style="display:none;">
    <h3>
        <button type="button" class="remove_item button" rel=""><?php _e( 'Remove', 'yit' ) ?></button>
        <div class="handlediv" title="<?php _e( 'Click to toggle', 'yit' ) ?>"></div>
        <strong></strong>
        <input disabled type="hidden" class="contactform_menu_order" name="<?php echo $name ?>[][order]" value=""/>
    </h3>
    <div class="inside">

        <div class="the-metabox text clearfix">
            <label for="<?php echo $id ?>_title"><?php _e( 'Title Field', 'yit' ) ?></label>

            <p>
                <input disabled type="text" value="" id="<?php echo $id ?>_title" name="<?php echo $name ?>[][title]" />
                <span class="desc inline"><?php _e( 'Insert the title of field.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox text clearfix">
            <label for="<?php echo $id ?>_data_name"><?php _e( 'Data Name', 'yit' ) ?></label>

            <p>
                <input disabled type="text" value="" id="<?php echo $id ?>_data_name" name="<?php echo $name ?>[][data_name]" />
                <span class="desc inline"><?php _e( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. <strong>Note:</strong>Use only lowercase characters and underscores.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox select clearfix text-field-type">
            <label for="<?php echo $id ?>_type"><?php _e( 'Type field', 'yit' ) ?></label>

            <p>
                <select disabled id="<?php echo $id ?>_type" name="<?php echo $name ?>[][type]">
                    <?php foreach ( $types as $type => $name_type ) : ?>
                        <option value="<?php echo $type ?>"><?php echo $name_type ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="desc inline"><?php _e( 'Select the type of this field.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox checkbox clearfix deps_checkbox deps">
            <label for="<?php echo $id ?>_already_checked"><?php _e( 'Checked', 'yit' ) ?></label>

            <p>
                <input disabled type="checkbox" id="<?php echo $id ?>_already_checked" name="<?php echo $name ?>[][already_checked]" value="1" />
                <span class="desc inline"><?php _e( 'Select this if you want this field already checked.', 'yit' ) ?></span>
            </p>
        </div>

        <div id="<?php echo $id ?>_addoptions" class="the-metabox addoptions clearfix deps_radio deps_select deps">
            <label for=""><?php _e( 'Add options ', 'yit' ) ?></label>
            <a href="#" class="add-field-option button-secondary"><?php _e( 'Add option', 'yit' ) ?></a><br /><br />

                <p class="option">
                    <label><input disabled type="radio" name="<?php echo $name ?>[][option_selected]" value="" /> <?php _e( 'Selected', 'yit' ) ?>
                    </label>
                    <input disabled type="text" name="<?php echo $name ?>[][options][]" value="" style="width:200px" />
                    <a href="#" class="del-field-option button-secondary"><?php _e( 'Delete option', 'yit' ) ?></a>
                </p>

        </div>

        <div class="the-metabox text clearfix">
            <label for="<?php echo $id ?>_error"><?php _e( 'Message Error', 'yit' ) ?></label>

            <p>
                <input disabled type="text" value="" id="<?php echo $id ?>_error" name="<?php echo $name ?>[][error]" />
                <span class="desc inline"><?php _e( 'Insert the error message for validation.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox checkbox clearfix">
            <label for="<?php echo $id ?>_required"><?php _e( 'Required', 'yit' ) ?></label>

            <p>
                <input disabled type="checkbox" id="<?php echo $id ?>_required" name="<?php echo $name ?>[][required]" value="1" />
                <span class="desc inline"><?php _e( 'Select this if it must be required.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox checkbox clearfix">
            <label for="<?php echo $id ?>_is_email"><?php _e( 'Email', 'yit' ) ?></label>

            <p>
                <input disabled type="checkbox" id="<?php echo $id ?>_is_email" name="<?php echo $name ?>[][is_email]" value="1" />
                <span class="desc inline"><?php _e( 'Select this if it must be a valid email.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox checkbox clearfix">
            <label for="<?php echo $id ?>_reply_to"><?php _e( 'Reply To', 'yit' ) ?></label>

            <p>
                <input disabled type="checkbox" id="<?php echo $id ?>_reply_to" name="<?php echo $name ?>[][reply_to]" value="1" />
                <span class="desc inline"><?php _e( 'Select this if it\'s the email where you can reply.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox text clearfix">
            <label for="<?php echo $id ?>_class"><?php _e( 'Class', 'yit' ) ?></label>

            <p>
                <input disabled type="text" value="" id="<?php echo $id ?>_class" name="<?php echo $name ?>[][class]" />
                <span class="desc inline"><?php _e( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'yit' ) ?></span>
            </p>
        </div>

        <div class="the-metabox text clearfix">
            <label for="<?php echo $id ?>_icon"><?php _e( 'Icon', 'yit' ) ?></label>

            <div class="option">

                <div class="icon_type">
                    <select disabled name="<?php echo $name ?>[][select-icon]" id="<?php echo $id ?>_icon">
                        <?php foreach ( $options['select'] as $val => $option ) { ?>
                            <option value="<?php echo $val ?>"><?php echo $option; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="awesome_icon" style="font-family: 'FontAwesome'">
                    <select disabled style="font-family: 'FontAwesome'" name="<?php echo $name ?>[][icon]" id="<?php echo $id ?>_icon[icon]">
                        <?php foreach ( $options['icon'] as $option => $val ) { ?>
                            <option value="<?php echo $val ?>">
                                <?php echo '&#x' . $option . '; ' . $val; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="input_wrapper custom_icon">
                    <input disabled type="text" name="<?php echo $name ?>[][custom]" id="<?php echo $id ?>_icon[custom-icon]" value="" class="upload_img_url upload_custom_icon" />
                    <input disabled type="button" name="<?php echo $name ?>[][custom]-button" value="<?php _e( 'Upload', 'yit' ) ?>" id="<?php echo $id ?>_icon[custom-icon]-button" class="upload_button button" />

                    <div class="upload_img_preview" style="margin-top:10px;">
                        <?php
                        $file = '';
                        if ( preg_match( '/(jpg|jpeg|png|gif|ico)$/', $file ) ) {
                            echo __('Image preview', 'yit') . ': ' . "<img src=\"" . YIT_CORE_ASSETS_URL . "/images/sleep.png\" data-src=\"$file\" />";
                        }
                        ?>
                    </div>

                </div>
            </div>

            <span class="desc inline"><?php _e( 'Insert an icon for more personalization.', 'yit' ) ?></span>
        </div>

        <div class="the-metabox text clearfix">
            <label for="<?php echo $id ?>_width"><?php _e( 'Width', 'yit' ) ?></label>

            <p>
                <select disabled id="<?php echo $id ?>_width" name="<?php echo $name?>[][width]">
                    <?php
                    for ( $i = 1; $i < 13; $i ++ ) {
                        ?>
                        <option value="col-sm-<?php echo $i ?>"> <?php echo $i ?> </option>
                    <?php
                    }
                    ?>
                </select>
                <span class="desc inline"><?php _e( 'Choose how much long will be the field.', 'yit' ) ?></span>
            </p>
        </div>
    </div>
</div>

<script>

    var index = <?php echo $index ?>;

    jQuery(document).ready(function ($) {

        $(document).on('click', '#<?php echo $id ?>_addoptions .add-field-option', function(){
            var select_index = $(this).data('index');
            var option = "<p class='option'><label><input type='radio' name='<?php echo $name ?>[option_selected]' value='' /> <?php _e( 'Selected', 'yit' ) ?></label><input type='text' name='<?php echo $name ?>[" + select_index + "][options][]' style='width:200px' /> <a href='#' class='del-field-option button-secondary'><?php _e( 'Delete option', 'yit' ) ?></a></p>";

            $(option).appendTo( $(this).parents('#<?php echo $id ?>_addoptions') );
            return false;
        });

        //toggle items
        $(document).on('click', '.contactform_item h3, .contactform_item .handlediv', function () {
            var p = $(this).parent('.contactform_item'), id = p.attr('id');
            p.toggleClass('closed');

            if (!p.hasClass('closed')) {
                p.find('.inside').show();
            } else {
                p.find('.inside').hide();
            }

        });

        //add item
        $(".add-items").click(function () {


            var a = $("#stamp_form").clone();
            a.appendTo("#panel_form").attr("id", "").show();

            a.find("input, select").each(function(){
               $(this).prop('disabled', false);
               var str = $(this).attr("name");

               var nam = str.replace("[]","["+ index +"]");
               $(this).attr("name", nam );
            });

            index++;

            $('body').trigger('yit_contact_form_added_item');

            return false;
        });

        //remove item
        $(document).on('click', '.remove_item', function () {
            if ($('.remove_item').length > 1) {
                var str = $(this).parents('.contactform_item').find("input:first-child").attr("name").match( /(.*)\[(.*)\](.*)\[(.*)\]/ );

                var i = parseInt(str[2]);

                $('.contactform_item:gt('+ --i +')').find("input, select").each(function(){
                    var str = $(this).attr("name").match( /(.*)\[(.*)\](.*)\[(.*)\]/ );
                    var indice = parseInt(str[2]);
                    var nam = $(this).attr('name').replace("[" + indice + "]", "[" + --indice + "]");
                    $(this).attr("name", nam );
                });

                $(this).parents('.contactform_item').remove();

                index--;

                $('body').trigger('yit_contact_form_removed_item');
            }

            return false;
        });

        //sortable
        $('.contactform_items').sortable({
            items:'.contactform_item',
            cursor:'move',
            axis:'y',
            handle: 'h3',
            scrollSensitivity:60,
            forcePlaceholderSize: true,
            helper: 'clone',
            opacity: 0.65,
            placeholder: 'metabox-sortable-placeholder',
            start:function(event,ui){
                ui.item.css('background-color','#f6f6f6');
            },
            stop:function(event,ui){
                ui.item.removeAttr('style');


                variation_row_indexes();
            }
        });


        function variation_row_indexes() {
            $('.contactform_items .contactform_item').each(function(index){
                index++;
                $(this).find("input,select").each(function(){
                    var str = $(this).attr('name').match( /(.*)\[(.*)\](.*)\[(.*)\]/ );
                    var nam = $(this).attr('name').replace("[" +parseInt(str[2])+ "]", "[" +index+ "]");
                    $(this).attr('name', nam);
                });
            });
        }

        //
        var field_type_handler = function(){
            var this_item = $(this);
            $(this_item).on('change', '.text-field-type select', function(){
                var val = $(this).val();
                $('.deps', this_item).hide().filter(function(i){ return $(this).hasClass( 'deps_' + val ); }).show();
            });
            $('.text-field-type select').change();
        };
        $('.contactform_item').each(field_type_handler);


        //
        $(document).on('click', '.del-field-option', function(){
            if( $('.option').length > 1 ) {
                $(this).parents('.option').remove();
            }

            return false;
        });

    });
</script>
