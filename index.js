$(document).ready(function() {
  $(".employee-details").submit(function(e){
    let fname = $(".fname").val();
    let lname = $(".lname").val();
    let code = $(".code").val();
    let codeName = $(".codeName").val();
    let id = $(".id").val();
    let domain = $(".domain").val();
    let salary = $(".salary").val();
    let percent = $(".percent").val();
    if (fname.length >20) {
      $(".form-error").text("*Error in first name");
      errStatus = false;
    }
    else if (lname.length >20 || (!lname.match(/(^[a-zA-Z ]{1,20}$)/))) {
      $(".form-error").text("*Error in last name");
      errStatus = false;
    }
    else if (code.length >20 || (!code.match(/(^(su_)[a-zA-Z]+$)/))) {
      $(".form-error").text("*Error in employee code");
      errStatus = false;
    }
    else if (codeName.length >20 || (!codeName.match(/(^[a-z]{1}(u_)[a-zA-Z]+$)/))) {
      $(".form-error").text("*Error in code name");
      errStatus = false;
    }
    else if (id.length >5 || (!id.match(/(^(RU)[1-9]{3}$)/))) {
      $(".form-error").text("*Error in id");
      errStatus = false;
    }
    else if (domain.length >20) {
      $(".form-error").text("*Error in domain");
      errStatus = false;
    }
    else if (salary.length >3 || (!salary.match(/(^[1-9]{1,3}(k)$)/))) {
      $(".form-error").text("*Error in salary");
      errStatus = false;
    }
    else if (percent.length >3 || (!percent.match(/(^[1-9]{2}(%)$)/))) {
      $(".form-error").text("*Error in percentile");
      errStatus = false;
    }
    if (errStatus == false) {
      e.preventDefault();
    }
  });
  $(".code-button").click(function(){
    $(".employee-code-table").css("display","block");
  });
  $(".salary-button").click(function(){
    $(".employee-salary-table").css("display","block");
  });
  $(".details-button").click(function(){
    $(".employee-details-table").css("display","block");
  });
  $("#query-1-show-table").click(function(){
    $(".query-1").toggle();
  });
  $("#query-2-show-table").click(function(){
    $(".query-2").toggle();
  });
  $("#query-3-show-table").click(function(){
    $(".query-3").toggle();
  });
  $("#query-4-show-table").click(function(){
    $(".query-4").toggle();
  });
  $("#query-5-show-table").click(function(){
    $(".query-5").toggle();
  });
  $("#query-6-show-table").click(function(){
    $(".query-6").toggle();
  });
  $("#query-7-show-table").click(function(){
    $(".query-7").toggle();
  });
});