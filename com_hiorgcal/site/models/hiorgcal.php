<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * HiOrgCal Model
 */
class HiOrgCalModelHiOrgCal extends JModelItem
{
	/**
	 * @var array messages
	 */
	protected $messages;
        protected $json;
        protected $json_pointer;
        protected $json_pointer_max;
        protected $amount;
        protected $version;
        protected $json_config;
 
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	2.5
	 */
        
        function __construct() {
            $this->counter = 0;
            $this->json_pointer = 0;
            parent::__construct();
            $this->getConfig();
            $this->helper_getJson(); //Get the stuff!
            $this->json_pointer_max = count($this->json["data"])-1;

            }
	public function getTable($type = 'HiOrgCal', $prefix = 'HiOrgCalTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Get the message
	 * @param  int    The corresponding id of the message to be retrieved
	 * @return string The message to be displayed to the user
	 */
        
        /**
         * Gibt Daten eines GET-Requests an die als Parameter übergebene URL zurück.
         * 
         * @param type $url
         */
        private function httpReq($url) {
            		$options = new JRegistry();
                         foreach ( array('curl', 'socket', 'stream') as $adapter ) {
				try {
					$class = 'JHttpTransport' . ucfirst($adapter);
					$http = new JHttp($options, new $class($options));
					$content = $http->get($url)->body;
					break;
				} catch ( RuntimeException $e ) {
                                    return "";
                                }
			}
            if (!empty($content)) {
                return $content;
            }
            return "";
            
        }
        
        
        private function getConfig() {
            
                if (!is_array($this->json_config))
		{
			$this->json_config = array();
		}
               
                
                if (!isset($this->json_config["url"])) 
		{
                        $table = $this->getTable();
                        $table->load("1");
                        $this->json_config["url"] = $table->url;
                        $this->json_config["ov"] = $table->ov;
                        
                }
                return $this->json_config;
            
        }
        
        
	public function getMsg($id = 1) 
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}
 
		if (!isset($this->messages[$id])) 
		{
                        //request the selected id
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id');
 
			// Get a TableHiOrgCal instance
			$table = $this->getTable();
 
			// Load the message
			$table->load($id);
 
			// Assign the message
			$this->messages[$id] = $table->greeting;
		}
 
		return $this->messages[$id];
	}
        
        
        private function stringContains($string, $substr){
            if (is_numeric(strpos($string, $substr))) { return true;}
            else { return false; }
                        
        }
        
        private function helper_getJson() { 
            if ($this->stringContains($this->json_config["url"], "?")) { $this->json_config["url"].="&"; }
            else { $this->json_config["url"].="?"; }
           
           $url =  $this->json_config["url"]. "ov=" .$this->json_config["ov"];
                $http = $this->httpReq($url);
                $output = json_decode($http, true);
                if ($output["success"]) {
                    $this->json = $output;
                    return $this->json;
                } 
                
                else {
                    
                    return false; //DB-Fehler? -->false
                }
                    
                    
            } 
            
     

        
        
        public function isEndReached() {
           if ($this->json_pointer > $this->json_pointer_max) {
               return true;
               
           } else {
               return false;
           }
            
        }
        
        public function getJson() {
            if ($array = $this->json) {
                
                if ($this->json_pointer > $this->json_pointer_max) {
                    $this->json_pointer = 0;
                }
                $output = $array["data"][$this->json_pointer];
                $this->json_pointer++;
                return $output; 
            } else { return false; }
            
            
        }
        /*
        public function getDates() {
            if ($array = $this->json) {
                return $this->helper_gen_html($array);
                
            } else { return "Es ist ein Fehler aufgetreten."; }
            
            
        }*/
        
        public function getJscript() {
            if ($array = $this->json) {
                return $this->helper_export_json_data_as_jscript_var($array).$this->helper_export_amount_as_jscript_var();
                
            } else { return "Es ist ein Fehler aufgetreten. Die Detailansicht ist daher nicht verfuegbar."; }
        }
        
        
        private function helper_export_amount_as_jscript_var() {
            $output = "<script>";
            $output.= "var hiorg_amount = ". $this->amount; 
            $output.= "</script>";
            return $output;
            
        }
        
        private function helper_export_json_data_as_jscript_var(array $array) {
            
            $output = "<script>";
            $output.= "var hiorg_json_data = '". json_encode($array["data"]) ."'"; 
            $output.= "</script>";
            return $output;
        }
        
        
/*        
        private function helper_gen_html($array) {
            $output = '<table id="kursuebersicht">';
            $output.= "<thead>";
            $output.= "<tr><th>Datum</th><th>Zeit</th><th>Ort</th><th>Anlass</th></tr>";
            $output.= "</thead>";
            $output.= "<tbody>";
            $colspan = 4;
            
            $id = 0;    
            foreach($array["data"] as $keys) {
                        
                        $dmy_start = date("d.m.Y", $keys["date"]);
                        $hi_start = date("H:i", $keys["date"]);
                        $hi_end = date("H:i", $keys["datethru"]);                        
$desc=$keys["desc"]; 
$loc=urlencode($keys["meetlocandortime"].", ".$keys["location"]);
$meetlocandortime=$keys["meetlocandortime"];
$person=$keys["personofcontact"];
$content=
<<<EOF
<div class="hiorgcal_event_details" style="display: none;">
    
    <h2>$desc</h2>
    <p>Treffpunkt/-zeit: $meetlocandortime <a target="_blank" class="no-arrow hiorgcal_maps_link" href="http://maps.google.de/?q=$loc"><img src="components/com_hiorgcal/img/maps.png" /></a> </p> 
    <p>Ansprechpartner: $person </p>
</div>
EOF;
                

                
                $output.= '<tr class="hiorgcal_class_entries_table" id="hiorgcal_'. $id .'" >';
                        
                        $output.="<td>". $dmy_start ."</td>";
                        $output.="<td>". $hi_start ." - ". $hi_end ."</td>";
                        $output.="<td>". $keys["location"] ."</td>";
                        $output.="<td>". $keys["desc"] ."</td>";
                $output.= "</tr>";        
                $output.= '<tr class="hiorgcal_class_extended_table" id="hiorgcal_data_'. $id .'">';
                $output.='<td class="hiorgcal_class_extended_table_row" colspan="4" style="border-bottom-width: 0px;">'. $content .'</td>';
                
                        
                $output.= "</td>";        
                $output.= "</tr>";
                $id++;            
                
            }
            $this->amount = $id-1;
            $output.= "</table>";
            $output.= "</tbody>";
            return $output;
        }*/
}
