<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Jari-Hermann Ernst <jari-hermann.ernst@bad-gmbh.de>, B·A·D GmbH
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package jhe_adventcalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_JheAdventcalendar_Controller_AdventcalendarController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		
		$adventcalendar['background']['image'] = $this->settings['flexform']['image'];
		$adventcalendar['background']['altText'] = $this->settings['flexform']['altText'];
		$adventcalendar['background']['imageWidth'] = $this->settings['flexform']['imageWidth'];
		$adventcalendar['background']['imageHeight'] = $this->settings['flexform']['imageHeight'];

		$adventcalendar['usemapData']['usemap'] = $this->settings['flexform']['usemap'];

		$adventcalendar['wickets']['1'] = $this->settings['flexform']['wicket1'];
		$adventcalendar['wickets']['2'] = $this->settings['flexform']['wicket2'];
		$adventcalendar['wickets']['3'] = $this->settings['flexform']['wicket3'];
		$adventcalendar['wickets']['4'] = $this->settings['flexform']['wicket4'];
		$adventcalendar['wickets']['5'] = $this->settings['flexform']['wicket5'];
		$adventcalendar['wickets']['6'] = $this->settings['flexform']['wicket6'];
		$adventcalendar['wickets']['7'] = $this->settings['flexform']['wicket7'];
		$adventcalendar['wickets']['8'] = $this->settings['flexform']['wicket8'];
		$adventcalendar['wickets']['9'] = $this->settings['flexform']['wicket9'];
		$adventcalendar['wickets']['10'] = $this->settings['flexform']['wicket10'];
		$adventcalendar['wickets']['11'] = $this->settings['flexform']['wicket11'];
		$adventcalendar['wickets']['12'] = $this->settings['flexform']['wicket12'];
		$adventcalendar['wickets']['13'] = $this->settings['flexform']['wicket13'];
		$adventcalendar['wickets']['14'] = $this->settings['flexform']['wicket14'];
		$adventcalendar['wickets']['15'] = $this->settings['flexform']['wicket15'];
		$adventcalendar['wickets']['16'] = $this->settings['flexform']['wicket16'];
		$adventcalendar['wickets']['17'] = $this->settings['flexform']['wicket17'];
		$adventcalendar['wickets']['18'] = $this->settings['flexform']['wicket18'];
		$adventcalendar['wickets']['19'] = $this->settings['flexform']['wicket19'];
		$adventcalendar['wickets']['20'] = $this->settings['flexform']['wicket20'];
		$adventcalendar['wickets']['21'] = $this->settings['flexform']['wicket21'];
		$adventcalendar['wickets']['22'] = $this->settings['flexform']['wicket22'];
		$adventcalendar['wickets']['23'] = $this->settings['flexform']['wicket23'];
		$adventcalendar['wickets']['24'] = $this->settings['flexform']['wicket24'];

		$adventcalendar['ajax']['useajax'] = $this->settings['flexform']['useajax'];
		$adventcalendar['ajax']['layerWidth'] = $this->settings['flexform']['layerWidth'];
		$adventcalendar['ajax']['layerHeight'] = $this->settings['flexform']['layerHeight'];
		$adventcalendar['ajax']['modalFadeInTime'] = $this->settings['flexform']['modalFadeInTime'];
		$adventcalendar['ajax']['dialogFadeInTime'] = $this->settings['flexform']['dialogFadeInTime'];
		$adventcalendar['ajax']['modalFadeOutTime'] = $this->settings['flexform']['modalFadeOutTime'];

		$adventcalendar['snow']['snowUsage'] = $this->settings['flexform']['snowUsage'];
		$adventcalendar['snow']['snowFlakeColor'] = $this->settings['flexform']['snowFlakeColor'];
		$adventcalendar['snow']['snowFlakeMinSize'] = $this->settings['flexform']['snowFlakeMinSize'];
		$adventcalendar['snow']['snowFlakeMaxSize'] = $this->settings['flexform']['snowFlakeMaxSize'];
		$adventcalendar['snow']['snowTimeForNewFlake'] = $this->settings['flexform']['snowTimeForNewFlake'];

		//rebuild image-map
		$imageMapArr = t3lib_div::xml2tree($this->settings['flexform']['imageMap']);
		$imageMapAreaArr = $imageMapArr['map']['0']['ch']['area'];

		$i=1;
		foreach($imageMapAreaArr as $area){
			$areaData = $area['attrs'];

			$imageMapAreaArr[$i]['shape'] = $areaData['shape'];
			$imageMapAreaArr[$i]['coords'] = $areaData['coords'];
			$imageMapAreaArr[$i]['id'] = $adventcalendar['wickets'][$i];
			$imageMapAreaArr[$i]['alt'] = $areaData['alt'];
			
			$i++;
		}

		$adventcalendar['usemapData']['imageMapAreas'] = $imageMapAreaArr;

		$dataArrForJqueryFunctions['layerWidth'] = $adventcalendar['ajax']['layerWidth'];
		$dataArrForJqueryFunctions['layerHeight'] = $adventcalendar['ajax']['layerHeight'];
		$dataArrForJqueryFunctions['username'] = $GLOBALS['TSFE']->fe_user->user['username'];
		$dataArrForJqueryFunctions['pathToAjaxLoaderImage'] = '/' .t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/Images/ajax-loader.gif';
		$dataArrForJqueryFunctions['pathToCloseButtonImage'] = '/' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/Images/bt_close.gif';
		$dataArrForJqueryFunctions['modalFadeInTime'] = $adventcalendar['ajax']['modalFadeInTime'];
		$dataArrForJqueryFunctions['dialogFadeInTime'] = $adventcalendar['ajax']['dialogFadeInTime'];
		$dataArrForJqueryFunctions['modalDialogFadeOutTime'] = $adventcalendar['ajax']['modalFadeOutTime'];
		$dataArrForJqueryFunctions['snowUsage'] = $adventcalendar['snow']['snowUsage'];
		$dataArrForJqueryFunctions['snowFlakeColor'] = $adventcalendar['snow']['snowFlakeColor'];
		$dataArrForJqueryFunctions['snowFlakeMinSize'] = $adventcalendar['snow']['snowFlakeMinSize'];
		$dataArrForJqueryFunctions['snowFlakeMaxSize'] = $adventcalendar['snow']['snowFlakeMaxSize'];
		$dataArrForJqueryFunctions['snowTimeForNewFlake'] = $adventcalendar['snow']['snowTimeForNewFlake'];

		$adventcalendar['jQuery']['serializedData'] = json_encode($dataArrForJqueryFunctions);

		//include necessary js / css if confugured via ces flexform
		if($adventcalendar['ajax']['useajax']){

			$this->addJqueryLibrary();

			if($adventcalendar['snow']['snowUsage']){
				$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jquery.cookie.js" /></script>');
				$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jquery.snow.js" /></script>');
			}

			$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jhe_adventcalendar.js" /></script>');
			$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/Css/ajax.css" />');
		}

		$this->view->assign('adventcalendar', $adventcalendar);
		$this->view->assign('debug', $adventcalendar);
	}

	/**
	 * Adds the jquery library
	 *
	 * @return			The correct header script part for including the jquery library - if necessary
	 */
	public function addJqueryLibrary(){
		// checks if t3jquery is loaded
		if (t3lib_extMgm::isLoaded('t3jquery')) {
			require_once(t3lib_extMgm::extPath('t3jquery').'class.tx_t3jquery.php');
		}
		// if t3jquery is loaded and the custom Library had been created
		if (T3JQUERY === true) {
			tx_t3jquery::addJqJS();
		} else {
			// if none of the previous is true, you need to include your own library
			//$GLOBALS['TSFE']->additionalHeaderData[$this->extKey] .= '<script language="JavaScript" src="' . t3lib_extMgm::extRelPath($this->extKey) . 'res/js/jquery/jquery-1.5.1.min.js"></script>';
			$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jquery.min.js" /></script>');
		}
	}
}
?>