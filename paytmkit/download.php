<?php

ob_start();
require 'Cdata.php';
require_once 'dompdf/autoload.inc.php'; 

// Reference the Dompdf namespace 
use Dompdf\Dompdf; 

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
 	
$i=$id;
$c1=$c;
$a1=$a;
$d=date('Y-m-d');
$m1=$m;

$out='<html><body>
  <div style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
        <div style="width:750px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
       <span style="font-size:50px; font-weight:bold">Certificate of Donation</span>
       <br><br>
       <span style="font-size:25px"><i>A big Thanks for Donating</i></span>
       <br><br>
       <span style="font-size:30px"><b> '.$m.' '.$id.'</b></span><br/><br/>
       <span style="font-size:25px"><i>Your This Contribution Of RS '.$a.' Will Save Many Lives</i></span> <br/><br/>
       
     
       <span style="font-size:25px"><i>CATEGORY '.$c.' </i></span><br>
        <span style="font-size:25px"><i>'.$d.'</i></span><br>
	
	<img src="Trust.jpg" height="250px" width="300px"/>
		
        </div>
        </div>
        </body>
        </html>';
         $dompdf->loadHtml($out);
        // (Optional) Setup the paper size and orientation 
        $dompdf->setPaper('A4', 'landscape'); 
 
        // Render the HTML as PDF 
        $dompdf->render(); 
 
        // Output the generated PDF to Browser 
     
        $dompdf->stream("codexworld", array("Attachment" => 0));
        

?>
