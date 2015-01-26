<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<?php
$data= $this->instance->getJson();
$dmy_start = date("d.m.Y", $data["sortdate"]);
$hi_start = date("H:i", $data["sortdate"]);
$hi_end = date("H:i", $data["enddate"]);
$loc=urlencode($data["treff"].", ".$data["verort"]);
?>
<tr class="hiorgcal_class_entries_table">
    <td> <?php echo $dmy_start ?> </td>
    <td> <?php echo $hi_start. " - " .$hi_end ?> </td>
    <td> <?php echo $data["verort"] ?> </td>
    <td> <?php echo $data["verbez"] ?> </td>
</tr>       
<tr class="hiorgcal_class_extended_table">
    <td class="hiorgcal_class_extended_table_row" colspan="4" style="border-bottom-width: 0px;"> 
        <div class="hiorgcal_event_details" style="display: none;">
    
            <h2><?php echo $data["verbez"] ?></h2>
            <?php if (empty($data["treff"])) {echo "<!--";} ?><p>Treffpunkt/-zeit: <?php echo $data["treff"] ?> <a target="_blank" class="no-arrow hiorgcal_maps_link" href="http://maps.google.de/?q=<?php echo $loc ?>"><img src="components/com_hiorgcal/img/maps.png" /></a> </p><?php if (empty($data["treff"])) {echo "-->";} ?> 
            <?php if (empty($data["ansprech"])) {echo "<!--";} ?><p>Ansprechpartner: <?php echo $data["ansprech"] ?> </p><?php if (empty($data["ansprech"])) {echo "-->";} ?>
            <?php if (empty($data["bemerk"])) {echo "<!--";} ?><p>Bemerkung: <?php echo $data["bemerk"] ?> </p><?php if (empty($data["bemerk"])) {echo "-->";} ?>
        </div>
    </td>
                    
</tr>          
                    