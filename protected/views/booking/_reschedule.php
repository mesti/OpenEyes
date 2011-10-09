<?php
/*
_____________________________________________________________________________
(C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
(C) OpenEyes Foundation, 2011
This file is part of OpenEyes.
OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
_____________________________________________________________________________
http://www.openeyes.org.uk   info@openeyes.org.uk
--
*/

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCSSFile('/css/theatre_calendar.css', 'all');
$patient = $operation->event->episode->patient; ?>
<div id="schedule">
<p><strong>Patient:</strong> <?php echo $patient->first_name . ' ' . $patient->last_name . ' (' . $patient->hos_num . ')'; ?></p>
<div id="operation">
	<input type="hidden" id="booking" value="<?php echo $operation->booking->id; ?>" />
	<h1>Re-schedule operation</h1><br />
<?php
if (Yii::app()->user->hasFlash('info')) { ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('info'); ?>
</div>
<?php
} ?>
	<p><strong>Operation duration:</strong> <?php echo $operation->total_duration; ?> minutes</p>
	<p><strong>Current schedule:</strong></p>
<?php $this->renderPartial('_session', array('operation' => $operation)); ?>
	<div class="cleartall"></div>
<?php
if ($operation->event->episode->firm_id != $firm->id) {
	if ($firm->name == 'Emergency List') {
		$class = 'flash-error';
		$message = 'You are booking into the Emergency List.';
	} else {
		$class = 'flash-notice';
		$message = 'You are booking into the list for ' . $firm->name . '.';
	} ?>
	<div class="<?php echo $class; ?>"><?php echo $message; ?></div>
	<input id="sessionFirm" type="hidden" value="<?php echo $firm->id; ?>" />
<?php
}
if (empty($sessions)) { ?>
	<div class="flash-error">This firm has no scheduled sessions.</div>
<?php
}
	?>
<div id="firmSelect" class="greyGradient">
	You are viewing the schedule for <strong><?php echo $firm->name; ?></strong>.
	<select id="firmId">
		<option value="">Select a different firm</option>
		<option value="EMG">Emergency List</option>
<?php	foreach ($firmList as $aFirm) { ?>
		<option value="<?php echo $aFirm->id; ?>"><?php echo $aFirm->name; ?> (<?php echo $aFirm->serviceSpecialtyAssignment->specialty->name ?>)</option>
<?php	} ?>
	</select>
</div>
<?php
	if (!empty($site->name)) { ?>
<div id="siteSelect" class="greyGradient">
	You are viewing the calendar for <strong><?php echo $site->name; ?></strong>.
	<?php echo CHtml::dropDownList('siteId', '', $siteList,
		array('empty' => 'Select a different site', 'disabled' => empty($siteList))); ?>
</div>
<div class="cleartall"></div>
<?php
	}
	?>
	<p><strong>Select a session date:</strong></p>
	<div id="calendar">
		<div id="session_dates">
		<div id="details">
<?php	echo $this->renderPartial('_calendar',
			array('operation'=>$operation, 'date'=>$date, 'sessions' => $sessions), false, true); ?>
		</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#previous_month').die('click').live('click',function() {
			var month = $('input[id=pmonth]').val();
			var operation = $('input[id=operation]').val();
			$.ajax({
				'url': '<?php echo Yii::app()->createUrl('booking/sessions'); ?>',
				'type': 'GET',
				'data': {'operation': operation, 'date': month},
				'success': function(data) {
					$('#details').html(data);
					if ($('#theatres').length > 0) {
						$('#theatres').remove();
					}
					if ($('#bookings').length > 0) {
						$('#bookings').remove();
					}
				}
			});
			return false;
		});
		$('#next_month').die('click').live('click',function() {
			var month = $('input[id=nmonth]').val();
			var operation = $('input[id=operation]').val();
			$.ajax({
				'url': '<?php echo Yii::app()->createUrl('booking/sessions'); ?>',
				'type': 'GET',
				'data': {'operation': operation, 'date': month},
				'success': function(data) {
					$('#details').html(data);
					if ($('#theatres').length > 0) {
						$('#theatres').remove();
					}
					if ($('#bookings').length > 0) {
						$('#bookings').remove();
					}
				}
			});
			return false;
		});
		$('#calendar table td.available,#calendar table td.limited,#calendar table td.full').die('click').live('click', function() {
			$('.selected_date').removeClass('selected_date');
			$(this).addClass('selected_date');
			var day = $(this).text();
			var month = $('#current_month').text();
			var operation = $('input[id=operation]').val();
			$.ajax({
				'url': '<?php echo Yii::app()->createUrl('booking/theatres'); ?>',
				'type': 'GET',
				'data': {'operation': operation, 'month': month, 'day': day},
				'success': function(data) {
					if ($('#theatres').length == 0) {
						$('#operation').append(data);
					} else {
						$('#theatres').replaceWith(data);
					}
					if ($('#bookings').length > 0) {
						$('#bookings').remove();
					}
					$( "#theatres" ).tabs();
					if ($('#theatres div.shinybutton').length == 1) {
						var button = $('#theatres div.shinybutton');
						var session = button.children().children('span.session_id').text();
						button.addClass('highlighted');
						showTheatreList(operation, month, day, session);
					}
				}
			});
		});
		$('#theatres div.shinybutton').die('click').live('click', function() {
			var session = $(this).children().children('span.session_id').text();
			var month = $('#current_month').text();
			var operation = $('input[id=operation]').val();
			var day = $('.selected_date').text();
			$(this).siblings().removeClass('highlighted');
			$(this).addClass('highlighted');
			showTheatreList(operation, month, day, session);
		});
		$('#firmSelect #firmId').die('change').live('change', function() {
			var firmId = $(this).val();
			var operation = $('input[id=operation]').val();

			$.ajax({
				'url': '<?php echo Yii::app()->createUrl('booking/reschedule'); ?>',
				'type': 'GET',
				'data': {'operation': operation, 'firmId': firmId},
				'success': function(data) {
					$('#schedule').html(data);
				}
			});
		});
		$('select[id=siteId]').change(function() {
			var site = $('select[name=siteId] option:selected').val();
			if (site != 'Select a different site') {
				var firmId = $('input[id=sessionFirm]').val();
				var operation = $('input[id=operation]').val();
				if (firmId == '') {
					firmId = 'EMG';
				}

				$.ajax({
					'url': '<?php echo Yii::app()->createUrl('booking/reschedule'); ?>',
					'type': 'GET',
					'data': {'operation': operation, 'firmId': firmId, 'siteId': site},
					'success': function(data) {
						$('#schedule').html(data);
					}
				});
			}
		});
	});

	function showTheatreList(operation, month, day, session) {
		$.ajax({
			'url': '<?php echo Yii::app()->createUrl('booking/list'); ?>',
			'type': 'GET',
			'data': {
				'operation': operation,
				'month': month,
				'day': day,
				'session': session,
				'reschedule': true,
			},
			'success': function(data) {
				if ($('#bookings').length == 0) {
					$('#operation').append(data);
				} else {
					$('#bookings').replaceWith(data);
				}
			}
		});
	}
</script>
