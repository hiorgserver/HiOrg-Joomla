<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
 
/**
 * HelloWorld Model
 */
class HiOrgCalModelHiOrgCal extends JModelAdmin
{
    
    protected $config;
    
    function __construct($config = array()) {
        parent::__construct($config);
        $this->getConfig();
    }
    
   
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	2.5
	 */
	public function getTable($type = 'HiOrgCal', $prefix = 'HiOrgCalTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	2.5
	 */
        
        public function getConfig() {
            
                if (!is_array($this->config))
		{
			$this->config = array();
		}
               
                
                if (!isset($this->config["url"])) 
		{
                        $table = $this->getTable();
                        $table->load("1");
                        $this->config["url"] = $table->url;
                        $this->config["ov"] = $table->ov;
                        
                }
                return $this->config;
            
        }
        
        
        
        public function setConfig($config) {
            $table = $this->getTable();
            $table->load("1");
            $table->set('url', $config["url"]);
            $table->set('ov', $config["ov"]);
            $table->store();
            
        }
        
	public function getForm($data = array(), $loadData = true) 
	{
		// Get the form.
		$form = $this->loadForm('com_hiorgcal.hiorgcal', 'hiorgcal',
		                        array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	2.5
	 */
        protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		return $this->config;
	}


}