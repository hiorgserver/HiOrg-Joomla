<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2005 - 2010 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
 
/**
 * HelloWorld Model
 */
class HiOrgCalModelWizard extends JModelAdmin
{
    
    protected $config;
    
    function __construct($config = array()) {
        parent::__construct($config);
    }
    
    public function getForm($data = array(), $loadData = true) 
	{
		// Get the form.
		$form = $this->loadForm('com_hiorgcal.wizard_1', 'wizard_1',
		                        array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
    
        
    	public function getTable($type = 'HiOrgCal', $prefix = 'HiOrgCalTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}    
        
    
    public function getDp() {
        return !is_dir("./components/com_dpcalendar/");
        
    }    
        
    public function getFopen() {
        return (get_cfg_var("allow_url_fopen") == 1);

    }
    
    public function setHiOrgCalConfig($ov) {
            $table = $this->getTable();
            $table->load("1");
            $table->set('ov', $ov);
            $table->store();
    }
    
    public function setDpCalConfig($ov) {
        $table = $this->getTable("Extensions");
        $table->load("dpcalendar_hiorg");
        $json = $table->get("params");
        
        $decoded = json_decode($json, true);
        $decoded["ov-1"] = $ov;
        
        $encoded = json_encode($decoded);
  
        $table->set("params", $encoded);
        $table->store();
    }

    public function installPlugin() {
        
        $installer =  new JInstaller();
        // Install the packages
        $installer->install(JPATH_BASE."/components/com_hiorgcal/plugin_install/");

    }

    
    public function enablePlugin() {
        $table = $this->getTable("Extensions");
        $table->load("dpcalendar_hiorg");
        $table->set("enabled", 1);
        $table->store();
        
    }
    
    public function removeYourself() {
        $table = $this->getTable("Extensions");
        $table->load("com_hiorgcal");
        $id = $table->get("extension_id");
        $installer = new JInstaller();
        $installer->uninstall("component", $id);
    }
    
    
}    
    
