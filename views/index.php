<h2>Admin Page </h2>

<?php

$args = array( 'public' => true);
$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'

$post_types = get_post_types($args, $output, $operator);

$first_taxonomy = null;
$i = 0;

foreach ($post_types as $post_type) {
    
    $taxonomies = get_object_taxonomies($post_type, 'names');

    if ($taxonomies) {
        foreach ($taxonomies as $taxonomy) {
            $first_taxonomy[$i] = $taxonomy;
            $i++;
        }
    }

}

update_option('wpetracker_cus', $first_taxonomy);

$sub_options = get_option('wpetracker_opt_val_page');

foreach ($sub_options as $key) {
    
    $page = get_page_by_title($key);
    
    if ($page != null) {

        $my_post = array( 'ID' => 147 );
        update_option('posts_type', $page->post_type);
    }

}