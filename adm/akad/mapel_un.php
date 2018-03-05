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
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "mapel_un.php";
$diload = "document.formx.no.focus();";
$judul = "Data Pelajaran UN";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);




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
	//re-direct
	xloc($filenya);
	exit();
	}





//jika edit
if ($s == "edit")
	{
	//nilai
	$kdx = nosql($_REQUEST['kd']);

	//query
	$qx = mysql_query("SELECT * FROM psb_m_mapel ".
						"WHERE kd_tapel = '$tp_tapelkd' ".
						"AND kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$x_no = nosql($rowx['no']);
	$x_mapel = balikin($rowx['mapel']);
	$x_bobot = nosql($rowx['bobot']);
	}





//jika simpan
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
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$x_no = nosql($_POST['no']);
	$x_mapel = cegah($_POST['mapel']);
	$x_bobot = nosql($_POST['bobot']);



	//jika null, insert
	if (empty($s))
		{
		mysql_query("INSERT INTO psb_m_mapel(kd, kd_tapel, no, mapel, bobot) VALUES ".
				"('$x', '$tp_tapelkd', '$x_no', '$x_mapel', '$x_bobot')");

		//re-direct
		xloc($filenya);
		exit();
		}


	//jika update
	else if ($s == "edit")
		{
		//update
		mysql_query("UPDATE psb_m_mapel SET no = '$x_no', ".
						"mapel = '$x_mapel', ".
						"bobot = '$x_bobot' ".
						"WHERE kd_tapel = '$tp_tapelkd' ".
						"AND kd = '$kd'");

		//re-direct
		xloc($filenya);
		exit();
		}
	}





//jika hapus
if ($_POST['btnHPS'])
	{
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
	//ketahui tapel aktif
	$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
				"WHERE status = 'true'");
	$rtp = mysql_fetch_assoc($qtp);
	$tp_tapelkd = nosql($rtp['kd']);
	$tp_tahun1 = nosql($rtp['tahun1']);
	$tp_tahun2 = nosql($rtp['tahun2']);


	$ketnya = "$judulku [HAPUS DATA]";
	mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
			"('$x', '$tp_tapelkd', '$kd1_session', '$ketnya', '$today')");
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////



	//ambil nilai
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM psb_m_mapel ".
				"WHERE kd_tapel = '$tp_tapelkd' ".
				"AND kd = '$kd'");
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

//query
$q = mysql_query("SELECT * FROM psb_m_mapel ".
					"WHERE kd_tapel = '$tp_tapelkd' ".
					"ORDER BY no ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

//js
require("../../inc/js/checkall.js");
require("../../inc/js/number.js");
require("../../inc/js/swap.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
No :
<br>
<input name="no" type="text" value="'.$x_no.'" size="2">
</p>

<p>
Nama MaPel :
<br>
<input name="mapel" type="text" value="'.$x_mapel.'" size="30">
</p>

<p>
Bobot :
<br>
<input name="bobot" type="text" value="'.$x_bobot.'" size="2" onKeyPress="return numbersonly(this, event)">
</p>


<p>
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</p>';



//jika ada
if ($total != 0)
	{
	echo '<table width="600" border="1" cellspacing="0" cellpadding="3">
	<tr align="center" bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="1">&nbsp;</td>
	<td width="5"><strong><font color="'.$warnatext.'">No</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama Pelajaran</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">Bobot</font></strong></td>
	</tr>';

	do {
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
		$d_kd = nosql($row['kd']);
		$d_no = nosql($row['no']);
		$d_mapel = balikin($row['mapel']);
		$d_bobot = nosql($row['bobot']);



		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$nomer.'" value="'.$d_kd.'">
       	</td>
		<td>
		<a href="'.$filenya.'?s=edit&kd='.$d_kd.'">
		<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
		</a>
		</td>
		<td>'.$d_no.'</td>
		<td>'.$d_mapel.'</td>
		<td>'.$d_bobot.'</td>
		</tr>';
		}
	while ($row = mysql_fetch_assoc($q));

	echo '</table>

	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="jml" type="hidden" value="'.$total.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$total.')">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
	</tr>

	</table>';
	}
else
	{
	echo '<p>
	<font color="red">
	<strong>Belum Ada Data Mata Pelajaran UN.</strong>
	</font>
	</p>';
	}



echo '</form>
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