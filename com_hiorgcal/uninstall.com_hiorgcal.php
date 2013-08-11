<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2005 - 2010 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */        

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
//Alle Menu Eintraege entfernen
function com_uninstall(){
        $db = JFactory::getDBO();
        $db->setQuery("Delete From #__menu Where `link` Like 'index.php?option=com_hiorgcal%'");
        $db->query();
        
}