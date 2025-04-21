<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Manual: <?php echo e($manual->nome); ?></title>
    
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
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/pdf-viewer.js']); ?>
</head>

<body data-pdf-url="<?php echo e($pdfUrl); ?>">
    
    <div id="viewerContainer">
        <div id="viewer" class="pdfViewer"></div>
    </div>

    

</body>
</html>
<?php /**PATH C:\painelimp\resources\views/public/manuais/viewer.blade.php ENDPATH**/ ?>