<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearProductImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete product images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = 'public/images/products';

        if (Storage::exists($directory)) {
            Storage::deleteDirectory($directory);

            echo "Directory have been deleted.";
        } else {
            echo "The directory does not exist.";
        }
    }
}
