<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Manual: {{ $manual->nome }}</title>
    {{-- CSS do PDF.js Viewer --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf_viewer.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { margin: 0; background-color: #525659; }
        #viewerContainer {
            position: absolute;
            overflow: auto;
            width: 100%;
            height: 100%;
        }
        /* Tentar ocultar botões de download/print */
        #download, #print, button[data-l10n-id="pdfjs-download-button"], button[data-l10n-id="pdfjs-print-button"] {
            display: none !important;
        }
        #secondaryToolbar button[data-l10n-id="pdfjs-download-button"], #secondaryToolbar button[data-l10n-id="pdfjs-print-button"] {
             display: none !important;
        }
    </style>
    {{-- Inclui o JS usando Vite --}}
    @vite(['resources/js/pdf-viewer.js'])
</head>
{{-- Adiciona a URL do PDF como um atributo data-* --}}
<body data-pdf-url="{{ $pdfUrl }}">
    {{-- Container onde o PDF será renderizado --}}
    <div id="viewerContainer">
        <div id="viewer" class="pdfViewer"></div>
    </div>

    {{-- Carrega as bibliotecas PDF.js via import ES6 module --}}
    <script type="module">
        // Importa os componentes necessários diretamente dos módulos CDN
        import * as pdfjsLib from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.min.mjs';
        import * as pdfjsViewer from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf_viewer.mjs';

        // Define o caminho para o worker
        const pdfjsWorkerSrc = `https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.worker.mjs`;
        pdfjsLib.GlobalWorkerOptions.workerSrc = pdfjsWorkerSrc;

        // URL do PDF passada pelo controller
        const pdfUrl = @json($pdfUrl);
        // Log da URL para depuração
        console.log("URL do PDF para carregar:", pdfUrl);

        const container = document.getElementById('viewerContainer');
        const eventBus = new pdfjsViewer.EventBus();

        // Inicializa o visualizador PDF
        const pdfViewer = new pdfjsViewer.PDFViewer({
            container: container,
            eventBus: eventBus,
            removePageBorders: true,
        });

        // Link service para navegação interna/externa
        const pdfLinkService = new pdfjsViewer.PDFLinkService({ eventBus });
        pdfLinkService.setViewer(pdfViewer);

        // Função assíncrona para carregar o documento PDF
        async function loadPdf() {
            try {
                 // Tenta criar uma instância do worker explicitamente
                // const worker = new pdfjsLib.PDFWorker();

                // Passa a URL diretamente como string ou objeto { url: ... }
                const loadingTask = pdfjsLib.getDocument({ url: pdfUrl /*, worker: worker*/ });
                console.log("Iniciando carregamento...");
                const pdfDocument = await loadingTask.promise;
                console.log("Documento carregado:", pdfDocument);

                pdfViewer.setDocument(pdfDocument);
                pdfLinkService.setDocument(pdfDocument, null);
                 console.log("Documento definido no viewer.");

            } catch (reason) {
                console.error(`Erro ao carregar PDF (${reason?.name || 'Error'}): ${reason?.message || reason}`);
                alert("Erro ao carregar o PDF. Verifique o console para mais detalhes.");
            }
        }

        // Ajusta a escala inicial quando as páginas são inicializadas
        eventBus.on('pagesinit', function () {
            console.log("Páginas inicializadas, ajustando escala.");
            pdfViewer.currentScaleValue = 'page-width';
        });

        // Inicia o carregamento do PDF
        console.log("Chamando loadPdf()...");
        loadPdf();

    </script>
</body>
</html>
