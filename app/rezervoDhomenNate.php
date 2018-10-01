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

    $editoSQL = "UPDATE dhomat_e_nates SET klient_emer='{$emerDhome}',
                  klient_mbiemer='{$mbiemerDhome}',statusi='0',pijet='{$pijetDhome}',
                  hyrja='{$oraHyrjesDhome}',dalja=null,cmimi_dhomes='{$cmimiDhomes}',cmimi_pijeve='{$cmimiPijeveDhome}' 
                  WHERE dhoma_id = {$dhomeId}";
    $edito = $conn->query($editoSQL);
    header('Location: ../dhomat_e_nates.php');
} /**
 * shtim i nje rezervimi
 */
else {

    $shtoSQL = "UPDATE dhomat_e_nates SET klient_emer='{$emerDhome}',
                  klient_mbiemer='{$mbiemerDhome}',statusi='0',pijet='{$pijetDhome}',
                  hyrja='{$oraAktuale}',dalja=null,cmimi_dhomes='{$cmimiDhomes}',cmimi_pijeve='{$cmimiPijeveDhome}' 
                  WHERE dhoma_id = {$dhomeId}";
    $shto = $conn->query($shtoSQL);
    header('Location: ../dhomat_e_nates.php');
}



