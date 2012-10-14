<?php
        

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
//Alle Menu Eintraege entfernen
function com_uninstall(){
        $db = JFactory::getDBO();
        $db->setQuery("Delete From #__menu Where `link` Like 'index.php?option=com_hiorgcal%'");
        $db->query();
        
}