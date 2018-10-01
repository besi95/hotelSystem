<?php
session_start();
include 'config.php';

$dhomeId = $_POST['dhoma_nr'];
$emerDhome = $conn->real_escape_string($_POST['emri']);
$mbiemerDhome = $conn->real_escape_string($_POST['mbiemri']);
$oraHyrjesDhome = $conn->real_escape_string($_POST['ora_hyrjes']);
$statusDhome = $_POST['status_dhome'];
$pijetDhome = $conn->real_escape_string($_POST['pijet']);
$cmimiDhomes = doubleval($_POST['cmimi_dhomes']);
$cmimiPijeveDhome = doubleval($conn->real_escape_string($_POST['totali_pijeve']));
$oraAktuale = date('Y-m-d H:i:s');


/**
 * editim i nje rezervimi aktual
 */
if ($statusDhome == '0') {

    $editoSQL = "UPDATE rezervimet SET klient_emer='{$emerDhome}',
                  klient_mbiemer='{$mbiemerDhome}',dhoma_status='0',pijet='{$pijetDhome}',
                  ora_hyrjes='{$oraHyrjesDhome}',ora_daljes=null,dhoma_cmimi='{$cmimiDhomes}',dhoma_cmimi_pijeve='{$cmimiPijeveDhome}' 
                  WHERE rezervim_id = {$dhomeId}";
    $edito = $conn->query($editoSQL);
    header('Location: ../menaxhimi_dhomave.php');
} /**
 * shtim i nje rezervimi
 */
else {

    $shtoSQL = "UPDATE rezervimet SET klient_emer='{$emerDhome}',
                  klient_mbiemer='{$mbiemerDhome}',dhoma_status='0',pijet='{$pijetDhome}',
                  ora_hyrjes='{$oraAktuale}',ora_daljes=null,dhoma_cmimi='{$cmimiDhomes}',dhoma_cmimi_pijeve='{$cmimiPijeveDhome}' 
                  WHERE rezervim_id = {$dhomeId}";
    $shto = $conn->query($shtoSQL);
    header('Location: ../menaxhimi_dhomave.php');
}



