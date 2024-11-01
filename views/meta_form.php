<?php

wp_nonce_field(basename(__FILE__), "meta-box-nonce");
$screen = get_current_screen();

if (get_option('wpetracker_mod_id') != $object->ID) {
    update_option('wpetracker_area_class', get_post_meta($object->ID, "wpetracker-area", true));
}

$i = 'false';
$screen = get_current_screen();

if ($screen->post_type == 'page') {

    foreach (get_option('wpetracker_opt_val_page') as $key) {
        if (get_the_title() == $key) {
            $i = 'true';
            break;
        }
    }

} else {

    $i = 'false';

    if(!is_array(get_option('wpetracker_opt_val_cat')))
        $opt = json_decode(get_option('wpetracker_opt_val_cat'));
    else
        $opt = get_option('wpetracker_opt_val_cat');

    $tax = get_post_taxonomies();
    if (is_array($tax) && is_array($opt)) {

        foreach ($tax as $t) {
            foreach ($opt as $o) {
                

                if ($o->option == $t) {
                    $i = 'true';
                    break;
                }
            }
        }

    }

}


if (get_option('auto_update_option') == 'on' && $i != 'true') {
    wp_update_post(get_post());
}

?>

<div id="my_form">
    <table class="m_table">
        
        <tr>
            <td>
            	<label><b><?php _e('Pagename:', 'wpetracker'); ?></b></label>
            </td>
            <td id="inp">
            	<input name="page" type="text" value="<?php if($screen->action != 'add') echo get_post_meta($object->ID, "wpetracker-page", true); ?>" />
            </td>
        </tr>

        <tr>
            <td>
            	<label><b><?php _e('Area:', 'wpetracker'); ?></b></label>
            </td>
            <td id="inp">
            	<input name="area" type="text" value="<?php if($screen->action != 'add') { $s = get_post_meta($object->ID, "wpetracker-area", true); } ?>" />
            </td>
        </tr>

        <tr>
            <td>
            	<label><b><?php _e('Browselinks:', 'wpetracker'); ?></b></label>
            </td>
            <td id="inp">
            	<input name="url" type="text" value="<?php if ($screen->action != 'add') echo the_permalink(); ?>" readonly="readonly" />
            </td>
        </tr>

    </table>
</div>


<script type="text/javascript">
    window.onload = function () {
        jQuery(function($) {

            setTimeout(function () {

                var _TAGS = "<?php echo $s;?>";

                $('input[name="area"]').val(_TAGS.trim() + ' ');

            }, 100);

            if (!localStorage.justOnce) {
                localStorage.setItem("justOnce", "true");
                window.location.reload();
            }

        });
    }
</script>