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
