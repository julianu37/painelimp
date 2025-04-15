// Espera o DOM carregar completamente antes de executar o código
document.addEventListener('DOMContentLoaded', () => {

    // Importa os componentes necessários diretamente dos módulos CDN
    import('https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.min.mjs').then(pdfjsLibModule => {
        import('https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf_viewer.mjs').then(pdfjsViewerModule => {

            const pdfjsLib = pdfjsLibModule;
            const pdfjsViewer = pdfjsViewerModule;

            // Define o caminho para o worker
            const pdfjsWorkerSrc = `https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.worker.mjs`;
            pdfjsLib.GlobalWorkerOptions.workerSrc = pdfjsWorkerSrc;

            // Pega a URL do PDF do atributo data-* no body
            const pdfUrl = document.body.dataset.pdfUrl;
            console.log("DOM Carregado. URL do PDF:", pdfUrl);

            if (pdfUrl) {
                const container = document.getElementById('viewerContainer');
                // Verifica se o container existe antes de prosseguir
                if (!container) {
                    console.error("Elemento #viewerContainer não encontrado.");
                    alert("Erro interno: container do visualizador não encontrado.");
                    return;
                }

                const eventBus = new pdfjsViewer.EventBus();
                const pdfViewer = new pdfjsViewer.PDFViewer({
                    container: container,
                    eventBus: eventBus,
                    removePageBorders: true,
                });
                const pdfLinkService = new pdfjsViewer.PDFLinkService({ eventBus });
                pdfLinkService.setViewer(pdfViewer);

                async function loadPdf() {
                    try {
                        const loadingTask = pdfjsLib.getDocument({ url: pdfUrl });
                        console.log("Iniciando carregamento PDF...");
                        const pdfDocument = await loadingTask.promise;
                        console.log("Documento PDF carregado.");
                        pdfViewer.setDocument(pdfDocument);
                        pdfLinkService.setDocument(pdfDocument, null);
                        console.log("Documento definido no viewer PDF.js.");
                    } catch (reason) {
                        console.error(`Erro ao carregar PDF (${reason?.name || 'Error'}): ${reason?.message || reason}`);
                        alert("Erro ao carregar o PDF. Verifique o console.");
                    }
                }

                eventBus.on('pagesinit', function () {
                    console.log("Páginas PDF.js inicializadas.");
                    pdfViewer.currentScaleValue = 'page-width';
                });

                console.log("Chamando loadPdf...");
                loadPdf();

            } else {
                console.error("URL do PDF não encontrada (data-pdf-url).");
                alert("URL do PDF não fornecida.");
            }

        }).catch(err => console.error('Erro ao importar pdf_viewer.mjs:', err));
    }).catch(err => console.error('Erro ao importar pdf.min.mjs:', err));

}); // Fim do DOMContentLoaded listener
