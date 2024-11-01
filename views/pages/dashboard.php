<div id="dashboard" class="tab-content current">
    <div id="cont">
        
        <?php include plugin_dir_path(__FILE__) . '../modules/banner.php'; ?>

        <div id="opt" class="col-12">
            
            <div class="col-4 last-col">
                
                <div class="shadow key-account">

                    <form action="" method="post">
                        <h2>
                            <div id="acc"><?php _e('Account', 'wpetracker'); ?></div>
                            <p><?php _e('Do you already have an account? Then enter here your account-key 1. If you don´t have one, you can create a free etracker.com test-account', 'wpetracker'); ?> <a href="http://wp-etracker.com/etracker-account-erstellen/" target="_blank"><?php _e('here', 'wpetracker'); ?></a>.</p>
                        </h2>
                        <h2 class="mainTitle-block"><?php _e('Add your account-key:', 'wpetracker'); ?></h2>
                        <div class="group_area">
                            <input type="text" name="key" class="area_post" value="<?php echo get_option('wpetracker-key'); ?>" placeholder="<?php _e('Account-Key...', 'wpetracker'); ?>"></input>
                            <span class="border"></span>
                        </div>

                        <input type="hidden" name="page_3" value="admin-options"></input>
                        <input type="submit" value="<?php _e('Save', 'wpetracker'); ?>" class="overwrite-button"></input>
                    </form>

                    <form id="acceptTosForm" action="" method="post">
                        <h3><?php _e('I accept the', 'wpetracker'); ?> <a href="https://www.etracker.com/agb/" target="_blank"><?php _e('general terms (AGBs)', 'wpetracker'); ?></a></h3>
                        <span class="mainTitle-block red-color"><?php _e('No', 'wpetracker'); ?></span>
                        <label class="switch">
                            <input name="tos_check" type="checkbox" <?php if (get_option('wpetracker_accept_tos') == 'on') { echo "checked"; } ?>>
                            <div class="slider round"></div>
                        </label>
                        <span class="mainTitle-block"><?php _e('Yes', 'wpetracker'); ?></span>
                    </form>

                    <div class="question-mark"><span class="question">?</span></div>
                    <div class="question-block hidden">
                        <h2><?php _e('etracker account-key', 'wpetracker'); ?></h2>
                        <div class="content-block">
                            <?php _e('Add your account-key here, which you can find under your account info on etracker.com: Account Info → Settings → Account → Account-Key. The Accountschlüssel is needed so that the tracking data is associated with your account.', 'wpetracker'); ?>
                        </div>
                        <span class="close-question"></span>
                    </div>

                </div>

                <div class="shadow bottom-block <?php wpetracker_disabled_blocks_class(); ?>">

                    <form id="active" action="" method="post">
                        <input type="hidden" value="x" name="hfind"></input>
                        <h2><?php _e('Automatically update posts?', 'wpetracker'); ?></h2>
                        <span class="mainTitle-block red-color"><?php _e('No', 'wpetracker'); ?></span>
                        <label class="switch">
                            <input name="active" type="checkbox" <?php if (get_option('auto_update_option') == 'on') { echo "checked"; } ?>>
                            <div class="slider round"></div>
                        </label>
                        <span class="mainTitle-block"><?php _e('Yes', 'wpetracker'); ?></span>
                    </form>

                    <div class="question-mark"><span class="question">?</span></div>
                    <div class="question-block hidden">
                        <h2><?php _e('Automatically update posts', 'wpetracker'); ?></h2>
                        <div class="content-block">
                            <?php _e('If this field is activated, it will overwrite all site name and category changes to the standard ones.
                            It is good to have this option activated once after your initial plugin install. Afterwards you can deactivate it, 
                            and add additional manual entries to areas and page names.', 'wpetracker'); ?>
                        </div>
                        <span class="close-question"></span>
                    </div>

                </div>
				
				
                <div class="shadow bottom-block <?php wpetracker_disabled_blocks_class(); ?>">

                    <form id="active2" action="" method="post">
                        <input type="hidden" value="x" name="hfind2"></input>
                        <h2><?php _e('Activate YouTube event tracking?', 'wpetracker'); ?></h2>
                        <span class="mainTitle-block red-color"><?php _e('No', 'wpetracker'); ?></span>
                        <label class="switch">
                            <input name="active2" type="checkbox" <?php if (get_option('youtube_tracking_option') == 'on') { echo "checked"; } ?>>
                            <div class="slider round"></div>
                        </label>
                        <span class="mainTitle-block"><?php _e('Yes', 'wpetracker'); ?></span>
                    </form>

                    <div class="question-mark"><span class="question">?</span></div>
                    <div class="question-block hidden">
                        <h2><?php _e('Activate YouTube event tracking', 'wpetracker'); ?></h2>
                        <div class="content-block">
                            <?php _e('If this field is activated, the YouTube event tracking is activated. Please ensure that your privacy protection page contains appropriate information about that.', 'wpetracker'); ?>
                        </div>
                        <span class="close-question"></span>
                    </div>

                </div>

                <div class="shadow bottom-block <?php wpetracker_disabled_blocks_class(); ?>">

                    <form id="active3" action="" method="post">
                        <input type="hidden" value="x" name="hfind3"></input>
                        <h2><?php _e('Tracking code in page footer?', 'wpetracker'); ?></h2>
                        <span class="mainTitle-block red-color"><?php _e('No', 'wpetracker'); ?></span>
                        <label class="switch">
                            <input name="active3" type="checkbox" <?php if (get_option('tracking_code_hf_option') == 'on') { echo "checked"; } ?>>
                            <div class="slider round"></div>
                        </label>
                        <span class="mainTitle-block"><?php _e('Yes', 'wpetracker'); ?></span>
                    </form>

                    <div class="question-mark"><span class="question">?</span></div>
                    <div class="question-block hidden">
                        <h2><?php _e('Tracking code in page footer', 'wpetracker'); ?></h2>
                        <div class="content-block">
                            <?php _e('If this field is activated, the etracker tracking code is integrated at the end of the page, otherwise it will be integrated in the page header', 'wpetracker'); ?>
                        </div>
                        <span class="close-question"></span>
                    </div>

                </div>



            </div>

            <form action="" method="post" id="upt" class="col-4 middle">
                <div>
                    <div class="shadow big-blocks <?php wpetracker_disabled_blocks_class(); ?>">

                        <input type="hidden" name="category" value="cat">

                        <div class="head"><h2><?php _e('Tracking posts in <span class="red">Categories</span>', 'wpetracker'); ?></h2></div>
                        <div class="body-col">
                            <div class="block-category">
                                <span id="select-categories"><?php _e('Choose Category', 'wpetracker'); ?></span>
                                <div class="categ-search hidden">
                                    <ul>
                                        <input type="text" name="s" id="s" placeholder="Search Categories">
                                        <div id="categ">
                                            
                                            <?php

                                            $categories = get_terms();

                                            $j = 0;
                                            if(!is_array(get_option('wpetracker_opt_val_cat'))) {
                                                $ch = json_decode(get_option('wpetracker_opt_val_cat'));
                                            } else {
                                                $ch = (get_option('wpetracker_opt_val_cat'));
                                            }

                                            foreach ($categories as $key) {
                                                if ($key->taxonomy != 'nav_menu') {

                                                    ?>

                                                    <li class="list-categ">
                                                        <input name="<?php echo $key->slug; ?>" value="<?php echo $key->taxonomy; ?>" type="checkbox" class="check-box" id="<?php echo $key->slug; ?>"
                                                            <?php

                                                                if ($ch != null) {
                                                                    if ($ch[$j]->value == 'on') {
                                                                        echo "checked";
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        >
                                                        <label for="<?php echo $key->slug; ?>"><?php echo $key->name; ?> </label>
                                                    </li>

                                                    <?php
                                                }

                                            }
                                            ?>

                                        </div>
                                    </ul>
                                </div>
                            </div>

                            <div class="categ-checked">
                                
                                <?php
                                $categories = get_terms();

                                $j = 0;
                                if(!is_array(get_option('wpetracker_opt_val_cat'))) {
                                    $ch = json_decode(get_option('wpetracker_opt_val_cat'));
                                } else {
                                    $ch = get_option('wpetracker_opt_val_cat');
                                }

                                foreach ($categories as $key) { ?>

                                    <li class="hidden">
                                        <input value="<?php echo $key->taxonomy; ?>" type="checkbox" class="check-box check-box1" id="<?php echo $key->slug; ?>1"

                                            <?php
                                            if ($ch[$j]->value == 'on') {
                                                echo "checked";
                                                $j++;
                                            }
                                            ?>

                                        />
                                       <label for="<?php echo $key->slug; ?>1"><?php echo $key->name; ?> </label>
                                    </li>

                                    <?php
                                }
                                ?>

                            </div>

                            <h2 class="mainTitle-block"><?php _e('Add this area:', 'wpetracker'); ?></h2>
                            <div class="group_area">
                                <input class="area_post" name="area_post" type="text" value="<?php
                                    echo get_option('wpetracker_area_posts'); ?>" placeholder="<?php _e('Area ...', 'wpetracker'); ?>">
                                <span class="border"></span>
                            </div>
                            <input type="submit" value="<?php _e('Save', 'wpetracker'); ?>" class="overwrite-button">
                            <div class="question-mark"><span class="question">?</span></div>
                            <div class="question-block hidden">
                                <h2><?php _e('Add areas to a category', 'wpetracker'); ?></h2>
                                <div class="content-block">
                                    <?php _e('Here you can choose one or more categories. Your area will be added to all posts inside that category.', 'wpetracker'); ?>
                                </div>
                                <span class="close-question"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-4 first-col">
                <div class="shadow big-blocks <?php wpetracker_disabled_blocks_class(); ?>">
                    <form action="" method="post" id="upt2">
                        <input type="hidden" value="page" name="page_3">

                        <div class="head"><h2><?php _e('Tracking <span class="red">Pages</span>', 'wpetracker'); ?></h2></div>
                        <div class="body-col">
                            <div class="block-category">
                                <span id="select-pages"><?php _e('Choose Page', 'wpetracker'); ?></span>
                                <div class="pages-search hidden">
                                    <ul>
                                        <input type="text" name="search_pages" id="s_pages" placeholder="<?php _e('Search Page', 'wpetracker'); ?>">
                                        <div class="content-pages">
                                            
                                            <?php
                                            $pages = get_pages();
                                            $pa = get_option('wpetracker_opt_val_page');

                                            foreach ($pages as $key) { ?>

                                                <li class="list-categ">
                                                    <input name="<?php echo $key->post_title; ?>" id="<?php echo $key->post_name; ?>" type="checkbox"
                                                           class="check-box-2" value="<?php echo $key->post_title; ?>"

                                                        <?php
                                                        if ($pa != false){
                                                            if (in_array($key->post_title, $pa)) {
                                                                echo "checked";
                                                            }
                                                        }
                                                            
                                                        ?>

                                                    />
                                                    <label for="<?php echo $key->post_name; ?>"><?php echo $key->post_title; ?> </label>
                                                </li>

                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </ul>
                                </div>
                            </div>

                            <div class="page-cheked">
                                
                                <?php
                                $pages = get_pages();
                                $pa = get_option('wpetracker_opt_val_page');

                                foreach ($pages as $key) { ?>

                                    <li class="hidden">
                                        <input name="<?php echo $key->post_title; ?>" id="<?php echo $key->post_name; ?>1" type="checkbox" class="check-box check-box1-2" value="<?php
                                            echo $key->post_title; ?>" <?php if (in_array($key->post_title, $pa)) {
                                            echo "checked";
                                        } ?>
                                        />
                                        <label for="<?php echo $key->post_name; ?>1"><?php echo $key->post_title; ?> </label>
                                    </li>

                                    <?php 
                                }
                                ?>

                            </div>

                            <h2 class="mainTitle-block"><?php _e('Add the following area:', 'wpetracker'); ?></h2>
                            <div class="group_area">
                                <input class="area_post" name="page_area" type="text" value="<?php echo get_option('wpetracker_page_area'); ?>" placeholder="<?php _e('Area ...', 'wpetracker'); ?>">
                                <span class="border"></span>
                            </div>

                            <input type="submit" value="<?php _e('Save', 'wpetracker'); ?>" class="overwrite-button"></td>
                            
                            <div class="question-mark"><span class="question">?</span></div>
                            <div class="question-block hidden">
                                <h2><?php _e('Add an area to sub-pages of a parent-page', 'wpetracker'); ?></h2>
                                <div class="content-block">
                                    <?php _e('Here you can append an area to sub-pages of a page.', 'wpetracker'); ?>
                                </div>
                                <span class="close-question"></span>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>