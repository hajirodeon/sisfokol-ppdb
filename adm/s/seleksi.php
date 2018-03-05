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

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/psb_adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "seleksi.php";
$judul = "Set Aktif Seleksi";
$judulku = "[$adm_session] ==> $judul";
$juduli = $judul;


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
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
			"('$x', '$tp_tapelkd', '$kd1_session', '$ketnya', '$today')");
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////




	//nilai
	$seleksi = nosql($_POST['seleksi']);

	//cek
	$qcc = mysql_query("SELECT * FROM psb_set_seleksi");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);

	//nek sudah ada, update
	if ($tcc != 0)
		{
		mysql_query("UPDATE psb_set_seleksi SET seleksi = '$seleksi', ".
						"postdate = '$today'");
		}
	else
		{
		mysql_query("INSERT INTO psb_set_seleksi(kd, seleksi, postdate) VALUES ".
						"('$x', '$seleksi', '$today')");
		}

	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//js
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//status
$qtsu = mysql_query("SELECT * FROM psb_set_seleksi");
$rtsu = mysql_fetch_assoc($qtsu);
$tsu_seleksi = nosql($rtsu['seleksi']);
$tsu_postdate = $rtsu['postdate'];

//true false
if ($tsu_seleksi == "true")
	{
	$tsu_status = "AKTIF";
	}
else
	{
	$tsu_status = "TIDAK Aktif";
	}

//null postdate
if (empty($tsu_postdate))
	{
	$tsu_postdate = "-";
	}

echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
<select name="seleksi">
<option value="'.$tsu_seleksi.'" selected>'.$tsu_status.'</option>
<option value="true">Aktif</option>
<option value="false">Tidak Aktif</option>
</select>
</p>

<p>Terhitung Sejak : <br>
<strong>'.$tsu_postdate.'</strong>
</p>

<p>
<em>NB. Jika Seleksi Telah Aktif, Maka Pendaftaran Otomatis Ditutup.</em>
</p>
<p>
<input name="btnSMP" type="submit" value="SIMPAN">
</p>
</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>