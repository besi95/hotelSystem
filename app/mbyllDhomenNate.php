<?php
session_start();
include 'config.php';
$rezervimId = $_GET['rezId'];

if(isset($rezervimId)){

    $mbyllSQL = "UPDATE dhomat_e_nates SET klient_emer='',klient_mbiemer='',statusi=1,pijet='',hyrja=null,dalja=null,cmimi_pijeve=0,cmimi_dhomes=3000 WHERE dhoma_id = {$rezervimId}";
    $mbyll = $conn->query($mbyllSQL);
    if($mbyll === TRUE){
        header('Location: ../dhomat_e_nates.php');
    }else{
        header('Location: ../mbyll_dhomen_e_nates.php?rezId='.$rezervimId);
    }
}


