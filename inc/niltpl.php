<?php

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
/////// SISFOKOL-PPDB                                           ///////
///////////////////////////////////////////////////////////////////////
/////// Dibuat oleh :                                           ///////
/////// Agus Muhajir, S.Kom                                     ///////
/////// URL 	:                                               ///////
///////     * http://sisfokol.wordpress.com/                    ///////
///////     * http://hajirodeon.wordpress.com/                  ///////
///////     * http://yahoogroup.com/groups/sisfokol/            ///////
///////     * http://yahoogroup.com/groups/linuxbiasawae/       ///////
/////// E-Mail	:                                               ///////
///////     * hajirodeon@yahoo.com                              ///////
///////     * hajirodeon@gmail.com                              ///////
/////// HP/SMS	: 081-829-88-54                                 ///////
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////


//nilai /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$konten = ParseVal($tpl, array ("judul" => $judul,
					"judulku" => $judulku,
					"sumber" => $sumber,
					"isi" => $isi,
					"diload" => $diload,
					"versi" => $versi,
					"author" => $author,
					"keywords" => $keywords,
					"url" => $url,
					"sesidt" => $sesidt,
					"filenya" => $filenya,
					"wkdet" => $wkdet,
					"wkurl" => $wkurl,
					"sek_nama" => $sek_nama,
					"sek_alamat" => $sek_alamat,
					"sek_kontak" => $sek_kontak,
					"sek_filex" => $sek_filex,
					"description" => $description));

//tampilkan
echo $konten;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//kill process //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
set_time_limit(600);  //set maksimal loading : 600 detik atau 10 menit
$result=mysql_query("show processlist");
while ($row=mysql_fetch_array($result))
	{
	$process_id=$row["Id"];

	if (($row["Time"] > 0) OR ($row["Command"]=="Sleep"))
		{
		//print $row["Id"];
		$sql="kill $process_id";
		mysql_query($sql);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>