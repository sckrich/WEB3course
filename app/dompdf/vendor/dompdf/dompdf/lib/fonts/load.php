   <?php
   require_once __DIR__ . '../../../autoload.inc.php'; 

   use Dompdf\Dompdf;
   use Dompdf\FontMetrics;

   
   $fontDir = 'app/dompdf/dompdf/lib/fonts/';
   $fontFile = $fontDir . 'go.ttf';

   if (file_exists($fontFile)) {
       FontMetrics::init();
       FontMetrics::set_font_family('Go', [
           'normal' => $fontFile,
           'bold' => null,
           'italic' => null,
           'bold_italic' => null,
       ]);
       echo "Шрифт успешно зарегистрирован!";
   } else {
       echo "Файл шрифта не найден!";
   }
