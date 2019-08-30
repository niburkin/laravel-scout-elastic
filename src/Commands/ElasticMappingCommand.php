<?php

namespace ScoutEngines\Elasticsearch\Commands;

use Illuminate\Console\Command;


class ElasticMappingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:mapping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import elastic search models';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info("Start importing models");

        $models = config("elastic.models");

        $index = config("scout.elasticsearch.index");
        $host = config("scout.elasticsearch.hosts")[0];

        foreach ($models as $model => $mapping) {
            /** @var  $model */
            $model = new $model;


            $this->info("Model: {$model}");
            Artisan::call("scout:import", [
                "model" => $model
            ]);
        }

        $this->info("Import success");
    }
}