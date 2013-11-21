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

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY); 
$pluginSignature = strtolower($extensionName) . '_adventcalendar'; 

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/ControllerActions.xml'); 

?>