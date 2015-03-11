<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2015 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');



?>




<form id="adminForm" action="<?php echo JRoute::_('index.php?option=com_hiorgcal&view=wizard&layout=step2'); ?>"
            method="post" name="adminForm" >


		<h3>Installations-Variante</h3>
                <div style="font-size: 12px;">
                    
                Wie m&ouml;chten Sie die Termine vom HiOrg-Server in Ihre Joomla-Installation integrieren?
                <ul style="list-style: none;">
                    <li><input type="radio" name="setup"  value="hiorgcal">Nur den HiOrg-Kalender installieren</li>
                    <li><input type="radio" name="setup" value="dp">Nur in den DPCalendar integrieren</li>
                    <li><input type="radio" name="setup" checked="true" value="both">Beides</li>
                <input type="hidden" name="from-step" value="1" />
		<input type="hidden" name="task" value="wizard.next" />
                
               </div> 
                
                </form>
    
   

