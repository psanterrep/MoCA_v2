$(document).ready(function() {
	$('#type').change(function() {
		var url = '/user/reloaduserinfo/' + $(this).val();
		$.ajax({
			type: "GET",
			url: url,
			success : function(response){
				$('#user-info').empty().append(response.html);
			},
		});
	});
});