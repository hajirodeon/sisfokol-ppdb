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
$filenya = "daftar_prt.php";
$judul = "Data Diri Calon";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$swkd = nosql($_REQUEST['swkd']);
$noregx = nosql($_REQUEST['noregx']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//re-direct print
$ke = "daftar.php";
$diload = "window.print();location.href='$ke';";




//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);





//isi *START
ob_start();



//js
require("../../inc/js/swap.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//query
$qdt = mysql_query("SELECT DATE_FORMAT(tgl_lahir, '%d') AS ltgl, ".
			"DATE_FORMAT(tgl_lahir, '%m') AS lbln, ".
			"DATE_FORMAT(tgl_lahir, '%Y') AS lthn, ".
			"DATE_FORMAT(tgl_daftar, '%d') AS dtgl, ".
			"DATE_FORMAT(tgl_daftar, '%m') AS dbln, ".
			"DATE_FORMAT(tgl_daftar, '%Y') AS dthn, ".
			"psb_siswa_calon.* ".
			"FROM psb_siswa_calon ".
			"WHERE kd = '$swkd' ".
			"AND no_daftar = '$noregx'");
$rdt = mysql_fetch_assoc($qdt);
$dt_noregx = nosql($rdt['no_daftar']);
$dt_nama = balikin($rdt['nama']);

//ttl
$dt_tmp_lahir = balikin($rdt['tmp_lahir']);
$dt_tgl = nosql($rdt['ltgl']);
$dt_bln = nosql($rdt['lbln']);
$dt_thn = nosql($rdt['lthn']);


//tgl daftar
$dt_dtgl = nosql($rdt['dtgl']);
$dt_dbln = nosql($rdt['dbln']);
$dt_dthn = nosql($rdt['dthn']);


$dt_alamat = balikin($rdt['alamat']);
$dt_kelamin = nosql($rdt['kelamin']);
$dt_agama = balikin($rdt['agama']);
$dt_telp = balikin($rdt['telp']);
$dt_nm_ortu = balikin($rdt['nama_ayah']);
$dt_almt_ortu = balikin($rdt['alamat_ayah']);
$dt_ker_ortu = balikin($rdt['kerja_ayah']);
$dt_nm_wali = balikin($rdt['nama_wali']);
$dt_almt_wali = balikin($rdt['alamat_wali']);
$dt_ker_wali = balikin($rdt['kerja_wali']);
$dt_asal_sek = balikin($rdt['asal_sekolah']);
$dt_status_sek = balikin($rdt['status_sekolah']);
$dt_almt_sek = balikin($rdt['alamat_sekolah']);
$dt_thn_lulus = nosql($rdt['tahun_lulus']);
$dt_tb = nosql($rdt['tb']);
$dt_bb = nosql($rdt['bb']);



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


<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr align="center">
<td><h1><strong>'.$judul.'</strong></h1></td>
</tr>
</table>

<p>
<strong>No. Pendaftaran : </strong>
<br>
'.$noregx.'
</p>
<br>

<p>
<strong>I. IDENTITAS PESERTA</strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250"><strong>1. Nama </strong></td>
<td width="1">:</td>
<td>'.$dt_nama.'</td>
</tr>

<tr>
<td>
<strong>2. TTL</strong>
</td>
<td>:</td>
<td>
'.$dt_tmp_lahir.',
'.$dt_tgl.' '.$arrbln1[$dt_bln].' '.$dt_thn.'
</td>
</tr>

<tr>
<td>
<strong>3. Alamat</strong>
</td>
<td>:</td>
<td>
'.$dt_alamat.'
</td>
</tr>

<tr>
<td>
<strong>4. Jenis Kelamin (L/P)</strong>
</td>
<td>:</td>
<td>
'.$dt_kelamin.'
</td>
</tr>

<tr>
<td>
<strong>5. Agama</strong>
</td>
<td>:</td>
<td>
'.$dt_agama.'
</td>
</tr>


<tr>
<td>
<strong>6. Telepon</strong>
</td>
<td>:</td>
<td>
'.$dt_telp.'
</td>
</tr>

<tr>
<td>
<strong>7. Tinggi Badan</strong>
</td>
<td>:</td>
<td>
'.$dt_tb.'
</td>
</tr>

<tr>
<td>
<strong>8. Berat Badan</strong>
</td>
<td>:</td>
<td>
'.$dt_bb.'
</td>
</tr>
</table>
</p>
<br>

<p>
<strong>II. IDENTITAS ORANG TUA </strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
<strong>1. Nama Orang Tua / Ayah </strong>
</td>
<td width="1">:</td>
<td>
'.$dt_nm_ortu.'
</td>
</tr>

<tr>
<td>
<strong>2. Alamat Orang Tua / Ayah</strong>
</td>
<td>:</td>
<td>
'.$dt_almt_ortu.'
</td>
</tr>


<tr>
<td>
<strong>3. Pekerjaan Orang Tua / Ayah</strong>
</td>
<td>:</td>
<td>
'.$dt_ker_ortu.'
</td>
</tr>
</table>
</p>
<br>

<p>
<strong>II. IDENTITAS WALI </strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
<strong>1. Nama Wali</strong>
</td>
<td>:</td>
<td>
'.$dt_nm_wali.'
</td>
</tr>

<tr>
<td>
<strong>2. Alamat Wali</strong>
</td>
<td>:</td>
<td>
'.$dt_almt_wali.'
</td>
</tr>

<tr>
<td>
<strong>3. Pekerjaan Wali</strong>
</td>
<td>:</td>
<td>
'.$dt_ker_wali.'
</td>
</tr>
</table>
</p>
<br>

<p>
<strong>III. SEKOLAH ASAL</strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
<strong>1. Sekolah Asal</strong>
</td>
<td width="1">:</td>
<td>
'.$dt_asal_sek.'
</td>
</tr>

<tr>
<td>
<strong>2. Status Sekolah : </strong>
</td>
<td>:</td>
<td>
'.$dt_status_sek.'
</td>
</tr>

<tr>
<td>
<strong>3. Alamat Sekolah : </strong>
</td>
<td>:</td>
<td>
'.$dt_almt_sek.'
</td>
</tr>

<tr>
<td>
<strong>4. Tahun Lulus : </strong>
</td>
<td>:</td>
<td>
'.$dt_thn_lulus.'
</td>
</tr>
</table>
</p>
<br>


<p>
<strong>NILAI UN</strong>
<br>
<table width="600" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="1"><font color="'.$warnatext.'"><strong>No.</strong></font></strong></td>
<td><strong><font color="'.$warnatext.'">Mata Pelajaran</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
</tr>';


//ambil data mata pelajaran
$qpel = mysql_query("SELECT * FROM psb_m_mapel ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY no ASC");
$rpel = mysql_fetch_assoc($qpel);

do
	{
	if ($warna_set ==0)
		{
		$warna = $warna01;
		$warna_set = 1;
		}
	else
		{
		$warna = $warna02;
		$warna_set = 0;
		}

	$nomer = $nomer + 1;
	$d_kd = nosql($rpel['kd']);
	$d_mapel = balikin2($rpel['mapel']);
	$d_bobot = nosql($rpel['bobot']);

	//nilaine...
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_un ".
				"WHERE kd_siswa_calon = '$swkd' ".
				"AND kd_mapel = '$d_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$nile_nilaiku = nosql($rnile['nilai']);


/*
	//angkane...
	$nile_nilai1 = substr($nile_nilai,0,-3);
	$nile_nilai2 = substr($nile_nilai,3,2);


	//angkane...
	$nile2_nilai1 = substr($nile_nilai2,0,-3);
	$nile2_nilai2 = substr($nile_nilai2,3,2);


	//angkane...
	$nile3_nilai1 = substr($nile_nilai3,0,-3);
	$nile3_nilai2 = substr($nile_nilai3,3,2);
*/




	//jika lebih dari sepuluh
	if ($nile_nilaiku > 10)
		{
		$nile_nilaiku2 = round($nile_nilaiku / $d_bobot,2);
		}
	else
		{
		$nile_nilaiku2 = $nile_nilaiku;
		}



	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td>
	<input name="kd'.$d_kd.'" type="hidden" value="'.$d_kd.'">
	'.$nomer.'
	</td>
	<td>'.$d_mapel.'</td>
	<td>
	'.$nile_nilaiku2.'
	</td>

    	</tr>';
	}
while ($rpel = mysql_fetch_assoc($qpel));

echo '</table>
</p>
<br>
<br>
<br>


<p>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
</td>
<td align="right">
'.$sek_kota.', '.$dt_dtgl.' '.$arrbln1[$dt_dbln].' '.$dt_dthn.'
<br>
<br>
<br>
<br>
<br>
<strong>'.$dt_nama.'</strong>
</td>
</tr>
</table>
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
