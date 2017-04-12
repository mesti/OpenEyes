<?php
/**
 * OpenEyes
 *
 * (C) OpenEyes Foundation, 2016
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2016, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<div class="row">
    <div class="column large-6">
        <?php $this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
            'idSuffix' => $side.'_'.$element->elementType->id.'_'.$element->id,
            'side' => ($side == 'right') ? 'R' : 'L',
            'mode' => 'view',
            'width' => 200,
            'height' => 200,
            'model' => $element,
            'attribute' => $side.'_eyedraw',
        ))?>
    </div>
    <div class="column large-6">
        <div class="data-row">
            <div class="data-value">
                <?= $element->{$side . '_stfb'} ? 'STFB' : 'No STFB' ?>
            </div>
        </div>

        <div class="data-row">
                <div class="data-value">
                    <?= Yii::app()->format->Ntext($element->{$side.'_ed_report'}) ?>
                </div>
            </div>
        <?php if ($element->{$side.'_comments'}) {
            ?>
            <div class="data-row">
                <div class="data-value">
                    <?= Yii::app()->format->Ntext($element->{$side.'_comments'}) ?>
                </div>
            </div>
            <?php
        }?>
    </div>
</div>
