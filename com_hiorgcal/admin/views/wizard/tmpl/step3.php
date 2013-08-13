<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2005 - 2010 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');


?>
<div style="font-size: 12px;">
Die Änderungen wurden erfolgreich angewandt <br>
<h3>HiOrg-Kalender</h3>
Fügen sie unter Menüs einen Menüeintrag für den HiOrg-Kalender hinzu.
Wählen sie dabei als "Menu Item Type" den Punkt "termine" in der Kategorie "hiorgcal".
<br>
<h3>DPCalendar</h3>
Der Asisstent hat das entsprechende Plugin für den DPCalendar bereits installiert und aktiviert.
Sie müssen nun in der DPCalendar-Konfiguration ihre HiOrg-Server Termine in einen Kalender importieren.
<br>
<br>
<br>
Drücken sie auf Weiter um den Assistenten zu schließen.
    
</div>
<form action="<?php echo JRoute::_('index.php?option=com_hiorgcal'); ?>"
            method="post" name="adminForm" id="wizard-form">
    <input type="hidden" name="task" value="next.step3" />
</form>
