<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class TempFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'temp:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command clean temps files and temporary files';

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
    public function handle()
    {
        $path = public_path('assets/livewire-tmp');
        $files = File::files($path);

        foreach ($files as $file) {
            $yesterdayStamp = now()->subHours(12)->timestamp;

            if ($yesterdayStamp > File::lastModified($file)) {
                File::delete($path . '/' . $file->getFilename());
            }
        }
        $this->info('Temporary files have been cleared');
    }
}
