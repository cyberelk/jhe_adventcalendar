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
class Tx_JheAdventcalendar_Controller_AjaxController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * action processAjax
	 *
	 * @return JSON encoded string
	 */
	public function processAjaxAction() {

		$pageID = intval(t3lib_div::_GP('pageID'));

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'uid = ' . $pageID);
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
			$pageName = $row['title'];
		}
		
		$selectContent = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tt_content', 'pid = ' . $pageID);
		while ($content = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($selectContent)){
			$contentTitle = $content['header'];
		}
		
		$type = intval(t3lib_div::_GP('type'));
		
		$cObjData = $this->request->getContentObjectData();
		
		//$link = $this->cObj->getTypoLink_URL($pageID);
		//$link = $this->pi_getPageLink($pageID);
		$link = '?id=' . $pageID . '&type=' . $type;

		if($_SERVER['HTTPS'] == 'on') {
			$protocol = 'https://';
		} else {
			$protocol = 'http://';
		}
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $link;
		
		$content = file_get_contents($url);
		
		echo json_encode(
			array(
				'pageTitle' => $pageName,
				'contentTitle' => $contentTitle,
				'url' => $url,
				'code' => $content
			)
		);
		//die();	
	}
}
?>