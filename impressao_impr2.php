<?php 
use Dompdf\Dompdf;
require_once 'vendor/autoload.php';
//require __DIR__. '/vendor/autoload.php';
$dompdf = new Dompdf(["enable_remote" => true]);
ob_start();
require __DIR__.'/impressao.php';
$pdf = ob_get_clean(); 
$dompdf->loadHtml($pdf);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Clientes',['Attachment'=> false]);
?>