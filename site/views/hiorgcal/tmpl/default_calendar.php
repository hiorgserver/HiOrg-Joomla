<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');



?>

<table id="hiorgcal">
<thead>
<tr><th>Datum</th><th>Zeit</th><th>Ort</th><th>Titel</th></tr>
</thead>
<tbody>
<?php 

while(!$this->instance->isEndReached()) {
     echo $this->loadTemplate('calendarcontent');  
} 

?>
</tbody> 
</table>
