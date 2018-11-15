<?php
    /**
     * Created by PhpStorm.
     * User: allan
     * Date: 15/11/18
     * Time: 12:47
     */

    namespace App\Controllers;

    use GuzzleHttp\Client;

    class NewsController
    {
        private $client;
        private $news;
        private $total = 380;
        private $current;
        private $pageSize;

        public function __construct()
        {
            $this->client = new Client(['base_uri' => 'https://content.guardianapis.com']);
        }

        public function index(): array
        {
            $this->current  = $_GET['page'] ? $_GET['page'] : 1;
            $this->pageSize = $_GET['page-size'] ? $_GET['page-size'] : 30;
            $response       = $this->client->request('get', "/search?api-key=0d160d0f-71cd-48b0-801f-2fc9cabd2157&page-size={$this->pageSize}&page={$this->current}");
            $this->news     = json_decode($response->getBody())->response->results;

            return [
                    'news'     => $this->news,
                    'total'    => $this->total,
                    'current'  => $this->current,
                    'pageSize' => $this->pageSize
            ];
        }
    }