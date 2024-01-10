$(document).ready(function() {
    $("#abrirPopup").on("click", function(event) {
        event.preventDefault();
        $("#popup").addClass("open-popup"); 
    });

    
    $("#fecharPopup").on("click", function() {
        $("#popup").removeClass("open-popup"); 
    });
});