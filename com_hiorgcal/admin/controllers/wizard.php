<?php
class HiOrgCalControllerWizard extends JController {

    public function next() {
        
        //$var = JRequest::getVar('jform', array(), 'default', 'array');
        if (JRequest::getString("cancontinue") == "no") {
            $this->setRedirect(JURI::base().'index.php?option='.JRequest::getCmd('option').'&view=wizard');
            JError::raiseWarning(413444, "Fehler: Voraussetzungen werden nicht erfüllt.");
        }

        if(JRequest::getString("from-step") == "2") {
            $ov = JRequest::getString("ov");
            if ($ov == "") { JError::raiseError(56434, "Kein Organisations-Kürzel"); }
            switch (JRequest::getString("setup")) {
                case "hiorgcal": {
                $this->getModel("wizard")->setHiOrgCalConfig($ov);
                break; 
                }
                case "dp": {
                $this->getModel("wizard")->installPlugin();    
                $this->getModel("wizard")->setDpCalConfig($ov);
                $this->getModel("wizard")->enablePlugin();
                break;
                }
                case "both": {
                $this->getModel("wizard")->installPlugin(); 
                $this->getModel("wizard")->setDpCalConfig($ov);
                $this->getModel("wizard")->enablePlugin();
                $this->getModel("wizard")->setHiOrgCalConfig($ov);
                break;
            
                }
                default:
                    JError::raiseError(453434, "Daten-Manipulation");    
                break;
            }
      
            
        }
              if(JRequest::getString("from-step") == "3") {
                  
                if (JRequest::getString("setup") == "dp" ) {
                    $this->setRedirect(JURI::base().'index.php');
                    $this->getModel("wizard")->removeYourself();
                }
                //$this->setRedirect(JURI::base().'index.php');
                JError::raiseNotice(123, "HiOrg-Server Integration wurde abgeschlossen. Unbenötigte Pakete und Dateien wurden entfernt.");
                
            }
    parent::display();
    }   
        

    
    
}





?>
