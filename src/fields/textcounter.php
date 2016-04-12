<?php
/**
 * @version    SVN:<SVN_ID>
 * @package    TJFields
 * @author     Techjoomla <extensions@techjoomla.com>
 * @copyright  Copyright (c) 2009-2016 TechJoomla. All rights reserved
 * @license    GNU General Public License version 2, or later
 */

require_once JPATH_BASE . '/libraries/joomla/form/fields/text.php';
defined('JPATH_PLATFORM') or die;

/**
 * Form Field class for the Joomla Platform.
 * Supports a one line text field.
 *
 * @link   http://www.w3.org/TR/html-markup/input.text.html#input.text
 * @since  11.1
 */
class JFormFieldTextcounter extends JFormFieldText
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  11.1
	 */
	protected $type = 'Textcounter';

	/**
	 * The allowable maxlength of the field.
	 *
	 * @var    integer
	 * @since  3.2
	 */
	protected $maxLength;

	/**
	 * The mode of input associated with the field.
	 *
	 * @var    mixed
	 * @since  3.2
	 */
	protected $inputmode;

	/**
	 * The name of the form field direction (ltr or rtl).
	 *
	 * @var    string
	 * @since  3.2
	 */
	protected $dirname;

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 * @since   3.2
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$return = parent::setup($element, $value, $group);

		if ($return)
		{
			$this->countertext = isset($this->element['countertext']) ? (string) $this->element['countertext'] : '';
			$this->countertext = JText::_($this->countertext);
			$this->maxlength = isset($this->element['maxlength']) ? (int) $this->element['maxlength'] : 0;
			$this->class .= ' charcounter';
		}

		return $return;
	}

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		
		$html = parent::getInput();
		$html .= $this->getCounterMask();

		// @TODO : Convert this into a snippet that loads only once
		// using the .charcounter selector
		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration('
			jQuery(document).ready(function() {
				jQuery("#'.$this->id.'").on("keyup", function() { 
					jQuery("#usedchars_'.$this->id.'").text(jQuery("#'.$this->id.'").val().length);
					jQuery("#remainingchars_'.$this->id.'").text(('.$this->maxlength.' - jQuery("#'.$this->id.'").val().length));
				});
			});
		');

		return $html;
	}

	private function getCounterMask()
	{

		$text = '<span class="charscontainer" id="charscontainer_'.$this->id.'">';
		$text .= $this->countertext;

		$text = str_replace('{used}', '<span class="charscontainer_used" id="usedchars_'.$this->id.'">0</span>', $text);
		$text = str_replace('{remaining}', '<span class="charscontainer_remaining" id="remainingchars_'.$this->id.'">'.$this->maxlength.'</span>', $text);
		$text = str_replace('{maxlength}', '<span class="charscontainer_maxlength" id="maxlength_'.$this->id.'">'.$this->maxlength.'</span>', $text);

		$text .= '</span>';
		return $text;

	}
}
