<?php
class HiOrgCalControllerWizard extends JController {

    public function next() {
        
        //$var = JRequest::getVar('jform', array(), 'default', 'array');
        if (JRequest::getString("cancontinue") == "no") {
            $this->setRedirect(JURI::base().'index.php?option='.JRequest::getCmd('option').'&view=wizard');
            JError::raiseWarning(413444, "Fehler: Vorraussetzungen werden nicht erfüllt.");
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
        
        
    parent::display();
    }   
        

    
    
}





?>
