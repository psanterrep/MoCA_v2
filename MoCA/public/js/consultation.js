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


function takeTest(idConsultation,idTest){
	bootbox.prompt({
        title: "Doctor : Enter your password", 
        inputType: "password",
        callback: function(password, token) {
			var token = $('input[name="_token"]').first().val();
            $.ajax({
				type: "POST",
				url: '/consultation/activateSupervisedTest/'+ idConsultation +'/' + idTest,
				data: 'password='+password+'&_token='+token,
				success : function(response){
					console.log(response);
					if(response.passwordMatch){
						window.location = "/consultation/takeTest/"+idConsultation+"/"+idTest;
					}
					else{
						if(response.error){
							bootbox.alert(response.error);
						}

					}
				},
			});
        }
    });
}

/*
*	Put the test in fullscreen
*/
function fullscreen(){
	if ( screenfull ) {
		var target = document.getElementById('jspsych-target');
		document.onkeydown = function (e) {
			e.preventDefault();		
		}
		screenfull.request( target );
	}
}