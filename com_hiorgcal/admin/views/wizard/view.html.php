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
class HiOrgCalViewWizard extends JViewLegacy
{
	/**
	 * HiOrgCals view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
		// Get data from the model
		
		
                $form = $this->get('form');
                $dp = $this->get("dp");
                $fopen = $this->get("URLSupport");
                
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		
		
                $this->form = $form;
                $this->dp = $dp;
                $this->fopen = $fopen;
                
                JFactory::getDocument()->setTitle(JText::_('HiOrg-Server Integrationsassistent'));
                if ($this->getLayout() != "step3"){
                JToolBarHelper::custom("wizard.next", "forward", "forward", "Weiter", false);
                } else {

                }
                JToolBarHelper::title("HiOrg-Server Integrationsassistent", "hiorgcal48.png");
 
		// Display the template
		parent::display($tpl);
	}
}