function btnsubmit() {
	var regForm = document.getElementById('regis-musilog');
	var child = document.getElementById('registration_form');
	regForm.removeChild(child);
	//var ele = document.createElement('div')
	regForm.innerHTML = '<div class="alert alert-success" role="alert">Thank you for your registration. We will get back to you as soon as possible!</div>';
  
}