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
require("../../inc/cek/psb_admbdh.php");
$tpl = LoadTpl("../../template/print.html");

nocache;

//nilai
$filenya = "konfirmasi_kuitansi.php";
$judul = "BUKTI PEMBAYARAN";
$judulku = "[$bdh_session : $username2_session] ==> $judul";
$judulx = $judul;
$swkd = nosql($_REQUEST['swkd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);


$ketnya = "$judulku [PRINT]";
mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
		"('$x', '$tp_tapelkd', '$kd2_session', '$ketnya', '$today')");
//entri history ////////////////////////////////////////////////////////////////////////////////////////////////




$ke = "konfirmasi.php?page=$page";
$diload = "window.print();location.href='$ke';";




//detail
$qdt = mysql_query("SELECT * FROM psb_siswa_calon ".
			"WHERE kd = '$swkd'");
$rdt = mysql_fetch_assoc($qdt);
$dt_no = nosql($rdt['no_daftar']);
$dt_nama = balikin($rdt['nama']);
$dt_asal_sek = balikin($rdt['asal_sekolah']);
$dt_no_tes = balikin($rdt['no_tes']);
$dt_no_loket = balikin($rdt['no_loket']);





//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);
$tp_biaya = nosql($rtp['biaya']);




//isi *START
ob_start();



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';


echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="#CCCCCC">
<td align="center"><big><strong>'.$judul.'</strong></big></td>
</tr>
</table>



<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td>
<p>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Yang Bertanda Tangan dibawah ini Petugas PPDB Jalur Prestasi Th.'.$tp_tahun1.'/'.$tp_tahun2.', '.$sek_nama.'
menyatakan bahwa tersebut dibawah ini :
</p>


<dd>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="100">
No.Pendaftaran
</td>
<td>: <strong>'.$dt_no.'</strong>
</td>
</tr>

<tr>
<td width="100">
No.Tes
</td>
<td>
: <strong>'.$dt_no_tes.'</strong>
</td>
</tr>


<tr>
<td width="100">
Nomor Loket
</td>
<td>
: <strong>'.$dt_no_loket.'</strong>
</td>
</tr>


<tr>
<td width="100">
Nama
</td>
<td>
: <strong>'.$dt_nama.'</strong>
</td>
</tr>

<tr>
<td width="100">
Sekolah Asal
</td>
<td>
: <strong>'.$dt_asal_sek.'</strong>
</td>
</tr>
</table>
</dd>


<p>
telah terdaftar dan membayar uang pendaftaran sebesar <strong>'.xduit2($tp_biaya).'</strong>
<br>
Terbilang : <b>';
xduitf($tp_biaya);
echo '</b>
</p>


<p>
Bukti pendaftaran ini juga digunakan sekaligus untuk Tes Tulis, Tes TIK, Tes Fisik, dan Daftar ulang
apabila yang bersangkutan diterima sebagai Calon Peserta Didik Baru Jalur Prestasi  Th.Pelajaran '.$tp_tahun1.'/'.$tp_tahun2.'
'.$sek_nama.' serta untuk pengambilan Berkas bagi Pendaftar yang tidak diterima.
</p>


<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td width="200" align="center">

<table border="1" cellspacing="0" cellpadding="3">
<tr>
<td width="100" height="150" align="center" valign="center">
Foto 3 x 4
</td>
</tr>
</table>

</td>

<td width="200" align="center">
</td>
<td>
<p>
'.$sek_kota.', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'
</p>
<p>
Petugas Pendaftaran
</p>
<br>
<br>
<br>
<br>


<p>
<strong><u>'.$nama2_session.'</u></strong>
<br>
NIP.'.$nip2_session.'
</p>
</td>
</tr>
</table>




</td>
</tr>
</table>





<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<font size="5">
JANGAN SAMPAI HILANG.
</font>
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