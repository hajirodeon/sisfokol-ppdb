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
require("../../inc/class/paging.php");
require("../../inc/cek/psb_admbdh.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "reg_view.php";
$judul = "Data Diri...";
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



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnOK'])
	{
	//re-direct
	$ke = "reg.php";
	xloc($ke);
	exit();
	}





//nek simpan
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
					"('$x', '$tp_tapelkd', '$kd2_session', '$ketnya', '$today')");
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////




	//nilai
	$swkd = nosql($_POST['swkd']);
	$page = nosql($_POST['page']);
	$noregx = nosql($_POST['noregx']);
	$nama = cegah($_POST['nama']);
	$tmp_lahir = cegah($_POST['tmp_lahir']);


	$mtgl = $_POST['datepicker1'];
	$mpecah1 = explode("/", $mtgl);
	$daftar_bln = $mpecah1[0];
	$daftar_tgl = $mpecah1[1];
	$daftar_thn = $mpecah1[2];
	$tgl_lahir = "$daftar_thn:$daftar_bln:$daftar_tgl";

	$alamat = cegah($_POST['alamat']);
	$kelamin = nosql($_POST['kelamin']);
	$agama = cegah($_POST['agama']);
	$telp = cegah($_POST['telp']);
	$nm_ortu = cegah($_POST['nm_ortu']);
	$almt_ortu = cegah($_POST['almt_ortu']);
	$ker_ortu = cegah($_POST['ker_ortu']);
	$nm_wali = cegah($_POST['nm_wali']);
	$almt_wali = cegah($_POST['almt_wali']);
	$ker_wali = cegah($_POST['ker_wali']);
	$asal_sek = cegah($_POST['asal_sek']);
	$status_sek = cegah($_POST['status_sek']);
	$almt_sek = cegah($_POST['almt_sek']);
	$thn_lulus = nosql($_POST['thn_lulus']);
	$tb = nosql($_POST['tb']);
	$bb = nosql($_POST['bb']);



	//cek
	if (empty($nama))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!";
		$ke = "$filenya?swkd=$swkd&noregx=$noregx&page=$page";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//query update //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		mysql_query("UPDATE psb_siswa_calon SET nama = '$nama', ".
						"tmp_lahir = '$tmp_lahir', ".
						"tgl_lahir = '$tgl_lahir', ".
						"alamat = '$alamat', ".
						"kelamin = '$kelamin', ".
						"agama = '$agama', ".
						"telp = '$telp', ".
						"nama_ayah = '$nm_ortu', ".
						"alamat_ayah = '$almt_ortu', ".
						"kerja_ayah = '$ker_ortu', ".
						"telp_ayah = '$telp_ortu', ".
						"nama_wali = '$nm_wali', ".
						"alamat_wali = '$almt_wali', ".
						"kerja_wali = '$ker_wali', ".
						"telp_wali = '$telp_wali', ".
						"asal_sekolah = '$asal_sek', ".
						"status_sekolah = '$status_sek', ".
						"alamat_sekolah = '$almt_sek', ".
						"tb = '$tb', ".
						"bb = '$bb', ".
						"tahun_lulus = '$thn_lulus' ".
						"WHERE kd = '$swkd'");




		//entry nilai UN ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$qpel = mysql_query("SELECT * FROM psb_m_mapel ".
					"WHERE kd_tapel = '$tp_tapelkd' ".
					"ORDER BY no ASC");
		$rpel = mysql_fetch_assoc($qpel);

		do
			{
			$nomer = $nomer + 1;
			$xx = md5("$x$nomer");
			$d_kd = nosql($rpel['kd']);
			$d_bobot = nosql($rpel['bobot']);


			//nilai mapel
			$xdnil = "nilku";
			$xdnil1 = "$xdnil$nomer";
			$xdnilx = nosql($_POST["$xdnil1"]);

			$d_total = round($xdnilx * $d_bobot,2);




			//entry update
			mysql_query("UPDATE psb_siswa_calon_un SET nilai = '$xdnilx', ".
					"total = '$d_total' ".
					"WHERE kd_siswa_calon = '$swkd' ".
					"AND kd_mapel = '$d_kd'");
			}
		while ($rpel = mysql_fetch_assoc($qpel));







		//entry nilai sertifikat ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$qpel = mysql_query("SELECT * FROM psb_m_sertifikat ".
								"ORDER BY no ASC");
		$rpel = mysql_fetch_assoc($qpel);

		do
			{
			$nomerx = $nomerx + 1;
			$xx = md5("$x$nomer");
			$d_kd = nosql($rpel['kd']);


			//nilai mapel
			$xdnil = "nilkuu";
			$xdnil1 = "$xdnil$nomerx";
			$xdnilx = nosql($_POST["$xdnil1"]);




			//entry update
			mysql_query("UPDATE psb_siswa_calon_sertifikat SET nilai = '$xdnilx' ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND kd_sertifikat = '$d_kd'");
			}
		while ($rpel = mysql_fetch_assoc($qpel));





		//re-direct
		$ke = "$filenya?swkd=$swkd&noregx=$noregx&page=$page";
		xloc($ke);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//isi *START
