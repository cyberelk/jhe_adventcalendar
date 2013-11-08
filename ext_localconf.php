<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Adventcalendar',
	array(
		'Adventcalendar' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Adventcalendar' => '',
		
	)
);

?>