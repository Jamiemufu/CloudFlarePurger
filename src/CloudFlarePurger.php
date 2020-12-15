<?php

namespace CloudFlarePurger;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CloudFlarePurger
{

    protected string $token;
    protected string $zoneId;
    private string $baseUrl = 'https://api.cloudflare.com/client/v4/';
    private string $verifyUrl = 'user/tokens/verify';
    private string $purgeUrl;
    private Object $client;

    /**
     * Instantiate a new Guzzle client with Auth header set
     *
     * @param string $token
     * @param string $zoneId
     */
    public function __construct(string $token, string $zoneId)
    {
        $this->token = $token;
        $this->zoneId = $zoneId;
        $this->client = new Client([
            'headers' => [
                'Authorization' => 'Bearer '.$this->token
            ]
        ]);
        $this->purgeUrl = $this->baseUrl . 'zones/' . $this->zoneId . '/purge_cache';
    }

    /**
     * Verify correct Token
     *
     * @return Object
     * @throws GuzzleException
     */
    public function verifyToken():Object
    {
        $response = $this->client->request('GET', $this->baseUrl . $this->verifyUrl);

        return $response->getBody();
    }

    /**
     * Purge Everything
     *
     * @return Object
     * @throws GuzzleException
     */
    public function purgeAll():Object
    {
        $json = json_encode(['purge_everything' => true]);

        $response = $this->client->request('POST', $this->purgeUrl, [
            'body' => $json,
        ]);

        return $response->getBody();
    }

    /**
     * Purge specific page urls
     *
     * @param array $urls
     * @return Object
     * @throws GuzzleException
     */
    public function purgeUrls(array $urls):Object
    {
        $arr = array();
        //build body to post
        //contains file (url) and url
        foreach($urls as $url)
        {
            $arr['files'][] = $url;
            $arr['files'][] = ['url' => $url];
        }

        $json = json_encode($arr);

        $response = $this->client->request('POST', $this->purgeUrl, [
            'body' => $json
        ]);

        return $response->getBody();
    }

    /**
     * Purge prefixes (easier and faster than URL's)
     * (https://api.cloudflare.com/#zone-purge-files-by-cache-tags,-host-or-prefix)
     * ENTERPRISE ONLY
     *
     * @param array $prefixes
     * @return Object
     * @throws GuzzleException
     */
    public function purgePrefixes(array $prefixes):Object
    {
        $arr = array();

        foreach($prefixes as $prefix) {
            $arr['prefixes'] = $prefix;
        }

        $json = json_encode($arr);

        $response = $this->client->request('POST', $this->purgeUrl, [
            'body' => $json
        ]);

        return $response->getBody();

    }

}
