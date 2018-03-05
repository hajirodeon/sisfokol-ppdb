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
$filenya = "nilai_tertulis.php";
$judul = "Calon : Nilai Tertulis";
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



	//entry nilai UN ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$qpel = mysql_query("SELECT * FROM psb_m_mapel2 ".
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
		$xbnil = "nilc";
		$xbnil1 = "$xbnil$nomer";
		$xbnilx = nosql($_POST["$xbnil1"]);

		//total
		$xcnilx = round(($d_bobot * $xbnilx),2);


		//cek null
		$qcc = mysql_query("SELECT * FROM psb_siswa_calon_tertulis ".
								"WHERE kd_siswa_calon = '$swkd' ".
								"AND kd_mapel = '$d_kd'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//jika ada
		if ($tcc != 0)
			{
			//entry update
			mysql_query("UPDATE psb_siswa_calon_tertulis SET nilai = '$xbnilx', ".
							"total = '$xcnilx', ".
							"postdate = '$today' ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND kd_mapel = '$d_kd'");
			}
		else
			{
			mysql_query("INSERT INTO psb_siswa_calon_tertulis(kd, kd_siswa_calon, kd_mapel, ".
							"nilai, total, postdate) VALUES ".
							"('$x', '$swkd', '$d_kd', ".
							"'$xbnilx', '$xcnilx', '$today')");
			}
		}
	while ($rpel = mysql_fetch_assoc($qpel));




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
<a href="nilai.php">Nilai-Nilai</a> > Nilai Ujian Tertulis
<br>
<br>


<strong>No. Pendaftaran :</strong> '.$dt_noregx.', <strong>Nama : </strong>'.$dt_nama.'.
<br>
<br>


<table width="500" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="1"><font color="'.$warnatext.'">No.</font></strong></td>
<td><strong><font color="'.$warnatext.'">Mata Pelajaran</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Bobot</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Total</font></strong></td>
</tr>';

//ambil data mata pelajaran
$qpel = mysql_query("SELECT * FROM psb_m_mapel2 ".
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
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_tertulis ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND kd_mapel = '$d_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$nile_nilai = nosql($rnile['nilai']);
	$nile_total = nosql($rnile['total']);



	//jika lebih dari sepuluh
	if ($nile_nilai > 10)
		{
		$nile_nilaiku2 = round($nile_nilai / $d_bobot,2);
		}
	else
		{
		$nile_nilaiku2 = $nile_nilai;
		}




	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td>
	<input name="kd'.$d_kd.'" type="hidden" value="'.$d_kd.'">
	'.$nomer.'
	</td>
	<td>'.$d_mapel.'</td>
	<td>
	<input name="nila'.$nomer.'" type="text" value="'.$d_bobot.'" size="5" class="input" readonly>
	</td>
	<td>
	<input name="nilc'.$nomer.'" type="text" value="'.$nile_nilaiku2.'" size="5">
	</td>
	<td>
	<input name="nilk'.$nomer.'" type="text" value="'.$nile_total.'" size="5" class="input" readonly>
	</td>
    	</tr>';
	}
while ($rpel = mysql_fetch_assoc($qpel));

echo '</table>';



//nilaine...
$qnile = mysql_query("SELECT SUM(total) AS totalku, ".
						"AVG(total) AS rataku ".
						"FROM psb_siswa_calon_tertulis ".
						"WHERE kd_siswa_calon = '$swkd'");
$rnile = mysql_fetch_assoc($qnile);
$nile_totalku = nosql($rnile['totalku']);
$nile_rataku = nosql($rnile['rataku']);



echo '<p>
Total : 
<b>'.$nile_totalku.'</b>
</p>


<p>
Rata - rata :
<b>'.$nile_rataku.'</b>
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