function validateForm(){
    var name = document.forms["personal_info"]["name_text"];			 
	var email = document.forms["personal_info"]["email_text"]; 
	var dob = document.forms["personal_info"]["datepicker"];
	var addr1 = document.forms["personal_info"]["addr1_text"];
    var addr2 = document.forms["personal_info"]["addr2_text"];
    var city = document.forms["personal_info"]["city_text"];
    var zip = document.forms["personal_info"]["zip_text"];
    var gender = document.forms["personal_info"]["select_gender"];
    var letters = /^[A-Za-z][A-Za-z\s]*$/;

	if (name.value == "")								 
	{ 
		window.alert("Please enter your name."); 
		name.focus(); 
		return false; 
	}
    
    if (!name.value.match(letters))
        {
            window.alert("Name should be letters only."); 
		    name.focus(); 
		    return false; 
        }
	
	if (email.value == "")								 
	{ 
		window.alert("Please enter a valid e-mail address."); 
		email.focus(); 
		return false; 
	}
    
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))
        {
            window.alert("Please enter a valid email."); 
		    email.focus(); 
		    return false;
        }
    
    if (dob.value == "")								 
	{ 
		window.alert("Please enter your Date of Birth."); 
		dob.focus(); 
		return false; 
	}
    
    
    if (gender.selectedIndex < 1)				 
	{ 
		alert("Please enter your gender."); 
		gender.focus(); 
		return false; 
	}
    
    if (addr1.value == "")							 
	{ 
		window.alert("Please enter your addr1."); 
		addr1.focus(); 
		return false; 
	}
    
    if (addr2.value == "")							 
	{ 
		window.alert("Please enter your addr2."); 
		addr2.focus(); 
		return false; 
	}
    
    if (city.value == "")							 
	{ 
		window.alert("Please enter your city."); 
		city.focus(); 
		return false; 
	}
    
    if (!city.value.match(letters))
        {
            window.alert("City should be letters only."); 
		    city.focus(); 
		    return false; 
        }
    
    if (zip.value == "")							 
	{ 
		window.alert("Please enter your zip."); 
		zip.focus(); 
		return false; 
	}
    
    if (!/[A-za-z]+\s[0-9]+$/.test(zip.value))
        {
            window.alert("Please enter a valid ZIP."); 
		    zip.focus(); 
		    return false;
        }
    
    var div = $("div");  
    div.animate({height: '100px'}, "slow");
    div.delay(2000).animate({height: '0px'}, "slow");
	
	return true;
    
}

$( function() {
    var d = new Date();
    var year = d.getFullYear();
    d.setFullYear(year);
    $("#datepicker").datepicker({ changeYear: true, changeMonth: true, defaultDate: d, dateFormat: 'dd/mm/yy', maxDate: 0});
  } );