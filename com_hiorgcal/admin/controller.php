<?php

/**
 * @version		$Id: controller.php 46 2010-11-21 17:27:33Z chdemko $
 * @package		Joomla16.Tutorials
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/helloworld_1_6/
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

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