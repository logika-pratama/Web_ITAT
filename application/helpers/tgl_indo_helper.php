<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
      
    if(!function_exists('tgl_indo'))
    {
        function tgl_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.' '.$bulan.' '.$tahun;
        }
    }
      
    if(!function_exists('bulan'))
    {
        function bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Januari";
                    break;
                case 2:
                    return "Februari";
                    break;
                case 3:
                    return "Maret";
                    break;
                case 4:
                    return "April";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Juni";
                    break;
                case 7:
                    return "Juli";
                    break;
                case 8:
                    return "Agustus";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "Oktober";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "Desember";
                    break;
            }
        }
    }
 
    if(!function_exists('shortdate_indo'))
    {
        function shortdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = short_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'/'.$bulan.'/'.$tahun;
        }
    }
      
    if(!function_exists('short_bulan'))
    {
        function short_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "01";
                    break;
                case 2:
                    return "02";
                    break;
                case 3:
                    return "03";
                    break;
                case 4:
                    return "04";
                    break;
                case 5:
                    return "05";
                    break;
                case 6:
                    return "06";
                    break;
                case 7:
                    return "07";
                    break;
                case 8:
                    return "08";
                    break;
                case 9:
                    return "09";
                    break;
                case 10:
                    return "10";
                    break;
                case 11:
                    return "11";
                    break;
                case 12:
                    return "12";
                    break;
            }
        }
    }
 
    if(!function_exists('mediumdate_indo'))
    {
        function mediumdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = medium_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'-'.$bulan.'-'.$tahun;
        }
    }
      
    if(!function_exists('medium_bulan'))
    {
        function medium_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Ags";
                    break;
                case 9:
                    return "Sep";
                    break;
                case 10:
                    return "Okt";
                    break;
                case 11:
                    return "Nov";
                    break;
                case 12:
                    return "Des";
                    break;
            }
        }
    }
     
    if(!function_exists('longdate_indo'))
    {
        function longdate_indo($tanggal)
        {
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $bln = $pecah[1];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
      
            $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
            $nama_hari = "";
            if($nama=="Sunday") {$nama_hari="Minggu";}
            else if($nama=="Monday") {$nama_hari="Senin";}
            else if($nama=="Tuesday") {$nama_hari="Selasa";}
            else if($nama=="Wednesday") {$nama_hari="Rabu";}
            else if($nama=="Thursday") {$nama_hari="Kamis";}
            else if($nama=="Friday") {$nama_hari="Jumat";}
            else if($nama=="Saturday") {$nama_hari="Sabtu";}
            return $tgl.' '.$bulan.' '.$thn;
        }
    }


    if(!function_exists('sub_kategori'))
    {
        function sub_kategori($id_kategori)
        {
           
            return $sub_kategori;
        }
    }

    if(!function_exists('fnum')){
        function fnum($number){
            return number_format((int)$number,'0','.','.');
        }
    }

    if(!function_exists('ftitik')){
        function ftitik($number){
            return str_replace('.','',$number);
        }
    }

    if(!function_exists('terbilang')){
        function penyebut($nilai) {
            $nilai = abs($nilai);
            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
            $temp = "";
            if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
            } else if ($nilai <20) {
                $temp = penyebut($nilai - 10). " belas";
            } else if ($nilai < 100) {
                $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " seratus" . penyebut($nilai - 100);
            } else if ($nilai < 1000) {
                $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " seribu" . penyebut($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
            }     
            return $temp;
        }
     
        function terbilang($nilai) {
            if($nilai<0) {
                $hasil = "minus ". trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }     		
            return $hasil.' rupiah';
        }
    }