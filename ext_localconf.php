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
		'Adventcalendar' => 'list',

	)
);

/**
 * Include the eId dispatcher in Frontend environment
 * TODO Mind, that there is no access controll ATM!!!!
 */
$TYPO3_CONF_VARS['FE']['eID_include']['adventcalenderAjax'] = t3lib_extMgm::extPath('jhe_adventcalendar').'Classes/Utility/eIDDispatcher.php';

?>