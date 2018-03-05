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
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/index.html");


nocache;

//nilai
$filenya = "psb_reg_akses.php";
$judul = "Akses User";
$judulku = $judul;
$userkd = nosql($_REQUEST['userkd']);
$noregx = nosql($_REQUEST['noregx']);
$ke = "$filenya?userkd=$userkd&noregx=$noregx";
//$dt_pass = $passbaru;
$dt_pass = $noregx;




//query
$qdt = mysql_query("SELECT DATE_FORMAT(tgl_lahir, '%d') AS ltgl, ".
			"DATE_FORMAT(tgl_lahir, '%m') AS lbln, ".
			"DATE_FORMAT(tgl_lahir, '%Y') AS lthn, ".
			"DATE_FORMAT(tgl_daftar, '%d') AS dtgl, ".
			"DATE_FORMAT(tgl_daftar, '%m') AS dbln, ".
			"DATE_FORMAT(tgl_daftar, '%Y') AS dthn, ".
			"psb_siswa_calon.* ".
			"FROM psb_siswa_calon ".
			"WHERE kd = '$userkd' ".
			"AND no_daftar = '$noregx'");
$rdt = mysql_fetch_assoc($qdt);
$dt_noregx = nosql($rdt['no_daftar']);
$dt_tgl = nosql($rdt['ltgl']);
$dt_bln = nosql($rdt['lbln']);
$dt_thn = nosql($rdt['lthn']);
$dt_dtgl = nosql($rdt['dtgl']);
$dt_dbln = nosql($rdt['dbln']);
$dt_dthn = nosql($rdt['dthn']);
$dt_kelamin = nosql($rdt['kd_kelamin']);





//password dengan kombinasi tgldaftar dan tgl lahir
//$passbarux = md5($passbaru);
//$passbarux = md5($noregx);
$passbarux = md5("$dt_dtgl$dt_tgl$dt_dbln$dt_bln$dt_kelamin");



//update password...
mysql_query("UPDATE psb_siswa_calon SET usernamex = '$noregx', ".
		"passwordx = '$passbarux' ".
		"WHERE kd = '$userkd'");





//isi *START
ob_start();

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$ke.'" method="post" name="formx">';
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top" align="left">
<td width="25%">';
//ambil data menu
require("inc/menu/psb_menu.php");
echo '</td>

<td align="left">
<big><strong>'.$judul.'</strong></big>
<p>
<strong>Terima Kasih, Anda Telah Berhasil Ikut Serta Isi Formulir.</strong>
<br>
Proses Pendaftaran, Silahkan berkunjung ke Sekolah pada Waktu Masa Pendaftaran.
<br>
Dengan membawa hasil printing dari Tanda Bukti berikut.
</p>

<p>
<a href="psb_reg_pdf.php?swkd='.$userkd.'" target="_blank">Klik Disini untuk Print Tanda Bukti</a>.
</p>
<br>

[<a href="'.$sumber.'">Kembali ke Halaman Utama</a>].
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

require("inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>