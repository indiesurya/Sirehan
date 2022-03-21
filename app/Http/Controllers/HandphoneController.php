<?php
namespace App\Http\Controllers;

class HandphoneController extends Controller {
    public function detail($nama_handphone)
    {
        $detail = $this->sparql->query('SELECT * WHERE
        {VALUES ?Handphone{handphone:'.$nama_handphone.'}.
            ?Handphone handphone:memilikiRAM ?RAM.
            ?Handphone handphone:memilikiBaterai ?Baterai.
            ?Handphone handphone:memilikiKameraDepan ?KameraDepan.
            ?Handphone handphone:memilikiKameraBelakang ?KameraBelakang.
            ?Handphone handphone:memilikiMemori ?Memori.
            ?Handphone handphone:memilikiProsesor ?Prosesor.
            ?Handphone handphone:memilikiSistemOperasi ?SistemOperasi.
            ?Handphone handphone:memilikiUkuranLayar ?UkuranLayar.
            ?Handphone handphone:nilaiHarga ?Harga.
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