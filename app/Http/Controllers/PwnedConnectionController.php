<?php


namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 *
 * Connect to https://api.pwnedpasswords.com/ and
 * Check if the breached happened and
 * How many times the user password has breached
 *
 */
class PwnedConnectionController extends Controller
{
    // the first 5 character used as prefix and the rest as suffix
    public function connectToPwnedApi(string $prefix, string $suffix) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.pwnedpasswords.com/range/'.$prefix,['verify' => false]);
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException("Couldn't query '$prefix'");
        }

        $hashes = explode("\r\n", $response->getBody());

        foreach($hashes as $val) {
            $h = explode(':', $val);

            if(strcasecmp($h[0],$suffix)!== 0){
                continue;
            }
            else{
                return (int)$h[1];
            }
        }
    }
}
