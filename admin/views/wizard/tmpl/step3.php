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

if (JRequest::getString("setup") == "dp") {
    $this->getModel("wizard")->removeYourself();
}

?>
<div style="font-size: 12px;">
Die &Auml;nderungen wurden erfolgreich angewandt <br>

 <?php
if (JRequest::getString("setup") == "hiorgcal" || JRequest::getString("setup") == "both" ) {
echo '
<h3>HiOrg-Kalender</h3>
F&uuml;gen Sie einen <a href="?option=com_menus" target="_blank">Men&uuml;-Punkt</a> f&uuml;r den HiOrg-Kalender hinzu.
W&auml;hlen Sie dabei als &quot;Menu Item Type&quot; den <b>Punkt &quot;termine&quot; in der Kategorie &quot;hiorgcal&quot;</b>.
<br>';
}
?>

<?php
if (JRequest::getString("setup") == "dp" || JRequest::getString("setup") == "both" ) {
echo '
<h3>DPCalendar</h3>
Der Asisstent hat das entsprechende Plugin für den DPCalendar installiert und aktiviert.
Unben-6ouml;tigte Dateien wurden bereits entfernt.<br>
<br>
 <p>F&uuml;gen Sie einen DPCalendar <a href="?option=com_menus" target="_blank">Men&uuml;-Punkt</a> hinzu und w&auml;hlen Sie in den Optionen als Kalender "HiOrg" aus. 
 <br> Bei dieser Methode werden die Termine direkt vom HiOrg-Server in den Kalender geladen und es bedarf keiner manuellen Aktualisierung.</p> 
';
} ?>  

</div>
<form action="<?php echo JRoute::_('index.php'); ?>"
            method="post" name="adminForm" id="wizard-form">

    <input type="hidden" name="from-step" value="3" />
    <input style="float: right; font-size: 14px;" type="submit" value="Zurück zur Hauptseite" />
</form>

