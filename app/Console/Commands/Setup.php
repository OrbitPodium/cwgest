<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Setup extends Command
{   

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria info inicial no ficheiro env.';

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
        $app_name = $this->ask('Nome da APP');
        $DB_HOST = $this->ask('Enter the DB_HOST', "127.0.0.1");
        $DB_DATABASE = $this->ask('Enter the DB_DATABASE');
        $DB_USERNAME = $this->ask('Enter the DB_USERNAME', "root");
        $DB_PASSWORD = $this->ask('Enter the DB_PASSWORD', " ");
        $url_app = $this->ask('URL da app (ex: http://localhost/appname');

        $this->writeNewEnvironmentFileWith('APP_NAME', $app_name);
        $this->writeNewEnvironmentFileWith('DB_HOST', $DB_HOST);
        $this->writeNewEnvironmentFileWith('DB_DATABASE', $DB_DATABASE);
        $this->writeNewEnvironmentFileWith('DB_USERNAME', $DB_USERNAME);
        $this->writeNewEnvironmentFileWith('DB_PASSWORD', $DB_PASSWORD);
        $this->writeNewEnvironmentFileWith('APP_URL', $url_app);

        $this->info(' .env atualizado');

    }

    protected function writeNewEnvironmentFileWith($key, $value)
    {
        file_put_contents($this->laravel->environmentFilePath(), 
            preg_replace("/{$key}=(.*)\n/", $key.'='.$value."\n", file_get_contents($this->laravel->environmentFilePath()))
        );
    }

}
