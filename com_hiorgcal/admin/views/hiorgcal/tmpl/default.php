<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');

?>
<form action="<?php echo JRoute::_('index.php?option=com_hiorgcal'); ?>"
      method="post" name="adminForm" id="helloworld-form">
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

