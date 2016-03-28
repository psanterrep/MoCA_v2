$(document).ready(function() {
    $('#date').datetimepicker({
      minDateTime: new Date(),
      dateFormat: 'yy-mm-dd',
      timeFormat: 'HH:mm',
      stepMinute: 15,
      showButtonPanel : true // TODO Check with Chrome
    });


    /*
    *	Update the consultation list in consultation.index
    */
    $('#searchBar').on('input', function(){
    	var name = $(this).val();
    	var token = $('input[name="_token"]').first().val();
    	var url = '/consultation/updateConsultationList';
		$.ajax({
			type: "POST",
			url: url,
			data: 'name='+name+'&_token='+token,
			success : function(response){
				$('#consultationList').empty().append(response.html);
			},
		});
    });
});

