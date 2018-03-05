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




//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
						"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);



//nilai
$filenya = "psb_reg.php";
$judul = "Pengisian Form Calon Peserta Didik $tp_tahun1/$tp_tahun2";
$judulku = $judul;
$swkd = nosql($_REQUEST['swkd']);
$kelkd = nosql($_REQUEST['kelkd']);




//jika null
if (empty($swkd))
	{
	$swkd = $x;
	}






//jika gak null
if (!empty($kelkd))
	{
	//bikin nomer
	//cek dahulu ya...
	$qcc = mysql_query("SELECT * FROM bikin_nomer ".
							"WHERE kd_tapel = '$tp_tapelkd' ".
							"AND kd_calon = '$swkd'");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);
	$cc_noid = nosql($rcc['noid']);
	
	//jika null
	if (empty($tcc))
		{
		//masukkan dahulu
		mysql_query("INSERT INTO bikin_nomer(kd, kd_tapel, kelamin, tahun, kd_calon, postdate) VALUES ".
						"('$x', '$tp_tapelkd', '$kelkd', '$tp_tahun1', '$swkd', '$today')");
		
		
		//ketahui nomer id terakhir
		$qpdku = mysql_query("SELECT * FROM bikin_nomer ".
								"WHERE kd_tapel = '$tp_tapelkd' ".
								"ORDER BY noid DESC");
		$rpdku = mysql_fetch_assoc($qpdku);
		$pdku_noid = nosql($rpdku['noid']);
			
	
		$pd_noreg = $pdku_noid;
	
	
	
		//jika satu digit
		if (strlen($pd_noreg) == "1")
			{
			$pd_noreg2 = "00$pd_noreg";
			}
	
		//jika dua digit
		else if (strlen($pd_noreg) == "2")
			{
			$pd_noreg2 = "0$pd_noreg";
			}
	
		//jika tiga digit
		else if (strlen($pd_noreg) == "3")
			{
			$pd_noreg2 = $pd_noreg;
			}
	
		$noregx = "$tp_tahun1$kelkd$pd_noreg2";
	
	
	
		//update nomor
		mysql_query("UPDATE bikin_nomer SET nomernya = '$noregx' ".
						"WHERE kd_tapel = '$tp_tapelkd' ".
						"AND kd_calon = '$swkd'");
		
	
	
		//insert
		mysql_query("INSERT INTO psb_siswa_calon(kd, kd_tapel, no_urut, no_daftar, postdate, ".
						"tgl_daftar, status_diterima, status_daftar) VALUES ".
						"('$swkd', '$tp_tapelkd', '$pd_noreg', '$noregx', '$today', ".
						"'$today', 'false', 'false')");
		}


	//jika sudah ada, update aja ya...
	else
		{
		$pd_noreg = $cc_noid;
		
		//jika satu digit
		if (strlen($pd_noreg) == "1")
			{
			$pd_noreg2 = "00$pd_noreg";
			}
	
		//jika dua digit
		else if (strlen($pd_noreg) == "2")
			{
			$pd_noreg2 = "0$pd_noreg";
			}
	
		//jika tiga digit
		else if (strlen($pd_noreg) == "3")
			{
			$pd_noreg2 = $pd_noreg;
			}
	
		$noregx = "$tp_tahun1$kelkd$pd_noreg2";
	


		//update
		mysql_query("UPDATE bikin_nomer SET kelamin = '$kelkd', ".
						"nomernya = '$noregx' ".
						"WHERE kd_tapel = '$tp_tapelkd' ".
						"AND kd_calon = '$swkd'");
		
		//update
		mysql_query("UPDATE psb_siswa_calon SET no_daftar = '$noregx', ".
						"postdate = '$today' ".
						"WHERE kd_tapel = '$tp_tapelkd' ".
						"AND kd = '$swkd'");
		}
	 
	}




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//kirim form
if ($_POST['btnOK'])
	{
	//nilai
	$noregx = nosql($_POST['noregx']);
	$tapelkd = nosql($_POST['tapelkd']);
	$swkd = nosql($_POST['swkd']);
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
	$telp = cegah($_POST['telp']);
	$agama = cegah($_POST['agama']);
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
	if ((empty($nama)) OR (empty($alamat)) OR (empty($telp)) OR (empty($daftar_tgl)) OR (empty($asal_sek)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diperhatikan...!!";
		$ke = "$filenya?kelkd=$kelkd&swkd=$swkd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//cek noreg dan nama, nama dan tgl lahir
		$qcc = mysql_query("SELECT * FROM psb_siswa_calon ".
								"WHERE nama = '$nama' ".
								"AND tgl_lahir = '$tgl_lahir'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//nek iya
		if ($tcc != 0)
			{
			//re-direct
			$pesan = "Anda telah melakukan pendaftaran. Tidak bisa melakukan pendaftaran lagi.";
			$ke = $filenya;
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//query /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
							"nama_wali = '$nm_wali', ".
							"alamat_wali = '$almt_wali', ".
							"kerja_wali = '$ker_wali', ".
							"asal_sekolah = '$asal_sek', ".
							"status_sekolah = '$status_sek', ".
							"alamat_sekolah = '$almt_sek', ".
							"tahun_lulus = '$thn_lulus', ".
							"tb = '$tb', ".
							"bb = '$bb', ".
							"tgl_daftar = '$today' ".
							"WHERE kd = '$swkd'");




			//entry nilai UN ////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
				$xcnil = "nilc";
				$xcnil1 = "$xcnil$nomer";
				$xcnilx = nosql($_POST["$xcnil1"]);

				$xckom = "komc";
				$xckom1 = "$xckom$nomer";
				$xckomx = nosql($_POST["$xckom1"]);

				//nek empty
				if (empty($xcnilx))
					{
					$xcnilx = "00";
					}

				if (empty($xckomx))
					{
					$xckomx = "00";
					}


				//cek nol
				if (strlen($xcnilx) == 1)
					{
					$xcnilx = "0$xcnilx";
					}

				if (strlen($xckomx) == 1)
					{
					$xckomx = "$xckomx"."0";
					}


				//nilai...
				$xcnilku = "$xcnilx.$xckomx";



				//rata2
				$rataku = round($xcnilku * $d_bobot,2);


				//entry
				mysql_query("INSERT INTO psb_siswa_calon_un(kd, kd_siswa_calon, kd_mapel, nilai, total, postdate) VALUES ".
								"('$xx', '$swkd', '$d_kd', '$xcnilku', '$rataku', '$today')");
				}
			while ($rpel = mysql_fetch_assoc($qpel));







			//entry nilai sertifikat ////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$qpel = mysql_query("SELECT * FROM psb_m_sertifikat ".
									"ORDER BY no ASC");
			$rpel = mysql_fetch_assoc($qpel);

			do
				{
				$nomerx = $nomerx + 1;
				$xx = md5("$x$nomer");
				$d_kd = nosql($rpel['kd']);



				//nilai mapel
				$xcnil = "nilcc";
				$xcnil1 = "$xcnil$nomerx";
				$xcnilx = nosql($_POST["$xcnil1"]);

				$xckom = "komcc";
				$xckom1 = "$xckom$nomerx";
				$xckomx = nosql($_POST["$xckom1"]);

				//nek empty
				if (empty($xcnilx))
					{
					$xcnilx = "00";
					}

				if (empty($xckomx))
					{
					$xckomx = "00";
					}


				//cek nol
				if (strlen($xcnilx) == 1)
					{
					$xcnilx = "0$xcnilx";
					}

				if (strlen($xckomx) == 1)
					{
					$xckomx = "$xckomx"."0";
					}


				//nilai...
				$xcnilku = "$xcnilx.$xckomx";



				//entry
				mysql_query("INSERT INTO psb_siswa_calon_sertifikat(kd, kd_siswa_calon, kd_sertifikat, nilai, postdate) VALUES ".
								"('$xx', '$swkd', '$d_kd', '$xcnilku', '$today')");
				}
			while ($rpel = mysql_fetch_assoc($qpel));




			//hapus session
			session_unset();
			session_destroy();
			

			//re-direct ke pemberian akses user /////////////////////////////////////////////////////////////////////////////////////////
			$ke = "psb_reg_akses.php?userkd=$swkd&noregx=$noregx";
			xloc($ke);
			exit();
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi *START
ob_start();


//js
require("inc/js/jumpmenu.js");
require("inc/js/number.js");

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


echo '<form action="'.$filenya.'" method="post" name="formx">';
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top" align="left">
<td width="25%">';
//ambil data menu
require("inc/menu/psb_menu.php");
echo '</td>

<td align="left">
<big><strong>'.$judul.'</strong></big>
<br>';


//cek, sudah aktif belum seleksi.
$qcc = mysql_query("SELECT * FROM psb_set_seleksi");
$rcc = mysql_fetch_assoc($qcc);
$cc_seleksi = nosql($rcc['seleksi']);

//jika tidak aktif, pendaftaran masih diijinkan. ////////////////////////////////////////////////////////////////////////////////////////
if ($cc_seleksi == "false")
	{
	echo '<p>
	Jenis Kelamin : ';
	echo "<select name=\"kelamin\" onChange=\"MM_jumpMenu('self',this,0)\">";
	echo '<option value="'.$kelkd.'" selected>--'.$kelkd.'--</option>';
	echo '<option value="'.$filenya.'?swkd='.$swkd.'&kelkd=L">L</option>
	<option value="'.$filenya.'?swkd='.$swkd.'&kelkd=P">P</option>
	</select>
	</p>
	<br>';

	if (empty($kelkd))
		{
		echo '<p>
		<font color="red">
		<strong>Jenis Kelamin Belum Ditentukan...!!.</strong>
		</font>
		</p>';
		}
	else
		{
		//nomor pendaftarannya
		$qku = mysql_query("SELECT * FROM psb_siswa_calon ".
								"WHERE kd_tapel = '$tp_tapelkd' ".
								"AND kd = '$swkd'");
		$rku = mysql_fetch_assoc($qku);
		$ku_noregx = nosql($rku['no_daftar']);
		
		
		echo '<p>
		Nomor Pendaftaran :
		<br>
		<b>'.$ku_noregx.'</b>
		</p>
		
		<p>
		<strong>Peringatan :</strong>
		<br>
		1. Pastikan Semua Form Berikut Terisi dengan Lengkap.
		<br>
		2. Printing PDF Formulir, berada setelah Pengisian Form ini.
		Dan Hasil Printing, menggunakan Kertas HVS/Folio 70gram.
		<br>
		3. Jangan lupa, Bawalah Hasil Printing Formulir Sementara,
		Saat akan Melakukan Pendaftaran PPDB di Sekolah '.$sek_nama.'
		</p>

			<strong>IDENTITAS PESERTA</strong>
		<br>
		<table border="0" cellpadding="0" cellspacing="0" >
		<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>1. Nama </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				</td>
			<td width="535" height="21">
				: <input name="nama" type="text" size="30" maxlength="30">*
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
			<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>2. Tempat, Tanggal Lahir </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <input name="tmp_lahir" type="text" value="" size="20">, 
				<input name="datepicker1" id="datepicker1" type="text" value="'.$tgl_lahir.'" size="10">
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
			<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>3. Alamat </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <input name="alamat" type="text" size="50">*
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
			<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>4. Jenis Kelamin (L/P)  </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <select name="kelamin">
					<option value="'.$kelkd.'" selected>-'.$kelkd.'-</option>
				</select>
				</td>
				</tr>
			<tr height="5"></TR>
			<tr>
			<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>5. Agama </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <select name="agama">
					<option value="" selected></option>
					<option value="Islam">Islam</option>
					<option value-"Kristen">Kristen</option>
					<option value="Katholik">Katholik</option>
					<option value="Budha">Budha</option>
					<option value="Hindu">Hindu</option>
					<option value="Konghuchu">Konghuchu</option>
				</select>
				</td>
			</tr>

			<tr height="5"></TR>
			<tr>
			<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>6. Telepon </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <input name="telp" type="text" size="30">*
				</td>
			</tr>


			<tr height="5"></TR>
			<tr>
			<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>7. Tinggi Badan </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <input name="tb" type="text" size="3">Cm.
				</td>
			</tr>


			<tr height="5"></TR>
			<tr>
			<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>8. Berat Badan</p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <input name="bb" type="text" size="3">Kg.
				</td>
			</tr>
		</table>
		<br>
		<strong>IDENTITAS ORANG TUA </strong>
		<table border="0" cellpadding="0" cellspacing="0" >
		<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200" height="21">
			<p>1. Nama Orang Tua / Ayah  </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <input name="nm_ortu" type="text" size="20">
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200" height="21">
			<p>2. Alamat Orang Tua / Ayah   </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <input name="almt_ortu" type="text" size="50">
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200" height="21">
			<p>3. Pekerjaan Orang Tua / Ayah </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
				<td width="535" height="21">
				: <select name="ker_ortu">
					<option value="" selected></option>
					<option value="PNS">PNS</option>
					<option value="TNI/POLRI">TNI/POLRI</option>
					<option value="Swasta">Swasta</option>
					<option value="Tani">Tani</option>
					<option value="Buruh">Buruh</option>
				</select>
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			</tr>
			</table>


		<br>
		<strong>IDENTITAS WALI MURID (diisi jika ada)  </strong>
		<table border="0" cellpadding="0" cellspacing="0" >
		<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200" height="21">
			<p>1. Nama Wali </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <input name="nm_wali" type="text" size="20">
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>2. Alamat Wali </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <input name="almt_wali" type="text" size="50">
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>3. Pekerjaan Wali </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <select name="ker_wali">
					<option value="" selected></option>
					<option value="PNS">PNS</option>
					<option value="TNI/POLRI">TNI/POLRI</option>
					<option value="Swasta">Swasta</option>
					<option value="Tani">Tani</option>
					<option value="Buruh">Buruh</option>
				</select>
				</td>
			</tr>
			<tr height="5"></TR>
		</table>
		<br>
		<strong>SEKOLAH ASAL</strong>
		<br>
		<table>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>1. Sekolah Asal </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <input name="asal_sek" type="text" size="30">
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>2. Status Sekolah </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <select name="status_sek">
					<option value="" selected></option>
					<option value="Negeri">Negeri</option>
					<option value="Swasta">Swasta</option>
				</select>
				</td>
			</tr>
			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>3. Alamat Sekolah </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <input name="almt_sek" type="text" size="50">
				</td>
			</tr>

			<tr height="5"></TR>
			<tr>
				<td width="23" height="21">
			<p></p>
			</td>
			<td width="200 height="21">
			<p>4. Tahun Lulus </p>
			</td>
			<td width="7" height="21">
			<p></p>
			</td>
			<td width="535" height="21">
				: <input name="thn_lulus" type="text" size="4" onKeyPress="return numbersonly(this, event)">
				</td>
			</tr>
			<tr height="5"></TR>
		</table>
		<br>
		<strong>NILAI UN</strong>
		<br>
			<table width="400" border="1" cellspacing="0" cellpadding="3">
				<tr align="center" bgcolor="'.$warnaheader.'">
				<td width="1"><font color="'.$warnatext.'"><strong>No.</strong></font></strong></td>
				<td><strong><font color="'.$warnatext.'">Mata Pelajaran</font></strong></td>
				<td width="150"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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

					echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
					echo '<td>
					<input name="kd'.$d_kd.'" type="hidden" value="'.$d_kd.'">
					'.$nomer.'.
					</td>
					<td>'.$d_mapel.'</td>
					<td>
					<input name="nilc'.$nomer.'" type="text" value="" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">,
					<input name="komc'.$nomer.'" type="text" value="" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">
					</td>
					</tr>';
					}
				while ($rpel = mysql_fetch_assoc($qpel));

		echo '</table>
		<br>


		<p>
		
		<br>
		<strong>NILAI SERTIFIKAT</strong>
		<br>
			<table width="400" border="1" cellspacing="0" cellpadding="3">
				<tr align="center" bgcolor="'.$warnaheader.'">
				<td width="1"><font color="'.$warnatext.'"><strong>No.</strong></font></strong></td>
				<td><strong><font color="'.$warnatext.'">Sertifikat</font></strong></td>
				<td width="150"><strong><font color="'.$warnatext.'">Nilai</font></strong></td>
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

					echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
					echo '<td>
					<input name="kd'.$d_kd.'" type="hidden" value="'.$d_kd.'">
					'.$nomerx.'.
					</td>
					<td>'.$d_mapel.'</td>
					<td>
					<input name="nilcc'.$nomerx.'" type="text" value="" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">,
					<input name="komcc'.$nomerx.'" type="text" value="" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">
					</td>
					</tr>';
					}
				while ($rpel = mysql_fetch_assoc($qpel));

		echo '</table>
		</p>
		<br>

		<input name="noregx" type="hidden" value="'.$noregx.'">
		<input name="swkd" type="hidden" value="'.$swkd.'">
		<input name="tapelkd" type="hidden" value="'.$tp_tapelkd.'">
		<input name="keakd" type="hidden" value="'.$keakd.'">
		<input name="keakd2" type="hidden" value="'.$keakd2.'">
		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnOK" type="submit" value="OK &gt;&gt;&gt;">';
		}
	}
else
	{
	echo '<p>
	<font color="red"><strong>
	Maaf, Sesi Pendaftaran Tidak Aktif atau Telah Ditutup.
	<br>
	<br>
	<br>
	Ttd. Panitia
	</strong></font>
	</p>';
	}

echo '</td>
</tr>
</table>


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
