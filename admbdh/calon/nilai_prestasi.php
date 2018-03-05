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
$filenya = "nilai_prestasi.php";
$judul = "Nilai Prestasi";
$judulku = "[$bdh_session : $username2_session] ==> $judul";
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
			"('$x', '$tp_tapelkd', '$kd1_session', '$ketnya', '$today')");
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////




	$jml = nosql($_POST['jml']);
	$swkd = nosql($_POST['swkd']);
	$noregx = nosql($_POST['noregx']);



	for ($m=1;$m<=3;$m++)
		{
		$xku = "pres_jenis";
		$xku1 = "$xku$m";
		$xkux = nosql($_POST["$xku1"]);

		$xcku = "nama";
		$xcku1 = "$xcku$m";
		$xckux = nosql($_POST["$xcku1"]);




		//prestasi
		$qdtx2 = mysql_query("SELECT psb_m_prestasi.* ".
								"FROM psb_m_prestasi ".
								"WHERE kd = '$xkux'");
		$rdtx2 = mysql_fetch_assoc($qdtx2);
		$dtx_skor = nosql($rdtx2['skor']);




		//cek
		$qcc = mysql_query("SELECT * FROM psb_siswa_calon_prestasi ".
								"WHERE kd_siswa_calon = '$swkd' ".
								"AND no = '$m'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//jika ada
		if ($tcc != 0)
			{
			//prestasi
			mysql_query("UPDATE psb_siswa_calon_prestasi SET kd_prestasi = '$xkux', ".
							"nama = '$xckux', ".
							"nilai = '$dtx_skor', ".
							"total = '$dtx_skor', ".
							"postdate = '$today' ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND no = '$m'");
			}
		else
			{
			mysql_query("INSERT INTO psb_siswa_calon_prestasi(kd, kd_siswa_calon, no, ".
							"kd_prestasi, nama, nilai, total, postdate) VALUES ".
							"('$x', '$swkd', '$m', ".
							"'$xkux', '$xckux', '$dtx_skor', '$dtx_skor', '$today')");
			}
		}


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
require("../../inc/menu/psb_admbdh.php");
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
<a href="nilai.php">Nilai-Nilai</a> > Nilai Prestasi
<br>
<br>


<strong>No. Pendaftaran :</strong> '.$dt_noregx.', <strong>Nama : </strong>'.$dt_nama.'.
<br>
<br>


<table width="900" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="1"><font color="'.$warnatext.'"><strong>No.</strong></font></strong></td>
<td><strong><font color="'.$warnatext.'">Tingkat Kejuaraan</font></strong></td>
<td width="500"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
</tr>';


for ($m=1;$m<=3;$m++)
	{
	//data ne
	$qc1 = mysql_query("SELECT * FROM psb_siswa_calon_prestasi ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND no = '$m'");
	$rc1 = mysql_fetch_assoc($qc1);
	$c1_nama = balikin($rc1['nama']);
	$c1_preskd = nosql($rc1['kd_prestasi']);




	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td>
	'.$m.'.
	</td>
	<td>';



	//prestasi
	$qdtx2 = mysql_query("SELECT psb_m_prestasi.* ".
				"FROM psb_m_prestasi ".
				"WHERE kd = '$c1_preskd'");
	$rdtx2 = mysql_fetch_assoc($qdtx2);
	$dtx_kode = nosql($rdtx2['kode']);
	$dtx_skor = nosql($rdtx2['skor']);
	$dtx_nama = balikin($rdtx2['nama']);
	$dtx_ket = balikin($rdtx2['ket']);


	echo '<select name="pres_jenis'.$m.'">
	<option value="'.$c1_preskd.'" selected>'.$dtx_kode.'. '.$dtx_nama.' '.$dtx_ket.' [Skor : '.$dtx_skor.'].</option>';

	//daftar prestasi
	$qdt = mysql_query("SELECT * FROM psb_m_prestasi ".
				"WHERE kd_tapel = '$tp_tapelkd' ".
				"ORDER BY kode ASC");
	$rdt = mysql_num_rows($qdt);

	do
		{
		$dt_kd = nosql($rdt['kd']);
		$dt_kode = nosql($rdt['kode']);
		$dt_nama = balikin($rdt['nama']);
		$dt_ket = balikin($rdt['ket']);
		$dt_skor = nosql($rdt['skor']);

		echo '<option value="'.$dt_kd.'">'.$dt_kode.'. '.$dt_nama.'. '.$dt_ket.' [Skor : '.$dt_skor.'].</option>';
		}
	while ($rdt = mysql_fetch_assoc($qdt));

	echo '</select>
	</td>


	<td>
	<input name="nama'.$m.'" type="text" value="'.$c1_nama.'" size="60">
	</td>
	</tr>';
	}


echo '</table>
<br>';




//data ne
$qc1 = mysql_query("SELECT SUM(total) AS totalku ".
						"FROM psb_siswa_calon_prestasi ".
						"WHERE kd_siswa_calon = '$swkd'");
$rc1 = mysql_fetch_assoc($qc1);
$c1_totalku = nosql($rc1['totalku']);

echo '<p>
Total : 
<b>
'.$c1_totalku.'
</b> 
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