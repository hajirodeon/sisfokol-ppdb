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
$tpl = LoadTpl("../../template/print.html");

nocache;

//nilai
$filenya = "statistik_prt.php";
$judul = "Statistik";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;


//re-direct print
$ke = "statistik.php";
$diload = "window.print();location.href='$ke';";


//isi *START
ob_start();






//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);
$tp_dayatampung = nosql($rtp['dayatampung']);








//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top">
<td>
<h1><strong>'.$sek_nama.'</strong></h1>
'.$sek_alamat.'.

'.$sek_kontak.'
</td>
</tr>
</table>
<hr>


<table width="600" border="0" cellspacing="3" cellpadding="0">
<tr align="center">
<td><h1><strong>'.$judul.'</strong></h1></td>
</tr>
</table>

<table width="990" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td>';


//jml. pendaftar - laki2 ///////////////////////////////////////////////////////////////////////
$qdftl = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"AND kelamin = 'L'");
$rdftl = mysql_fetch_assoc($qdftl);
$tdftl = mysql_num_rows($qdftl);

//jml. pendaftar - perempuan
$qdftp = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"AND kelamin = 'P'");
$rdftp = mysql_fetch_assoc($qdftp);
$tdftp = mysql_num_rows($qdftp);

//jml.pendaftar total
$tdft = $tdftl + $tdftp;

//persen grafik
if ((empty($tdftl)) OR (empty($tdft)))
	{
	$dft_laki = 0;
	}
else
	{
	$dft_laki = round(($tdftl/$tdft) * 100);
	}

if ((empty($tdftp)) OR (empty($tdft)))
	{
	$dft_per = 0;
	}
else
	{
	$dft_per = round(($tdftp/$tdft) * 100);
	}
////////////////////////////////////////////////////////////////////////////////////////////////




//yang diterima - laki2 ////////////////////////////////////////////////////////////////////////
$qdtil = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE status_diterima = 'true' ".
			"AND kd_tapel = '$tp_tapelkd' ".
			"AND kelamin = 'L'");
$rdtil = mysql_fetch_assoc($qdtil);
$tdtil = mysql_num_rows($qdtil);

//yang diterima - perempuan
$qdtip = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE status_diterima = 'true' ".
			"AND kd_tapel = '$tp_tapelkd' ".
			"AND kelamin = 'P'");
$rdtip = mysql_fetch_assoc($qdtip);
$tdtip = mysql_num_rows($qdtip);

//total yang diterima
$tdti = $tdtil + $tdtip;

//persen grafik
if ((empty($tdtil)) OR (empty($tdti)))
	{
	$dti_laki = 0;
	}
else
	{
	$dti_laki = round(($tdtil/$tdti) * 100);
	}

if ((empty($tdtip)) OR (empty($tdti)))
	{
	$dti_per = 0;
	}
else
	{
	$dti_per = round(($tdtip/$tdti) * 100);
	}
////////////////////////////////////////////////////////////////////////////////////////////////




//yang ditolak - laki2 /////////////////////////////////////////////////////////////////////////
$qdtol = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE status_diterima = 'false' ".
			"AND kd_tapel = '$tp_tapelkd' ".
			"AND kelamin = 'L'");
$rdtol = mysql_fetch_assoc($qdtol);
$tdtol = mysql_num_rows($qdtol);

//yang ditolak - perempuan
$qdtop = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE status_diterima = 'false' ".
			"AND kd_tapel = '$tp_tapelkd' ".
			"AND kelamin = 'P'");
$rdtop = mysql_fetch_assoc($qdtop);
$tdtop = mysql_num_rows($qdtop);

//total yang ditolak
$tdto = $tdtol + $tdtop;

//persen grafik
if ((empty($tdtol)) OR (empty($tdto)))
	{
	$dto_laki = 0;
	}
else
	{
	$dto_laki = round(($tdtol/$tdto) * 100);
	}

if ((empty($tdtop)) OR (empty($tdto)))
	{
	$dto_per = 0;
	}
else
	{
	$dto_per = round(($tdtop/$tdto) * 100);
	}
////////////////////////////////////////////////////////////////////////////////////////////////



//nilai tertinggi //////////////////////////////////////////////////////////////////////////////
$qkin = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon_rangking.* ".
			"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
			"WHERE psb_siswa_calon_rangking.kd_siswa_calon = psb_siswa_calon.kd ".
			"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon.status_diterima = 'true' ".
			"ORDER BY round(psb_siswa_calon_rangking.rata) DESC");
$rkin = mysql_fetch_assoc($qkin);
$kin_tinggi = nosql($rkin['total']);

