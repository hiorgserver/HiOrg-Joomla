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

if (JRequest::getString("setup") == "dp") {
    $this->getModel("wizard")->removeYourself();
}

?>
<div style="font-size: 12px;">
Die Änderungen wurden erfolgreich angewandt <br>
<h3>HiOrg-Kalender</h3>
Fügen sie unter Menüs einen Menüeintrag für den HiOrg-Kalender hinzu.
Wählen sie dabei als "Menu Item Type" den Punkt "termine" in der Kategorie "hiorgcal".
<br>
<h3>DPCalendar</h3>
Der Asisstent hat das entsprechende Plugin für den DPCalendar bereits installiert und aktiviert.
Unbenötigte Dateien wurden bereits entfernt.
Sie müssen nun in der DPCalendar-Konfiguration ihre HiOrg-Server Termine in einen Kalender importieren.

    
</div>
<form action="<?php echo JRoute::_('index.php'); ?>"
            method="post" name="adminForm" id="wizard-form">

    <input type="hidden" name="from-step" value="3" />
    <input style="float: right; font-size: 14px;" type="submit" value="Zurück zur Hauptseite" />
</form>
