function loginFunction() {
	const uname = document.getElementById("login-uname").value;
	const email = document.getElementById("login-email").value;
	const pw = document.getElementById("login-pass").value;
	
	if(uname === "" || email === "" || pw === "") {
		console.log("Error");
	} else {
		console.log(uname);
		console.log(email);
		console.log(pw);
	}
}

function openFormSA() {
	window.open('forms/shippingAddress_form.php', 'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=350px,height=250px,left=160px,top=170px');
}

function openFormBA() {
	window.open('forms/shippingAddress_form.php', 'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=350px,height=250px,left=160px,top=170px');
}