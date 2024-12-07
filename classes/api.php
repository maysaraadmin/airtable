<?php
namespace local_airtable;

class api {
    private $apikey;
    private $baseid;

    public function __construct() {
        $this->apikey = get_config('local_airtable', 'apikey');
        $this->baseid = get_config('local_airtable', 'baseid');
    }

    public function get_records($table) {
        $url = "https://api.airtable.com/v0/{$this->baseid}/{$table}";
        $headers = [
            "Authorization: Bearer {$this->apikey}"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function create_record($table, $fields) {
        $url = "https://api.airtable.com/v0/{$this->baseid}/{$table}";
        $headers = [
            "Authorization: Bearer {$this->apikey}",
            "Content-Type: application/json"
        ];

        $data = json_encode(['fields' => $fields]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
