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
<?php $copy = $data['copy']; ?>

<h1>Prescription Form</h1>

<?php
$firm = $element->event->episode->firm;
$consultantName = $firm->consultant ? $firm->consultant->fullName : 'None';
$subspecialty = $firm->serviceSubspecialtyAssignment->subspecialty;
?>
<table class="borders prescription_header">
	<tr>
		<th>Patient Name</th>
		<td><?php echo $this->patient->fullname ?> (<?php echo $this->patient->gender ?>)</td>
		<th>Hospital Number</th>
		<td><?php echo $this->patient->hos_num ?></td>
	</tr>
	<tr>
		<th>Date of Birth</th>
		<td><?php echo $this->patient->NHSDate('dob') ?> (<?php echo $this->patient->age ?>)</td>
		<th>NHS Number</th>
		<td><?php echo $this->patient->getNhsnum() ?></td>
	</tr>
	<tr>
		<th>Consultant</th>
		<td><?php echo $consultantName ?></td>
		<th>Service</th>
		<td><?php echo $subspecialty->name ?></td>
	</tr>
</table>
<div class="spacer"></div>

<table class="borders prescription_items">
	<thead>
		<tr>
			<th class="prescriptionLabel">Prescription details</th>
			<th>Dose</th>
			<th>Route</th>
			<th>Freq.</th>
			<th>Duration</th>
			<th>Dispensed</th>
			<th>Checked</th>
			<th>Continued by GP</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($element->items as $key => $item) {?>
		<tr
			class="prescriptionItem<?php if ($this->patient->hasDrugAllergy($item->drug_id)) {?> allergyWarning<?php }?>">
			<td class="prescriptionLabel"><?php echo $item->drug->label; ?></td>
			<td><?php echo $item->dose ?></td>
			<td><?php echo $item->route->name ?> <?php if ($item->route_option) {
    echo ' ('.$item->route_option->name.')';
            }?></td>
			<td><?php if ($data['copy'] == 'patient') { 
					echo $item->frequency->long_name; } 
				else { 
					echo $item->frequency->name; 
				}?>
			</td>
			<td><?php echo $item->duration->name ?></td>
			<td></td>
			<td></td>
			<td><?php echo ($item->continue_by_gp) ? 'Yes' : '--'; ?></td>
		</tr>
		<?php foreach ($item->tapers as $taper) {?>
		<tr class="prescriptionTaper">
			<td class="prescriptionLabel">then</td>
			<td><?php echo $taper->dose ?></td>
			<td>-</td>
			<td><?php if ($data['copy'] == 'patient') { 
					echo $taper->frequency->long_name; 
				} else { 
					echo $taper->frequency->name; 
				}?>
			</td>
			<td><?php echo $taper->duration->name ?></td>
			<td>-</td>
			<td>-</td>
		</tr>
		<?php	
}
}?>
	</tbody>
</table>
<div class="spacer"></div>

<p>Trust policy limits supply to a maximum of 4 weeks</p>

<h2>Allergies</h2>
<table class="borders">
	<tr>
		<td><?php echo $this->patient->getAllergiesString(); ?></td>
	</tr>
</table>

<h2>Comments</h2>
<table class="borders">
	<tr>
		<td><?php echo $element->comments ? $element->textWithLineBreaks('comments') : '&nbsp;'?></td>
	</tr>
</table>

<h2>Pharmacy Use Only</h2>
<table class="borders pharmacy_checkboxes">
	<tr>
		<th>Used medication before?</th>
		<td>Yes <span class="checkbox">❑</span> / No <span class="checkbox">❑</span></td>
		<th>Allergies / reactions</th>
		<td>Yes <span class="checkbox">❑</span> / No <span class="checkbox">❑</span></td>
	</tr>
	<tr>
		<th>Heart problems</th>
		<td>Yes <span class="checkbox">❑</span> / No <span class="checkbox">❑</span></td>
		<th>Respiratory problems</th>
		<td>Yes <span class="checkbox">❑</span> / No <span class="checkbox">❑</span></td>
	</tr>
	<tr>
		<th>Drug history</th>
		<td>Yes <span class="checkbox">❑</span> / No <span class="checkbox">❑</span></td>
	</tr>
</table>
<div class="spacer"></div>

<table class="borders done_bys">
	<tr>
		<th>Prescribed by</th>
		<td><?php echo $element->user->fullname ?>
		</td>
		<th>Date</th>
		<td><?php echo $element->NHSDate('last_modified_date') ?>
		</td>
	</tr>
	<tr class="handWritten">
		<th>Clinical Checked by</th>
		<td></td>
		<th>Date</th>
		<td></td>
	</tr>
</table>

<?php if (!$data['copy']) {?>
	<p>Doctor's Signature:</p>
<?php }?>
