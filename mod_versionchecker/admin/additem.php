<?php
/**
 * @package    Joomla.Administrator
 * @subpackage mod_versionchecker
 * @author     Klaus Krippeit {@link http://www.krippeit.org}
 * @license    GNU/GPL
 */

defined('JPATH_BASE') or die;

class JFormFieldAddItem extends JFormField {

	protected $type = 'AddItem';

	protected function  getInput()
	{
		$modulePath = JURI::base().'modules/mod_versionchecker';

		$doc = JFactory::getDocument();
		$doc->addScript( $modulePath . '/js/scripts.js');

		$name = $this->name;

		$values = $this->value;
		if( !is_array($values) && empty($values) ){
			$values = array();
		}
		$values = !is_array($values) ? array($values):$values;

		$items  = '<div id="item-template" class="item">';
		$items .= '<input type="text" class="url"';
		$items .= ' value="' . $values[0]['url'] . '"';
		$items .= ' name="'.$name.'[0][url]" >';
		$items .= '<button class="btn delete"><span class="icon-unpublish"></span>'.JText::_('MOD_VERSIONCHECKER_REMOVE_DOMAIN').'</button>';
		$items .= '</div>';

		foreach( $values as $key => $value ){
			if($key !== 0){
				$items .= '<div class="item">';
				$items .= '<input type="text" class="url" ';
				$items .= 'value="'.$values[$key]['url'].'" ';
				$items .= 'name="'.$name.'['.$key.'][url]">';
				$items .= '<button class="btn delete"><span class="icon-unpublish"></span>'.JText::_('MOD_VERSIONCHECKER_REMOVE_DOMAIN').'</button>';
				$items .= '</div>';
			}
		}
		$noscript = '<noscript>You must have JavaScript enabled to add/remove links.</noscript>';

		$return  = '<div class="add-item" ';
		$return .= 'id="'.$this->fieldname.'" ';
		$return .= 'name="jform[params]['.$this->fieldname.'][]">';
		$return .= $noscript.$items;
		$return .= '<button class="btn button-add btn-success" id="but_l"><span class="icon-plus icon-white"></span>'.JText::_('MOD_VERSIONCHECKER_ADD_DOMAIN').'</button>';
		$return .= '</div>';

		return $return;
	}
}
?>
