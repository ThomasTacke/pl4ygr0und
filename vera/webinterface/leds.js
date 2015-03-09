function flipChangeLed() {
	var status = 0;
	if(status === 0) {
		$.ajax({
			url: "service.php?opts=sleds&color=all&brightness=2000",
			success: function ( data ) { //function to deal with returned information
				// So far nothing todo here, but function stub is better then ignoring
			}
		});
		status = 2000;
	} else {
		$.ajax({
			url: "service.php?opts=sleds&color=all&brightness=0",
			success: function ( data ) { //function to deal with returned information
				// So far nothing todo here, but function stub is better then ignoring
			}
		});
		status = 0;
	}
}
