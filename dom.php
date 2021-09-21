<?php
use Dompdf\Dompdf;

require "vendor/autoload.php";
try {

$dompdf=new Dompdf();
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
$dompdf->loadHtml($output);
$dompdf->setPaper("A4",'landscape');
$dompdf->render();
$dompdf->stream();


} catch (Exception $th) {
    echo $th->getMessage();
}
?>
