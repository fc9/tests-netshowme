<?php

namespace Tests\Unit\App\Repositories;

use App\Repositories\ContactRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactRepositoryTest extends TestCase
{

    /** @test */
    public function check_ifUploadedFile_saveInDisk()
    {
        $file = UploadedFile::fake()->create('file.svg', 1);
        $disk = config('contact')['options']['disk'];
        Storage::fake($disk);

        $path = ContactRepository::uploadAttachment($file);

        Storage::disk($disk)->assertExists($path);
        Storage::delete($path);
        Storage::assertMissing($path);
    }

}
