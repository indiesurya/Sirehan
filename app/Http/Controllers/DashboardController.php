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
                    'nama_handphone' => str_replace('_',' ',$this->parseData($hp->hp->getUri())),  
            ]);
            $count=$count+1;
        }
        $data = [
            'handphone' => $result
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