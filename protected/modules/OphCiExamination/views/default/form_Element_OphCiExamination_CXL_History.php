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
<?php echo $form->hiddenInput($element, 'eye_id', false, array('class' => 'sideField')); ?>
<div class="element-fields row">
        <div class="large-2 column">
            <label><?php echo $element->getAttributeLabel('ocular_surface_disease_id')?>:</label>
        </div>
        <div class="large-1 column">
            <?php
            $allCXLOcularSurfaceDisease = \OEModule\OphCiExamination\models\OphCiExamination_CXL_Ocular_Surface_Disease::model()->findAll(array('order' => 'display_order'));
            echo CHtml::dropDownList('OEModule_OphCiExamination_models_Element_OphCiExamination_CXL_History[ocular_surface_disease_id]',
                $element->ocular_surface_disease_id,
                CHtml::listData($allCXLOcularSurfaceDisease, 'id', 'name'), array('class' => 'MultiSelectList')); ?>
        </div>
    <div class="large-1 column">
        <label><?php echo $element->getAttributeLabel('asthma_id')?>:</label>
    </div>
    <div class="large-2 column">
        <?php $form->radioButtons(
            $element,
            'asthma_id',
            array(
                0 => 'No',
                1 => 'Yes',
            ),
            ($element->asthma_id !== null) ? $element->asthma_id : 0,
            false,
            false,
            false,
            false,
            array(
                'text-align' => 'right',
                'nowrapper' => true,
            ),
            array(
                'label' => 4,
                'field' => 8,
            ));
?>
    </div>
    <div class="large-1 column">
        <label><?php echo $element->getAttributeLabel('eczema_id')?>:</label>
    </div>
    <div class="large-2 column">
        <?php $form->radioButtons(
            $element,
            'eczema_id',
            array(
                0 => 'No',
                1 => 'Yes',
            ),
            ($element->eczema_id !== null) ? $element->eczema_id : 0,
            false,
            false,
            false,
            false,
            array(
                'text-align' => 'right',
                'nowrapper' => true,
            ),
            array(
                'label' => 4,
                'field' => 8,
            ));
        ?>
    </div>
    <div class="large-1 column">
        <label><?php echo $element->getAttributeLabel('hayfever_id')?>:</label>
    </div>
    <div class="large-2 column">
        <?php $form->radioButtons(
            $element,
            'hayfever_id',
            array(
                0 => 'No',
                1 => 'Yes',
            ),
            ($element->hayfever_id !== null) ? $element->hayfever_id : 0,
            false,
            false,
            false,
            false,
            array(
                'text-align' => 'right',
                'nowrapper' => true,
            ),
            array(
                'label' => 4,
                'field' => 8,
            ));
        ?>
    </div>
</div>
<div class="element-fields element-eyes row">
    <div class="element-eye right-eye column side left<?php if (!$element->hasRight()) {
        ?> inactive<?php
    }?>" data-side="right">
        <div class="active-form">
            <a href="#" class="icon-remove-side remove-side">Remove side</a>
            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('right_previous_cxl_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'right_previous_cxl_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->right_previous_cxl_value !== null) ? $element->right_previous_cxl_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>
                </div>
                <div class="large-4 column">
                </div>
            </div>

            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('right_previous_refractive_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'right_previous_refractive_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->right_previous_refractive_value !== null) ? $element->right_previous_refractive_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>
                </div>
                <div class="large-4 column">
                </div>
            </div>
            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('right_intacs_kera_ring_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'right_intacs_kera_ring_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->right_intacs_kera_ring_value !== null) ? $element->right_intacs_kera_ring_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>
                </div>
                <div class="large-4 column">
                </div>
            </div>

            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('right_previous_hsk_keratitis_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'right_previous_hsk_keratitis_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->right_previous_hsk_keratitis_value !== null) ? $element->right_previous_hsk_keratitis_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>
                </div>
                <div class="large-4 column">
                </div>
            </div>



        </div>
        <div class="inactive-form">
            <div class="add-side">
                <a href="#">
                    Add right side <span class="icon-add-side"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="element-eye left-eye column side right<?php if (!$element->hasLeft()) {
        ?> inactive<?php
    }?>" data-side="left">
        <div class="active-form">
            <a href="#" class="icon-remove-side remove-side">Remove side</a>
            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('left_previous_cxl_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'left_previous_cxl_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->left_previous_cxl_value !== null) ? $element->left_previous_cxl_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>
                </div>
                <div class="large-4 column">
                </div>
            </div>

            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('left_previous_refractive_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'left_previous_refractive_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->left_previous_refractive_value !== null) ? $element->left_previous_refractive_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>
                </div>
                <div class="large-4 column">
                </div>
            </div>
            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('left_intacs_kera_ring_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'left_intacs_kera_ring_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->left_intacs_kera_ring_value !== null) ? $element->left_intacs_kera_ring_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>
                </div>
                <div class="large-4 column">
                </div>
            </div>

            <div class="row field-row">
                <div class="large-4 column">
                    <label><?php echo $element->getAttributeLabel('left_previous_hsk_keratitis_value')?>:</label>
                </div>
                <div class="large-4 column">
                    <?php $form->radioButtons(
                        $element,
                        'left_previous_hsk_keratitis_value',
                        array(
                            0 => 'No',
                            1 => 'Yes',
                        ),
                        ($element->left_previous_hsk_keratitis_value !== null) ? $element->left_previous_hsk_keratitis_value : 0,
                        false,
                        false,
                        false,
                        false,
                        array(
                            'text-align' => 'right',
                            'nowrapper' => true,
                        ),
                        array(
                            'label' => 4,
                            'field' => 8,
                        ));
                    ?>                </div>
                <div class="large-4 column">
                </div>
            </div>

        </div>
    <div class="inactive-form">
        <div class="add-side">
            <a href="#">
                Add left side <span class="icon-add-side"></span>
            </a>
        </div>
    </div>
</div>
</div>