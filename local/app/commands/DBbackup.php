<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DBbackup extends Command {

	/**   
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:backup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command for backup database.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$dbconn = require(__DIR__.'\..\config\database.php');
		$socket = $dbconn['default'];
		$dbConfig = $dbconn['connections'][$socket] ;
        $username = $dbConfig['username'];
        $password = $dbConfig['password'];
		$database = $dbConfig['database'];

		$ds = DIRECTORY_SEPARATOR;
		$path =   storage_path('backups' . $ds .'database' . $ds . date('Y') . $ds . date('m') . $ds);
		$file = date('Y-m-d') . '_mysqldump.sql';
		if (!is_dir($path)) {
            mkdir($path, 0755, true);
		}
		$fileName = $path . $file;

		$this->process = new Process(sprintf(
            'mysqldump -u%s -p%s %s > %s',
			$username,
			$password,
			$database,
            $fileName
        ));
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		try {
			$this->process->mustRun();

            $this->info('The backup has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has been failed.' . $exception);
        }
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		
		return array(
			array('dbname', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		
		return array(
			array('dbname', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
