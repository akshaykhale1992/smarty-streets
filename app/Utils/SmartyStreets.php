<?php
namespace App\Utils;

use SmartyStreets\PhpSdk\ClientBuilder;
use SmartyStreets\PhpSdk\StaticCredentials;

class SmartyStreets
{
    private $staticCredentials;

    public function __construct()
    {
        $authId    = env('SMARTY_STREETS_AUTH_ID');
        $authToken = env('SMARTY_STREETS_AUTH_TOKEN');

        $this->staticCredentials = new StaticCredentials(
            $authId,
            $authToken
        );
    }

    public function lookupAddress($query)
    {
        $client = (new ClientBuilder($this->staticCredentials))
            ->buildUSAutocompleteApiClient();

        $lookup = new \SmartyStreets\PhpSdk\US_Autocomplete\Lookup($query);

        $client->sendLookup($lookup);

        $suggestions = [];

        foreach ($lookup->getResult() as $response) {
            $suggestions[] = [
                'text'    => $response->getText(),
                'city'    => $response->getCity(),
                'state'   => $response->getState(),
            ];
        }

        return compact('suggestions');
    }

    public function getZipCode($city, $state)
    {
        $client = (new ClientBuilder($this->staticCredentials))
            ->buildUsZIPCodeApiClient();

        $lookup = new \SmartyStreets\PhpSdk\US_ZIPCode\Lookup();
        $lookup->setCity($city);
        $lookup->setState($state);

        $client->sendLookup($lookup);

        $result         = $lookup->getResult();
        $zipCodesResult = $result->getZIPCodes();

        $zipCodes = [];

        foreach ($zipCodesResult as $zip) {
            $zipCodes[] = [
                'zipcode'   => $zip->getZIPCode(),
                'latitude'  => $zip->getLatitude(),
                'longitude' => $zip->getLongitude(),
            ];
        }

        return compact('zipCodes');
    }
}
