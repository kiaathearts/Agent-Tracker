$(document).ready(function(){
   $("form[id^='save']").ajaxForm(function(){
       $('#confirmation').show();
       setTimeout(function() { $("#confirmation").hide(); }, 5000);
   });
});