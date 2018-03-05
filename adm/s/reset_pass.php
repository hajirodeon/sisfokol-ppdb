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
require("../../inc/class/paging.php");
require("../../inc/cek/psb_adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "reset_pass.php";
$diload = "document.formx.akses.focus();";
$judul = "Reset Password";
$judulku = "[$adm_session] ==> $judul";
$juduli = $judul;
$tpkd = nosql($_REQUEST['tpkd']);
$tipe = cegah($_REQUEST['tipe']);
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
//jika reset
if ($_POST['btnRST'])
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




	$tpkd = nosql($_POST['tpkd']);
	$tipe = cegah($_POST['tipe']);
	$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&page=$page";
	$page = nosql($_POST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}


	//nek petugas pendaftaran .....................................................................................................................
	if ($tpkd == "tp01")
		{
		//nilai
		$dataku = nosql($_POST['dataku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("UPDATE psb_m_login SET passwordx = '$passbarux', ".
						"postdate = '$today' ".
						"WHERE level = '2' ".
						"AND kd = '$dataku'");

		//auto-kembali
		$pesan = "Password Baru : $passbaru";
		pekem($pesan,$ke);
		exit();
		}
	//...................................................................................................................................





	//nek tes fisik....................................................................................................................
	if ($tpkd == "tp02")
		{
		//nilai
		$dataku = nosql($_POST['dataku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("UPDATE psb_m_login SET passwordx = '$passbarux', ".
						"postdate = '$today' ".
						"WHERE level = '3' ".
						"AND kd = '$dataku'");

		//auto-kembali
		$pesan = "Password Baru : $passbaru";
		pekem($pesan,$ke);
		exit();
		}








	//nek pengembalian....................................................................................................................
	if ($tpkd == "tp05")
		{
		//nilai
		$dataku = nosql($_POST['dataku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("UPDATE psb_m_login SET passwordx = '$passbarux', ".
						"postdate = '$today' ".
						"WHERE level = '6' ".
						"AND kd = '$dataku'");

		//auto-kembali
		$pesan = "Password Baru : $passbaru";
		pekem($pesan,$ke);
		exit();
		}
	}





//jika hapus
if ($_POST['btnHPS'])
	{
	$tpkd = nosql($_POST['tpkd']);
	$tipe = cegah($_POST['tipe']);
	$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&page=$page";
	$page = nosql($_POST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}


	//nek petugas pendaftaran .....................................................................................................................
	if ($tpkd == "tp01")
		{
		//nilai
		$dataku = nosql($_POST['dataku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("DELETE FROM psb_m_login ".
						"WHERE level = '2' ".
						"AND kd = '$dataku'");

		//auto-kembali
		xloc($ke);
		exit();
		}




	//nek tes fisik .....................................................................................................................
	if ($tpkd == "tp02")
		{
		//nilai
		$dataku = nosql($_POST['dataku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("DELETE FROM psb_m_login ".
						"WHERE level = '3' ".
						"AND kd = '$dataku'");

		//auto-kembali
		xloc($ke);
		exit();
		}







	//nek pengembalian.....................................................................................................................
	if ($tpkd == "tp05")
		{
		//nilai
		$dataku = nosql($_POST['dataku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("DELETE FROM psb_m_login ".
						"WHERE level = '6' ".
						"AND kd = '$dataku'");

		//auto-kembali
		xloc($ke);
		exit();
		}
	//...................................................................................................................................
	}





//jika baru
if ($_POST['btnBR'])
	{
	$tpkd = nosql($_POST['tpkd']);
	$tipe = cegah($_POST['tipe']);
	$ke = "$filenya?tpkd=$tpkd&tipe=$tipe&page=$page";
	$page = nosql($_POST['page']);
	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}


	//nek petugas pendaftaran .....................................................................................................................
	if ($tpkd == "tp01")
		{
		//nilai
		$userku = nosql($_POST['namaku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("INSERT INTO psb_m_login (kd, usernamex, passwordx, nama, level, postdate) VALUES ".
						"('$x', '$userku', '$passbarux', '$userku', '2', '$today')");

		//auto-kembali
		$pesan = "User : $userku, Berhasil Dibuat. Dengan Password : $passbaru";
		pekem($pesan,$ke);
		exit();
		}




	//nek tes fisik .....................................................................................................................
	if ($tpkd == "tp02")
		{
		//nilai
		$userku = nosql($_POST['namaku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("INSERT INTO psb_m_login (kd, usernamex, passwordx, nama, level, postdate) VALUES ".
				"('$x', '$userku', '$passbarux', '$userku', '3', '$today')");

		//auto-kembali
		$pesan = "User : $userku, Berhasil Dibuat. Dengan Password : $passbaru";
		pekem($pesan,$ke);
		exit();
		}





	//nek pengembalian .....................................................................................................................
	if ($tpkd == "tp05")
		{
		//nilai
		$userku = nosql($_POST['namaku']);
		$passbarux = md5($passbaru);

		//perintah SQL
		mysql_query("INSERT INTO psb_m_login (kd, usernamex, passwordx, nama, level, postdate) VALUES ".
						"('$x', '$userku', '$passbarux', '$userku', '6', '$today')");

		//auto-kembali
		$pesan = "User : $userku, Berhasil Dibuat. Dengan Password : $passbaru";
		pekem($pesan,$ke);
		exit();
		}

	//...................................................................................................................................
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table bgcolor="'.$warnaover.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Akses : ';
echo "<select name=\"akses\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$filenya.'?tpkd='.$tpkd.'" selected>--'.$tipe.'--</option>
<option value="'.$filenya.'?tpkd=tp01&tipe=Petugas Pendaftaran">Petugas Pendaftaran</option>
<option value="'.$filenya.'?tpkd=tp02&tipe=Petugas Tes Fisik">Petugas Tes Fisik</option>
<option value="'.$filenya.'?tpkd=tp05&tipe=Petugas Berkas">Petugas Berkas</option>
</select>
</td>
</tr>
</table>

<p>';
//nek petugas pendaftaran /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($tpkd == "tp01")
	{
	echo '<p>
	<INPUT type="text" name="namaku" size="10">
	<INPUT type="submit" name="btnBR" value="BARU >>">
	</p>


	<table width="400" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">User</font></strong></td>
	</tr>';



	//query
	$qminx = mysql_query("SELECT * FROM psb_m_login ".
							"WHERE level = '2' ".
							"ORDER BY usernamex ASC");
	$rminx = mysql_fetch_assoc($qminx);

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
		$r_kd = nosql($rminx['kd']);
		$r_username = nosql($rminx['usernamex']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="radio" name="dataku" value="'.$r_kd.'">
        	</td>
		<td>
		'.$r_username.'
		</td>
		</tr>';
		}
	while ($rminx = mysql_fetch_assoc($qminx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnHPS" type="submit" value="HAPUS">
	<input name="btnRST" type="submit" value="RESET">
	</td>
	</tr>
	</table>';
	}



//nek petugas tes fisik ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($tpkd == "tp02")
	{
	echo '<p>
	<INPUT type="text" name="namaku" size="10">
	<INPUT type="submit" name="btnBR" value="BARU >>">
	</p>


	<table width="400" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">User</font></strong></td>
	</tr>';



	//query
	$qminx = mysql_query("SELECT * FROM psb_m_login ".
							"WHERE level = '3' ".
							"ORDER BY usernamex ASC");
	$rminx = mysql_fetch_assoc($qminx);

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
		$r_kd = nosql($rminx['kd']);
		$r_username = nosql($rminx['usernamex']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="radio" name="dataku" value="'.$r_kd.'">
        	</td>
		<td>
		'.$r_username.'
		</td>
		</tr>';
		}
	while ($rminx = mysql_fetch_assoc($qminx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnHPS" type="submit" value="HAPUS">
	<input name="btnRST" type="submit" value="RESET">
	</td>
	</tr>
	</table>';
	}






//nek petugas pengembalian ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($tpkd == "tp05")
	{
	echo '<p>
	<INPUT type="text" name="namaku" size="10">
	<INPUT type="submit" name="btnBR" value="BARU >>">
	</p>


	<table width="400" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">User</font></strong></td>
	</tr>';



	//query
	$qminx = mysql_query("SELECT * FROM psb_m_login ".
							"WHERE level = '6' ".
							"ORDER BY usernamex ASC");
	$rminx = mysql_fetch_assoc($qminx);

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
		$r_kd = nosql($rminx['kd']);
		$r_username = nosql($rminx['usernamex']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="radio" name="dataku" value="'.$r_kd.'">
        	</td>
		<td>
		'.$r_username.'
		</td>
		</tr>';
		}
	while ($rminx = mysql_fetch_assoc($qminx));

	echo '</table>
	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="tpkd" type="hidden" value="'.$tpkd.'">
	<input name="tipe" type="hidden" value="'.$tipe.'">
	<input name="btnHPS" type="submit" value="HAPUS">
	<input name="btnRST" type="submit" value="RESET">
	</td>
	</tr>
	</table>';
	}



echo '</p></form>
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