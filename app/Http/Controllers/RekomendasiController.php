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
            //INPUTAN USER
            $kriteriaKenyamanan = $this->getKenyamanan($request->cariUkuranLayar);
            $kriteriaBudget = $this->getBudget($request->cariHarga);
            $kriteriaAplikasi = $this->getAplikasi($request->cariAplikasi);
            $kriteriaFotografi1 = $this->getFotografi1($request->cariKamera);
            $kriteriaFotografi2 = $this->getFotografi2($request->cariKamera);
            $kriteriaTravelling = $this->getTravelling($request->cariBaterai);
            $bobotUser = $this->getBobotUser($request->bobotKamera, $request->bobotHarga, $request->bobotUl, $request->bobotBaterai, $request->bobotAplikasi);
            //END INPUTAN USER
            
            //PROSES PENCARIAN HANDPHONE
            $spesifikasiAplikasi = $this->spesifikasiAplikasi($kriteriaAplikasi);
            $resultHandphone =$this->namaHandphone($spesifikasiAplikasi, $kriteriaKenyamanan, $kriteriaBudget, $kriteriaFotografi1, $kriteriaFotografi2, $kriteriaTravelling);
            $jumlahCari = count($resultHandphone);
            //END PROSES PENCARIAN HANDPHONE

            if($jumlahCari == 0)
            {
                $resultSpesifikasi = [];
                $resultBobot = [];
                $resultKriteria = [];
                $resultNormalisasi = [];
                $resultRanking = [];
                $resultSAW =[];
            }
            else 
            {
                $resultSpesifikasi = $this->getSpesifikasi($resultHandphone);
                $resultBobot = $this->getBobot($resultSpesifikasi);
                $resultKriteria = $this->getKriteria();
                $resultNormalisasi = $this->getNormalisasi($resultBobot, $resultKriteria);
                $resultRanking = $this->getHasil($resultNormalisasi, $resultKriteria, $bobotUser);
                $resultSAW = $this->getRanking($resultRanking);
            }
        }
        else
        {
            $kriteriaKenyamanan = [];
            $resultHandphone = [];
            $resultSpesifikasi = [];
            $resultBobot = [];
            $resultKriteria = [];
            $resultNormalisasi = [];
            $resultRanking = [];
            $resultSAW = [];
            $jumlahCari = 0;
            $resp = 0;
            $spesifikasiAplikasi = [];
        }

        $rowAplikasi = $this->showAplikasi();

        $data = [
            'resp' => $resp,
            'kriteriaKenyamanan' =>$kriteriaKenyamanan,
            'jumlahCari' => $jumlahCari,
            'resulthandphone' => $resultHandphone,
            'resultspesifikasi' => $resultSpesifikasi,
            // 'tampildata' => $resultdata,
            'resultbobot' => $resultBobot,
            'resultkriteria' => $resultKriteria,
            'resultnormalisasi' => $resultNormalisasi,
            'resultranking' => $resultRanking,
            'resultSAW' => $resultSAW,
            'rowAplikasi' => $rowAplikasi,
            'spesifikasiAplikasi' => $spesifikasiAplikasi
        ];

        return view('rekomendasi', [
            'title' => 'Fitur Rekomendasi',
            'page' => 'rekomendasi',
            'data' => $data
        ]);
    }

    public function getKenyamanan($kriteria)
    {
        if ($kriteria != '') 
        {
            if ($kriteria == 'besar') 
            {
                $query = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiUkuranLayar ?ul FILTER( ?ul > 8 )}');
            } 
            else if ($kriteria == 'sedang') 
            {
                $query = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiUkuranLayar ?ul FILTER( ?ul > 6.5 && ?ul < 8 )}');
            } 
            else 
            {
                $query = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiUkuranLayar ?ul FILTER( ?ul < 6.5 )}');
            }
        } 
        else 
        {
            $query = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiUkuranLayar ?ul FILTER( ?ul > 0 )}');
        }
        $result1 = [];

        foreach ($query as $item) {
            array_push($result1, [
                'nama' => $this->parseData($item->hp->getUri()),
                'ul' => $this->parseData($item->ul->getValue())
            ]);
        }

        $result2 = [];
        foreach ($result1 as $item) {
            array_push($result2, [
                'data' => $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiUkuranLayar handphone:' . $item['nama'] . '}')
            ]);
        }

        $rowResult = [];
        foreach ($result2 as $item) {
            $total = count($item['data']);
            for ($i = 0; $i < $total; $i++) {
                array_push($rowResult, [
                    'nama' => $this->parseData($item['data'][$i]->hp->getUri())
                ]);
            }
        }

        return $rowResult;
    }

    public function getBudget($kriteria)
    {
        if ($kriteria != '') 
        {
            $harga = $kriteria;
        } 
        else 
        {
            $harga = 9999999999;
        }

        $query = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiHarga ?harga FILTER(?harga < '.$harga.')}');

        $rowResult = [];
        foreach($query as $item)
        {
            array_push($rowResult,[
                'nama' => $this->parseData($item->hp->getUri())
            ]);
        }

        return $rowResult;
    }

    public function getAplikasi($kriteria)
    {
        if ($kriteria != '') {
            $aplikasi = $kriteria;
            $rowapp = [];
            foreach ($aplikasi as $item) {
                array_push($rowapp, [
                    'req' => $this->sparql->query('SELECT * WHERE{VALUES ?app {handphone:' . $item . '}.
                            ?app handphone:minRAM ?minRAM.
                            ?app handphone:minMemori ?minMemori.
                            ?app handphone:minProsesor ?minProsesor.
                            ?app handphone:minSistemOperasi ?minOS.
                        }')
                ]);
            }

            $minreq = [];
            foreach ($rowapp as $item) {
                array_push($minreq, [
                    'minRAM' => $this->parseData($item['req'][0]->minRAM->getValue()),
                    'minMemori' => $this->parseData($item['req'][0]->minMemori->getValue()),
                    'minOS' => $this->parseData($item['req'][0]->minOS->getValue()),
                    'minProsesor' => $this->parseData($item['req'][0]->minProsesor->getValue())
                ]);
            }
            $sumMemori = 0;
            for ($i = 0; $i < count($minreq); $i++) {
                $sumMemori = $sumMemori + $minreq[$i]['minMemori'];
            }

            $minrequirement = max($minreq);
            array_push($minrequirement, [
                'sumMemori' => $sumMemori
            ]);
        } 
        else {
            $minreq = [];
            $minrequirement = [
                'minRAM' => 0,
                'minMemori' => 0,
                'minOS' => 0,
                'minProsesor' => 0
            ];

            array_push($minrequirement, [
                'sumMemori' => 0
            ]);
        }

        return $minrequirement;
    }

    public function getFotografi1($kriteria)
    {
        if ($kriteria == '') 
        {
            $querykb = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiKameraBelakang ?kb FILTER(?kb > 0)}');
        } 
        else if ($kriteria == '1') 
        {
            $querykb = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiKameraBelakang ?kb FILTER(?kb > 15)}');
        } 
        else 
        {
            $querykb = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiKameraBelakang ?kb FILTER(?kb < 15)}');
        }
        $kb = [];
        foreach ($querykb as $item) {
            array_push($kb, [
                'kb' => $this->parseData($item->hp->getUri())
            ]);
        }

        $resultquerykb = [];
        foreach ($kb as $item) {
            array_push($resultquerykb, [
                'nama' => $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiKameraBelakang handphone:' . $item['kb'] . '}')
            ]);
        }

        $resultkb = [];

        for ($i = 0; $i < count($resultquerykb); $i++) 
        {
            for ($j = 0; $j < count($resultquerykb[$i]['nama']); $j++) 
            {
                array_push($resultkb, [
                    'nama' => $this->parseData($resultquerykb[$i]['nama'][$j]->hp->getUri())
                ]);
            }
        }
        
        return $resultkb;
    }

    public function getFotografi2($kriteria)
    {
        if ($kriteria == '') {
            $querykd = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiKameraDepan ?kd FILTER(?kd > 0)}');
        } else if ($kriteria == '1') {
            $querykd = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiKameraDepan ?kd FILTER(?kd > 10)}');
        } else {
            $querykd = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiKameraDepan ?kd FILTER(?kd < 10)}');
        }
        $kd = [];

        foreach ($querykd as $item) {
            array_push($kd, [
                'kd' => $this->parseData($item->hp->getUri())
            ]);
        }

        $resultquerykd = [];
        foreach ($kd as $item) {
            array_push($resultquerykd, [
                'nama' => $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiKameraDepan handphone:' . $item['kd'] . '}')
            ]);
        }

        $resultkd = [];

        for ($i = 0; $i < count($resultquerykd); $i++) {
            for ($j = 0; $j < count($resultquerykd[$i]['nama']); $j++) {
                array_push($resultkd, [
                    'nama' => $this->parseData($resultquerykd[$i]['nama'][$j]->hp->getUri())
                ]);
            }
        }

        return $resultkd;
    }

    public function getTravelling($kriteria)
    {
        if ($kriteria != '') {
            $lamaAktivitas = $kriteria;

            $query = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiDayaTahan ?dayaTahan FILTER (?dayaTahan > ' . $lamaAktivitas . ')}');
        } else {
            $query = $this->sparql->query('SELECT * WHERE {?hp handphone:nilaiDayaTahan ?dayaTahan FILTER (?dayaTahan > 0)}');
        }

        $resultBaterai = [];
        foreach ($query as $item) {
            array_push($resultBaterai, [
                'nama' => $this->parseData($item->hp->getUri())
            ]);
        }

        return $resultBaterai;
    }

    public function getBobotUser($kamera, $harga, $ul, $baterai, $aplikasi)
    {
        $bobotUser = [];
        if ($kamera) {
            array_push($bobotUser, [
                'Kamera_Belakang' => $kamera
            ]);
        } else {
            array_push($bobotUser, [
                'Kamera_Belakang' => 1
            ]);
        }
        if ($harga) {
            array_push($bobotUser, [
                'Harga' => $harga
            ]);
        } else {
            array_push($bobotUser, [
                'Harga' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'Memori' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'Memori' => 1
            ]);
        }
        if ($kamera) {
            array_push($bobotUser, [
                'Kamera_Depan' => $kamera
            ]);
        } else {
            array_push($bobotUser, [
                'Kamera_Depan' => 1
            ]);
        }
        if ($ul) {
            array_push($bobotUser, [
                'Ukuran_Layar' => $ul
            ]);
        } else {
            array_push($bobotUser, [
                'Ukuran_Layar' => 1
            ]);
        }
        if ($baterai) {
            array_push($bobotUser, [
                'Baterai' => $baterai
            ]);
        } else {
            array_push($bobotUser, [
                'Baterai' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'Prosesor' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'Prosesor' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'RAM' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'RAM' => 1
            ]);
        }
        if ($aplikasi) {
            array_push($bobotUser, [
                'Sistem_Operasi' => $aplikasi
            ]);
        } else {
            array_push($bobotUser, [
                'Sistem_Operasi' => 1
            ]);
        }

        return $bobotUser;
    }

    public function showAplikasi()
    {
        $resultquery=[];
        $resultsql = $this->sparql->query('SELECT * WHERE {?app a handphone:Aplikasi}');
        foreach($resultsql as $item){
            array_push($resultquery,[
                'aplikasi' => $this->parseData($item->app->getUri())
            ]);
        }

        return $resultquery;
    }

    public function spesifikasiAplikasi ($minRequirement)
    {
        $ram = $this->sparql->query('SELECT * WHERE {?ram handphone:nilaiRAM ?nilairam FILTER(?nilairam >= '.$minRequirement['minRAM'].')}');
        $prosesor = $this->sparql->query('SELECT * WHERE {?Prosesor handphone:nilaiProsesor ?nilaiProsesor FILTER(?nilaiProsesor >= ' . $minRequirement['minProsesor'] . ')}');
        $memori = $this->sparql->query('SELECT * WHERE {?Memori handphone:nilaiMemori ?nilaiMemori FILTER(?nilaiMemori >= ' . $minRequirement[0]['sumMemori'] . ')}');
        $os = $this->sparql->query('SELECT * WHERE {?OS handphone:nilaiSistemOperasi ?nilaiOS FILTER(?nilaiOS >= ' . $minRequirement['minOS'] . ')}');
        
        $uriRAM = [];
        foreach($ram as $item){
            array_push($uriRAM, [
                'RAM' => $this->parseData($item->ram->getUri())
            ]);
        }
        $uriProsesor = [];
        foreach ($prosesor as $item) {
            array_push($uriProsesor, [
                'Prosesor' => $this->parseData($item->Prosesor->getUri())
            ]);
        }
        $uriMemori = [];
        foreach ($memori as $item) {
            array_push($uriMemori, [
                'Memori' => $this->parseData($item->Memori->getUri())
            ]);
        }
        $uriOS = [];
        foreach ($os as $item) {
            array_push($uriOS, [
                'OS' => $this->parseData($item->OS->getUri())
            ]);
        }
        
        $minreq = [
            'minRAM' => $uriRAM,
            'minProsesor' => $uriProsesor,
            'minMemori' => $uriMemori,
            'minOS' => $uriOS
        ];
        
        //Handphone berdasarkan RAM
        $tempRAM = [];
        $x=0;
        foreach ($minreq['minRAM'] as $item) {
            array_push($tempRAM, [
                'ram' => $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiRAM handphone:'.$item['RAM'].'}'),
                'nram' => $item['RAM']
            ]);
        $x++;
        }
        $resultRAM=[];
        for ($i=0; $i <count($tempRAM) ; $i++) { 
            for ($j=0; $j <count($tempRAM[$i]['ram']) ; $j++) { 
                array_push($resultRAM,[
                    'nama'=>$this->parseData($tempRAM[$i]['ram'][$j]->hp->getUri())
                ]);
            }
        }
        //END

        //Handphone berdasarkan Prosesor
        $tempProsesor = [];
        $x = 0;
        foreach ($minreq['minProsesor'] as $item) {
            array_push($tempProsesor, [
                'Prosesor' => $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiProsesor handphone:' . $item['Prosesor'] . '}')
            ]);
            $x++;
        }
        $resultProsesor = [];
        for ($i = 0; $i < count($tempProsesor); $i++) {
            for ($j = 0; $j < count($tempProsesor[$i]['Prosesor']); $j++) {
                array_push($resultProsesor, [
                    'nama' => $this->parseData($tempProsesor[$i]['Prosesor'][$j]->hp->getUri())
                ]);
            }
        }
        //END

        //Handphone Berdasarkan Memori
        $tempMemori = [];
        $x = 0;
        foreach ($minreq['minMemori'] as $item) {
            array_push($tempMemori, [
                'Memori' => $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiMemori handphone:' . $item['Memori'] . '}')
            ]);
            $x++;
        }
        $resultMemori = [];
        for ($i = 0; $i < count($tempMemori); $i++) {
            for ($j = 0; $j < count($tempMemori[$i]['Memori']); $j++) {
                array_push($resultMemori, [
                    'nama' => $this->parseData($tempMemori[$i]['Memori'][$j]->hp->getUri())
                ]);
            }
        }
        //END

        //Handphone berdasarkan OS
        $tempOS = [];
        $x = 0;
        foreach ($minreq['minOS'] as $item) {
            array_push($tempOS, [
                'OS' => $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiSistemOperasi handphone:' . $item['OS'] . '}')
            ]);
            $x++;
        }
        $resultOS = [];
        for ($i = 0; $i < count($tempOS); $i++) {
            for ($j = 0; $j < count($tempOS[$i]['OS']); $j++) {
                array_push($resultOS, [
                    'nama' => $this->parseData($tempOS[$i]['OS'][$j]->hp->getUri())
                ]);
            }
        }
        //END

        $resultAplikasi = [
            'RAM' => $resultRAM,
            'OS' => $resultOS,
            'Memori' => $resultMemori,
            'Prosesor' => $resultProsesor 
        ];
        
        return $resultAplikasi;
    }

    public function namaHandphone($minAplikasi, $minUkuranLayar, $minBudget, $minKameraBelakang, $minKameraDepan, $minBaterai)
    {
        $namaAplikasi = [];
        foreach($minAplikasi['RAM'] as $item){
            array_push($namaAplikasi,[
                strval($item['nama'])
            ]);
        }
        foreach ($minAplikasi['Prosesor'] as $item) {
            array_push($namaAplikasi, [
                strval($item['nama'])
            ]);
        }
        foreach ($minAplikasi['Memori'] as $item) {
            array_push($namaAplikasi, [
                strval($item['nama'])
            ]);
        }
        foreach ($minAplikasi['OS'] as $item) {
            array_push($namaAplikasi, [
                strval($item['nama'])
            ]);
        }
        foreach ($minUkuranLayar as $item) {
            array_push($namaAplikasi, [
                strval($item['nama'])
            ]);
        }
        foreach ($minKameraBelakang as $item){
            array_push($namaAplikasi, [
                strval($item['nama'])
            ]);
        }
        foreach ($minBudget as $item) {
            array_push($namaAplikasi, [
                strval($item['nama'])
            ]);
        }
        foreach ($minKameraDepan as $item){
            array_push($namaAplikasi,[
                strval($item['nama'])
            ]);
        }
        foreach($minBaterai as $item){
            array_push($namaAplikasi,[
                strval($item['nama'])
            ]);
        }
        for($i=0;$i<1;$i++){
            for ($j = 0; $j < count($namaAplikasi); $j++) {
                $namaAplikasi[$j] = $this->parseData($namaAplikasi[$j][0]);
            }
        }

        $duplicates = array_count_values($namaAplikasi);
        
        $resultdata=[];
        $x=0;
        foreach($duplicates as $item){
            if($item == 9){
                array_push($resultdata,[
                    'nama' => $namaAplikasi[$x]
                ]);
            }
        $x++;
        }
        return $resultdata;
    }
    
    public function getSpesifikasi($data)
    {
        $queryData = [];
        $jumlahData = count($data);
        for ($x = 0; $x < $jumlahData; $x++) {
            array_push($queryData, [
                'data' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $data[$x]['nama'] . '}
                .?hp handphone:memilikiBaterai ?baterai 
                .?hp handphone:nilaiDayaTahan ?nilaibaterai
                .?hp handphone:nilaiHarga ?harga
                .?hp handphone:memilikiRAM ?ram 
                .?hp handphone:memilikiMemori ?memori 
                .?hp handphone:memilikiKameraDepan ?kd 
                .?hp handphone:memilikiKameraBelakang ?kb 
                .?hp handphone:memilikiSistemOperasi ?so 
                .?hp handphone:memilikiProsesor ?prosesor 
                .?hp handphone:memilikiUkuranLayar ?ul 
            } ')
            ]);
        }
        $resultData = [];
        foreach ($queryData as $item) {
            array_push($resultData, [
                'nama' => $this->parseData($item['data'][0]->hp->getUri()),
                'harga' => $this->parseData($item['data'][0]->harga->getValue()),
                'ukuranlayar' => $this->parseData($item['data'][0]->ul->getUri()),
                'ram' => $this->parseData($item['data'][0]->ram->getUri()),
                'kb' => $this->parseData($item['data'][0]->kb->getUri()),
                'baterai' => $this->parseData($item['data'][0]->baterai->getUri()),
                'nbaterai' => $this->parseData($item['data'][0]->nilaibaterai->getValue()),
                'memori' => $this->parseData($item['data'][0]->memori->getUri()),
                'kd' => $this->parseData($item['data'][0]->kd->getUri()),
                'prosesor' => $this->parseData($item['data'][0]->prosesor->getUri()),
                'so' => $this->parseData($item['data'][0]->so->getUri()),

            ]);
        }

        return $resultData;
    }

    public function getKriteria ()
    {
        $resultQuery = [];
        $query = $this->sparql->query('SELECT * WHERE {?hp a handphone:Kriteria}');

        foreach($query as $item){
            array_push($resultQuery, [
                'kriteria' =>$this->parseData($item->hp->getUri()) 
            ]);
        }

        return $resultQuery;
    }

    public function getBobot ($bobot)
    {
        $queryNilai = [];
        $jumlahData = count($bobot);
        for ($x = 0; $x < $jumlahData; $x++) {
            array_push($queryNilai, [
                // 'nilaiprosesor' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $resultdata[$x]['prosesor'] . '}.?hp handphone:nilai_Prosesor ?prosesor}')
                'nilaiprosesor' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['prosesor'].'}.?hp handphone:nilaiProsesor ?prosesor}'),
                'nilairam' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['ram'] . '}.?hp handphone:nilaiRAM ?ram}'),
                'nilaiukuranlayar' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['ukuranlayar'] . '}.?hp handphone:nilaiUkuranLayar ?ul}'),
                'nilaikb' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['kb'] . '}.?hp handphone:nilaiKameraBelakang ?kb}'),
                'nilaibaterai' => $bobot[$x]['nbaterai'],
                'nilaimemori' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['memori'] . '}.?hp handphone:nilaiMemori ?memori}'),
                'nilaikd' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['kd'] . '}.?hp handphone:nilaiKameraDepan ?kd}'),
                'nilaiso' => $this->sparql->query('SELECT * WHERE {VALUES ?hp {handphone:' . $bobot[$x]['so'] . '}.?hp handphone:nilaiSistemOperasi ?so}'),
                'nilaiharga' => $bobot[$x]['harga'],
                'nama' => $bobot[$x]['nama']
            ]);
        }

        $nilai = [];
        foreach ($queryNilai as $item) {
            array_push($nilai, [
                'Prosesor' => $this->parseData($item['nilaiprosesor'][0]->prosesor->getValue()),
                'RAM' => $this->parseData($item['nilairam'][0]->ram->getValue()),
                'Ukuran_Layar' => $this->parseData($item['nilaiukuranlayar'][0]->ul->getValue()),
                'Kamera_Belakang' => $this->parseData($item['nilaikb'][0]->kb->getValue()),
                'Baterai' => $item['nilaibaterai'],
                'Memori' => $this->parseData($item['nilaimemori'][0]->memori->getValue()),
                'Kamera_Depan' => $this->parseData($item['nilaikd'][0]->kd->getValue()),
                'Sistem_Operasi' => $this->parseData($item['nilaiso'][0]->so->getValue()),
                'Harga' => $item['nilaiharga'],
                'nama' => $item['nama']
            ]);
        }

        return $nilai;
    }

    public function getNormalisasi($data, $kriteria)
    {
        $jumlahData = count($data);

        //inisialisasi array masing-masing nilai
        for($i=0;$i<count($kriteria);$i++)
        {
            for($j=0;$j<$jumlahData;$j++)
            {
                $bobot[$kriteria[$i]['kriteria']][$j] = $data[$j][$kriteria[$i]['kriteria']];
            }
        }

        //menentukan maksimum dan minimum masing-masing nilai
        for ($i = 0; $i < count($kriteria); $i++)
        {
            if($kriteria[$i]=='harga'){
                $maxMin[$kriteria[$i]['kriteria']] = min($bobot[$kriteria[$i]['kriteria']]);
            }
            else
            {
                $maxMin[$kriteria[$i]['kriteria']] = max($bobot[$kriteria[$i]['kriteria']]);
            }
        }
        
        //melakukan perhitungan minimum dan maksimum
        for ($i = 0 ; $i < count($kriteria) ; $i++)
        {
            for($j = 0 ; $j < $jumlahData ; $j++)
            {
                $normal[$j][$kriteria[$i]['kriteria']] = round($bobot[$kriteria[$i]['kriteria']][$j] / $maxMin[$kriteria[$i]['kriteria']],3);
            }
        }
        for ($i = 0; $i < $jumlahData ; $i++){
            $normal[$i]['nama'] = $data[$i]['nama']; 
        }
        return $normal;
    }

    public function getHasil($data, $kriteria, $bobotUser)
    {

        for($i=0;$i<count($kriteria);$i++)
        {
            for($j=0;$j<count($data);$j++)
            {
                $hasilKali[$j][$kriteria[$i]['kriteria']] = $data[$j][$kriteria[$i]['kriteria']] * $bobotUser[$i][$kriteria[$i]['kriteria']];
            }
        }

        $tempTotal = 0 ;
        for($i=0 ; $i<count($data) ; $i++)
        {
            for($j=0; $j<count($kriteria) ; $j++)
            {
                $tempTotal = $tempTotal + $hasilKali[$i][$kriteria[$j]['kriteria']];
            }
            $total[$i]['total'] = $tempTotal; 
            $tempTotal = 0;
        }
        for ($i = 0; $i < count($data); $i++) {
            $total[$i]['nama'] = $data[$i]['nama'];
        }

        return $total;
    }

    public function getRanking($data)
    {
        
        $hasil = [];

        //melakukan sorting dengan menggunakan bubblesort
        for ($i = 0; $i < count($data); $i++) 
        {
            for ($j = 0; $j < count($data)-1; $j++) 
            {
                if($data[$j]['total'] < $data[$j+1]['total']){

                    $tempNilai = $data[$j]['total'];
                    $data[$j]['total'] = $data[$j+1]['total'];
                    $data[$j+1]['total'] = $tempNilai;

                    $tempNama = $data[$j]['nama'];
                    $data[$j]['nama'] = $data[$j + 1]['nama'];
                    $data[$j + 1]['nama'] = $tempNama;
                }
            }
        }

        return $data;
    }
        
} 