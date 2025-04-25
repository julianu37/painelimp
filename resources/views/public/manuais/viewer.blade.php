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
{{-- Adiciona a URL do PDF e a página inicial como atributos data-* --}}
<body data-pdf-url="{{ $pdfUrl }}" data-initial-page="{{ $initialPage }}">
    {{-- Container onde o PDF será renderizado --}}
    <div id="viewerContainer">
        <div id="viewer" class="pdfViewer"></div>
    </div>

    {{-- Script pdf-viewer.js já é carregado pelo @vite no head --}}

</body>
</html>
