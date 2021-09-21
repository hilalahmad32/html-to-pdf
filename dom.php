<?php
// use Dompdf\Options;
use Dompdf\Dompdf;

require "vendor/autoload.php";
try {
// $option=new Options();
// $option->set("defaultFont","Time New Roman");

$dompdf=new Dompdf();
$page=file_get_contents("index.html");
// $dompdf->loadHtml($page);

$conn=mysqli_connect("localhost","root","","testing");
$sql="SELECT * FROM category";
$run_sql=mysqli_query($conn,$sql);
$output="";
if(mysqli_num_rows($run_sql) > 0){
    while($row=mysqli_fetch_assoc($run_sql)){
        $output .="
        <h2>{$row["name"]}</h2>
        ";
    }
}
// $option=$dompdf->getOptions();
// $option->setDefaultFont("Cambria, Cochin, Georgia, Times, 'Times New Roman', serif");
// $dompdf->setOptions($option);
$dompdf->loadHtml($output);
// $dompdf->setPaper("A4",'portrait');
$dompdf->setPaper("A4",'landscape');
$dompdf->render();
$dompdf->stream();


} catch (Exception $th) {
    echo $th->getMessage();
}
?>