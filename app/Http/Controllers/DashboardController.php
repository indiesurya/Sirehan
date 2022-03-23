<?php
namespace App\Http\Controllers;

class DashboardController extends Controller 
{
    public function index()
    {
        $handphone = $this->sparql->query('SELECT * WHERE{?hp a handphone:Handphone}');
        $result = [];
        $count=0;
        foreach($handphone as $hp){
            array_push($result, [
                'nama_handphone' => $this->parseData($hp->hp->getUri())  
            ]);
            $count=$count+1;
        }
        $resultharga = [];
        foreach ($result as $item){
            array_push($resultharga, [
                'data' => $this->sparql->query('SELECT * WHERE{VALUES ?hp{handphone:'.$item['nama_handphone'].'}.?hp handphone:nilaiHarga ?harga.?hp handphone:memilikiGambar ?gambar}'),
            ]);
        }
        $resultdashboard = [];
        foreach ($resultharga as $item){
            for ($i=0; $i <count($item['data']); $i++) {
                array_push($resultdashboard, [
                    'nama_handphone' => $this->parseData($item['data'][$i]->hp->getUri()),
                    'harga' => $this->parseData($item['data'][$i]->harga->getValue()),
                    'gambar' => $this->parseData($item['data'][$i]->gambar->getValue())
                ]);
            }
        }
        $data = [
            'handphone' => $resultdashboard
        ];
        return view('dashboard', [
                "title" => 'Dashboard',
                "page" => "dashboard",
                "handphone" => $data,
                "count" => $count
            ]);
    }
}
?>