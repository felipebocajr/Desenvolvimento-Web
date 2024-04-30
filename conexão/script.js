function viewPDF(path) {
    // abre uma nova janela para exibir o PDF
    var newWindow = window.open('', '_blank', 'height=600,width=800');

    // carrega o PDF na nova janela
    newWindow.document.write('<embed src="' + path + '" type="application/pdf" width="100%" height="100%"/>');
}

// função que utiliza o método ajax para pegar o ID do candidato
// e atualizar a exibição com o novo status automaticamente
function alterarsituacao(candidatoID) {
    var novoStatus = $(".statusSelect[data-candidato-id='" + candidatoID + "']").val();

    $.ajax({
        type: "POST",
        url: "alterar_status_candidato.php",
        data: { candidatoID: candidatoID, novoStatus: novoStatus },
        success: function (response) {
            $("#situacao-" + candidatoID).html(response);
        }

    });
}
