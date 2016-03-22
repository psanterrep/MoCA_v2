$(document).ready(function() {
    $('#date').datetimepicker({
      minDateTime: new Date(),
      dateFormat: 'yy-mm-dd',
      timeFormat: 'HH:mm',
      stepMinute: 15,
      showButtonPanel : false
    });
});
