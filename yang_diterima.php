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


require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/info.html");

nocache;

//nilai
$filenya = "yang_diterima.php";
$judul = "Calon Yang Diterima";
$judulku = $judul;
$judulx = $judul;
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//isi *START
ob_start();




//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);






//js
require("inc/js/jumpmenu.js");
require("inc/js/swap.js");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="990" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">';

//daftar keahlian
$qkea = mysql_query("SELECT * FROM psb_m_keahlian ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY kode ASC");
$rkea = mysql_fetch_assoc($qkea);

do
	{
	//nilai
	$kea_kd = nosql($rkea['kd']);
	$kea_kode = nosql($rkea['kode']);
	$kea_kea = balikin($rkea['keahlian']);
	$kea_dayatampung = nosql($rkea['dayatampung']);


	//jml. diterima
	$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
				"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
				"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
				"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon.status_diterima = 'true' ".
				"AND psb_siswa_calon_rangking.nil_fisik = 'true' ".
				"AND psb_siswa_calon_rangking.nil_tertulis >= '0' ".
				"AND psb_siswa_calon_rangking.nil_raport >= '0' ".
				"AND psb_siswa_calon.kd_keahlian = '$kea_kd'");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);

	echo '<td>
	<big>
	<strong>'.$kea_kode.'</strong>
	</big>
	<br>
	'.$kea_kea.'
	</td>';
	}
while ($rkea = mysql_fetch_assoc($qkea));


echo '<td bgcolor="cyan">
<big>
<strong>TOTAL</strong>
</big>
</td>
</tr>


<tr bgcolor="yellow">'; //yang diterima

//daftar keahlian
$qkea = mysql_query("SELECT * FROM psb_m_keahlian ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY kode ASC");
$rkea = mysql_fetch_assoc($qkea);

do
	{
	//nilai
	$kea_kd = nosql($rkea['kd']);
	$kea_kode = nosql($rkea['kode']);
	$kea_kea = balikin($rkea['keahlian']);
	$kea_dayatampung = nosql($rkea['dayatampung']);


	//jml. diterima
	$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
				"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
				"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
				"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon.status_diterima = 'true' ".
				"AND psb_siswa_calon_rangking.nil_fisik = 'true' ".
				"AND psb_siswa_calon_rangking.nil_tertulis >= '0' ".
				"AND psb_siswa_calon_rangking.nil_raport >= '0' ".
				"AND psb_siswa_calon.kd_keahlian = '$kea_kd'");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);

	echo '<td>
	Yang Diterima :
	<h1>
	<big>
	<strong>'.$tku.'</strong>
	</big>
	</h1>
	</td>';
	}
while ($rkea = mysql_fetch_assoc($qkea));


//jml. diterima
$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
			"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
			"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
			"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon.status_diterima = 'true' ".
			"AND psb_siswa_calon_rangking.nil_fisik = 'true' ".
			"AND psb_siswa_calon_rangking.nil_tertulis >= '0' ".
			"AND psb_siswa_calon_rangking.nil_raport >= '0'");
$rku = mysql_fetch_assoc($qku);
$tku = mysql_num_rows($qku);


echo '<td bgcolor="cyan">
<h1>
<big>
<strong>'.$tku.'</strong>
</big>
</h1>
</td>
</tr>


<tr bgcolor="green">'; //daya tampung

//daftar keahlian
$qkea = mysql_query("SELECT * FROM psb_m_keahlian ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY kode ASC");
$rkea = mysql_fetch_assoc($qkea);

