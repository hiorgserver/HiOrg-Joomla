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

$dp_avail = "";
$continue = "";
if ($this->dp) {
    $dp = '<img src="./components/com_hiorgcal/icons/icon-16-allow.png">';
    
} else {
    $dp = '<img src="./components/com_hiorgcal/icons/icon-16-deny.png"> Es ist kein DPCalendar installiert';
    
}

if ($this->fopen) {
    $fopen = '<img src="./components/com_hiorgcal/icons/icon-16-allow.png">';
    
} else {
    $fopen = '<img src="./components/com_hiorgcal/icons/icon-16-deny.png">';
    
}

if ($this->fopen && $this->dp) {
    $text = "Sie können mit der Einrichtung fortfahren: Klicken Sie dazu oben in der Toolbar auf [Weiter].";
    $dp_avail = "yes";
}

if ($this->fopen && !$this->dp) {
    $text = "Sie können mit der Einrichtung fortfahren: Klicken Sie dazu oben in der Toolbar auf [Weiter].<br/>Wenn Sie Ihre HiOrg-Server Termine in den DPCalendar importieren möchten, installieren Sie zuerst DPCalendar, und rufen dann diesen Assistenten erneut auf (über die Einstellungs-Seite). ";
}

if (!$this->fopen) {
    
    $text = "Es konnte keine Verbindung zum HiOrg-Server hersgestellt werden. Ihre Konfiguration lässt keine Zugriffe auf externe Ressourcen zu. Bitte wenden Sie sich an Ihren Webhoster.";
    $continue = "no";
    
}

?>
<div style="font-size: 12px;">
Willkommen zum HiOrg-Server Integrations-Assistenten.<br>
<h3>Voraussetzungen</h3>
<ul>
    <li>Verbindung zum HiOrg-Server <?php echo $fopen ?> </li>
    <li>DPCalendar <?php echo $dp; ?> </li>
</ul>
<?php echo $text ?>
</div>
<form action="<?php if ($this->dp) { echo JRoute::_('index.php?option=com_hiorgcal&view=wizard&layout=step1'); } else { echo JRoute::_('index.php?option=com_hiorgcal&view=wizard&layout=step2');} ?>"
            method="post" name="adminForm" id="adminForm">
    <input type="hidden" name="task" value="wizard.next" />
    <input type="hidden" name="from-step" value="0" />
    <input type="hidden" name="setup" value="<?php if (!$this->dp) { echo "hiorgcal"; } ?>" />
    <input type="hidden" name="cancontinue" value="<?php echo $continue; ?>" />
</form>