//nek null
if (empty($kin_tinggi))
	{
	$kin_tinggi = "_";
	}

//nilai terendah
$qkid = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon_rangking.* ".
			"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
			"WHERE psb_siswa_calon_rangking.kd_siswa_calon = psb_siswa_calon.kd ".
			"AND psb_siswa_calon.status_diterima = 'true' ".
			"AND psb_siswa_calon_rangking.rata <> '0' ".
			"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"ORDER BY round(psb_siswa_calon_rangking.rata) ASC");
$rkid = mysql_fetch_assoc($qkid);
$kid_rendah = nosql($rkid['total']);

//nek null
if (empty($kid_rendah))
	{
	$kid_rendah = "_";
	}
////////////////////////////////////////////////////////////////////////////////////////////////



//jml. sekolah negeri //////////////////////////////////////////////////////////////////////////
$qson = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE status_diterima = 'true' ".
			"AND kd_tapel = '$tp_tapelkd' ".
			"AND status_sekolah = 'Negeri'");
$rson = mysql_fetch_assoc($qson);
$tson = mysql_num_rows($qson);

//jml. sekolah swasta
$qswa = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE status_diterima = 'true' ".
			"AND kd_tapel = '$tp_tapelkd' ".
			"AND status_sekolah = 'Swasta'");
$rswa = mysql_fetch_assoc($qswa);
$tswa = mysql_num_rows($qswa);

//total
$tsux = $tson + $tswa;

//persen grafik
if ((empty($tson)) OR (empty($tsux)))
	{
	$sux_negeri = 0;
	}
else
	{
	$sux_negeri = round(($tson/$tsux) * 100);
	}

if ((empty($tswa)) OR (empty($tsux)))
	{
	$sux_swasta = 0;
	}
else
	{
	$sux_swasta = round(($tswa/$tsux) * 100);
	}
////////////////////////////////////////////////////////////////////////////////////////////////



echo '[Daya Tampung : '.$tp_dayatampung.'].
</td>
</tr>
</table>

<table width="300" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td>
Jumlah Pendaftar
</td>
<td>
:
</td>
<td>
<strong>'.$tdft.'</strong>
</td>
</tr>

<tr valign="top">
<td align="right">
Laki-Laki
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$dft_laki.'" bgcolor="cyan"><strong>'.$tdftl.'</strong></td>
</tr>
</table>


</td>
</tr>

<tr valign="top">
<td align="right">
Perempuan
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$dft_per.'" bgcolor="cyan"><strong>'.$tdftp.'</strong></td>
</tr>
</table>

</td>
</tr>

<tr valign="top">
<td>
Jumlah Diterima
</td>
<td>
:
</td>
<td>
<strong>'.$tdti.'</strong>
</td>
</tr>

<tr valign="top">
<td align="right">
Laki-Laki
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$dti_laki.'" bgcolor="cyan"><strong>'.$tdtil.'</strong></td>
</tr>
</table>

</td>
</tr>

<tr valign="top">
<td align="right">
Perempuan
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$dti_per.'" bgcolor="cyan"><strong>'.$tdtip.'</strong></td>
</tr>
</table>


</td>
</tr>

<tr valign="top">
<td>
Jumlah Ditolak
</td>
<td>
:
</td>
<td>
<strong>'.$tdto.'</strong>
</td>
</tr>

<tr valign="top">
<td align="right">
Laki-Laki
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$dto_laki.'" bgcolor="cyan"><strong>'.$tdtol.'</strong></td>
</tr>
</table>

</td>
</tr>

<tr valign="top">
<td align="right">
Perempuan
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$dto_per.'" bgcolor="cyan"><strong>'.$tdtop.'</strong></td>
</tr>
</table>

</td>
</tr>

<tr valign="top">
<td>
Nilai Tertinggi
</td>
<td>
:
</td>
<td>
<strong>'.$kin_tinggi.'</strong>
</td>
</tr>

<tr valign="top">
<td>
Nilai Terendah
</td>
<td>
:
</td>
<td>
<strong>'.$kid_rendah.'</strong>
</td>
</tr>

<tr valign="top">
<td>
Sekolah Negeri
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$sux_negeri.'" bgcolor="cyan"><strong>'.$tson.'</strong></td>
</tr>
</table>

</td>
</tr>

<tr valign="top">
<td>
Sekolah Swasta
</td>
<td>
:
</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="'.$sux_swasta.'" bgcolor="cyan"><strong>'.$tswa.'</strong></td>
</tr>
</table>

</td>
</tr>

</table>

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