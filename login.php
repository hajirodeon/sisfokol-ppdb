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
$filenya = "login.php";
$judul = "Login ADMIN";
$judulku = $judul;
$diload = "document.formx.tipe.focus();";
$pesan = "PASSWORD SALAH. HARAP DIULANGI...!!!";





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
	//ambil nilai
	$tipe = nosql($_POST["tipe"]);
	$username = nosql($_POST["usernamex"]);
	$password = md5(nosql($_POST["passwordx"]));

	//cek null
	if ((empty($tipe)) OR (empty($username)) OR (empty($password)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika tp01 --> Administrator .......................................................................
		if ($tipe == "tp01")
			{
			//query
			$q = mysql_query("SELECT * FROM psb_m_login ".
								"WHERE level = '1' ".
								"AND usernamex = '$username' ".
								"AND passwordx = '$password'");
			$row = mysql_fetch_assoc($q);
			$total = mysql_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//nilai
				$_SESSION['kd1_session'] = nosql($row['kd']);
				$_SESSION['username1_session'] = $username;
				$_SESSION['adm_session'] = "Administrator";
				$kd1_session = nosql($row['kd']);
				$username1_session = $username;
				$adm_session = "Administrator";



				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
				$ketnya = "Login $adm_session : $username1_session";
				mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
								"('$x', '$tp_tapelkd', '$kd1_session', '$ketnya', '$today')");
				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////



				//re-direct
				$ke = "adm/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................





		//jika tp02 --> petugas pendaftaran ...........................................................................
		if ($tipe == "tp02")
			{
			//query
			$q = mysql_query("SELECT * FROM psb_m_login ".
								"WHERE level = '2' ".
								"AND usernamex = '$username' ".
								"AND passwordx = '$password'");
			$row = mysql_fetch_assoc($q);
			$total = mysql_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//nilai
				$_SESSION['kd2_session'] = nosql($row['kd']);
				$_SESSION['nama2_session'] = balikin($row['nama']);
				$_SESSION['nip2_session'] = nosql($row['nip']);
				$_SESSION['username2_session'] = $username;
				$_SESSION['bdh_session'] = "Petugas Pendaftaran";
				$kd2_session = nosql($row['kd']);
				$nama2_session = balikin($row['nama']);
				$nip2_session = nosql($row['nip']);
				$username2_session = $username;
				$bdh_session = "Petugas Pendaftaran";



				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
				$ketnya = "Login $bdh_session : $username2_session";
				mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
						"('$x', '$tp_tapelkd', '$kd2_session', '$ketnya', '$today')");
				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////


				//re-direct
				$ke = "admbdh/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................





		//jika tp03 --> petugas tes fisik .........................................................................
		if ($tipe == "tp03")
			{
			//query
			$q = mysql_query("SELECT * FROM psb_m_login ".
								"WHERE level = '3' ".
								"AND usernamex = '$username' ".
								"AND passwordx = '$password'");
			$row = mysql_fetch_assoc($q);
			$total = mysql_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//nilai
				$_SESSION['kd3_session'] = nosql($row['kd']);
				$_SESSION['username3_session'] = $username;
				$_SESSION['wwc_session'] = "Petugas Tes Fisik";
				$kd3_session = nosql($row['kd']);
				$username3_session = $username;
				$wwc_session = "Petugas Tes Fisik";



				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
				$ketnya = "Login $wwc_session : $username3_session";
				mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
						"('$x', '$tp_tapelkd', '$kd3_session', '$ketnya', '$today')");
				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////



				//re-direct
				$ke = "admfisik/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................








		//jika tp06 --> petugas pengembalian .........................................................................
		if ($tipe == "tp06")
			{
			//query
			$q = mysql_query("SELECT * FROM psb_m_login ".
								"WHERE level = '6' ".
								"AND usernamex = '$username' ".
								"AND passwordx = '$password'");
			$row = mysql_fetch_assoc($q);
			$total = mysql_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//nilai
				$_SESSION['kd6_session'] = nosql($row['kd']);
				$_SESSION['username6_session'] = $username;
				$_SESSION['kembali_session'] = "Petugas Berkas";
				$kd6_session = nosql($row['kd']);
				$username6_session = $username;
				$kembali_session = "Petugas Berkas";



				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
				$ketnya = "Login $kembali_session : $username6_session";
				mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
						"('$x', '$tp_tapelkd', '$kd6_session', '$ketnya', '$today')");
				//entri history ////////////////////////////////////////////////////////////////////////////////////////////////



				//re-direct
				$ke = "admberkas/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
		//...................................................................................................
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top" align="left">
<td width="25%">';
//ambil data menu
require("inc/menu/psb_menu.php");
echo '</td>

<td align="left">


<TABLE WIDTH=400 BORDER=0 CELLPADDING=0 CELLSPACING=0>
<TR>
<TD>
<IMG SRC="'.$sumber.'/img/login_01.gif" WIDTH=17 HEIGHT=17 ALT="">
</TD>
<TD COLSPAN=2 background="'.$sumber.'/img/login_02.gif">
<IMG SRC="'.$sumber.'/img/login_02.gif" WIDTH=366 HEIGHT=17 ALT="">
</TD>
<TD>
<IMG SRC="'.$sumber.'/img/login_03.gif" WIDTH=17 HEIGHT=17 ALT="">
</TD>
</TR>
<TR>
<TD>
<IMG SRC="'.$sumber.'/img/login_04.gif" WIDTH=17 HEIGHT=226 ALT="">
</TD>
<TD>
<IMG SRC="'.$sumber.'/img/login_05.gif" WIDTH=203 HEIGHT=226 ALT="">
</TD>
<TD background="'.$sumber.'/img/login_06.gif">


Tipe :
<br>
<select name="tipe">
<option value="" selected></option>
<option value="tp01">Administrator</option>
<option value="tp02">Petugas Pendaftaran</option>
<option value="tp03">Petugas Tes Fisik</option>
<option value="tp06">Petugas Berkas</option>
</select>
<br>

Username :
<br>
<input name="usernamex" type="text" size="10" maxlength="15">
<br>

Password :
<br>
<input name="passwordx" type="password" size="10" maxlength="15">
<br>

<input name="btnBTL" type="reset" value="BATAL">
<input name="btnOK" type="submit" value="OK &gt;&gt;&gt;">
<br>


</TD>
<TD>
<IMG SRC="'.$sumber.'/img/login_07.gif" WIDTH=17 HEIGHT=226 ALT="">
</TD>
</TR>
<TR>
<TD>
<IMG SRC="'.$sumber.'/img/login_08.gif" WIDTH=17 HEIGHT=49 ALT="">
</TD>
<TD>
<IMG SRC="'.$sumber.'/img/login_09.gif" WIDTH=203 HEIGHT=49 ALT="">
</TD>
<TD background="'.$sumber.'/img/login_10.gif">
<IMG SRC="'.$sumber.'/img/login_10.gif" WIDTH=163 HEIGHT=49 ALT="">
</TD>
<TD>
<IMG SRC="'.$sumber.'/img/login_11.gif" WIDTH=17 HEIGHT=49 ALT="">
</TD>
</TR>
</TABLE>





</td>
</tr>
</table>





</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>