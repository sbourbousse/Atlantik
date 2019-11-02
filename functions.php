<?php
function getPortNom ($maBase,$portId)
{
    $req="select portNom from port where portId=".$portId;
    $res=mysqli_query($maBase,$req);
    $row=mysqli_fetch_row($res);

    return $row[0];
}

function convertDate ($date)
{
    if ($date[8]=='0')$date[8]=' ';
    if ($date[5].$date[6]=='01') return $date[8].$date[9].' Janvier '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='02')return $date[8].$date[9].' Fevrier '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='03')return $date[8].$date[9].' Mars '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='04')return $date[8].$date[9].' Avril '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='05')return $date[8].$date[9].' Mai '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='06')return $date[8].$date[9].' Juin '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='07')return $date[8].$date[9].' Juillet '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='08')return $date[8].$date[9].' Aout '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='09')return $date[8].$date[9].' Septembre '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='10')return $date[8].$date[9].' Octobre '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='11')return $date[8].$date[9].' Novembre '.$date[0].$date[1].$date[2].$date[3];
    else if ($date[5].$date[6]=='12')return $date[8].$date[9].' Decembre '.$date[0].$date[1].$date[2].$date[3];

}
?>