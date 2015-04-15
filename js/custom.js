 function getDoctors(id){
		var formData = 'did=' + id;
                //alert(formData);
		 $.ajax({
		type: "POST",
		url: "getAllDoctors.php",
		data: formData,
		success: function(html){
			////alert(html);
                        $('#docname').html(html);
                }
			   });
		   return false;
}

function getInsuranceDoctorPatients(id){
    var formData = 'disId=' + id;
    //alert(formData);
    $.ajax({
        type: "POST",
        url: "getAllDoctors.php",
        data: formData,
        dataType: "json",
        success: function(html){
         console.log(html);
            $('#patientsInsPatients').show();
            $('#insPatientsName').html(html.patients);
            
            $('#doctorsInsPatients').show();
            $('#insDoctorsName').html(html.doctors);
        }
    });
    return false;
}
 
function hide(obj) {

    var el = document.getElementById(obj);

        el.style.display = 'none';

}
 
 
 $( document ).ready(function(){ 
     $("#disreply").hide();
     $( "#replyTR" ).click(function(){  
         $("#replyTR").hide();
         $("#disreply").show();
     });
  $( "#Register1" ).click(function() {  
    $('#regis_form').show();
    $('#department').show();
    $('#bg').hide();
    $('#DOB').hide();
    $('#doctors').hide();
    $('#city').hide();
    $('#zip').hide();
    $('#phone_carrier').hide();
    
  });
  $( "#Register2" ).click(function(){ 
     $('#department').hide();
    $('#regis_form').show();
    $('#bg').show();
    $('#DOB').show();
    $('#doctors').show();
    $('#city').show();
    $('#zip').show();
    $('#phone_carrier').show();
    
    
    
  });
  
   
  
   $( "#forgotPassword" ).click(function(){
       if(($('#Register1').is(':checked')) || ($('#Register2').is(':checked'))) 
       { if ($('#Register1').is(':checked'))
         location.href="forget.php?err=Doctor";
   }
     if(($('#Register2').is(':checked')))
   {
       location.href="forget.php?err=Patient";
   }
   else
       {
           alert('Please select your idenetity'); 
       }
       
   
  });
  
  $( "#disease" ).click(function(){
    $('#disease_selection').show();
    $('#department').show();
    $('#doctor').show();
        $('#patient_selection').show();

    $('#insurance_selection').hide();
    
    
    
  }); 
  
    $( "#insurance" ).click(function(){  
    $('#disease_selection').hide();
    $('#department').hide();
    $('#doctor').hide();
     $('#patient_selection').hide();
    $('#insurance_selection').show();
    
    
  });
  
   });
   $(function() {
    $( "#datepicker" ).datepicker();
  });
  $( document ).ready(function(){ 
      
  $( "#Edit_details" ).click(function() 
  {
     $('#column-right').show(); 
     //$('#column-right').hide();
     
  });
  $( "#submit" ).click(function() 
  {
     $('#column-right').hide(); 
     
     
  });
  
  $( "#reply" ).click(function() 
  {
     $('#disreply').show(); 
     
     
  });
 
$("#button").click(function()
{ alert("please check your email for activation code");
   $('#activation').show(); 
});
  
  

      
  $( "#Edit_Patientdetails" ).click(function() 
  {
    //  alert("hello");
     $('#column-right').show(); 
     //$('#column-right').hide();
     
  });
 
  
  
    }); 
    
    
   function patient()
   {
       $('#column-patient').show();
   }
   
    function Add_patient()
   {
       $('#column-Add-patient').show();
        
   } 
   function appoitment()
   {
       $('#column-appointment').show();
   }
   function show_reports()
   {
       $('#column-show-reports').show();
   }
   function prescription()
   {
       $('#column-patient-prescription').show();
   }
   
    $(document).ready(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
  rules: {
            email: {
                required: true,
                email: true
            },
            
        
        
        messages: {
            email: "Please enter your first name",
        },
            email: "Please enter a valid email address",
            
        },
         submitHandler: function(form) {
            form.submit();
        }
    });
        
    
    });
    
     

/*function submitvalidEmail(){
    
 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
   if(!emailReg.test(emailaddress)) {  
        alert("Please enter valid email id");
   }          
}*/
 
 function validateForm(id){	 
var error = 0
 
 $("#"+id+" .required").each(function(){

 var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
if (!email_reg.test($.trim($(this).val()))){
 $(this).addClass('error'); 
  $(this).focus();
  error = error+1; alert("email is not valid");
    
     	return false;
}

});
}
function validateEmail(email) { 
    var re = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return re.test(email);
} 

function vsubmit(){
    var emailid = document.getElementById('email').value;
if (!validateEmail(emailid)){
   alert('msg');
return false;
}else{
return true;
}
}
 
 $( document ).ready(function(){ 
     $( "#appointment1" ).click(function() 
  { 
    $('#relation').hide();
    $('#Relative').hide();
     $('#Relative_email').hide();
     $('#Relative_Insurance').hide();
       $('#Prefered_Contact').show();
       $('#Prefered_Address').show();
  });

  $( "#appointment2" ).click(function() 
  { 
      $('#Prefered_Contact').hide();
    $('#Prefered_Address').hide();
    $('#login_bg').hide();
    $('#Relative').show();
    $('#relation').show();
    $('#Relative_email').show();
    $('#Relative_Insurance').show();
    $('#patient_insurance').hide();
    
    
  });
 });
 
 //$( document ).ready(function(){ 
 //$( "#total1" ).onclick(function() {
   // $( "#total" ).dialog();
  //});
  
 //});
 $( document ).ready(function(){ 
 $('#total1').hover(
    function(){$('#total').fadeIn(100);},
    function(){$('#total').fadeOut(100);}
);
    });
   $( "#total" ).click(function() {
    $( "#sortable" ). sortable();
    $( "#sortable" ).disableSelection();
  });
  
  $(function() {
    $( "#settime" ).datepicker();
  });
 
  $( document ).ready(function(){ 
  $( "#Patient_history" ).click(function() 
  {
      alert("hello");
     $('#column-right').show(); 
     //$('#column-right').hide();
     
  });});

function getMedcine(id){
		var formData = 'did=' + id;
                //alert(formData);
		 $.ajax({
		type: "POST",
		url: "getAllMedicine.php",
		data: formData,
		success: function(html){
			////alert(html);
                        $('#medname').html(html);
                }
			   });
		   return false;
}
 function getpatient(id){
		var formData = 'did=' + id;
                //alert(formData);
		 $.ajax({
		type: "POST",
		url: "getAllDoctors.php",
		data: formData,
		success: function(html){
			////alert(html);
                        $('#docname').html(html);
                }
			   });
		   return false;
}