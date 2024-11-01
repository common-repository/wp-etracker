<tr class="form-field">
    <th scope="row" valign="top">
    	<label for="term_meta[custom_term_meta]">
    		<?php _e('Pagename:', 'wpetracker'); ?>
    	</label>
    </th>
    <td>
        <input type="text" name="term_meta[et_pagename]" value="<?php echo esc_attr($term_meta['et_pagename']) ? esc_attr($term_meta['et_pagename']) : ''; ?>" />
        <p class="description">
        	<?php _e('Enter a value for this field leave blank for defaults', 'wpetracker'); ?>
        </p>
    </td>
</tr>

<tr class="form-field">
    <th scope="row" valign="top">
    	<label for="term_meta[custom_term_meta]">
    		<?php _e('Area Name:', 'wpetracker'); ?>
    	</label>
    </th>
    <td>
        <input type="text" name="term_meta[et_area]" value="<?php echo esc_attr($term_meta['et_area']) ? esc_attr($term_meta['et_area']) : ''; ?>" />
        <p class="description">
        	<?php _e('Enter a value for this field', 'wpetracker'); ?>
        </p>
    </td>
</tr>

<tr class="form-field">
    <th scope="row" valign="top">
    	<label for="term_meta[custom_term_meta]">
    		<?php _e('Post Url:', 'wpetracker'); ?>
    	</label>
    </th>
    <td>
        <input type="text" name="term_meta[et_url]" id="" value="<?php echo esc_attr($term_meta['et_url']) ? esc_attr($term_meta['et_url']) : ''; ?>" />
        <p class="description">
        	<?php _e('Enter a value for this field', 'wpetracker'); ?>
        </p>
    </td>
</tr>