<?php

HTML::macro('flash_message', function(){
	$alerts = array();
	$alerts_types = array('error', 'success', 'warning', 'info');
	
	foreach ($alerts_types as $type) {
		if(Session::has($type)){
			array_push($alerts, '<div class="flash flash-' . $type . '">');
				array_push($alerts, Session::get($type));
			array_push($alerts, '</div>');
		}
	}
	return implode("", $alerts);
});