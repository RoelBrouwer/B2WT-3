$(function(){
$( "[name='username']" ).blur(function() {
		if($( "[name='username']" ).val() === ""){
			alert("Enter username");
		}
	});

	$( "[name='first_name']" ).blur(function() {
		if($( "[name='firstname']" ).val() === ""){
			alert("Enter firstname");
		}
	});

	$( "[name='last_name']" ).blur(function() {
		if($( "[name='lastname']" ).val() === ""){
			alert("Enter lastname");
		}
	});

	$( "[name='email']" ).blur(function() {
		if($( "[name='email']" ).val() === ""){
			alert("Enter email");
		}
	});

	$( "[name='password_check']" ).blur(function() {
		if($( "[name='password_check']" ).val() !== $( "[name='password']" ).val()){
		alert("Wachtwoorden komen niet overeen");
		}
	});

	$( "[name='birthdate']" ).blur(function() {
		if(!$( "[name='birthdate']" ).val().match(/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/)){
			alert("Datum klopt niet");
		}
	});

	$( "[name='min_age']" ).blur(function() {
		if(!$( "[name='min_age']" ).val().match(/^([0-9]{2})$/)){
			alert("Minimumleeftijd klopt niet");
		}
	});

	$( "[name='max_age']" ).blur(function() {
		if(!$( "[name='max_age']" ).val().match(/^([0-9]{2})$/)){
			alert("Maximumleeftijd klopt niet");
		}
	});
});