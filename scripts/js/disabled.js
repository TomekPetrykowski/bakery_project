function toggleDisabled() {
	var inputs = document.getElementsByClassName("disabled");
	var hidden = document.getElementById("hidden");
	var changeBtn = document.getElementById("change-btn");
	var cancelBtn = document.getElementById("cancel-btn");

	if (changeBtn.value == "change") {
		hidden.hidden = false;
		hidden.disabled = false;
		changeBtn.value = "cancel";
		changeBtn.disabled = true;
		changeBtn.hidden = true;
		cancelBtn.hidden = false;
		cancelBtn.disabled = false;
	} else {
		hidden.hidden = true;
		hidden.disabled = true;
		changeBtn.value = "change";
		changeBtn.hidden = false;
		changeBtn.disabled = false;
		cancelBtn.disabled = true;
		cancelBtn.hidden = true;
	}

	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].disabled == false) {
			inputs[i].disabled = true;
		} else {
			inputs[i].disabled = false;
		}
	}
}
