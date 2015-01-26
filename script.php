<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Script file of HelloWorld component
 */
class com_hiorgcalInstallerScript
{
        /**
         * method to install the component
         *
         * @return void
         */
        function install($parent) 
        {
                // $parent is the class calling this method
                $parent->getParent()->setRedirectURL('index.php?option=com_hiorgcal&view=wizard');
        }
 
        /**
         * method to uninstall the component
         *
         * @return void
         */
        function uninstall($parent) 
        {
        $db = JFactory::getDBO();
        $db->setQuery("Delete From #__menu Where `link` Like 'index.php?option=com_hiorgcal%'");
        $db->query();
        }
 
        /**
         * method to update the component
         *
         * @return void
         */
        function update($parent) 
        {
         
        }
 
        /**
         * method to run before an install/update/uninstall method
         *
         * @return void
         */
        function preflight($type, $parent) 
        {

        }
 
        /**
         * method to run after an install/update/uninstall method
         *
         * @return void
         */
        function postflight($type, $parent) 
        {
            
        }
}
