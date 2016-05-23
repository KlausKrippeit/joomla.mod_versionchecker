<?php
/**
 * @package    Joomla.Administrator
 * @subpackage versionchecker
 * @author     Klaus Krippeit {@link http://www.krippeit.org}
 * @license    GNU/GPL
 */

defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
$websites = $params->get('websites');
$modulePath = JURI::base().'modules/mod_versionchecker';
$doc = JFactory::getDocument();
$doc->addStyleSheet( $modulePath . '/css/style.css');
$htmlString = '<div class="row-striped">';
foreach ($websites as $website) {

	$updateVersionFile = 'http://update.joomla.org/core/sts/extension_sts.xml';
	$websiteVersionFile = $website->url."/administrator/manifests/files/joomla.xml";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_URL, $websiteVersionFile);
	$xmlresponse = curl_exec($ch);
	$xmlWebsiteVersionFile = simplexml_load_string($xmlresponse);
	$xmlUpdateVersionFile = simplexml_load_file($updateVersionFile);
	$websiteJoomlaVersion = $xmlWebsiteVersionFile->version;
	$currentCMSVersionName = 'Joomla! '.substr($websiteJoomlaVersion, 0, 3);


	foreach($xmlUpdateVersionFile->update as $status){
		if(preg_match("/".$currentCMSVersionName."/", $status->name))
		{
			$updateJoomlaVersion = $status->version;
		}
	}

	$status = str_replace($updateJoomlaVersion, "1", $websiteJoomlaVersion);

	$classLabelStatus = $status == 1 ? "label-success" : "label-important";
	$htmlString  .= '<div class="row-fluid">';
	$htmlString  .= '<div class="span9">';
	$htmlString  .=  "<strong class=\"row-title\">  $currentCMSVersionName</strong> <a href=\"$website->url\" target=\"blank\">$website->url</a> </div>";
	$htmlString  .= "<div class='span3'>Version: <span class=\"label $classLabelStatus\">$websiteJoomlaVersion</span></div>";
	$htmlString  .= '</div>';

}
$htmlString .= '</div>';
echo $htmlString;
?>


