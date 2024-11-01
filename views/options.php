<?php require_once 'OptVal.php'; ?>

<br>

<script type='text/javascript'>

    jQuery(document).ready(function ($) {
        
        <?php
        if(!is_array(get_option('wpetracker_opt_val_cat')))
            $sc_opt = json_decode(get_option('wpetracker_opt_val_cat'));
        else
            $sc_opt = get_option('wpetracker_opt_val_cat');
        $pa_opt = get_option('wpetracker_opt_val_page');

        if (is_array($sc_opt) && is_array($pa_opt)) {
        	
        	foreach ($sc_opt as $key) {
        		
        		if ($key->value == 'on') {
        			$ids = $key->option . '1'; ?>

        			$('#' + '<?php echo $ids ?>').parent().removeClass('hidden');
        				
        			<?php
       			}

        		foreach ($pa_opt as $k) {
        			$idp = $k; ?>

        			$('input[name = "<?php echo $idp ?>"]').parent().removeClass('hidden');
        			
        			<?php
        		}

        	}

        }
        ?>

        $("#select-categories").on("click", function (e) {
            $('.categ-search').toggleClass('hidden');
            e.stopPropagation();
        });

    	$("#select-pages").on("click", function (e) {
        	$('.pages-search').toggleClass('hidden');
        	e.stopPropagation();
    	});

        $(document).on('click', function (e) {
            var has_class = $('.categ-search').siblings().not('.hidden');
            var has_class2 = $('.pages-search').siblings().not('.hidden');

            if (has_class = true) {
                $('.categ-search').addClass('hidden');
                $('.pages-search').addClass('hidden');
            }

        });

        $('.categ-search').click(function (event) {
            event.stopPropagation();
        });

        $('.pages-search').click(function (event) {
            event.stopPropagation();
        });

        $(".question").on("click", function () {
            $(this).parent().parent().find('.question-block').removeClass('hidden');
            $(this).parent().parent().find('.question-block').removeClass('zoomOutRight');
            $(this).parent().parent().find('.question-block').addClass('zoonInRight');
            $('.question-block').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
                $(this).removeClass('hidden');
            });
        });

        $(".close-question").on("click", function () {
            $(this).parent().removeClass('zoonInRight');
            $(this).parent().addClass('zoomOutRight');
            $('.question-block').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
                $(this).addClass('hidden');
            });
        });

        $('.check-box').change(function () {
            if ($(this).is(':checked')) {
                id = $(this).attr('id');
                par = $('#' + id + '1').parent().removeClass('hidden');
                $('#' + id + '1').attr('checked', 'checked');

            } else {
                id = $(this).attr('id');
                par = $('#' + id + '1').parent().addClass('hidden');
                newid = id.substring(0, id.length - 1);
                $('#' + newid).attr('checked', false);
            }
        });

        $('.check-box1').change(function () {
            $(this).parent().addClass('hidden');
        });

        $('.check-box-2').change(function () {

            if ($(this).is(':checked')) {
                id = $(this).attr('id');

                par = $('#' + id + '1').parent().removeClass('hidden');
                $('#' + id + '1').attr('checked', 'checked');

            } else {
                id = $(this).attr('id');
                $('#' + id + '1').attr('checked', false);
                par = $('#' + id + '1').parent().addClass('hidden');

                newid = id.substring(0, id.length - 1);
                $('#' + newid).attr('checked', false);
            }
        });

        $('.check-box1-2').change(function () {
            //$(this).attr('checked',false);
            $(this).parent().addClass('hidden');
        });
    });

</script>

<div class="plugin">

    <div id="cont">
        <ul class="tabs">
            <li class="tab-link current" data-tab="dashboard"><?php _e('Dashboard', 'wpetracker'); ?></li>
            <li class="tab-link" data-tab="information"><?php _e('Information', 'wpetracker'); ?></li>
            <li class="tab-link" data-tab="kaufkraft"><?php _e('Kaufkraft', 'wpetracker'); ?></li>
            <li class="tab-link" data-tab="hilfe"><?php _e('Help', 'wpetracker'); ?></li>
        </ul>
    </div>
	
	<?php
	require_once plugin_dir_path(__DIR__) . 'views/pages/dashboard.php';
	require_once plugin_dir_path(__DIR__) . 'views/pages/information.php';
	require_once plugin_dir_path(__DIR__) . 'views/pages/kaufkraft.php';
	require_once plugin_dir_path(__DIR__) . 'views/pages/hilfe.php';
	?>

</div>

<script>
    jQuery(function ($) {
        $(document).ready(function () {
            $('ul.tabs li').click(function () {
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#" + tab_id).addClass('current');
            })
        });
    });
</script>

<?php
$s = new PCconfig;
$s->wpetracker_save_meta_box(0, 0, 0);