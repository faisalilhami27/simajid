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
                'value' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'kode' => 'majelis',
                'value' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
