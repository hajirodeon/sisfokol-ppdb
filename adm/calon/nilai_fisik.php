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
$filenya = "nilai_fisik.php";
$judul = "Calon : Nilai Fisik";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$swkd = nosql($_REQUEST['swkd']);
$noregx = nosql($_REQUEST['noregx']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}






//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	$ke = "nilai.php";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//isi *START
ob_start();



//js
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//query
$qdt = mysql_query("SELECT * FROM psb_siswa_calon ".
						"WHERE kd = '$swkd' ".
						"AND no_daftar = '$noregx'");
$rdt = mysql_fetch_assoc($qdt);
$dt_noregx = nosql($rdt['no_daftar']);
$dt_nama = balikin($rdt['nama']);


echo '<form action="'.$filenya.'" method="post" name="formx">
<a href="nilai.php">Nilai-Nilai</a> > Nilai Fisik
<br>
<br>


<strong>No. Pendaftaran :</strong> '.$dt_noregx.', <strong>Nama : </strong>'.$dt_nama.'.
<br>
<br>';




//nilaine...
$qnile = mysql_query("SELECT * FROM psb_siswa_calon_fisik ".
						"WHERE kd_siswa_calon = '$swkd'");
$rnile = mysql_fetch_assoc($qnile);
$e_nilai1 = nosql($rnile['tinggi_badan']);
$e_nilai2 = nosql($rnile['tindik_tatto']);
$e_nilai3 = nosql($rnile['buta_warna']);
$e_nilai4 = nosql($rnile['cacat_fisik']);
$e_nilai5 = nosql($rnile['penampilan']);
$e_nilaiku = nosql($rnile['nilai']);


//jika
if ($e_nilai1 == "true")
	{
	$e_nilai1_ket = "Lulus";
	}
else if ($e_nilai1 == "false")
	{
	$e_nilai1_ket = "Tidak Lulus";
	}

//jika
if ($e_nilai2 == "true")
	{
	$e_nilai2_ket = "Lulus";
	}
else if ($e_nilai2 == "false")
	{
	$e_nilai2_ket = "Tidak Lulus";
	}


//jika
if ($e_nilai3 == "true")
	{
	$e_nilai3_ket = "Lulus";
	}
else if ($e_nilai3 == "false")
	{
	$e_nilai3_ket = "Tidak Lulus";
	}


//jika
if ($e_nilai4 == "true")
	{
	$e_nilai4_ket = "Lulus";
	}
else if ($e_nilai4 == "false")
	{
	$e_nilai4_ket = "Tidak Lulus";
	}


//jika
if ($e_nilai5 == "true")
	{
	$e_nilai5_ket = "Lulus";
	}
else if ($e_nilai5 == "false")
	{
	$e_nilai5_ket = "Tidak Lulus";
	}



//jika
if ($e_nilaiku == "true")
	{
	$e_nilaiku_ket = "Lulus";
	}
else if ($e_nilaiku == "false")
	{
	$e_nilaiku_ket = "Tidak Lulus";
	}








echo '<p>
Tinggi Badan :
<br>
<strong>'.$e_nilai1_ket.'</strong>
</p>

<p>
Tidak Tindik atau Tatto :
<br>
<strong>'.$e_nilai2_ket.'</strong>
</p>

<p>
Tidak Buta Warna :
<br>
<strong>'.$e_nilai3_ket.'</strong>
</p>

<p>
Tidak Cacat Fisik :
<br>
<strong>'.$e_nilai4_ket.'</strong>
</p>


<p>
Penampilan (periksa rambut,kalung, anting, gelang dan seragam rapi) :
<br>
<strong>'.$e_nilai5_ket.'</strong>
</p>

<hr>



<p>
Kesimpulan Akhir Tes Fisik :
<br>
<strong>'.$e_nilaiku_ket.'</strong>
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
xclose($koneksi);
exit();
?>