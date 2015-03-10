function flipChangeLed() {

	var status = $("#flip-checkbox-led").prop("checked") ? "On" : "Off";

	if(status === "On") {
		$.ajax({
			url: "service.php?opts=sleds&color=all&brightness=2000",
			success: function ( data ) { //function to deal with returned information
				// So far nothing todo here, but function stub is better then ignoring
			}
		});
	} else {
		$.ajax({
			url: "service.php?opts=sleds&color=all&brightness=0",
			success: function ( data ) { //function to deal with returned information
				// So far nothing todo here, but function stub is better then ignoring
			}
		});
	}
}

function sliderRed(value) {
		var myurl = "service.php?opts=sleds&color=red&brightness=";
		myurl = myurl.concat(value);
		$.ajax({
			url: myurl,
			success: function ( data ) { //function to deal with returned information
				// So far nothing todo here, but function stub is better then ignoring
			}
		});
}

function sliderGreen(value) {
		var myurl = "service.php?opts=sleds&color=green&brightness=";
		myurl = myurl.concat(value);
		$.ajax({
			url: myurl,
			success: function ( data ) { //function to deal with returned information
				// So far nothing todo here, but function stub is better then ignoring
			}
		});
}

function sliderBlue(value) {
		var myurl = "service.php?opts=sleds&color=blue&brightness=";
		myurl = myurl.concat(value);
		$.ajax({
			url: myurl,
			success: function ( data ) { //function to deal with returned information
				// So far nothing todo here, but function stub is better then ignoring
			}
		});
}
