<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function searching (Request $request)
    {
        $ram = $this -> sparql -> query('SELECT * WHERE{?ram a handphone:RAM}');
        $memori = $this -> sparql -> query('SELECT * WHERE{?memori a handphone:Memori}');
        $baterai = $this -> sparql -> query('SELECT * WHERE{?baterai a handphone:Baterai}');
        $kameradepan =$this->sparql->query('SELECT * WHERE{?kameradepan a handphone:KameraDepan}');
        $kamerabelakang =$this->sparql->query('SELECT * WHERE{?kamerabelakang a handphone:KameraBelakang}');
        $sistemoperasi =$this->sparql->query('SELECT * WHERE{?sistemoperasi a handphone:SistemOperasi}');
        $ukuranlayar =$this->sparql->query('SELECT * WHERE{?ukuranlayar a handphone:UkuranLayar}');

        //prosesor
        $exynos = $this->sparql->query('SELECT * WHERE{?exynos a handphone:Exynos}');
        $mediatek =$this->sparql->query('SELECT * WHERE{?mediatek a handphone:MediaTek}');
        $qualcomm = $this->sparql->query('SELECT * WHERE{?qualcomm a handphone:Qualcomm}');
        $kirin = $this->sparql->query('SELECT * WHERE{?kirin a handphone:Kirin}');


        $resultram=[];
        $resultmemori=[];
        $resultbaterai = [];
        $resultkameradepan = [];
        $resultkamerabelakang = [];
        $resultprosesor = [];
        $resultsistemoperasi = [];
        $resultukuranlayar = [];

        foreach($ram as $item){
            array_push($resultram, [
                'ram' => $this->parseData($item->ram->getUri())
            ]);
        }
        foreach ($memori as $item) {
            array_push($resultmemori, [
                'memori' => $this->parseData($item->memori->getUri())
            ]);
        }
        foreach ($baterai as $item) {
            array_push($resultbaterai, [
                'baterai' => $this->parseData($item->baterai->getUri())
            ]);
        }
        foreach ($kameradepan as $item) {
            array_push($resultkameradepan, [
                'kameradepan' => $this->parseData($item->kameradepan->getUri())
            ]);
        }
        foreach ($kamerabelakang as $item) {
            array_push($resultkamerabelakang, [
                'kamerabelakang' => $this->parseData($item->kamerabelakang->getUri())
            ]);
        }
        
        foreach ($sistemoperasi as $item) {
            array_push($resultsistemoperasi, [
                'sistemoperasi' => $this->parseData($item->sistemoperasi->getUri())
            ]);
        }
        foreach ($ukuranlayar as $item) {
            array_push($resultukuranlayar, [
                'ukuranlayar' => $this->parseData($item->ukuranlayar->getUri())
            ]);
        }

        //prosesor
        foreach ($exynos as $item) {
            array_push($resultprosesor, [
                'prosesor' => $this->parseData($item->exynos->getUri())
            ]);
        }
        foreach ($mediatek as $item) {
            array_push($resultprosesor, [
                'prosesor' => $this->parseData($item->mediatek->getUri())
            ]);
        }
        foreach ($kirin as $item) {
            array_push($resultprosesor, [
                'prosesor' => $this->parseData($item->kirin->getUri())
            ]);
        }
        foreach ($qualcomm as $item) {
            array_push($resultprosesor, [
                'prosesor' => $this->parseData($item->qualcomm->getUri())
            ]);
        }
        if ($request->has('cari_spesifikasi')) {
            $resp = 1;
            $sql = 'SELECT * WHERE {';
            $i = 0;
            if($request->cari_ram != ''){
                if ( $i == 0 ){
                    $sql = $sql . '?hp handphone:memiliki_RAM handphone:' . $request->cari_ram;
                    $i++;
                }
                else{
                    $sql = $sql . '. ?hp handphone:memiliki_RAM handphone:' . $request->cari_ram;
                }
            }
            else{
                $sql = $sql;
            }
            if ($request->cari_baterai!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memiliki_Baterai handphone:' . $request->cari_baterai;
                    $i++;
                }
                else{
                    $sql = $sql . '. ?hp handphone:memiliki_Baterai handphone:' . $request->cari_baterai;
                } 
            } 
            else {
                $sql = $sql;
            }
            if ($request->cari_kameradepan!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memiliki_KameraDepan handphone:' . $request->cari_kameradepan;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memiliki_KameraDepan handphone:' . $request->cari_kameradepan;
                }   
            } 
            else {
                $sql = $sql;
            }
            if ($request->cari_kamerabelakang!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memiliki_KameraBelakang handphone:' . $request->cari_kamerabelakang;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memiliki_KameraBelakang handphone:' . $request->cari_kamerabelakang;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cari_memori!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memiliki_Memori handphone:' . $request->cari_memori;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memiliki_Memori handphone:' . $request->cari_memori;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cari_sistemoperasi!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memiliki_SistemOperasi handphone:' . $request->cari_sistemoperasi;
                    $i++;
                } 
                else {
                    $sql = $sql . '. ?hp handphone:memiliki_SistemOperasi handphone:' . $request->cari_sistemoperasi;
                }  
            } 
            else {
                $sql = $sql;
            }
            if ($request->cari_ukuranlayar!= '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memiliki_UkuranLayar handphone:' . $request->cari_ukuranlayar;
                    $i++;
                } 
                else {
                    $sql = $sql . '?hp handphone:memiliki_UkuranLayar handphone:' . $request->cari_ukuranlayar;
                }  
                
            } 
            else {
                $sql = $sql;
            }
            if ($request->cari_prosesor != '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:memiliki_Prosesor handphone:' . $request->cari_prosesor;
                    $i++;
                } else {
                    $sql = $sql . '?hp handphone:memiliki_Prosesor handphone:' . $request->cari_prosesor;
                }
            } else {
                $sql = $sql;
            }
            if ($request->cari_harga != '') {
                if ($i == 0) {
                    $sql = $sql . '?hp handphone:nilai_Harga ?harga FILTER(?harga <' . $request->cari_harga.')';
                    $i++;
                } else {
                    $sql = $sql .'?hp handphone:nilai_Harga ?harga FILTER(?harga <' . $request->cari_harga . ')';
                }
            } else {
                $sql = $sql;
            }
            $sql = $sql . '}';
            $querydata = $this->sparql->query($sql);

            $resulthandphone = [];

            //meyimpan data nama dan id motor
            foreach ($querydata as $item) {
                array_push($resulthandphone, [
                    'nama' => $this->parseData($item->hp->getUri())
                ]);
            }
            $jumlahhandphone = count($resulthandphone);

            // $getMerek = $request->cari_merek;
            // $getTransmisi = $request->cari_transmisi;
            // $getJenis = $request->cari_typemotor;
            // $getTahun = $request->cari_tahun;
            // $getVolume = $request->cari_volume;
            // $getLokasi = '';
        }
        else{
            $resulthandphone = [];
            $jumlahhandphone = 0;
            $resp = 0;
        }
        

        $data = [
            'listram' => $resultram,
            'listmemori' => $resultmemori,
            'listbaterai' => $resultbaterai,
            'listkameradepan' => $resultkameradepan,
            'listkamerabelakang' => $resultkamerabelakang,
            'listprosesor' => $resultprosesor,
            'listsistemoperasi' => $resultsistemoperasi,
            'listukuranlayar' => $resultukuranlayar,
            'searching1' => $resulthandphone,
            'jumlahhandphone' => $jumlahhandphone,
            'resp' => $resp
        ];

        // $harga = $this->sparql->query('SELECT * WHERE {
        //     ?hp handphone:memiliki_RAM handphone:4 }');
            
        return view('pencarian', [
            'title' => 'Fitur Pencarian',
            'page' => 'pencarian', 
            'list' =>  $data
        ]);

    }

}

?>