document.addEventListener("DOMContentLoaded", function () {

    var confirm_exit = function(e){
        e = e || window.event;
        var message = "You have unsaved changes. Are you sure you want to leave this page?";
        if (e)
        {
            e.returnValue = message;
        }

        return message;
    };

    window.onbeforeunload = null;

  OpenEyes.Dialog.init(
    document.getElementById('dialog-container'),
    document.getElementById('refresh-button'),
    'Are you sure?',
    'This will update the record to match the current status of the patient. If you are unsure do not continue.'
  );

  $('#exit-button').on('click', function (event) {
    event.preventDefault();
    window.close();
  });

  $('.editable').find('.material-icons').on('click', function () {
    var icon = this;
    var $cardContent = $(icon).parents('.editable').find('.mdl-card__supporting-text');
    var whiteboardEventId = icon.dataset.whiteboardEventId;
    var textArea;
    var data = {};
    var contentId;
    var text;

    if (icon.textContent !== 'done') {
      textArea = $('<textarea />');
      icon.textContent = 'done';
      textArea[0].value = $cardContent.get(0).textContent.trim();
      $cardContent.html(textArea);
      window.onbeforeunload = confirm_exit;
    } else {
      contentId = $cardContent.get(0).id;
      text = $cardContent.find('textarea').val();
      data[contentId] = text;
      data.YII_CSRF_TOKEN = YII_CSRF_TOKEN;
      $.ajax({
        'type': 'POST',
        'url': '/OphTrOperationbooking/whiteboard/saveComment/' + whiteboardEventId,
        'data':data,
        'success': function () {
          $cardContent.text(text);
          icon.textContent = 'create';
          window.onbeforeunload = null;
        },
        'error': function () {
          alert('Something went wrong, please try again.');
        }
      });
    }
  });


});