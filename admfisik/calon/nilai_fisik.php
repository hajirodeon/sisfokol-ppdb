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
require("../../inc/cek/psb_admfisik.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "nilai_fisik.php";
$judul = "Calon : Nilai Fisik";
$judulku = "[$wwc_session : $username3_session] ==> $judul";
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



//simpan data
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
					"('$x', '$tp_tapelkd', '$kd3_session', '$ketnya', '$today')");
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////




	$jml = nosql($_POST['jml']);
	$swkd = nosql($_POST['swkd']);
	$noregx = nosql($_POST['noregx']);
	$nilai1 = nosql($_POST['nilai1']);
	$nilai2 = nosql($_POST['nilai2']);
	$nilai3 = nosql($_POST['nilai3']);
	$nilai4 = nosql($_POST['nilai4']);
	$nilai5 = nosql($_POST['nilai5']);
	$nilaiku = nosql($_POST['nilaiku']);



	//cek
	$qcc2 = mysql_query("SELECT * FROM psb_siswa_calon_fisik ".
							"WHERE kd_siswa_calon = '$swkd'");
	$rcc2 = mysql_fetch_assoc($qcc2);
	$tcc2 = mysql_num_rows($qcc2);

	//jika ada
	if ($tcc2 != 0)
		{
		//entry update
		mysql_query("UPDATE psb_siswa_calon_fisik SET tinggi_badan = '$nilai1', ".
						"tindik_tatto = '$nilai2', ".
						"buta_warna = '$nilai3', ".
						"cacat_fisik = '$nilai4', ".
						"penampilan = '$nilai5', ".
						"nilai = '$nilaiku', ".
						"postdate = '$today' ".
						"WHERE kd_siswa_calon = '$swkd'");
		}
	else
		{
		mysql_query("INSERT INTO psb_siswa_calon_fisik(kd, kd_siswa_calon, ".
						"tinggi_badan, tindik_tatto, buta_warna, ".
						"cacat_fisik, penampilan, nilai, postdate) VALUES ".
						"('$x', '$swkd', ".
						"'$nilai1', '$nilai2', '$nilai3', ".
						"'$nilai4', '$nilai5', '$nilaiku', '$today')");
		}


	//update
	mysql_query("UPDATE psb_siswa_calon SET tes_fisik = '$nilaiku' ".
					"WHERE kd = '$swkd'");



	//re-direct
	$ke = "$filenya?swkd=$swkd&noregx=$noregx";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//isi *START
ob_start();



//js
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/psb_admfisik.php");
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
<select name="nilai1">
<option value="'.$e_nilai1.'" selected>'.$e_nilai1_ket.'</option>
<option value="false">Tidak Lulus</option>
<option value="true">Lulus</option>
</select>
</p>

<p>
Tidak Tindik atau Tatto :
<br>
<select name="nilai2">
<option value="'.$e_nilai2.'" selected>'.$e_nilai2_ket.'</option>
<option value="false">Tidak Lulus</option>
<option value="true">Lulus</option>
</select>
</p>

<p>
Tidak Buta Warna :
<br>
<select name="nilai3">
<option value="'.$e_nilai3.'" selected>'.$e_nilai3_ket.'</option>
<option value="false">Tidak Lulus</option>
<option value="true">Lulus</option>
</select>
</p>

<p>
Tidak Cacat Fisik :
<br>
<select name="nilai4">
<option value="'.$e_nilai4.'" selected>'.$e_nilai4_ket.'</option>
<option value="false">Tidak Lulus</option>
<option value="true">Lulus</option>
</select>
</p>


<p>
Penampilan (periksa rambut,kalung, anting, gelang dan seragam rapi) :
<br>
<select name="nilai5">
<option value="'.$e_nilai5.'" selected>'.$e_nilai5_ket.'</option>
<option value="false">Tidak Lulus</option>
<option value="true">Lulus</option>
</select>
</p>

<hr>



<p>
Kesimpulan Akhir Tes Fisik :
<br>
<select name="nilaiku">
<option value="'.$e_nilaiku.'" selected>'.$e_nilaiku_ket.'</option>
<option value="false">Tidak Lulus</option>
<option value="true">Lulus</option>
</select>
</p>


<p>
<input name="jml" type="hidden" value="'.$tdni.'">
<input name="swkd" type="hidden" value="'.$swkd.'">
<input name="noregx" type="hidden" value="'.$noregx.'">
<input name="btnBTL" type="submit" value="BATAL">
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
xclose($koneksi);
exit();
?>