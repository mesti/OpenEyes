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
$assetManager = Yii::app()->getAssetManager();
?>

<div class="box admin">
    <h2><?php echo ($admin->getModel()->id ? 'Edit' : 'Add') . ' ' . $admin->getModelDisplayName() ?></h2>
    <?php echo $this->renderPartial('//admin/_form_errors', array('errors' => $errors)) ?>
    <?php
    if ($admin->getCustomSaveURL() !== '') {
        $formAction = $admin->getCustomSaveURL();
    } else {
        $formAction = '#';
    }
    $form = $this->beginWidget('BaseEventTypeCActiveForm', array(
        'id' => 'generic-admin-form',
        'enableAjaxValidation' => false,
        'focus' => '#username',
        'action' => $formAction,
        'layoutColumns' => array(
            'label' => 2,
            'field' => 5,
        ),
    ));
    $autoComplete = array('autocomplete' => Yii::app()->params['html_autocomplete']);
    echo $form->hiddenInput($admin->getModel(), 'id');
    if (Yii::app()->request->getParam('returnUri')) {
        echo CHTML::hiddenField('returnUriEdit', Yii::app()->request->getParam('returnUri'));
    }
    ?>

    <?php foreach ($admin->getEditFields() as $field => $type) {
        if (is_array($type)) {
            switch ($type['widget']) {
                case 'MultiSelectList':
                    ?>
                    <div class="field-row furtherfindings-multi-select">
                        <?php
                        $through = array();
                        $link = '';
                        if(array_key_exists('through', $type) && is_array($type['through'])){
                            $through = $type['through'];
                        }
                        if(array_key_exists('link', $type) && $type['link']){
                            $link = $type['link'];
                        }
                        echo $form->multiSelectList(
                            $admin->getModel(),
                            $admin->getModelName() . '[' . $field . ']',
                            $field,
                            $type['relation_field_id'],
                            $type['options'],
                            array(),
                            array(
                                'empty' => '',
                                'label' => $type['label'],
                                'searchable' => true,
                            ),
                            false,
                            true,
                            null,
                            false,
                            false,
                            array(),
                            $through,
                            $link
                        );
                        ?>
                    </div>
                    <?php
                    break;
                case 'DropDownList':
                    $form->dropDownList(
                        $admin->getModel(),
                        $field,
                        $type['options'],
                        $type['htmlOptions'],
                        $type['hidden'],
                        $type['layoutColumns']
                    );
                    break;
                case 'CustomView':
                    // arguments: (string) viewName, (array) viewArguments
                    $this->renderPartial($type['viewName'], $type['viewArguments']);
                    break;
                case 'RelationList':
                    if (isset($admin->getModel()->id)) {
                        $assetManager->registerScriptFile('js/oeadmin/list.js');
                        $subAdmin = $admin->generateAdminForRelationList($type['relation'], $type['listFields']);
                        if (isset($type['search'])) {
                            $subAdmin->getSearch()->setSearchItems($type['search']);
                        }
                        $this->renderPartial('//admin/generic/list', array(
                            'admin' => $subAdmin,
                            'uniqueid' => $type['action'],
                        ));
                    }
                    break;
                case 'PatientLookup':
                    $this->renderPartial('//admin//generic/patientLookup', array(
                        'model' => $admin->getModel(),
                        'extras' => array_key_exists('extras', $type) ? $type['extras'] : false,
                    ));
                    break;
                case 'DisorderLookup':
                    if (!is_array($admin->getModel()->{$type['relation']})) {
                        $relations = array($admin->getModel()->{$type['relation']});
                    } else {
                        $relations = $admin->getModel()->{$type['relation']};
                    }
                    ?>
                    <div class="row field-row">
                        <div class="large-2 column">
                            <label>Diagnosis</label>
                        </div>
                        <div class="large-5 column end">
                            <div id="enteredDiagnosisText">
                                <?php
                                foreach($relations as $relation) {
                                    if($relation){
                                        echo '<span>' . $relation->term .
                                            '&nbsp;<i class="fa fa-minus-circle clear-diagnosis-widget" aria-hidden="true" data-diagnosis-id="'.$relation->id.'"></i><br>' .
                                            '</span>';
                                    }
                                } ?>
                            </div>
                        <?php
                          $this->renderPartial('//disorder/disorderAutoComplete', array(
                              'class' => get_class($admin->getModel()),
                              'name' => $field,
                              'code' => '',
                              'value' => $admin->getModel()->$field,
                              'clear_diagnosis' => '&nbsp;<i class="fa fa-minus-circle clear-diagnosis-widget" aria-hidden="true" data-diagnosis-id=""></i>',
                              'placeholder' => 'Search for a diagnosis',
                          ));
                        ?>
                        </div>
                    </div>
                    <?php
                    break;
                case 'LinkTo':
                    ?>
                    <div class="row field-row">
                        <div class="large-2 column">
                            <label></label>
                        </div>
                        <div class="large-5 column end">
                            <?php
                                echo CHtml::link($type['label'],array( $type['linkTo']));
                            ?>
                        </div>
                    </div>
                    <?php
                    break;
                case 'text':
                    echo $form->textField($admin->getModel(), $field, $type['htmlOptions']);
                    break;
            }
        } else {
            switch ($type) {
                case 'checkbox':
                    echo $form->checkBox($admin->getModel(), $field, $autoComplete);
                    break;
                case 'date':
                    echo $form->datePicker($admin->getModel(), $field, $autoComplete, array('null' => true));
                    break;
                case 'label':
                    echo $form->textField($admin->getModel(), $field, array('readonly' => true));
                    break;
                case 'textarea':
                    echo $form->textArea($admin->getModel(), $field);
                    break;
                case 'referer':
                    echo CHTML::hiddenField('referer', Yii::app()->request->getUrlReferrer());
                    break;
                case 'text':
                default:
                    echo $form->textField($admin->getModel(), $field, $autoComplete);
                    break;
            }
        }
    }
    ?>

    <?php
    if ($admin->getCustomCancelURL() != '') {
        echo $form->formActions(array('cancel-uri' => $admin->getCustomCancelURL()));
    } else {
        echo $form->formActions(array('cancel-uri' => (Yii::app()->request->getParam('returnUri')) ? Yii::app()->request->getParam('returnUri') : '/' . $this->uniqueid . '/list'));
    }

    ?>

    <?php $this->endWidget() ?>
</div>