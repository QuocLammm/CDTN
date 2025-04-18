<?php

namespace App\Http\Controllers;

use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TyGiaController extends Controller
{
    public function index() {
        $json = file_get_contents('https://chogia.vn/get-live-price.php?k=8fgY0d9s%238g023j5lagu9%248G72935jsaf987DF2935%5EuflskaB%40j9873Y5&t=currency');

        // Nếu bạn xem nội dung $json, nó là HTML table rows
        $html = new DOMDocument();
        $html->loadHTML('<table>' . $json . '</table>');

        $xpath = new DOMXPath($html);
        $rows = $xpath->query('//tr');

        $data = [];
        foreach ($rows as $row) {
            $cells = $row->getElementsByTagName('td');
            if ($cells->length >= 3) {
                $data[] = [
                    'ngoai-te' => trim($cells->item(0)->textContent),
                    'gia-mua' => trim($cells->item(1)->textContent),
                    'gia-ban' => trim($cells->item(2)->textContent),
                ];
            }
        }

        return view('ty-gia', ['data' => $data]);
    }

}
