<?php
session_start();
include 'config.php';
$rezervimId = $_GET['rezId'];

if(isset($rezervimId)){

    $mbyllSQL = "UPDATE rezervimet SET klient_emer='',klient_mbiemer='',dhoma_status=1,pijet='',ora_hyrjes=null,ora_daljes=null,dhoma_cmimi_pijeve=0,dhoma_cmimi=500 WHERE rezervim_id = {$rezervimId}";
    $mbyll = $conn->query($mbyllSQL);
    if($mbyll === TRUE){
        header('Location: ../menaxhimi_dhomave.php');
    }else{
        header('Location: ../mbyll_dhomen.php?rezId='.$rezervimId);
    }
}


