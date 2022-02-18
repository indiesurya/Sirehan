<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function rekomendasi(Request $request)
    {
        if($request->has('rekomendasi'))
        {
            $resp=1;
            $sql = 'SELECT * WHERE {';
            if($request->cari_ukuranlayar != '')
            {
                if($request->cari_ukuranlayar == 'besar')
                {
                    $sql = $sql . '?hp handphone:nilai_UkuranLayar ?ul FILTER( ?ul > 8 )' ;
                }
                else if ($request->cari_ukuranlayar == 'sedang')
                {
                    $sql = $sql . '?hp handphone:nilai_UkuranLayar ?ul FILTER( ?ul > 6 && ?ul < 8 )';
                }
                else 
                {
                    $sql = $sql . '?hp handphone:nilai_UkuranLayar ?ul FILTER( ?ul < 6 )';
                }
            }
            else
            {
                $sql = $sql;
            }
            $sql = $sql . '}';
            $queryfilter = $this->sparql->query($sql);
            $jumlahqueryfilter = count($queryfilter);
            $resultcari = [];

            foreach ($queryfilter as $item) {
                array_push($resultcari, [
                    'nama' => $this->parseData($item->hp->getUri()),
                    'ul' => $this->parseData($item->ul->getValue())
                ]);
            }
        }
        else
        {
            $resultcari = [];
            $jumlahcari = 0;
            $jumlahqueryfilter = 0;
            $queryfilter = [];
            $resp = 0;
        }

        $resultdata = $this->getData($resultcari);
        $jumlahcari = count($resultdata);

        $resultspesifikasi = $this -> getSpesifikasi($resultdata);

        $resultbobot = $this -> getBobot($resultspesifikasi);

        $data = [
            'resp' => $resp,
            'resultcari' =>$resultcari,
            'jumlahcari' => $jumlahcari,
            'resulthandphone' => $resultdata,
            'resultspesifikasi' => $resultspesifikasi,
            'jumlahqueryfilter' => $jumlahqueryfilter,
            // 'tampildata' => $resultdata,
            'resultbobot' => $resultbobot
        ];

        return view('rekomendasi', [
            'title' => 'Fitur Rekomendasi',
            'page' => 'rekomendasi',
            'data' => $data
        ]);
    }

    public function getData($data)
    {
        $resultquery =[];
        $x=0;
        foreach ($data as $item) {
            array_push($resultquery, [
                'data' => $this->sparql->query('SELECT * WHERE {?hp handphone:memiliki_UkuranLayar handphone:'.$data[$x]['nama'].'}')
            ]);
        $x++;
        }

        $result = [];
        foreach($resultquery as $item) {
            $total = count($item['data']);
            for($i=0;$i<$total;$i++){
                array_push($result, [
                        'nama' => $this->parseData($item['data'][$i]->hp->getUri())
                ]);
            }
        }

        return $result;
    }

    public function getSpesifikasi($data)
    {
        $querytdata = [];
        $jumlahdata = count($data);
        for ($x = 0; $x < $jumlahdata; $x++) {
            array_push($querytdata, [
                'data' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $data[$x]['nama'] . '}
                .?hp handphone:memiliki_Baterai ?baterai 
                .?hp handphone:nilai_Harga ?harga
                .?hp handphone:memiliki_RAM ?ram 
                .?hp handphone:memiliki_Memori ?memori 
                .?hp handphone:memiliki_KameraDepan ?kd 
                .?hp handphone:memiliki_KameraBelakang ?kb 
                .?hp handphone:memiliki_SistemOperasi ?so 
                .?hp handphone:memiliki_Prosesor ?prosesor 
                .?hp handphone:memiliki_UkuranLayar ?ul 
            } ')
            ]);
        }
        $resultdata = [];
        foreach ($querytdata as $item) {
            array_push($resultdata, [
                'nama' => $this->parseData($item['data'][0]->hp->getUri()),
                'harga' => $this->parseData($item['data'][0]->harga->getValue()),
                'ukuranlayar' => $this->parseData($item['data'][0]->ul->getUri()),
                'ram' => $this->parseData($item['data'][0]->ram->getUri()),
                'kb' => $this->parseData($item['data'][0]->kb->getUri()),
                'baterai' => $this->parseData($item['data'][0]->baterai->getUri()),
                'memori' => $this->parseData($item['data'][0]->memori->getUri()),
                'kd' => $this->parseData($item['data'][0]->kd->getUri()),
                'prosesor' => $this->parseData($item['data'][0]->prosesor->getUri()),
                'so' => $this->parseData($item['data'][0]->so->getUri()),

            ]);
        }

        return $resultdata;
    }

    public function getBobot ($bobot)
    {
        $querynilai = [];
        $jumlahdata = count($bobot);
        for ($x = 0; $x < $jumlahdata; $x++) {
            array_push($querynilai, [
                // 'nilaiprosesor' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $resultdata[$x]['prosesor'] . '}.?hp handphone:nilai_Prosesor ?prosesor}')
                'nilaiprosesor' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['prosesor'].'}.?hp handphone:nilai_Prosesor ?prosesor}'),
                'nilairam' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['ram'] . '}.?hp handphone:nilai_RAM ?ram}'),
                'nilaiukuranlayar' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['ukuranlayar'] . '}.?hp handphone:nilai_UkuranLayar ?ul}'),
                'nilaikb' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['kb'] . '}.?hp handphone:nilai_KameraBelakang ?kb}'),
                'nilaibaterai' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['baterai'] . '}.?hp handphone:nilai_Baterai ?baterai}'),
                'nilaimemori' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['memori'] . '}.?hp handphone:nilai_Memori ?memori}'),
                'nilaikd' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['kd'] . '}.?hp handphone:nilai_KameraDepan ?kd}'),
                'nilaiso' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['so'] . '}.?hp handphone:nilai_SistemOperasi ?so}'),
                'nilaiharga' => $bobot[$x]['harga'],
                'nama' => $bobot[$x]['nama']
            ]);
        }

        $nilai = [];
        foreach ($querynilai as $item) {
            array_push($nilai, [
                'prosesor' => $this->parseData($item['nilaiprosesor'][0]->prosesor->getValue()),
                'ram' => $this->parseData($item['nilairam'][0]->ram->getValue()),
                'ukuranlayar' => $this->parseData($item['nilaiukuranlayar'][0]->ul->getValue()),
                'kb' => $this->parseData($item['nilaikb'][0]->kb->getValue()),
                'baterai' => $this->parseData($item['nilaibaterai'][0]->baterai->getValue()),
                'memori' => $this->parseData($item['nilaimemori'][0]->memori->getValue()),
                'kd' => $this->parseData($item['nilaikd'][0]->kd->getValue()),
                'so' => $this->parseData($item['nilaiso'][0]->so->getValue()),
                'harga' => $item['nilaiharga'],
                'nama' => $item['nama']
            ]);
        }

        return $nilai;
    }
} 