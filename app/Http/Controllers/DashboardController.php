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
                'harga' => $this->sparql->query('SELECT * WHERE{VALUES ?hp{handphone:'.$item['nama_handphone'].'}.?hp handphone:nilaiHarga ?harga.}'),
            ]);
        }
        $resultdashboard = [];
        foreach ($resultharga as $item){
            for ($i=0; $i <count($item['harga']); $i++) {
                array_push($resultdashboard, [
                    'nama_handphone' => $this->parseData($item['harga'][$i]->hp->getUri()),
                    'harga' => $this->parseData($item['harga'][$i]->harga->getValue())
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