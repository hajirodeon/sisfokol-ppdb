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


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/index.html");


nocache;




//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);



//nilai
$filenya = "psb_reg_lupa.php";
$judul = "Lupa Password, Calon Peserta Didik $tp_tahun1/$tp_tahun2";
$judulku = $judul;




//jika reset password  //////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnRST'])
	{
	//nilai
	$noreg = nosql($_POST['noreg']);
	$kelamin = nosql($_POST['kelamin']);
	$lxtgl = nosql($_POST['lxtgl']);
	$lxbln = nosql($_POST['lxbln']);
	$lxthn = nosql($_POST['lxthn']);
	$tgl_lahir = "$lxthn:$lxbln:$lxtgl";
	$dxtgl = nosql($_POST['dxtgl']);
	$dxbln = nosql($_POST['dxbln']);
	$dxthn = nosql($_POST['dxthn']);
	$tgl_daftar = "$dxthn:$dxbln:$dxtgl";



	//cek
	$qcc = mysql_query("SELECT * FROM psb_siswa_calon ".
				"WHERE kd_tapel = '$tp_tapelkd' ".
				"AND no_daftar = '$noreg' ".
				"AND kelamin = '$kelamin' ".
				"AND tgl_lahir = '$tgl_lahir' ".
				"AND tgl_daftar = '$tgl_daftar'");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);
	$cc_kd = nosql($rcc['kd']);


	//jika ada, berikan password baru
	if ($tcc != 0)
		{
		$dt_pass = $passbaru;
		$passbarux = md5($dt_pass);


		//update password...
		mysql_query("UPDATE psb_m_login SET password = '$passbarux' ".
				"WHERE kd = '$cc_kd'");


		//re-direct
		$pesan = "Password Baru : $dt_pass. Harap Disimpan Dengan Baik. Terima Kasih.";
		pekem($pesan, $sumber);
		exit();
		}
	else
		{
		$pesan = "Entri Tidak Sesuai. Harap Diperhatikan. Terima Kasih.";
		pekem($pesan, $filenya);
		exit();
		}
	}
//jika reset password  //////////////////////////////////////////////////////////////////////////////////











//isi *START
ob_start();


//js
require("inc/js/jumpmenu.js");
require("inc/js/number.js");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top" align="left">
<td width="25%">';
//ambil data menu
require("inc/menu/psb_menu.php");
echo '</td>

<td align="left">
<big><strong>'.$judul.'</strong></big>
<br>


<p>
Masukkan Terlebih Dahulu, Data - Data Berikut ini :
</p>


<p>
No.Pendaftaran :
<br>
<input name="noreg" type="text" size="10">
</p>


<p>
Jenis Kelamin :
<br>
<select name="kelamin">
<option value="" selected></option>
<option value="01">Laki - Laki</option>
<option value="02">Perempuan</option>
</select>
</p>


<p>
Tanggal Lahir :
<br>
<select name="lxtgl">
<option value="" selected></option>';
for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$i.'">'.$i.'</option>';
	}
echo '</select>
<select name="lxbln">
<option value="" selected></option>';
for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
	}
echo '</select>
<select name="lxthn">
<option value="" selected></option>';
for ($k=$lahir01;$k<=$lahir02;$k++)
	{
	echo '<option value="'.$k.'">'.$k.'</option>';
	}
echo '</select>
</p>




<p>
Tanggal Pendaftaran :
<br>
<select name="dxtgl">
<option value="" selected></option>';
for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$i.'">'.$i.'</option>';
	}
echo '</select>
<select name="dxbln">
<option value="" selected></option>';
for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
	}
echo '</select>
<select name="dxthn">
<option value="" selected></option>';
for ($k=$daft01;$k<=$daft02;$k++)
	{
	echo '<option value="'.$k.'">'.$k.'</option>';
	}
echo '</select>
</p>



<INPUT type="submit" name="btnRST" value="RESET >>">
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