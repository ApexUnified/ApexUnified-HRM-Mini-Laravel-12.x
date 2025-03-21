<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearPayslipPdfFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-files-created-for-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path =  public_path("assets/pdfs");
        info($path);
        if (File::exists($path)) {
            File::cleanDirectory($path);
            info("All files in '$path' have been deleted.");
        } else {
            $created =   File::makeDirectory($path, 0777, true, true);
            info("Directory '$path' does not exist." . "And" . $created ? "Directory Created" : "Directory Not Created");
        }
    }
}
