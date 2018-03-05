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
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "konfirmasi_bayar.php";
$judul = "Pembayaran";
$judulku = "[$bdh_session : $username2_session] ==> $judul";
$judulx = $judul;
$swkd = nosql($_REQUEST['swkd']);
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
$tp_biaya = nosql($rtp['biaya']);





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//batal
if ($_POST['btnBTL'])
	{
	//ambil nilai
	$page = nosql($_POST['page']);

	//re-direct
	$ke = "konfirmasi.php?page=$page";
	xloc($ke);
	exit();
	}





//aktifkan
if ($_POST['btnOK'])
	{
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
	//ketahui tapel aktif
	$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
				"WHERE status = 'true'");
	$rtp = mysql_fetch_assoc($qtp);
	$tp_tapelkd = nosql($rtp['kd']);
	$tp_tahun1 = nosql($rtp['tahun1']);
	$tp_tahun2 = nosql($rtp['tahun2']);


	$ketnya = "$judulku [EDIT DATA]";
	mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
			"('$x', '$tp_tapelkd', '$kd2_session', '$ketnya', '$today')");
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////





	//ambil nilai
	$page = nosql($_POST['page']);
	$swkd = nosql($_POST['swkd']);
	$btgl = nosql($_POST['btgl']);
	$bbln = nosql($_POST['bbln']);
	$bthn = nosql($_POST['bthn']);
	$tgl_bayar = "$bthn:$bbln:$btgl";
	$no_tes = cegah($_POST['no_tes']);
	$no_loket = cegah($_POST['no_loket']);

	//update
	mysql_query("UPDATE psb_siswa_calon SET status_daftar = 'true', ".
			"no_tes = '$no_tes', ".
			"no_loket = '$no_loket', ".
			"tgl_bayar = '$tgl_bayar' ".
			"WHERE kd = '$swkd'");

	//re-direct
	$ke = "konfirmasi.php?page=$page";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//isi *START
ob_start();



//js
require("../../inc/js/swap.js");
require("../../inc/menu/psb_admbdh.php");
xheadline($judul);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//query
$qdt = mysql_query("SELECT DATE_FORMAT(tgl_daftar, '%d') AS dtgl, ".
			"DATE_FORMAT(tgl_daftar, '%m') AS dbln, ".
			"DATE_FORMAT(tgl_daftar, '%Y') AS dthn, ".
			"DATE_FORMAT(tgl_bayar, '%d') AS btgl, ".
			"DATE_FORMAT(tgl_bayar, '%m') AS bbln, ".
			"DATE_FORMAT(tgl_bayar, '%Y') AS bthn, ".
			"psb_siswa_calon.* ".
			"FROM psb_siswa_calon ".
			"WHERE kd = '$swkd'");
$rdt = mysql_fetch_assoc($qdt);
$dt_noregx = nosql($rdt['no_daftar']);
$dt_no_tes = nosql($rdt['no_tes']);
$dt_no_loket = nosql($rdt['no_loket']);
$dt_nama = balikin($rdt['nama']);
$dt_jml_bayar = nosql($rdt['jml_bayar']);
$dt_asal_sek = balikin($rdt['asal_sekolah']);
$dt_keakd = nosql($rdt['kd_keahlian']);


//keahlian
$qx = mysql_query("SELECT * FROM psb_m_keahlian ".
			"WHERE kd = '$dt_keakd'");
$rowx = mysql_fetch_assoc($qx);
$e_keahlian = nosql($rowx['keahlian']);


//tgl daftar
$dt_dtgl = nosql($rdt['dtgl']);
$dt_dbln = nosql($rdt['dbln']);
$dt_dthn = nosql($rdt['dthn']);

//tgl bayar
$dt_btgl = nosql($rdt['btgl']);
$dt_bbln = nosql($rdt['bbln']);
$dt_bthn = nosql($rdt['bthn']);



//jika null
if (empty($dt_btgl))
	{
	$dt_btgl = $tanggal;
	$dt_bbln = $bulan;
	$dt_bthn = $tahun;
	}

echo '<form action="'.$filenya.'" method="post" name="formx">
<a href="konfirmasi.php">Data Konfirmasi</a> > Pembayaran
<br>
<br>

No. Pendaftaran :
<br>
<INPUT type="text" name="noregx" value="'.$dt_noregx.'" size="20" class="input" readonly>
<br>
<br>


No. Tes :
<br>
<INPUT type="text" name="no_tes" value="'.$dt_no_tes.'" size="20">
<br>
<br>


No. Loket :
<br>
<INPUT type="text" name="no_loket" value="'.$dt_no_loket.'" size="20">
<br>
<br>


Nama :
<br>
<INPUT type="text" name="nama" value="'.$dt_nama.'" size="30" class="input" readonly>
<br>
<br>



Sekolah Asal :
<br>
<INPUT type="text" name="sek_asal" value="'.$dt_asal_sek.'" size="20" class="input" readonly>
<br>
<br>






Program / Kompetensi Keahlian :
<br>
<INPUT type="text" name="keahlian" value="'.$e_keahlian.'" size="20" class="input" readonly>
<br>
<br>




Tanggal Pendaftaran :
<br>
<strong>'.$dt_dtgl.' '.$arrbln1[$dt_dbln].' '.$dt_dthn.'</strong>
<br>
<br>
<br>
<br>

<strong>PEMBAYARAN :</strong>
<br>
Tanggal Pembayaran :
<br>
<select name="btgl">
<option value="'.$dt_btgl.'" selected>'.$dt_btgl.'</option>';
for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$i.'">'.$i.'</option>';
	}

echo '</select>
<select name="bbln">
<option value="'.$dt_bbln.'" selected>'.$arrbln1[$dt_bbln].' </option>';
for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
	}

echo '</select>
<select name="bthn">
<option value="'.$dt_bthn.'" selected>'.$dt_bthn.'</option>';
for ($k=$daft01;$k<=$daft02;$k++)
	{
	echo '<option value="'.$k.'">'.$k.'</option>';
	}
echo '</select>
<br>
<br>

Jumlah Yang Telah Ditransfer :
<br>
<strong>'.xduit2($tp_biaya).'</strong>
<br>
<br>
<input name="page" type="hidden" value="'.$page.'">
<input name="swkd" type="hidden" value="'.$swkd.'">
<input name="btnBTL" type="submit" value="BATAL">
<input name="btnOK" type="submit" value="SIMPAN & Aktifkan">
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