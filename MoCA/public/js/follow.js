/*
*	Make a csv file for importing data
*/
function exportResults(id){
	var url = '/follow/exportResults/' + id;
		$.ajax({
			type: "GET",
			url: url
		});
}