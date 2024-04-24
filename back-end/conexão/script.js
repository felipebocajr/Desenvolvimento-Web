function viewPDF(path) {
    // Abre uma nova janela para exibir o PDF
    var newWindow = window.open('', '_blank', 'height=600,width=800');

    // Carrega o PDF na nova janela
    newWindow.document.write('<embed src="' + path + '" type="application/pdf" width="100%" height="100%"/>');
}
function atualizarSituacao(id, novaSituacao) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            // Atualizar a interface do usuário conforme necessário
        }
    };
    xhttp.open("POST", "atualizar_situacao.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&novaSituacao=" + novaSituacao);
}
