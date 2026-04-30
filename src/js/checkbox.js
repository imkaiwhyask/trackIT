$(document).ready(function() {
    $("#checkedAll").change(function(){
      if(this.checked){
        $(".checkSingle").each(function(){
          this.checked=true;
        })              
      }else{
        $(".checkSingle").each(function(){
          this.checked=false;
        })              
      }
    });
  
    $(".checkSingle").click(function () {
      if ($(this).is(":checked")){
        var isAllChecked = 0;
        $(".checkSingle").each(function(){
          if(!this.checked)
             isAllChecked = 1;
        })              
        if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }     
      }else {
        $("#checkedAll").prop("checked", false);
      }
    });
  });