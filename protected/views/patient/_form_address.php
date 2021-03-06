<?php
/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<div class="row field-row">
    <div class="large-3 column"><?php echo $form->labelEx($address,'address_type_id'); ?></div>
    <div class="large-4 column end">
        <?php echo $form->dropDownList($address,'address_type_id', $address_type_ids, array('empty'=>'-- select --')); ?>
        <?php echo $form->error($address,'address_type_id'); ?>
    </div>
</div>
<div class="row field-row">
    <div class="large-3 column"><?php echo $form->labelEx($address,'address1'); ?></div>
    <div class="large-4 column end">
        <?php echo $form->textField($address,'address1',array('size'=>15)); ?>
        <?php echo $form->error($address,'address1'); ?>
    </div>
</div>

<div class="row field-row">
    <div class="large-3 column"><?php echo $form->labelEx($address,'address2'); ?></div>
    <div class="large-4 column end">
        <?php echo $form->textField($address,'address2',array('size'=>15)); ?>
        <?php echo $form->error($address,'address2'); ?>
    </div>
</div>

<div class="row field-row">
    <div class="large-3 column"><?php echo $form->labelEx($address,'city'); ?></div>
    <div class="large-4 column end">
        <?php echo $form->textField($address,'city',array('size'=>15)); ?>
        <?php echo $form->error($address,'city'); ?>
    </div>
</div>

<div class="row field-row">
    <div class="large-3 column"><?php echo $form->labelEx($address,'postcode'); ?></div>
    <div class="large-4 column end">
        <?php echo $form->textField($address,'postcode',array('size'=>15)); ?>
        <?php echo $form->error($address,'postcode'); ?>
    </div>
</div>

<div class="row field-row">
    <div class="large-3 column"><?php echo $form->labelEx($address,'county'); ?></div>
    <div class="large-4 column end">
        <?php echo $form->textField($address,'county',array('size'=>15)); ?>
        <?php echo $form->error($address,'county'); ?>
    </div>
</div>

<div class="row field-row">
    <div class="large-3 column"><?php echo $form->labelEx($address,'country_id'); ?></div>
    <div class="large-4 column end">
        <?php echo $form->dropDownList($address,'country_id', $countries, array('empty'=>'-- select --')); ?>
        <?php echo $form->error($address,'country_id'); ?>
    </div>
</div>



