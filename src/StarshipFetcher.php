<?php

class StarshipFetcher
{
    private string $apiUrl = 'https://swapi.dev/api/starships/';
    
    public function fetchAll(): array
    {
        $results = [];
        $url = $this->apiUrl;

        while ($url) {
            $response = $this->get($url);

            $data = json_decode($response, true);

            if (!isset($data['results']) || !is_array($data['results'])) {
                throw new Exception("Resposta inválida da API SWAPI.");
            }

            $results = array_merge($results, $data['results']);
            $url = $data['next'];
        }

        return $results;
    }

    private function get(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception("Erro ao acessar $url: " . curl_error($ch));
        }

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status !== 200) {
            throw new Exception("HTTP $status ao acessar $url");
        }

        return $response;
    }
}
