<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Adventcalendar',
	'Adventcalendar'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Adventcalendar');

t3lib_extMgm::addLLrefForTCAdescr('tx_jheadventcalendar_domain_model_adventcalendar', 'EXT:jhe_adventcalendar/Resources/Private/Language/locallang_csh_tx_jheadventcalendar_domain_model_adventcalendar.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_jheadventcalendar_domain_model_adventcalendar');
$TCA['tx_jheadventcalendar_domain_model_adventcalendar'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:jhe_adventcalendar/Resources/Private/Language/locallang_db.xml:tx_jheadventcalendar_domain_model_adventcalendar',
		'label' => 'uid',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => '',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Adventcalendar.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jheadventcalendar_domain_model_adventcalendar.gif'
	),
);

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY); 
$pluginSignature = strtolower($extensionName) . '_adventcalendar'; 

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/ControllerActions.xml'); 


?>