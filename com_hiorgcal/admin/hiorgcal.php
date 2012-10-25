<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Set some global property
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-hiorgcal48 { background-image: url(../components/com_hiorgcal/img/icon48.png); }');



// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by HiOrgCal
$controller = JController::getInstance('HiOrgCal');
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();