<?php

/** @var $content string */

?>

<style>
    *{margin:0;padding:0;}
    .table_moved_list{
        width: 97%;
        border-collapse: collapse;
    }
    .table_moved_list th,
    .table_moved_list td {
        border: 1px solid #000;
        padding: 3px;
    }
    .barcode_image_container svg,
    .barcode_image_container img {
        height: auto;
        width: 100%;
    }
</style>
<body onload="print()"><p>&nbsp;</p>
<?= $content ?>
<style type="text/css">p.dline {
        line-height: 0.7;
    }
    P {
        line-height: 1em;
    }
</style>
</body>
