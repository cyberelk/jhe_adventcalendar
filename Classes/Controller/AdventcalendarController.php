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
		//$adventcalendars = $this->adventcalendarRepository->findAll();
		
		$adventcalendar['background']['image'] = $this->settings['flexform']['image'];
		$adventcalendar['background']['altText'] = $this->settings['flexform']['altText'];
		$adventcalendar['background']['imageWidth'] = $this->settings['flexform']['imageWidth'];
		$adventcalendar['background']['imageHeight'] = $this->settings['flexform']['imageHeight'];
	
		$adventcalendar['usemapData']['usemap'] = $this->settings['flexform']['usemap'];
		
		$adventcalendar['wickets']['wicket1'] = $this->settings['flexform']['wicket1'];
		$adventcalendar['wickets']['wicket2'] = $this->settings['flexform']['wicket2'];
		$adventcalendar['wickets']['wicket3'] = $this->settings['flexform']['wicket3'];
		$adventcalendar['wickets']['wicket4'] = $this->settings['flexform']['wicket4'];
		$adventcalendar['wickets']['wicket5'] = $this->settings['flexform']['wicket5'];
		$adventcalendar['wickets']['wicket6'] = $this->settings['flexform']['wicket6'];
		$adventcalendar['wickets']['wicket7'] = $this->settings['flexform']['wicket7'];
		$adventcalendar['wickets']['wicket8'] = $this->settings['flexform']['wicket8'];
		$adventcalendar['wickets']['wicket9'] = $this->settings['flexform']['wicket9'];
		$adventcalendar['wickets']['wicket10'] = $this->settings['flexform']['wicket10'];
		$adventcalendar['wickets']['wicket11'] = $this->settings['flexform']['wicket11'];
		$adventcalendar['wickets']['wicket12'] = $this->settings['flexform']['wicket12'];
		$adventcalendar['wickets']['wicket13'] = $this->settings['flexform']['wicket13'];
		$adventcalendar['wickets']['wicket14'] = $this->settings['flexform']['wicket14'];
		$adventcalendar['wickets']['wicket15'] = $this->settings['flexform']['wicket15'];
		$adventcalendar['wickets']['wicket16'] = $this->settings['flexform']['wicket16'];
		$adventcalendar['wickets']['wicket17'] = $this->settings['flexform']['wicket17'];
		$adventcalendar['wickets']['wicket18'] = $this->settings['flexform']['wicket18'];
		$adventcalendar['wickets']['wicket19'] = $this->settings['flexform']['wicket19'];
		$adventcalendar['wickets']['wicket20'] = $this->settings['flexform']['wicket20'];
		$adventcalendar['wickets']['wicket21'] = $this->settings['flexform']['wicket21'];
		$adventcalendar['wickets']['wicket22'] = $this->settings['flexform']['wicket22'];
		$adventcalendar['wickets']['wicket23'] = $this->settings['flexform']['wicket23'];
		$adventcalendar['wickets']['wicket24'] = $this->settings['flexform']['wicket24'];

		//rebuild image-map
		$imageMapArr = t3lib_div::xml2tree($this->settings['flexform']['imageMap']);
		$imageMapAreaArr = $imageMapArr['map']['0']['ch']['area'];
		
		$i=1;
		foreach($imageMapAreaArr as $area){
			$areaData = $area['attrs'];
			//create typolinks for area href
			//$cObj = t3lib_div::makeInstance('tslib_cObj');
			//$hrefTarget = $cObj->typoLink_URL(array('parameter' => $this->conf['wicket'][$i]));
			$hrefTarget = '#';
			/*if($hrefTarget){
				if($this->conf['useajax']){
					$map .= '
						<area shape="' . $areaData['shape'] . '"
						 coords="' . $areaData['coords'] . ' " 
						 href=""  
						 id="' . $this->conf['wicket'][$i] . '"
						 alt="' . $areaData['alt'] . '" 
						/>';
				} else {
					$map .= '<area shape="' . $areaData['shape'] . '" coords="' . $areaData['coords'] . ' " href="' . $hrefTarget . '" alt="' . $areaData['alt'] . '" />';
				}
			}*/
			
			$imageMapAreaArr[$i]['shape'] = $areaData['shape'];
			$imageMapAreaArr[$i]['coords'] = $areaData['coords'];
			$imageMapAreaArr[$i]['href'] = $hrefTarget;
			$imageMapAreaArr[$i]['id'] = '';
			$imageMapAreaArr[$i]['alt'] = $areaData['alt'];
			
			
			
			
			
			$i++;
		}
		
		
		$adventcalendar['usemapData']['imageMapAreas'] = $imageMapAreaArr;
		
		
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
		
		
		$this->view->assign('adventcalendar', $adventcalendar);
		$this->view->assign('debug', $adventcalendar);
	}

}
?>