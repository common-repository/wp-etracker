<div id="hilfe" class="tab-content">
    <div id="cont">

        <?php include plugin_dir_path(__FILE__) . '../modules/banner.php'; ?>
        
        <div id="opt" class="col-12">
            
            <div class="col-12">
                
                <h2><?php _e('WP ETRACKER DOCUMENTATION FOR WORDPRESS', 'wpetracker'); ?></h2>
                <p><?php _e('Below you find descriptions for functions of the WP etracker plugin.', 'wpetracker'); ?></p>
                
                <h3><?php _e('1. WP etracker PlugIn installation', 'wpetracker'); ?></h3>
                <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/images/hilfe/1.png" alt="">
                <p><?php _e('First download the plugin as a zip-file. Navigate to Wordpress under plugins to: /wp-admin/plugin-install.php. Here you can now upload the plugin as a zip. As an alternative, you can also upload the plugin to the plugin directory via FTP.', 'wpetracker'); ?></p>
                <p><?php _e('Now you can activate the plugin in the plugin overview.', 'wpetracker'); ?></p>
                
                <h3><?php _e('2. Add your etracker account-key and enable the plugin', 'wpetracker'); ?></h3>
                <p><?php _e('You have to add your personal account-key to be able to track data with your account. You can find your account key under etracker - settings - account info - account key 1.', 'wpetracker'); ?></p>
                <p><?php _e('The settings can be found under the WP etracker dashboard in your Wordpress sidebar on the left.', 'wpetracker'); ?></p>
                <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/images/hilfe/2.png" alt="">
                <p><?php _e('After you have added your key, the plugin has started tracking.', 'wpetracker'); ?></p>
                
                <h3><?php _e('3. Add individual areas and pagenames to Wordpress posts and pages', 'wpetracker'); ?></h3>
                <p><?php _e('If you have enabled automatical overwrite, the plugin will set the Wordpress title and category automatically as a standard to all URLs. If you want to update pagenames and areas manually, you can do this under each post/page after you have opened it. ', 'wpetracker'); ?></p>
                <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/images/hilfe/3.png" alt="">
                
                <h3><?php _e('4. Add Pagename to posts and pages', 'wpetracker'); ?></h3>
                <p><?php _e('The titles set at Wordpress will be taken in the default-state. The pagenames you can manually change under each post.', 'wpetracker'); ?></p>
                
                <h3><?php _e('5. Browselinks/URLs', 'wpetracker'); ?></h3>
                <p><?php _e('The URLs will be send to etracker automatically and can\'t be changed.', 'wpetracker'); ?></p>
                
                <h3><?php _e('6. Dynamic pageviews', 'wpetracker'); ?></h3>
                <p><?php _e('Dynamic pageviews i.e. at Ajax-functions will be tracked automatically. Read more under our compabilitylist to see if your plugin is supported.', 'wpetracker'); ?></p>
                
                <h3><?php _e('7. Tracking of different languages', 'wpetracker'); ?></h3>
                <p><?php _e('If you use the multi-language plugin „WPML“, areas will be automatically set individuall for each language. For this, short-language codes will be appeneded. Example:', 'wpetracker'); ?></p>
                <p><?php _e('a. German version: DE_Gesamt/DE_Shop/DE_kategorie3<br>b. English Version: EN_Gesamt/EN_Shop/EN_kategorie3', 'wpetracker'); ?></p>
                
                <h3><?php _e('8. Event-Tracking', 'wpetracker'); ?></h3>
                <p><?php _e('The following events will be tracked:<br>Tracking of downloads <br>Tracking of internal and external links <br> Tracking of music players (start/stop/play/etc.) <br>Tracking of video players (start/stop/play/etc.) <br> Tracking of galleries (start/stop/play/etc.) <br> logins', 'wpetracker'); ?></p>
                <p><?php _e('See our compability list at WP-etracker.com which plugins are supported. If it doesn´t work with one of your plugins or a new version, don´t hesitate to contact our support.', 'wpetracker'); ?></p>
                
                <h3><?php _e('9. Tracking of internal searches', 'wpetracker'); ?></h3>
                <p><?php _e('Internal searches are tracked automatically', 'wpetracker'); ?></p>
                
                <h3><?php _e('10. Add areas to a category', 'wpetracker'); ?></h3>
                <p><?php _e('This setting is found under the WP etracker dashboard. Here you can append a specific area which will be added to all posts in the chosen categories.', 'wpetracker'); ?></p>
                <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/images/hilfe/4.png" alt="">
                
                <h3><?php _e('11. Add an area to sub-pages of a parent-page', 'wpetracker'); ?></h3>
                <p><?php _e('This setting is found under the WP etracker dashboard. Here you can append a sepcific area to sub-pages of a page.', 'wpetracker'); ?></p>
                <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/images/hilfe/5.png" alt="">
                
                <h3><?php _e('12. Automatically update posts', 'wpetracker'); ?></h3>
                <p><?php _e('If this field is active, all your sitenames and areas will be filled with the Wordpress page-titles and categories. This is useful to be activated once on your first run of WP etracker. If you keep it activated, and change a Wordpress title, the etracker pagename will be updated with the new Wordpress title. If it´s disabled, changes in Wordpress to Wordpress titles and categories won´t affect the pagenames and areas of etracker.', 'wpetracker'); ?></p>
                <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/images/hilfe/6.png" alt="">

            </div>

        </div>
    </div>
</div>