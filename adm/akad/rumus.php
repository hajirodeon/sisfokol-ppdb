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


session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/psb_adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "rumus.php";
$judul = "Rumus Nilai";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);





//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);





//PROSES ///////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$yuk6 = "persen_tertulis";
	$yuhu6 = "$yuk6";
	$nilku6 = nosql($_POST["$yuhu6"]);

	$yuk7 = "persen_prestasi";
	$yuhu7 = "$yuk7";
	$nilku7 = nosql($_POST["$yuhu7"]);

	$yuk8 = "persen_sertifikat";
	$yuhu8 = "$yuk8";
	$nilku8 = nosql($_POST["$yuhu8"]);

	$yuk9 = "persen_un";
	$yuhu9 = "$yuk9";
	$nilku9 = nosql($_POST["$yuhu9"]);
	
	

	//cek
	$qcc = mysql_query("SELECT * FROM psb_m_rumus ".
							"WHERE kd_tapel = '$tp_tapelkd'");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);

	//jika ada
	if ($tcc != 0)
		{
		mysql_query("UPDATE psb_m_rumus SET persen_tertulis = '$nilku6', ".
						"persen_prestasi = '$nilku7', ".
						"persen_sertifikat = '$nilku8', ".
						"persen_un = '$nilku9', ".
						"postdate = '$today' ".
						"WHERE kd_tapel = '$tp_tapelkd'");
		}
	else
		{
		mysql_query("INSERT INTO psb_m_rumus(kd, kd_tapel, persen_tertulis, ".
						"persen_prestasi, persen_sertifikat, persen_un, postdate) VALUES ".
						"('$x', '$tp_tapelkd', '$nilku6', ".
						"'$nilku7', '$nilku8', '$nilku9', '$today')");
		}
	}
//PROSES ///////////////////////////////////////////////////////////////////////////////////////////














//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';


//datanya
$qcc = mysql_query("SELECT * FROM psb_m_rumus ".
			"WHERE kd_tapel = '$tp_tapelkd'");
$rcc = mysql_fetch_assoc($qcc);
$tcc = mysql_num_rows($qcc);
$cc_p_tertulis = nosql($rcc['persen_tertulis']);
$cc_p_prestasi = nosql($rcc['persen_prestasi']);
$cc_p_sertifikat = nosql($rcc['persen_sertifikat']);
$cc_p_un = nosql($rcc['persen_un']);
$cc_postdate = $rcc['postdate'];


echo '<p>
<hr>
<i>
Per Entri Terakhir : '.$cc_postdate.'
</i>
<hr>
</p>

<p>
Bobot Nilai Tertulis =
<br>
<input name="persen_tertulis" type="text" value="'.$cc_p_tertulis.'" size="5">% .
</p>

<p>
Bobot Nilai Prestasi =
<br>
<input name="persen_prestasi" type="text" value="'.$cc_p_prestasi.'" size="5">% .
</p>

<p>
Bobot Nilai Sertifikat =
<br>
<input name="persen_sertifikat" type="text" value="'.$cc_p_sertifikat.'" size="5">% .
</p>

<p>
Bobot Nilai UN =
<br>
<input name="persen_un" type="text" value="'.$cc_p_un.'" size="5">% .
</p>


<p>
<input name="btnSMP" type="submit" value="SIMPAN">
</p>


</form>
<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>
