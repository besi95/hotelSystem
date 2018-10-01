<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.html');
}
include 'app/config.php';
$rezervimId = $_GET['rezId'];
$merrDhomenSQl = "SELECT * FROM dhomat_e_nates WHERE dhoma_id = {$rezervimId}";

$dhoma = $conn->query($merrDhomenSQl);
$dhoma = $dhoma->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Hotel Arberia</title>
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <link href="vendor/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="vendor/bootstrap-3.3.0/dist/js/bootstrap.min.js"></script>

    </head>

    <body>

    <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Hotel Arberia
                    </a>
                </li>
                <li><a href="menaxhimi_dhomave.php">Dhomat e Dites</a></li>
                <li><a class="menu-active"  href="dhomat_e_nates.php">Dhomat e Nates</a></li>
                <li>
                    <a href="app/logout.php">Dil</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid" id="mbyll-dhomen-fature">
                Website: <a href="https://hotelarberia.com">https://hotelarberia.com</a>
                <p><?php echo "Data: ".date('Y-m-d')?></p>
                <div class="fatura-dhomes">
                    <p><b>Emer: </b><?php echo $dhoma['klient_emer']?></p>
                    <p><b>Mbiemer: </b><?php echo $dhoma['klient_mbiemer']?></p>
                    <p><b>Pijet: </b><?php echo $dhoma['pijet']?></p>
                    <p><b>Total Pijet: </b><?php echo $dhoma['cmimi_pijeve']?></p>
                    <p><b>Ora Hyrjes: </b><?php echo $dhoma['hyrja']?></p>
                    <p><b>Ora Daljes: </b><?php echo date('Y-m-d H:i:s')?></p>
                    <p><b>Qendrim Total: </b><?php echo llogaritOret($dhoma['hyrja'],date('Y-m-d H:i:s'))?></p>
                    <p><b>Cmimi Dhomes: </b><?php echo $dhoma['cmimi_dhomes'].' LEK/nate'?></p>
                    <p><b style="color: red">TOTALI: </b><?php echo llogaritTotalin($dhoma['hyrja'],date('Y-m-d H:i:s'),$dhoma['cmimi_pijeve'],$dhoma['cmimi_dhomes']).' LEK'?></p>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-info btn-lg" style="width: 45%;" onclick="PrintDiv()"><span
                        class="glyphicon glyphicon-print"></span> Printo Faturen
                </button>
                <a href="app/mbyllDhomenNate.php?rezId=<?php echo $rezervimId?>" onclick="return confirm('Jeni i sigurte qe deshironi te mbyllni dhomen?')"><button type="button" class="btn btn-danger btn-lg" style="width: 45%;"><span
                            class="glyphicon glyphicon-lock"></span> Mbyll Dhomen
                    </button></a></div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->


    </body>
    <script type="text/javascript">
        function PrintDiv() {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');
            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title  + '</h1>');
            mywindow.document.write(document.getElementById('mbyll-dhomen-fature').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }
    </script>

    </html>

<?php
function llogaritTotalin($oraHyrjes, $oraDaljes, $totaliPijeve,$cmimiDhomesNate)
{
    $oraHyrjes = strtotime($oraHyrjes);
    $oraDaljes = strtotime($oraDaljes);
    /**
     * rrumbullakos ne ore
     */
    $oretEqendrimit = ceil(abs($oraDaljes - $oraHyrjes) / (60 * 60 * 24));
    $cmimiDhomes = $oretEqendrimit * $cmimiDhomesNate;
    $totaliDhomes = $cmimiDhomes + $totaliPijeve;
    return $totaliDhomes;

}

function llogaritOret($oraHyrjes, $oraDaljes)
{
    $diff = abs(strtotime($oraDaljes) - strtotime($oraHyrjes));
    $tmins = $diff / 60;
    $hours = floor($tmins / 60);
    $mins = $tmins % 60;

    return $hours . ' ore ' . $mins . ' min';
}

?>