do
	{
	//nilai
	$kea_kd = nosql($rkea['kd']);
	$kea_kode = nosql($rkea['kode']);
	$kea_kea = balikin($rkea['keahlian']);
	$kea_kelas = nosql($rkea['jml_kelas']);
	$kea_siswa = nosql($rkea['jml_siswa']);
	//$kea_dayatampung1 = nosql($rkea['dayatampung']);
	$kea_dayatampung = $kea_siswa;


/*
	//jml. diterima
	$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
				"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
				"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
				"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon.status_diterima = 'true' ".
				"AND psb_siswa_calon_rangking.nil_fisik = 'true' ".
				"AND psb_siswa_calon_rangking.nil_tertulis >= '0' ".
				"AND psb_siswa_calon_rangking.nil_raport >= '0' ".
				"AND psb_siswa_calon.kd_keahlian = '$kea_kd'");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);
*/


	echo '<td>
	Daya Tampung :
	<br>
	<big>
	<strong>'.$kea_dayatampung.'</strong>
	</big>
	</td>';
	}
while ($rkea = mysql_fetch_assoc($qkea));



//total
$qku = mysql_query("SELECT SUM(jml_siswa) AS total ".
			"FROM psb_m_keahlian ".
			"WHERE kd_tapel = '$tp_tapelkd' ");
$rku = mysql_fetch_assoc($qku);
$tku = mysql_num_rows($qku);
$ku_total = nosql($rku['total']);


echo '<td bgcolor="cyan">
<h1>
<big>
<strong>'.$ku_total.'</strong>
</big>
</h1>
</td>
</tr>




<tr bgcolor="orange">';//lulus tes fisik

//daftar keahlian
$qkea = mysql_query("SELECT * FROM psb_m_keahlian ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY kode ASC");
$rkea = mysql_fetch_assoc($qkea);

do
	{
	//nilai
	$kea_kd = nosql($rkea['kd']);
	$kea_kode = nosql($rkea['kode']);
	$kea_kea = balikin($rkea['keahlian']);
	$kea_dayatampung = nosql($rkea['dayatampung']);


	//jml. diterima
	$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
				"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
				"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
				"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon_rangking.nil_fisik = 'true' ".
				"AND psb_siswa_calon.kd_keahlian = '$kea_kd'");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);

	echo '<td>
	Jumlah Yang Lulus Tes Fisik :
	<br>
	<big>
	<strong>'.$tku.'</strong>
	</big>
	</td>';
	}
while ($rkea = mysql_fetch_assoc($qkea));



//jml. fisik
$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
			"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
			"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
			"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon_rangking.nil_fisik = 'true'");
$rku = mysql_fetch_assoc($qku);
$tku = mysql_num_rows($qku);


echo '<td bgcolor="cyan">
<h1>
<big>
<strong>'.$tku.'</strong>
</big>
</h1>
</td>
</tr>




<tr bgcolor="violet">'; //pendaftar

//daftar keahlian
$qkea = mysql_query("SELECT * FROM psb_m_keahlian ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY kode ASC");
$rkea = mysql_fetch_assoc($qkea);

do
	{
	//nilai
	$kea_kd = nosql($rkea['kd']);
	$kea_kode = nosql($rkea['kode']);
	$kea_kea = balikin($rkea['keahlian']);
	$kea_dayatampung = nosql($rkea['dayatampung']);


	//jml. diterima
	$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama ".
				"FROM psb_siswa_calon ".
				"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon.nama <> '' ".
				"AND psb_siswa_calon.kd_keahlian = '$kea_kd'");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);

	echo '<td>
	Jumlah Pendaftar :
	<br>
	<big>
	<strong>'.$tku.'</strong>
	</big>
	</td>';
	}
while ($rkea = mysql_fetch_assoc($qkea));


/*
//jml. pendaftar
$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama ".
			"FROM psb_siswa_calon ".
			"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon.nama <> ''");
$rku = mysql_fetch_assoc($qku);
$tku = mysql_num_rows($qku);
*/


//jml. pendaftar
$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama ".
			"FROM psb_siswa_calon ".
			"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon.nama <> ''");
$rku = mysql_fetch_assoc($qku);
$tku = mysql_num_rows($qku);



echo '<td bgcolor="cyan">
<h1>
<big>
<strong>'.$tku.'</strong>
</big>
</h1>
</td>
</tr>


</table>';



echo '</form>
<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>