ob_start();



//js
require("../../inc/js/swap.js");
require("../../inc/menu/psb_admbdh.php");
xheadline($judul);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<script type="text/javascript">
$(document).ready(function() {
$(function() {
	$('#datepicker1').datepicker({
		changeMonth: true,
		yearRange: "-30:+0",
		changeYear: true
		});

	});
});
</script>


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






//query
$qdt = mysql_query("SELECT DATE_FORMAT(tgl_lahir, '%d') AS ltgl, ".
					"DATE_FORMAT(tgl_lahir, '%m') AS lbln, ".
					"DATE_FORMAT(tgl_lahir, '%Y') AS lthn, ".
					"psb_siswa_calon.* ".
					"FROM psb_siswa_calon ".
					"WHERE kd = '$swkd'");
$rdt = mysql_fetch_assoc($qdt);
$dt_noregx = nosql($rdt['no_daftar']);
$dt_nama = balikin($rdt['nama']);
$dt_tmp_lahir = balikin($rdt['tmp_lahir']);
$dt_tgl = nosql($rdt['ltgl']);
$dt_bln = nosql($rdt['lbln']);
$dt_thn = nosql($rdt['lthn']);
$tgl_lahir = "$dt_bln/$dt_tgl/$dt_thn";


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
$dt_no_sttb = balikin($rdt['no_sttb']);
$dt_thn_lulus = nosql($rdt['tahun_lulus']);
$dt_tb = nosql($rdt['tb']);
$dt_bb = nosql($rdt['bb']);



//jika laki
if ($dt_kelamin == "01")
	{
	$dt_kelamin2 = "L";
	}
else if ($dt_kelamin == "02")
	{
	$dt_kelamin2 = "P";
	}



echo '<form action="'.$filenya.'" method="post" name="formx">
<a href="reg.php">Data Pendaftaran</a> > Data Diri

<p>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
No. Pendaftaran
</td>
<td width="1">:</td>
<td>
<input name="no_reg" type="text" size="30" value="'.$dt_noregx.'" disabled>
</td>
</tr>
</table>
</p>
<br>

<p>
<strong>IDENTITAS PESERTA</strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
1. Nama
</td>
<td width="1">:</td>
<td>
<input name="nama" type="text" value="'.$dt_nama.'" size="30" maxlength="30">
</td>
</tr>

<tr>
<td>
2. Tempat, Tanggal Lahir
</td>
<td>:</td>
<td>
<input name="tmp_lahir" type="text" value="'.$dt_tmp_lahir.'" size="20">,

<input name="datepicker1" id="datepicker1" type="text" value="'.$tgl_lahir.'" size="10">
</td>
</tr>

<tr>
<td>
3. Alamat
</td>
<td>:</td>
<td>
<input name="alamat" type="text" value="'.$dt_alamat.'" size="50">
</td>
</tr>

<tr>
<td>
4. Jenis Kelamin (L/P)
</td>
<td>:</td>
<td>
<select name="kelamin" class="input" readonly>
<option value="'.$dt_kelamin.'" selected>'.$dt_kelamin.'</option>
</select>
</td>
</tr>

<tr>
<td>
5. Agama
</td>
<td>:</td>
<td>
<select name="agama">
<option value="'.$dt_agama.'" selected>'.$dt_agama.'</option>
<option value="Islam">Islam</option>
<option value-"Kristen">Kristen</option>
<option value="Katholik">Katholik</option>
<option value="Budha">Budha</option>
<option value="Hindu">Hindu</option>
<option value="Konghuchu">Konghuchu</option>
</select>
</td>
</tr>


<tr>
<td>
7. Telepon
</td>
<td>:</td>
<td>
<input name="telp" type="text" value="'.$dt_telp.'" size="30">
</td>
</tr>

<tr>
<td>
8. Tinggi Badan
</td>
<td>:</td>
<td>
<input name="tb" type="text" value="'.$dt_tb.'" size="5">Cm.
</td>
</tr>

<tr>
<td>
9. Berat Badan
</td>
<td>:</td>
<td>
<input name="bb" type="text" value="'.$dt_bb.'" size="5">Kg.
</td>
</tr>
</table>
<br>
<br>
<br>

<strong>IDENTITAS ORANG TUA </strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
1. Nama Orang Tua / Ayah
</td>
<td width="1">:</td>
<td>
<input name="nm_ortu" type="text" value="'.$dt_nm_ortu.'" size="20">
</td>
</tr>

