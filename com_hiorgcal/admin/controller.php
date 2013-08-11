<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2005 - 2010 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restrictedd access');

// import Joomla controller library
jimport('joomla.application.component.controllerform');

/**
 * General Controller of HiOrgCal component
 */
class HiOrgCalController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
    
    
    	public function getModel($name = 'HiOrgCal', $prefix = 'HiOrgCalModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}     
    
    
	function display($cachable = false) 
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'HiOrgCal'));

		// call parent behavior
		parent::display($cachable);
	}
        
        
        public function save()
	{
		$var = JRequest::getVar('jform', array(), 'default', 'array');
                $var2 = $this->getModel()->setConfig($var);
                
		$this->setRedirect(JURI::base().'index.php?option='.JRequest::getCmd('option'), JText::_('Konfiguration gesichert.'));
	}
       
}