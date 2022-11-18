<?php

namespace App\Console\Commands;

use App\Services\ArticleService;
use Illuminate\Console\Command;

class ImportArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:articles {?-U|--update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import data from Space Flight News Api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ArticleService $service)
    {
        $update = $this->option("update");
        $update ? $this->update($service) : $this->import($service);
    }

    private function import(ArticleService $service){
        $url = "https://api.spaceflightnewsapi.net/v3/articles?_sort=id&_limit=";
        $countUrl = "https://api.spaceflightnewsapi.net/v3/articles/count";
        $service->importApiData($url, $countUrl);
    }

    private function update(ArticleService $service){
        $url = "https://api.spaceflightnewsapi.net/v3/articles?_limit=100&id_gt=";
        $service->updateImportedApiData($url);
    }
}
