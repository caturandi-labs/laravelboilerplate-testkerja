<?php

use Illuminate\Support\Facades\Route;

	function set_active($uri, $output = 'active')
	{
	 if( is_array($uri) ) {
	   foreach ($uri as $u) {
	     if (Route::is($u)) {
	       return $output;
	     }
	   }
	 } else {
	   if (Route::is($uri)){
	     return $output;
	   }
	 }
	}

	function formatRupiah($nominal)
    {
        $hasil = number_format($nominal,0,',','.');
        return 'Rp.' . $hasil;	 
    }

    function tanggalIndonesia($tgl, $tampil_hari=true,$jam=true)
    {
        $nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        $nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        
        $tahun = substr($tgl,0,4);
        $bulan = $nama_bulan[(int)substr($tgl,5,2)];
        $tanggal = substr($tgl,8,2);
        
        $text = "";
        
        if($tampil_hari){
            $urutan_hari = date('w', mktime(0,0,0, substr($tgl,5,2), $tanggal, $tahun));
            $hari = $nama_hari[$urutan_hari];
            $text .= $hari.", ";
        }

        $text .= $tanggal ." ". $bulan ." ". $tahun;
        
        if($jam){
            $jam = date("H:i:s",strtotime($tgl));
            $text.=" ".$jam;
        }
        return $text;    
    }