<?php

    include 'vendor/autoload.php';
    use Smalot\PdfParser\Parser;
?>

<style>
    * {
        padding: 0;
        margin: 0;
    }

    .page {
        position: absolute;
        border: 1px solid black;
    }

    .page#page-0 {        
        border-color: #FF0000AA;
    }

    .page#page-1 {        
        border-color: #00FF00AA;
    } 
    
    .page#page-2 {        
        border-color: #0000FFAA;
    }

    .row {
        position: absolute;
        width: 100%;
        height: 100%;
    }
</style>

<?php
    $parser = new Parser();
    $document = $parser->parseFile('samples/private/CZ-866.pdf');


    $prevPageHeight = 0;
    $pages = $document->getPages();
    foreach ($pages as $index => $page) {
        if (null === $page) {
            continue;
        }
       
        $height = -1;
        $map = $page->getTextMap();

        // Then render items
        foreach($map as $item) {
            $matrix = join(',', $item['matrix']);
            [ $x, $y ] = $item['pos'];
            echo "<div style='transform: matrix({$matrix});' class='page' id='page-{$index}'>{$item['text']}</div>";
        }
        break;
    }

?>