<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2015 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Set some global property
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-hiorgcal48 { background-image: url(../components/com_hiorgcal/img/icon48.png); }');


// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by HiOrgCal
$controller = JControllerLegacy::getInstance('HiOrgCal');
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();
