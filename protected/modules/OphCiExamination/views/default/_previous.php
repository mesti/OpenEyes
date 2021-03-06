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
<div id="previous_elements" class="event previous-elements">
	<?php foreach ($elements as $element) {
    ?>
		<div class="element-container">
			<section class="element <?php echo CHtml::modelName($element) ?>"
				data-element-id="<?php echo $element->id ?>"
				data-element-type-id="<?php echo $element->elementType->id ?>"
				data-element-type-class="<?php echo CHtml::modelName($element) ?>"
				data-element-type-name="<?php echo $element->elementType->name ?>"
				data-element-display-order="<?php echo $element->elementType->display_order ?>">

				<?php $this->renderPartial(
                    $element->view_view,
                    array('element' => $element)
                );
    ?>

			</section>
			<div class="metadata">
				<span class="info">Examination created by <span class="user"><?php echo $element->event->user->fullname ?></span>
					on <?php echo $element->event->NHSDate('created_date') ?>
					at <?php echo date('H:i', strtotime($element->event->created_date)) ?></span>
				<span class="info">Examination last modified by <span class="user"><?php echo $element->event->usermodified->fullname ?></span>
					on <?php echo $element->event->NHSDate('last_modified_date') ?>
					at <?php echo date('H:i', strtotime($element->event->last_modified_date)) ?></span>
			</div>
			<?php if ($element->canCopy()) {
    ?>
				<div class="actions">
					<button name="copy" class="copy_element small"
						data-element-id="<?php echo $element->id ?>" data-element-type-class="<?php echo CHtml::modelName($element) ?>">
						Copy
					</button>
				</div>
			<?php 
}
    ?>
		</div>
	<?php 
} ?>
</div>
