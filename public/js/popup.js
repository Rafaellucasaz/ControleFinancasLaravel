
    $("#abrirPopup").on("click", function(event) {
        event.preventDefault();
        $("#popup").addClass("open-popup"); 
    });

    // Função para fechar o popup
    $("#fecharPopup").on("click", function() {
        $("#popup").removeClass("open-popup"); 
    });