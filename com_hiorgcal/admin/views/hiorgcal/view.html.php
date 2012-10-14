<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HiOrgCals View
 */
class HiOrgCalViewHiOrgCal extends JView
{
	/**
	 * HiOrgCals view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
		// Get data from the model
		
		
                $form = $this->get('form');
                
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		
		
                $this->form = $form;
                

                JFactory::getDocument()->setTitle(JText::_('HiOrgCal - Konfiguration'));
                JToolBarHelper::save();
                JToolBarHelper::title("HiOrgCal Konfiguration");
 
		// Display the template
		parent::display($tpl);
	}
}