<?php

function wpetracker_disabled_blocks_class() {
	if(get_option('wpetracker_accept_tos')) {
		if(get_option('wpetracker_accept_tos') == 'off') {
			echo 'disabled'; // does not need to be translated
		} else {
			return;
		}
	} else {
		echo 'disabled'; // does not need to be translated
	}
}