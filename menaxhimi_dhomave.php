<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
}
include 'app/config.php';

$merrDhomatSQl = "SELECT * FROM rezervimet";
$dhomat = $conn->query($merrDhomatSQl);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dhomat e Dites</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
            <li class="sidebar-brand"><a href="#">Hotel Arberia</a></li>
            <li><a class="menu-active" href="menaxhimi_dhomave.php">Dhomat e Dites</a></li>
            <li><a href="dhomat_e_nates.php">Dhomat e Nates</a></li>
            <li><a href="app/logout.php">Dil</a></li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h1>Dhomat e Dites</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">


                        <table id="mytable" class="table table-bordred table-striped">

                            <thead>
                            <th style="text-align: center">Dhoma #</th>
                            <th>Emer</th>
                            <th>Mbiemer</th>
                            <th>Pijet</th>
                            <th>Totali Pijeve</th>
                            <th>Ora Hyrjes</th>
                            <th>Cmimi Dhomes (/ore)</th>
                            <th>Statusi</th>
                            <th>Modifiko</th>
                            <th>Mbyll</th>
                            </thead>
                            <tbody>
                            <?php while ($dhoma = $dhomat->fetch_assoc()) {
                                $statusi = $dhoma['dhoma_status']; ?>

                                <tr>
                                    <td id="id-room-<?php echo $dhoma['dhoma_id']?>" style="text-align: center;font-weight: bold"><?php echo $dhoma['dhoma_id'] ?></td>
                                    <td id="emer-room-<?php echo $dhoma['dhoma_id']?>">
                                        <?php if ($statusi == 1) {
                                            echo '---';
                                        } else {
                                            echo $dhoma['klient_emer'];
                                        } ?></td>
                                    <td id="mbiemer-room-<?php echo $dhoma['dhoma_id']?>">
                                        <?php if ($statusi == 1) {
                                            echo '---';
                                        } else {
                                            echo $dhoma['klient_mbiemer'];
                                        } ?></td>
                                    <td id="pijet-room-<?php echo $dhoma['dhoma_id']?>">
                                        <?php if ($statusi == 1) {
                                            echo '---';
                                        } else {
                                            echo $dhoma['pijet'];
                                        } ?></td>
                                    <td id="cmimi-pijet-room-<?php echo $dhoma['dhoma_id']?>"><?php echo $dhoma['dhoma_cmimi_pijeve'] ?></td>
                                    <td id="ora-hyrjes-room-<?php echo $dhoma['dhoma_id']?>">
                                        <?php if ($statusi == 0) {
                                            echo $dhoma['ora_hyrjes'];
                                        } else { ?>
                                            <?php
                                            echo '---';
                                        } ?>
                                    </td>
                                    <td id="cmimi-room-<?php echo $dhoma['dhoma_id']?>"><?php echo $dhoma['dhoma_cmimi'] ?></td>
                                    <td id="status-room-<?php echo $dhoma['dhoma_id']?>">
                                        <?php if ($statusi == 1) { ?>
                                            <span data-value="<?php echo $statusi?>" class="label label-success">E Lire</span>
                                        <?php } else { ?>
                                            <span data-value="<?php echo $statusi?>" class="label label-danger">E Zene</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary btn-xs edit-button" data-title="Edit" data-toggle="modal"
                                                    data-id="<?php echo $dhoma['dhoma_id']?>" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                        </p>
                                    </td>
                                    <td>
                                        <p data-placement="top">

                                            <a class="<?php echo $statusi =='0'?'':'disabled'?>" href="<?php echo 'mbyll_dhomen.php?rezId=' . $dhoma['rezervim_id'] ?>">
                                                <button class="btn btn-danger btn-xs <?php echo $statusi =='0'?'':'disabled'?>"><span
                                                            class="glyphicon glyphicon-lock"></span>
                                                </button>
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="overflow-y: auto;height: 600px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="titull-edito-dhomen modal-title custom_align" id="Heading">Edito Detajet e Dhomes:</h4>
                    </div>
                    <form method="post" action="app/rezervoDhomen.php">
                        <div class="modal-body forma-editimit">
                            <div class="form-group">
                                Dhoma #:<input id="dhoma_nr" name="dhoma_nr" class="form-control" type="text" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="emri">Emri:</label>
                                <input id="emri" name="emri" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="mbiemri">Mbiemri:</label>
                                <input id="mbiemri" name="mbiemri" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="ora_hyrjes">Ora Hyrjes:</label>
                                <input id="ora_hyrjes" name="ora_hyrjes" class="form-control" type="text"
                                       placeholder="<?php echo date('H:i:s') ?>" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="pijet">Pijet:</label>
                                <textarea id="pijet" rows="5" cols="15" class="form-control" name="pijet"
                                          placeholder="Emri Pijes - Sasia"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="totali_pijeve">Totali Pijeve:</label>
                                <input id="totali_pijeve" name="totali_pijeve" class="form-control " type="text">
                            </div>
                            <div class="form-group">
                                <label for="cmimi_dhomes">Cmimi Dhomes:</label>
                                <input id="cmimi_dhomes" name="cmimi_dhomes" class="form-control " type="text">
                            </div>
                            <input type="hidden" name="status_dhome" id="status_dhome">
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span
                                        class="glyphicon glyphicon-ok-sign"></span> Ruaj
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>
</div>


</body>
<script type="text/javascript">
    var $ = jQuery.noConflict();
    $('.edit-button').click(function(){
        $('.modal').css('display','block');
        var rezervimId = $(this).attr('data-id');
        var statusDhoma = $('#status-room-'+rezervimId).find('span').attr('data-value');
        $('.forma-editimit #dhoma_nr').val($.trim($('#id-room-'+rezervimId).html()));
        /**
         * nqs dhoma e zene, merr vlerat nga tabela
         */
        if(statusDhoma == 0){
            $('.titull-edito-dhomen').html('Edito Detajet e Dhomes ( '+rezervimId+' ):');
            $('.forma-editimit #emri').val($.trim($('#emer-room-'+rezervimId).html()));
            $('.forma-editimit #mbiemri').val($.trim($('#mbiemer-room-'+rezervimId).html()));
            $('.forma-editimit #ora_hyrjes').val($.trim($('#ora-hyrjes-room-'+rezervimId).html()));
            $('.forma-editimit #pijet').val($.trim($('#pijet-room-'+rezervimId).html()));
            $('.forma-editimit #totali_pijeve').val($.trim($('#cmimi-pijet-room-'+rezervimId).html()));
            $('.forma-editimit #cmimi_dhomes').val($.trim($('#cmimi-room-'+rezervimId).html()));
            $('.forma-editimit #status_dhome').val(statusDhoma);



        }else{
            $('.titull-edito-dhomen').html('Edito Detajet e Dhomes:');
            $('.forma-editimit #ora_hyrjes').val('<?php echo date('Y-m-d H:i:s')?>');
            $('.forma-editimit #cmimi_dhomes').val($.trim($('#cmimi-room-'+rezervimId).html()));
            $('.forma-editimit #status_dhome').val(statusDhoma);
        }
    });
</script>
<script type="text/javascript">
    var $ = jQuery.noConflict();
    $( document ).ready(function() {
        $("a.disabled").removeAttr("href");
    });
</script>
</html>

