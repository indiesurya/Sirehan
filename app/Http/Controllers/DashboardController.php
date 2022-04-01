<?php
namespace App\Http\Controllers;

class DashboardController extends Controller 
{
    public function index()
    {
        $data=$this->showCardHandphone(1000);
        $totalData=count($data);
        return view('dashboard', [
            "title" => 'Dashboard',
            "page" => "dashboard",
            "handphone" => $data,
            "count" => $totalData
        ]);
    }

    public function landingPage()
    {
        $data = $this->showCardHandphone(8);
        $totalData = count($data);
        return view('main', [
            "title" => 'SIREHAN',
            "page" => "sirehan",
            "handphone" => $data,
            "count" => $totalData
        ]);
    }

    public function showCardHandphone($limit)
    {
        $handphone = $this->sparql->query('SELECT * WHERE{?hp a handphone:Handphone .?hp handphone:nilaiHarga ?harga .?hp handphone:memilikiGambar ?gambar}ORDER BY ?hp LIMIT '.$limit.'');
        $result = [];
        foreach ($handphone as $hp) {
            array_push($result, [
                'nama_handphone' => $this->parseData($hp->hp->getUri()),
                'harga' => $this->parseData($hp->harga->getValue()),
                'gambar' => $this->parseData($hp->gambar->getValue())
            ]);
        }
        return $result;
    }

}
?>