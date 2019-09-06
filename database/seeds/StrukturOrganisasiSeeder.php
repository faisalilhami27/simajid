<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('struktur_organisasi')->insert([
            [
                'kode' => 'DKM',
                'value' => '<h4>DEWAN PENASEHAT</h4>

<ol>
	<li>Kepala Desa Sukanagara Kecamatan Sukanagara</li>
	<li>Ketua RW 01 Desa Sukangara</li>
	<li>Ketua RT Pasir Kelewih</li>
</ol>

<h4>PENGURUS UTAMA</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:300px">
	<tbody>
		<tr>
			<td>&nbsp;Ketua DKM</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Muhammad Al Fatih</td>
		</tr>
		<tr>
			<td>&nbsp;Wakil Ketua DKM</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Khalid Bin Walid</td>
		</tr>
		<tr>
			<td>&nbsp;Sekretaris 1</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Fatimah Azzahra</td>
		</tr>
		<tr>
			<td>&nbsp;Sekretaris 2</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Siti Aisyah</td>
		</tr>
		<tr>
			<td>&nbsp;Bendahara 1</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Bilal Bin Rabbah</td>
		</tr>
		<tr>
			<td>&nbsp;Bendahara 2</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Ali Bin Abi Thalib</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>BIDANG DAKWAH DAN PERIBADATAN</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:300px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Abu Bakar Ash-Shiddiq</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Sa&#39;id Bin Zaid</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp; Zubair Bin Awwam</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp; Anas Bin Malik</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp; Zaid Bin Haritsah</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>BIDANG PENDIDIKAN DAN PENGABDIAN MASYARAKAT</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:300px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Utsman Bin Affan</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp; Sa&rsquo;ad bin Abi Waqqash</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Abu &lsquo;Ubaidah bin Jarrah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Abdurrahman bin &lsquo;Auf</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Thalhah bin Ubaidillah</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>BIDANG HUMAS DAN KELEMBAGAAN</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:300px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Hamzah bin &lsquo;Abdul Muththalib</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Amr bin &lsquo;Ash</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Abdullah bin Mas&rsquo;ud</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Salman Al Farisi</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Ubay bin Ka&rsquo;ab</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>BIDANG SARPRAS</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:300px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abbas bin Abdul Muththalib</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abu Dzar Al Ghifari</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Abbad bin Bisyr</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Ammar bin Yasir</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;&nbsp;Abdullah bin Umi Maktum</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'kode' => 'remaja',
                'value' => '<h4>PENASEHAT</h4>

<ol>
	<li>Ketua DKM Mesjid Nurul Huda</li>
</ol>

<h4>PENGURUS UTAMA</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:400px">
	<tbody>
		<tr>
			<td>&nbsp;Ketua Remaja Mesjid</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abdullah bin Amr bin Ash</td>
		</tr>
		<tr>
			<td>&nbsp;Wakil Ketua Remaja Mesjid</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abdullah bin Amr bin Haram</td>
		</tr>
		<tr>
			<td>&nbsp;Sekretaris 1</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abdullah bin Hudzafah As Sahmi</td>
		</tr>
		<tr>
			<td>&nbsp;Sekretaris 2</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Arahah bin Aus</td>
		</tr>
		<tr>
			<td>&nbsp;Bendahara 1</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Al Barra bin Malik</td>
		</tr>
		<tr>
			<td>&nbsp;Bendahara 2</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Dihrar bin al Khattab</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>BIDANG PENDIDIKAN DAN DAKWAH</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:400px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Hassan bin Tsabit al Anshari</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Hasan bin Ali bin Abu Thalib</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Husain bin Ali bin Abu Thalib</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Hudzaifah bin Yaman</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Ikrimah bin Abu Jahal</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Imran bin Hishin</td>
		</tr>
	</tbody>
</table>

<h4>&nbsp;</h4>

<h4>BIDANG KESENIAN DAN OLAHRAGA</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:400px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Ka&rsquo;ab bin Malik</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Ka&rsquo;ab bin Zuhair</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Khabbab bin al Arts</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Khubaib bin Adi</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp; Khuzaimah bin Tsabit</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>BIDANG KEAMANAN</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:400px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Miqdad bin al Aswad</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Muawiyah bin Abu Sufyan</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Muadz bin Jabal</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Mundzir bin Amr</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Nu&rsquo;aim bin Mas&rsquo;ud</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'kode' => 'majelis',
                'value' => '<h4>DEWAN PENASEHAT</h4>

<ol>
	<li>Kepala Desa Sukanagara Kecamatan Sukanagara</li>
	<li>Ketua RW 01 Desa Sukangara</li>
	<li>Ketua RT Pasir Kelewih</li>
</ol>

<h4>DEWAN PEMBINA</h4>

<ol>
	<li class="pembina">Ketua DKM Mesjid Nurul Huda</li>
</ol>

<h4>PENGURUS UTAMA</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:400px">
	<tbody>
		<tr>
			<td>&nbsp;Ketua Majelis Taklim</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abu Sa&rsquo;id Al Khudri</td>
		</tr>
		<tr>
			<td>&nbsp;Wakil Ketua Majelis Taklim</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abu Darda&rsquo;</td>
		</tr>
		<tr>
			<td>&nbsp;Sekretaris 1</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abdurrahman bin Abu Bakar</td>
		</tr>
		<tr>
			<td>&nbsp;Sekretaris 2</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Imran bin Hushain</td>
		</tr>
		<tr>
			<td>&nbsp;Bendahara 1</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Hudzaifah bin Yaman</td>
		</tr>
		<tr>
			<td>&nbsp;Bendahara 2</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abu Musa Al Asy&rsquo;ari</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>SEKSI TAHLIL</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Al Barra&rsquo; bin Malik</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abdullah ibnu Rawahah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Abdullah ibnu &lsquo;Umar</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Abdulah bin Abbas</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Abdullah ibnu Zubair</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>SEKSI DAKWAH</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Abdullah bin Amr bin Ash</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Muadz bin Jabal</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Jabir bin Abdillah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Khadijah binti Khuwailid</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Saudah binti Zam&rsquo;ah</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>SEKSI PHBI (Peringatan Hari Besar Islam)</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Zainab binti Khuzaimah</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Hafshah binti &lsquo;Umar</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Ummu Salamah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Zainab binti Jahsyi</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Juwairiyah binti Harits</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Shafiyyah binti Huyaiy</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h4>SEKSI PERLENGKAPAN</h4>

<table border="0" cellpadding="1" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td>&nbsp;Koordinator</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Ummu Aiman</td>
		</tr>
		<tr>
			<td>&nbsp;Anggota</td>
			<td style="text-align:center">:</td>
			<td>&nbsp;&nbsp;Tsuwaibah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Halimah As Sa&rsquo;diyah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Ruqayyah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;Ibrahim</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
