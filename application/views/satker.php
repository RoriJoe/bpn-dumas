<?php
<input type="hidden" name="satkerkd" id="satkerkd" value="<?php echo $inst_satkerkd; ?>" />
<input class="validate[required] text-input" type="text" name="satker" id="satker" value="<?php echo $inst_nama; ?>" readonly="readonly" size="50" />

 <?php echo anchor_popup('popup/popup', 'Satker', $atts); ?>