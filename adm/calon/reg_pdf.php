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


//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/tanda_bukti.php");


error_reporting(0);


nocache;


//start class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->SetTitle($judul);
$pdf->SetAuthor($author);
$pdf->SetSubject($description);
$pdf->SetKeywords($keywords);


//nilai
$judul = "Print Tanda Bukti";
$judulz = $judul;
$swkd = nosql($_REQUEST['swkd']);






//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
						"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);





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









//isi *START
ob_start();




//header
$pdf->AddPage();




$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(233,233,233);
$pdf->SetY(10);
$pdf->SetX(10);
$pdf->Image('../../img/logo.png',10,8,16);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(140,5,''.$sek_nama.'',0,0,'C',0);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(140,5,''.$sek_alamat.'',0,0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(140,0.5,'',1,0,'C',1);



$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(233,233,233);
$pdf->SetY(40);
$pdf->SetX(10);
//$pdf->Cell(70,10,'TANDA BUKTI PENDAFTARAN PPDB ONLINE',1,0,'C',1);
$pdf->Cell(100,5,'TANDA BUKTI PENDAFTARAN PPDB ONLINE',0,0,'C',0);
$pdf->Ln();
$pdf->Cell(100,5,'TAHUN PELAJARAN '.$tp_tahun1.'/'.$tp_tahun2.'',0,0,'C',0);
$pdf->Ln();




$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(233,233,233);
$pdf->SetY(40);
$pdf->SetX(110);
$pdf->Cell(40,5,'NOMOR PENDAFTARAN',1,0,'C',1);
$pdf->Ln();
$pdf->SetX(110);
$pdf->SetFont('Arial','B',10);

//jika mulai tanggal tujuh juni 2014
if (($tanggal == "07") AND ($bulan == "06") AND ($tahun == "2014"))
	{
	$pdf->Cell(40,10,$dt_noregx,1,0,'C',0);
	}
else
	{
//	$pdf->Cell(40,10,'',1,0,'C',0);
	$pdf->Cell(40,10,$dt_noregx,1,0,'C',0);
	}





//pas foto
$pdf->SetFont('Arial','',8);
$pdf->SetY(155);
$pdf->SetX(75);
$pdf->Cell(30,40,'PAS FOTO',1,0,'C',0);
$nilY = $pdf->GetY();
//$pdf->SetY($nilY + 25);
$pdf->SetY(175);
$pdf->SetX(80);
$pdf->Cell(20,10,'3 x 4',0,0,'C',0);




$pdf->SetFont('Arial','',11);
$pdf->SetY(80);
$pdf->SetX(10);
$pdf->Cell(70,5,'1. Nama Lengkap ',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_nama.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'2. Tempat dan Tanggal Lahir',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_tmp_lahir.', '.$dt_tgl.' '.$arrbln1[$dt_bln].' '.$dt_thn.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'3. Agama',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_agama.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'4. Jenis Kelamin',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_kelamin.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'5. Tinggi Badan',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_tb.' Cm.',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'6. Berat Badan',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_bb.' Kg.',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'7. Asal Sekolah',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_asal_sek.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'8. Nama Orang Tua / Wali',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_nm_ortu.' / '.$dt_nm_wali.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'9. Pekerjaan Orang Tua / Wali',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_ker_ortu.' / '.$dt_ker_wali.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'10. Alamat Orang Tua / Wali',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_almt_ortu.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(120,5,''.$dt_almt_wali.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'11. Nomor Telepon / HP',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': '.$dt_telp.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(70,5,'12. Daftar Nilai Ujian Nasional',0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,5,': ',0,0,'L',0);
$pdf->Ln();



//query
$q = mysql_query("SELECT * FROM psb_m_mapel ".
					"WHERE kd_tapel = '$tp_tapelkd' ".
					"ORDER BY no ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

$pdf->SetFont('Arial','',11);

do
	{
	$pdf->SetX(20);
	$r_kd = nosql($row['kd']);
	$r_no = nosql($row['no']);
	$r_bobot = nosql($row['bobot']);
	$r_mapel = nosql($row['mapel']);


	//nilaine...
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_un ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND kd_mapel = '$r_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$nile_nilai = nosql($rnile['nilai']);





	//jika lebih dari sepuluh
	if ($nile_nilaiku > 10)
		{
		$nile_nilaiku2 = round($nile_nilai / $r_bobot,2);
		}
	else
		{
		$nile_nilaiku2 = $nile_nilai;
		}




	$pdf->Cell(40,5,''.$r_no.'. '.$r_mapel.'',0,0,'L',0);
	$pdf->Cell(10,5,': '.$nile_nilaiku2.'',0,0,'L',0);
	$pdf->Ln();
	}
while ($row = mysql_fetch_assoc($q));





//query
$q = mysql_query("SELECT * FROM psb_m_sertifikat ".
					"ORDER BY no ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

$pdf->SetFont('Arial','',11);

do
	{
	$pdf->SetX(10);
	$r_kd = nosql($row['kd']);
	$r_no = nosql($row['no']);
	$r_mapel = nosql($row['nama']);
	$r_nox = $r_no + 12;

	//nilaine...
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_sertifikat ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND kd_sertifikat = '$r_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$nile_nilai = nosql($rnile['nilai']);




	$nile_nilaiku2 = $nile_nilai;


	$pdf->Cell(50,5,''.$r_nox.'. Sertifikat '.$r_mapel.'',0,0,'L',0);
	$pdf->Cell(50,5,': '.$nile_nilaiku2.'',0,0,'L',0);
	$pdf->Ln();
	}
while ($row = mysql_fetch_assoc($q));





$pdf->SetFont('Arial','',11);
$pdf->Cell(50,5,'14. Sertifikat Bahasa Inggris',0,0,'L',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(50,5,': ',0,0,'L',0);
$pdf->Ln();



//ttd
$pdf->SetY($nilY-10);
$pdf->SetX(100);
$pdf->Cell(40,5,''.$sek_nama.', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'',0,0,'C',0);
$pdf->SetY($nilY);
$pdf->SetX(110);
$pdf->Cell(40,5,'Petugas',0,0,'C',0);
$pdf->SetY($nilY + 35);
$pdf->SetX(110);
$pdf->Cell(40,5,'. . . . . . . . . . . . . . . . . . . .',0,0,'C',0);













//sebelah kanan /////////////////////////////////////////////////////////////////////////////
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(233,233,233);
$pdf->SetY(10);
$pdf->SetX(160+10);
$pdf->Image('../../img/logo.png',170,8,14);
$pdf->Ln();

$pdf->SetY(9);
$pdf->SetX(160+10);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(140,5,''.$sek_nama.'',0,0,'C',0);
$pdf->Ln();
$pdf->SetX(160+10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(140,3,''.$sek_alamat.'',0,0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetX(160+10);
$pdf->Cell(140,0.5,'',1,0,'C',1);
$pdf->Ln();




$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(233,233,233);
$pdf->SetY(30);
$pdf->SetX(170);
//$pdf->Cell(70,10,'TANDA BUKTI PENDAFTARAN PPDB ONLINE',1,0,'C',1);
$pdf->Cell(100,5,'TANDA BUKTI PENDAFTARAN PPDB ONLINE',0,0,'C',0);
$pdf->Ln();
$pdf->SetY(40);
$pdf->SetX(170);
$pdf->Cell(100,5,'TAHUN PELAJARAN '.$tp_tahun1.'/'.$tp_tahun2.'',0,0,'C',0);
$pdf->Ln();




$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(233,233,233);
$pdf->SetY(30);
$pdf->SetX(270);
$pdf->Cell(40,5,'NOMOR PENDAFTARAN',1,0,'C',1);
$pdf->Ln();
$pdf->SetX(270);
$pdf->SetFont('Arial','B',10);

//jika mulai tanggal tujuh juni 2014
if (($tanggal == "07") AND ($bulan == "06") AND ($tahun == "2014"))
	{
	$pdf->Cell(40,10,$dt_noregx,1,0,'C',0);
	}
else
	{
//	$pdf->Cell(40,10,'',1,0,'C',0);
	$pdf->Cell(40,10,$dt_noregx,1,0,'C',0);
	}




//pas foto
$pdf->SetFont('Arial','',8);
$pdf->SetY(100);
$pdf->SetX(230);
$pdf->Cell(30,40,'PAS FOTO',1,0,'C',0);
$nilY = $pdf->GetY();
//$pdf->SetY($nilY + 25);
$pdf->SetY(120);
$pdf->SetX(235);
$pdf->Cell(20,10,'3 x 4',0,0,'C',0);




$pdf->SetFont('Arial','',10);
$pdf->SetY(70);
$pdf->SetX(170);
$pdf->Cell(70,5,'1. Nama Lengkap ',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,': '.$dt_nama.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetX(170);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70,5,'2. Tempat dan Tanggal Lahir',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,': '.$dt_tmp_lahir.', '.$dt_tgl.' '.$arrbln1[$dt_bln].' '.$dt_thn.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetX(170);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70,5,'3. Agama',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,': '.$dt_agama.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetX(170);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70,5,'4. Asal Sekolah',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,': '.$dt_asal_sek.'',0,0,'L',0);
$pdf->Ln();
$pdf->SetX(170);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70,5,'5. Daftar Nilai Ujian Nasional',0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,': ',0,0,'L',0);
$pdf->Ln();


//query
$q = mysql_query("SELECT * FROM psb_m_mapel ".
			"WHERE kd_tapel = '$tp_tapelkd' ".
			"ORDER BY no ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

$pdf->SetFont('Arial','',10);

do
	{
	$pdf->SetX(175);
	$r_kd = nosql($row['kd']);
	$r_no = nosql($row['no']);
	$r_mapel = nosql($row['mapel']);


	//nilaine...
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_un ".
				"WHERE kd_siswa_calon = '$swkd' ".
				"AND kd_mapel = '$r_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$nile_nilai = nosql($rnile['nilai']);


	$pdf->Cell(40,5,''.$r_no.'. '.$r_mapel.'',0,0,'L',0);
	$pdf->Cell(10,5,': '.$nile_nilai.'',0,0,'L',0);
	$pdf->Ln();
	}
while ($row = mysql_fetch_assoc($q));



/*
$pdf->SetX(170);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,5,'6. Sertifikat Kejuaraan',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,5,': ',0,0,'L',0);
$pdf->Ln();


$pdf->SetX(170);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,5,'7. Sertifikat Bahasa Inggris',0,0,'L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,5,': ',0,0,'L',0);
$pdf->Ln();
*/


//query
$q = mysql_query("SELECT * FROM psb_m_sertifikat ".
					"ORDER BY no ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

$pdf->SetFont('Arial','',10);

do
	{
	$pdf->SetX(170);
	$r_kd = nosql($row['kd']);
	$r_no = nosql($row['no']);
	$r_mapel = nosql($row['nama']);
	$r_nox = $r_no + 5;

	//nilaine...
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_sertifikat ".
							"WHERE kd_siswa_calon = '$swkd' ".
							"AND kd_sertifikat = '$r_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$nile_nilai = nosql($rnile['nilai']);


	$pdf->Cell(45,5,''.$r_nox.'. Sertifikat '.$r_mapel.'',0,0,'L',0);
	$pdf->Cell(50,5,': '.$nile_nilai.'',0,0,'L',0);
	$pdf->Ln();
	}
while ($row = mysql_fetch_assoc($q));






//ttd
$pdf->SetY($nilY);
$pdf->SetX(270);
$pdf->Cell(40,5,''.$sek_kota.', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'',0,0,'C',0);
$pdf->SetY($nilY + 10);
$pdf->SetX(270);
$pdf->Cell(40,5,'Petugas',0,0,'C',0);
$pdf->SetY($nilY + 35);
$pdf->SetX(270);
$pdf->Cell(40,5,'. . . . . . . . . . . . . . . . . . . .',0,0,'C',0);




//catatan
$pdf->Ln();
$pdf->SetX(160);
$pdf->SetFont('Arial','BU',10);
$pdf->Cell(40,5,'Catatan',0,0,'C',0);
$pdf->Ln();


$nil_1 = "1. Tanda bukti ini harus dibawa dan ditunjukkan pada saat Tes Fisik dan Tes Tulis.";
$nil_2 = "2. Setelah selesai mengikuti Tes Fisik Anda harus menyerahkan berkas PPDB kepada petugas Verifikasi yaitu :";
$nil_3 = "a. Tanda Bukti Pendaftaran PPDB On Line untuk ditandatangani dan di stempel";
$nil_4 = "b. Surat keterangan tes kesehatan";
$nil_5 = "c. Ijazah asli";
$nil_6 = "d. SKHUN asli";
$nil_7 = "e. Pas foto hitam putih ukuran 3 x 4 cm sebanyak 3 lembar";
$nil_8 = "f. Sertifikat kejuaraan prestasi akademik/non akademik asli (juara I,II,III, 3 tahun terakhir) bagi yang memiliki";
$nil_9 = "g. Sertifikat kursus Bahasa Inggris asli dari lembaga kursus bagi yang memiliki";



$pdf->SetX(180);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(130,4,$nil_1,0,1,'L');
$pdf->SetX(180);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(130,4,$nil_2,0,1,'L');

$pdf->SetX(190);
$pdf->Cell(40,5,$nil_3,0,0,'L',0);
$pdf->Ln();
$pdf->SetX(190);
$pdf->Cell(40,5,$nil_4,0,0,'L',0);
$pdf->Ln();
$pdf->SetX(190);
$pdf->Cell(40,5,$nil_5,0,0,'L',0);
$pdf->Ln();
$pdf->SetX(190);
$pdf->Cell(40,5,$nil_6,0,0,'L',0);
$pdf->Ln();
$pdf->SetX(190);
$pdf->Cell(40,5,$nil_7,0,0,'L',0);
$pdf->Ln();
$pdf->SetX(190);
$pdf->Cell(40,5,$nil_8,0,0,'L',0);
$pdf->Ln();
$pdf->SetX(190);
$pdf->Cell(40,5,$nil_9,0,0,'L',0);
$pdf->Ln();






//isi
$isi = ob_get_contents();
ob_end_clean();


$pdf->WriteHTML($isi);
$nama_filenya = "tanda_bukti_$dt_noregx.pdf";
$pdf->Output("$nama_filenya",I);
?>