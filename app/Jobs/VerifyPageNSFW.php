<?php

namespace App\Jobs;

use App\Services\NSFWVerificationService;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;

class VerifyPageNSFW implements ShouldQueue
{
    use Queueable, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $filePath,
        public string $documentName
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(NSFWVerificationService $nsfw): void
    {
        if ($this->batch()->cancelled()) {
            return;
        }

        // Check if the file is a PDF.
        // If yes, extract the images from the PDF.
        // Add every page to the batch as a new job.
        // Otherwise, just verify the file with isSafe
        // If found unsafe, cancel the batch and add Remark to the application.

        if (pathinfo($this->filePath, PATHINFO_EXTENSION) === 'pdf') {
            $pdf = new Pdf($this->filePath);
            $tempDir = storage_path('app/public/pdf-pages/'.date('Ymd-His').'-'.Str::slug($this->documentName));
            mkdir($tempDir, 0755, true);
            $pdf->saveAllPages($tempDir);

            $pages = glob($tempDir.'/*.jpg');
            Log::info('Found ' . count($pages) . ' pages in ' . $this->documentName);
            Log::info('Temp dir: ' . $tempDir);
            foreach ($pages as $page) {
                $this->batch()->add([       
                    new VerifyPageNSFW( 
                        $page,
                        $this->documentName
                    )
                ]);
            }
        } else {
            $isSafe = $nsfw->isSafe($this->filePath);
            if (!$isSafe) {
                $this->batch()->cancel();                
            }
        }
    }

    public function middleware(): array
    {
        return [
            (new RateLimited('nsfw'))->releaseAfter(10),
            new ThrottlesExceptions(10, 60),
        ];
    }
}
