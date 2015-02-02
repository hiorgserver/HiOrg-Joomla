<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2005 - 2010 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
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
                JToolBarHelper::title("HiOrgCal Konfiguration", "hiorgcal48.png");
 
		// Display the template
		parent::display($tpl);
	}
}