<tr>
<td>
2. Alamat Orang Tua / Ayah
</td>
<td>:</td>
<td>
<input name="almt_ortu" type="text" value="'.$dt_almt_ortu.'" size="50">
</td>
</tr>

<tr>
<td>
3. Pekerjaan Orang Tua / Ayah
</td>
<td>:</td>
<td>
<select name="ker_ortu">
<option value="'.$dt_ker_ortu.'" selected>'.$dt_ker_ortu.'</option>
<option value="PNS">PNS</option>
<option value="TNI/POLRI">TNI/POLRI</option>
<option value="Swasta">Swasta</option>
<option value="Tani">Tani</option>
<option value="Buruh">Buruh</option>
</select>
</td>
</tr>
</table>
</p>
<br>

<p>
<strong>IDENTITAS WALI </strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
1. Nama Wali
</td>
<td width="1">:</td>
<td>
<input name="nm_wali" type="text" value="'.$dt_nm_wali.'" size="20">
</td>
</tr>
<tr>
<td>
2. Alamat Wali
</td>
<td>:</td>
<td>
<input name="almt_wali" type="text" value="'.$dt_almt_wali.'" size="50">
</td>
</tr>

<tr>
<td>
3. Pekerjaan Wali
</td>
<td>:</td>
<td>
<select name="ker_wali">
<option value="'.$dt_ker_wali.'" selected>'.$dt_ker_wali.'</option>
<option value="PNS">PNS</option>
<option value="TNI/POLRI">TNI/POLRI</option>
<option value="Swasta">Swasta</option>
<option value="Tani">Tani</option>
<option value="Buruh">Buruh</option>
</select>
</td>
</tr>
</table>
</p>
<br>

<p>
<strong>SEKOLAH ASAL</strong>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="250">
1. Sekolah Asal
</td>
<td width="1">:</td>
<td>
<input name="asal_sek" type="text" value="'.$dt_asal_sek.'" size="30">
</td>
</tr>

<tr>
<td>
2. Status Sekolah
</td>
<td>:</td>
<td>
<select name="status_sek">
<option value="'.$dt_status_sek.'" selected>'.$dt_status_sek.'</option>
<option value="Negeri">Negeri</option>
<option value="Swasta">Swasta</option>
</select>
</td>
</tr>

<tr>
<td>
3. Alamat Sekolah
</td>
<td>:</td>
<td>
<input name="almt_sek" type="text" value="'.$dt_almt_sek.'" size="50">
</td>
</tr>

<tr>
<td>
4. Tahun Lulus
</td>
<td>:</td>
<td>
<input name="thn_lulus" type="text" value="'.$dt_thn_lulus.'" size="4" onKeyPress="return numbersonly(this, event)">
</td>
</tr>
</table>
</p>
<br>



<p>
<strong>NILAI UN</strong>
<br>
<table width="400" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="1"><font color="'.$warnatext.'"><strong>No.</strong></font></strong></td>
<td><strong><font color="'.$warnatext.'">Mata Pelajaran</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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
	$d_bobot = nosql($rpel['bobot']);
	$d_mapel = balikin2($rpel['mapel']);

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
	<input name="nilku'.$nomer.'" type="text" value="'.$nile_nilaiku2.'" size="5">
	</td>
    	</tr>';
	}
while ($rpel = mysql_fetch_assoc($qpel));

echo '</table>
</p>
<br>






<p>
<strong>NILAI SERTIFIKAT</strong>
<br>
<table width="400" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="1"><font color="'.$warnatext.'"><strong>No.</strong></font></strong></td>
<td><strong><font color="'.$warnatext.'">Sertifikat</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
</tr>';


//ambil data sertifikat
$qpel = mysql_query("SELECT * FROM psb_m_sertifikat ".
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

	$nomerx = $nomerx + 1;
	$d_kd = nosql($rpel['kd']);
	$d_mapel = balikin2($rpel['nama']);

	//nilaine...
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_sertifikat ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND kd_sertifikat = '$d_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$nile_nilaiku = nosql($rnile['nilai']);



	$nile_nilaiku2 = $nile_nilaiku;


	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td>
	<input name="kd'.$d_kd.'" type="hidden" value="'.$d_kd.'">
	'.$nomerx.'
	</td>
	<td>'.$d_mapel.'</td>
	<td>
	<input name="nilkuu'.$nomerx.'" type="text" value="'.$nile_nilaiku2.'" size="5">
	</td>
    </tr>';
	}
while ($rpel = mysql_fetch_assoc($qpel));

echo '</table>
</p>
<br>




<p>
<input name="swkd" type="hidden" value="'.$swkd.'">
<input name="noregx" type="hidden" value="'.$noregx.'">
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnOK" type="submit" value="Daftar Calon Lainnya >>">
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