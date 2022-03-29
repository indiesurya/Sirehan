<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjelajahanController extends Controller
{
    public function browsing(Request $request)
    {
        $merek = $this->sparql->query('SELECT * WHERE{?hp a handphone:Merek}');
        $result = [];
        foreach ($merek as $item) {
            array_push($result, [
                'merek' => str_replace('_', ' ', $this->parseData($item->hp->getUri())),
            ]);
        }
        $resultmerek = [];
        $resp = 0;
        if (isset($_GET['browsing'])) {
            $resp++;
            if ($request->browse != '') {
                $querydata = $this->sparql->query('SELECT * WHERE {?hp handphone:memilikiMerek handphone:' . $request->browse . '}');
                
                foreach ($querydata as $item) {
                    array_push($resultmerek, [
                        'browse' => $this->parseData($item->hp->getUri())
                    ]);
                }
            }
            else{
                $resultmerek = [];
                $jumlahbrowse = 0;
            }
        } else if (isset($_GET['reset'])) {
            header('Location: /penjelajahan');
            $resultmerek = [];
            $resp = 0;
        }
        $jumlahbrowse = count($resultmerek);
        $data = [
            'merek' => $result,
            'result' => $resultmerek,
            'resp' => $resp,
            'jumlahbrowse' => $jumlahbrowse
        ];

        return view('penjelajahan', [
            'title' => 'Fitur Penjelajahan',
            'page' => 'penjelajahan',
            'data' => $data
        ]);
    }   
}
?>
