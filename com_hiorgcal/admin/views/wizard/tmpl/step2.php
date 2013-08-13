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

$setup = "";
switch (JRequest::getString("setup")) {
    case "hiorgcal":
        $setup = "hiorgcal";
        break;
    
    case "dp":
        $setup = "dp";
        break;
    
    case "both":
        $setup = "both";
        break;
    
    default:
        JError::raiseError(1534, "Fehler Parameter wurden manipuliert.");
        break;
}

?>

    <h3>Verbindung mit dem HiOrg-Server herstellen.</h3>
    
    <div style="font-size: 12px;">Um eine Verbindung mit dem HiOrg-Server herzustellen, müssen wir zunächst ihre Organisation finden.</div>
<form action="<?php echo JRoute::_('index.php?option=com_hiorgcal&view=wizard&layout=step3'); ?>"
            method="post" name="adminForm" id="wizard-form">
    <div style="font-size: 12px; margin-bottom: 1em;">Bitte geben Sie nachfolgend ihr Organisations-Kürzel an.</div>
    <label for="ov">Organisations-Kürzel</label> <input type="text" name="ov" value="" maxlength="5" size="5" />
    <input type="hidden" name="setup" value="<?php echo $setup; ?>" />
    <input type="hidden" name="from-step" value="2" />
    <input type="hidden" name="task"  value="hiorgcalo.save" />
</form>
