function viewPDF(path) {
    // Abre uma nova janela para exibir o PDF
    var newWindow = window.open('', '_blank', 'height=600,width=800');

    // Carrega o PDF na nova janela
    newWindow.document.write('<embed src="' + path + '" type="application/pdf" width="100%" height="100%"/>');
}