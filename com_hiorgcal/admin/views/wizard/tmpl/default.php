<?php
/**
 * @subpackage          Components
 * @copyright           Copyright (C) 2005 - 2013 HiOrg Server GmbH All rights reserved.
 * @author		HiOrg Server GmbH
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');

$dp_avail = "";
$continue = "";
if ($this->dp) {
    $dp = '<span class="icon-16-allowed"></span>';
    
} else {
    $dp = '<span class="icon-16-denied">Es ist kein DPCalendar installiert.</span>';
    
}

if ($this->fopen) {
    $fopen = '<span class="icon-16-allowed"></span>';
    
} else {
    $fopen = '<span class="icon-16-denied"></span>';
    
}

if ($this->fopen && $this->dp) {
    $text = "Sie können mit der Einrichtung fortfahren.";
    $dp_avail = "yes";
}

if ($this->fopen && !$this->dp) {
    $text = "Sie können mit der Einrichtung fortfahren. Wenn Sie Ihre HiOrg-Server Termine in den DPCalendar importieren möchten, installieren Sie zunächst DPCalendar, und rufen danach diesen Assistenten erneut auf.";
}

if (!$this->fopen) {
    
    $text = "Leider gibt es ein Problem. Da allow_url_fopen in Ihren PHP-Einstellungen deaktiviert ist, ist unsere Komponente nicht funtionsfähig. Bitten Sie Ihren Webhoster bzw. System-Administrator um die Aktivierung dieser PHP-Option.";
    $continue = "no";
    
}

?>
<div style="font-size: 12px;">
Willkommen zum HiOrg-Server Integrations-Assistenten.<br>
<h3>Vorraussetzungen</h3>
<ul>
    <li>allow_url_fopen <?php echo $fopen ?> </li>
    <li>DPCalendar <?php echo $dp; ?> </li>
</ul>
<?php echo $text ?>
</div style="font-size: 12px;">
<form action="<?php if ($this->dp) { echo JRoute::_('index.php?option=com_hiorgcal&view=wizard&layout=step1'); } else { echo JRoute::_('index.php?option=com_hiorgcal&view=wizard&layout=step2');} ?>"
            method="post" name="adminForm" id="wizard-form">
    <input type="hidden" name="task" value="wizard.next" />
    <input type="hidden" name="from-step" value="0" />
    <input type="hidden" name="setup" value="<?php if (!$this->dp) { echo "hiorgcal"; } ?>" />
    <input type="hidden" name="cancontinue" value="<?php echo $continue; ?>" />
</form>

