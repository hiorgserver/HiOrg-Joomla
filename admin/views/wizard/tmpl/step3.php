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

 <?php
if (JRequest::getString("setup") == "hiorgcal" || JRequest::getString("setup") == "both" ) {
echo '
<h3>HiOrg-Kalender</h3>
Fügen sie unter Menüs einen Menüeintrag für den HiOrg-Kalender hinzu.
Wählen sie dabei als "Menu Item Type" den Punkt "termine" in der Kategorie "hiorgcal".
<br>';
}
?>

<?php
if (JRequest::getString("setup") == "dp" || JRequest::getString("setup") == "both" ) {
echo '
<h3>DPCalendar</h3>
Der Asisstent hat das entsprechende Plugin für den DPCalendar bereits installiert und aktiviert.
Unbenötigte Dateien wurden bereits entfernt.<br>
<br>
 <p>Fügen Sie einen DPCalendar <a href="?option=com_menus" target="_blank">Men&uuml;-Punkt</a> hinzu und wählen sie in den Optionen als Kalender "HiOrg" aus. <br> Bei dieser Methode werden die Termine direkt vom HiOrg-Server in den Kalender geladen und es bedarf keiner manuellen Aktualisierung.</p> 

';
} ?>  

</div>
<form action="<?php echo JRoute::_('index.php'); ?>"
            method="post" name="adminForm" id="wizard-form">

    <input type="hidden" name="from-step" value="3" />
    <input style="float: right; font-size: 14px;" type="submit" value="Zurück zur Hauptseite" />
</form>

