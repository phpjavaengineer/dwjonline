<?php

add_action("wp_footer", "footer_popups");

function footer_popups() {
	
	foreach ( glob(STYLESHEETPATH ."/lib/popup/*.php") as $filename) {
		include_once($filename);
	}

}