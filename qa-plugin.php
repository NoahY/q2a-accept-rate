<?php

/*
        Plugin Name: Accept Rate
        Plugin URI: https://github.com/NoahY/q2a-accept-rate
        Plugin Update Check URI: https://github.com/NoahY/q2a-accept-rate/master/qa-plugin.php
        Plugin Description: Adds accept rate to meta
        Plugin Version: 0.1
        Plugin Date: 2012-11-2
        Plugin Author: NoahY
        Plugin Author URI: 
        Plugin License: GPLv2
        Plugin Minimum Question2Answer Version: 1.5
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
			header('Location: ../../');
			exit;
	}
	
	qa_register_plugin_layer('qa-accept-layer.php', 'Accept Layer');	
	
	qa_register_plugin_module('module', 'qa-accept-admin.php', 'qa_accept_admin', 'Accept Rate');

	qa_register_plugin_phrases('qa-accept-lang-*.php', 'accept');

/*
	Omit PHP closing tag to help avoid accidental output
*/
