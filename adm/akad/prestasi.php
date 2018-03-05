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
$filenya = "prestasi.php";
$diload = "document.formx.kode.focus();";
$judul = "Data Prestasi";
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
//jika batal
if ($_POST['btnBTL'])
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

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
	$qx = mysql_query("SELECT * FROM psb_m_prestasi ".
				"WHERE kd_tapel = '$tp_tapelkd' ".
				"AND kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_kd = nosql($rowx['kd']);
	$e_kode = nosql($rowx['kode']);
	$e_nama = balikin($rowx['nama']);
	$e_ket = balikin($rowx['ket']);
	$e_skor = nosql($rowx['skor']);
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
	$kd = nosql($_POST['kd']);
	$kode = nosql($_POST['kode']);
	$nama = cegah($_POST['nama']);
	$ket = cegah($_POST['ket']);
	$skor = nosql($_POST['skor']);


	//nek null
	if ((empty($nama)) OR (empty($skor)))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika baru
		if (empty($s))
			{
			//cek
			$qcc = mysql_query("SELECT * FROM psb_m_prestasi ".
						"WHERE kd_tapel = '$tp_tapelkd' ".
						"AND kode = '$kode'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Kode Prestasi : $kode, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				pekem($pesan,$filenya);
				exit();
				}
			else
				{
				//query
				mysql_query("INSERT INTO psb_m_prestasi(kd, kd_tapel, kode, nama, ket, skor) VALUES ".
						"('$x', '$tp_tapelkd', '$kode', '$nama', '$ket', '$skor')");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				xloc($filenya);
				exit();
				}
			}

		//jika update
		else if ($s == "edit")
			{
			//query
			mysql_query("UPDATE psb_m_prestasi SET kode = '$kode', ".
					"nama = '$nama', ".
					"ket = '$ket', ".
					"skor = '$skor' ".
					"WHERE kd_tapel = '$tp_tapelkd' ".
					"AND kd = '$kd'");

			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			xloc($filenya);
			exit();
			}
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
		mysql_query("DELETE FROM psb_m_prestasi ".
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
$q = mysql_query("SELECT * FROM psb_m_prestasi ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY kode ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

//js
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
Kode :
<br>
<input name="kode" type="text" value="'.$e_kode.'" size="5">
</p>

<p>
Nama Prestasi :
<br>
<input name="nama" type="text" value="'.$e_nama.'" size="30">
</p>

<p>
Keterangan :
<br>
<input name="ket" type="text" value="'.$e_ket.'" size="30">
</p>

<p>
Skor :
<br>
<input name="skor" type="text" value="'.$e_skor.'" size="5">
</p>


<p>
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</p>';

if ($total != 0)
	{
	echo '<table width="500" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="1">&nbsp;</td>
	<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama Prestasi</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Keterangan</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">Skor</font></strong></td>
	</tr>';

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
		$i_kd = nosql($row['kd']);
		$i_kode = nosql($row['kode']);
		$i_nama = balikin($row['nama']);
		$i_ket = balikin($row['ket']);
		$i_skor = nosql($row['skor']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
        	</td>
		<td>
		<a href="'.$filenya.'?s=edit&kd='.$i_kd.'">
		<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
		</a>
		</td>
		<td>
		'.$i_kode.'
		</td>
		<td>
		'.$i_nama.'
		</td>
		<td>
		'.$i_ket.'
		</td>
		<td>
		'.$i_skor.'
		</td>
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
	<strong>TIDAK ADA DATA. Silahkan Entry Dahulu...!!</strong>
	</font>
	</p>';
	}

echo '</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>