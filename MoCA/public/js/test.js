/*
*	Put the test in fullscreen
*/
function fullscreen(){
	if ( screenfull ) {
		var target = document.getElementById('jspsych-target');
		target.style.display = "block";
		document.onkeydown = function (e) {
			e.preventDefault();		
		}
		screenfull.request( target );
	}
}

function saveResult(result){
	console.log("Result for the test");
	console.log(result);
};