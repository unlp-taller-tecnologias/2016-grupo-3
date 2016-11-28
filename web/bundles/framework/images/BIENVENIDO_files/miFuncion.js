$(document).ready(function()  {
	    $('#user_dni').blur(function(key)
		{
		  if (this.value.length > 8 )
		  {
		    alert('El campo DNI no puede tener mas de 8 digitos');
		  }
		  if(this.value.length < 7){
		  	alert('El campo DNI debe tener 7 y 8 digitos');
		  }
		});
});




