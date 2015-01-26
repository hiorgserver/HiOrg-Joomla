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
<form action="<?php echo JRoute::_('index.php?option=com_hiorgcal'); ?>"
      method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
		<legend>Einstellungen HiOrg-Server</legend>
		<ul class="adminformlist">
<?php foreach($this->form->getFieldset() as $field): ?>
			<li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
		</ul>
	</fieldset>
	<div>
		<input type="hidden" name="task" value="hiorgcalo.save" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<div>
Wenn Sie die Entwicklung dieser Komponente unterstützen wollen, forken Sie <a href="https://github.com/hiorgserver/HiOrg-Joomla">https://github.com/hiorgserver/HiOrg-Joomla</a> und senden uns einen Pull-Request!
</div>
<div>
<a href="?option=com_hiorgcal&view=wizard">Klicken sie hier</a> um den Installationsasisstenten erneut aufzurufen.
</div>
