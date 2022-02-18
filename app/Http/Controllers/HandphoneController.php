<?php
namespace App\Http\Controllers;

class HandphoneController extends Controller {
    public function detail($nama_handphone)
    {
        $detail = $this->sparql->query('SELECT * WHERE
        {VALUES ?Handphone{handphone:'.$nama_handphone.'}.
            ?Handphone handphone:memiliki_RAM ?RAM.
            ?Handphone handphone:memiliki_Baterai ?Baterai.
            ?Handphone handphone:memiliki_KameraDepan ?KameraDepan.
            ?Handphone handphone:memiliki_KameraBelakang ?KameraBelakang.
            ?Handphone handphone:memiliki_Memori ?Memori.
            ?Handphone handphone:memiliki_Prosesor ?Prosesor.
            ?Handphone handphone:memiliki_SistemOperasi ?SistemOperasi.
            ?Handphone handphone:memiliki_UkuranLayar ?UkuranLayar.
            ?Handphone handphone:nilai_Harga ?Harga.
        }');

        $result=[];
        foreach ($detail as $dtl) {
            array_push($result, [
                'nama' => str_replace('_',' ',$this->parseData($dtl->Handphone->getUri())),
                'ram' => $this->parseData($dtl->RAM->getUri()),
                'baterai' => $this->parseData($dtl->Baterai->getUri()),
                'kameradepan' => $this->parseData($dtl->KameraDepan->getUri()),
                'kamerabelakang' => $this->parseData($dtl->KameraBelakang->getUri()),
                'memori' => $this->parseData($dtl->Memori->getUri()),
                'prosesor' => str_replace('_',' ',$this->parseData($dtl->Prosesor->getUri())),
                'sistemoperasi' => str_replace('_',' ',$this->parseData($dtl->SistemOperasi->getUri())),
                'ukuranlayar' => $this->parseData($dtl->UkuranLayar->getUri()),
                'harga' => $this->parseData($dtl->Harga->getValue()),
                // 'pros' => $this->parseData($dtl->pros->getValue())
            ]);
        }
        return view('detailhandphone', [
            "title" => 'Detail Handphone',
            "page" => "detail_handphone",
            "detail" => $result
        ]);
    }
}