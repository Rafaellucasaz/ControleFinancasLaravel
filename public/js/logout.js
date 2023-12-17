
$(document).ready(function() {
  $('#logout').on('click',function(event){
    event.preventDefault();
    logout();
  });

    function logout() {
    $('#logout-form').submit();
  }
});