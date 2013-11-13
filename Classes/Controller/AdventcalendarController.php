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
			
			//create typolinks for area href
			$cObj = t3lib_div::makeInstance('tslib_cObj');
			$hrefTarget = $cObj->typoLink_URL(array('parameter' => $adventcalendar['wickets'][$i]));
			
			if($hrefTarget){
				if($adventcalendar['ajax']['useajax']){
					$imageMapAreaArr[$i]['shape'] = $areaData['shape'];
					$imageMapAreaArr[$i]['coords'] = $areaData['coords'];
					$imageMapAreaArr[$i]['href'] = '""';
					$imageMapAreaArr[$i]['id'] = $adventcalendar['wickets'][$i];
					$imageMapAreaArr[$i]['alt'] = $areaData['alt'];
				} else {
					$imageMapAreaArr[$i]['shape'] = $areaData['shape'];
					$imageMapAreaArr[$i]['coords'] = $areaData['coords'];
					$imageMapAreaArr[$i]['href'] = $hrefTarget;
					$imageMapAreaArr[$i]['id'] = '';
					$imageMapAreaArr[$i]['alt'] = $areaData['alt'];
				}
			}
			
			$i++;
		}
		
		$adventcalendar['usemapData']['imageMapAreas'] = $imageMapAreaArr;

		
		//include necessary js / css if confugured via ces flexform
		if($adventcalendar['ajax']['useajax']){
			$this->addJqueryLibrary();
			$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jhe_adventcalendar.js" /></script>');
			
			$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/Css/ajax.css" />');
			
			if($adventcalendar['snow']['snowUsage']){
				$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jquery.snow.js" /></script>');
				$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jquery.cookie.js" /></script>');
			}
			
			
			
			//...
		}
		
		
		
		
		
		/*if($this->conf['useajax']){
			$user =  $GLOBALS['TSFE']->fe_user->user['username'];

			

			$js = '
				<script type="text/javascript">

				function clearVariables(){
					document.getElementById(\'dialog\').style.top = "";
					document.getElementById(\'dialog\').style.left = "";
					document.getElementById(\'dialogheader\').innerHTML = "";
					document.getElementById(\'dialogcontent\').innerHTML = "";
				}';
			if($this->conf['usesnow']){
				$js .= '
					var snowFlakeColor = \'' . $this->conf['snowFlakeColor'] . '\';
					var flakeMinSize = ' . $this->conf['snowFlakeMinSize'] . ';
					var flakeMaxSize = ' . $this->conf['snowFlakeMaxSize'] . ';
                    var timeForNewFlake = ' . $this->conf['snowTimeForNewFlake'] . ';
                    ';
			}
			
			$js .= '
				$(document).ready(function(){';
                
            if($this->conf['usesnow']){
                $js .= '
                    $.fn.snow({ 
                        minSize: flakeMinSize, 
                        maxSize: flakeMaxSize, 
                        newOn: timeForNewFlake, 
                        flakeColor: snowFlakeColor
                    });';
            }

			$js .= '		$(\'<div id="boxes"><div id="dialog" class="window" style="width: ' . $this->conf['layerWidth'] . 'px;height:' . $this->conf['layerHeight'] . 'px;"><div id="dialogheader"></div><div id="dialogcontent"></div></div><div id="mask"></div></div>\').appendTo(\'body\');
							
					$(\'area\').click(function(e){
						e.preventDefault();
						var id = $(this).attr(\'id\');
						var username = \'' . $user . '\';';
						
            if($this->conf['usesnow']){
                $js .= '            
                        $.fn.snow({ 
                            minSize: flakeMinSize, 
                            maxSize: flakeMaxSize, 
                            newOn: timeForNewFlake, 
                            flakeColor: snowFlakeColor,
                            appendTo: \'#mask\'
                        });';
            }

            $js .= '            $(\'#dialogcontent\').append(\'<div id="ajax-loader"><img src="' . t3lib_extMgm::siteRelPath($this->extKey) . 'res/img/ajax-loader.gif" /></div>\');

						var winH = $(window).height();
						var winW = $(window).width();
						$(\'#dialog\').css(\'top\',  winH/2-$(\'#dialog\').height()/2);
						$(\'#dialog\').css(\'left\', winW/2-$(\'#dialog\').width()/2);
						$(\'#dialog\').css(\'width\', ' . $this->conf['layerWidth'] . ');
						$(\'#dialog\').css(\'min-height\', ' . $this->conf['layerHeight'] . ');
						$(\'#dialog\').css(\'height\', \'auto\');

						var maskHeight = $(document).height();
						var maskWidth = $(window).width();
						$(\'#mask\').css({\'width\':maskWidth,\'height\':maskHeight});

						$(\'#mask\').fadeIn(' . $this->conf['modalFadeInTime'] . ');
						$(\'#mask\').fadeTo("slow",0.8);
						$(\'#dialog\').fadeIn(' . $this->conf['dialogFadeInTime'] . ');

						$.ajax({
							url: \'?eID=adventcalender\',
							type: \'GET\',
							data: \'pageID=\' + id + \'&user=\' + username,
							dataType: \'json\',
							success: function(result) {
								$(\'#ajax-loader\').hide();
								$(\'#dialogheader\').html(\'<h2>\' + result.pageTitle + \'</h2><div id="dialogclose"><img src="' . t3lib_extMgm::siteRelPath($this->extKey) . 'res/img/bt_close.gif" width="25" height="25" alt="schliessen..."</div>\');
								$(\'#dialogcontent\').html(result.code);
								if($(document).height() < $(\'#dialog\').height()){
									maskHeight = $(\'#dialog\').height(); 
								} else {
									maskHeight = $(document).height();
								}
								$(\'#mask\').css({\'width\':maskWidth,\'height\':maskHeight});
							}
						});
					});

					//if mask is clicked
					$(\'#mask\').click(function () {';
            
            if($this->conf['usesnow']){
                $js .= '
                        $.fn.stopsnow(\'#mask\');
                        $.fn.stopsnow(\'body\');';
            }
   
             $js .= '           $(this).fadeOut(' . $this->conf['modalDialogFadeOutTime'] . ');
						$(\'.window\').fadeOut(' . $this->conf['modalDialogFadeOutTime'] . ');
						window.setTimeout(\'clearVariables()\',' . 500 . ');
					});

					//if close button is clicked
					$(\'#dialogclose\').live(\'click\', function(){';
             
             if($this->conf['usesnow']){
                 $js .= '
                        $.fn.stopsnow(\'#mask\');
                        $.fn.stopsnow(\'body\');';
             }
             $js .= ' $(\'#mask, .window\').fadeOut(' . $this->conf['modalDialogFadeOutTime'] . ');
						window.setTimeout(\'clearVariables()\',' . 500 . ');
					});
				});
				</script>
			';
			
			
		}*/
		
		
		
		
		
		
		
		
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