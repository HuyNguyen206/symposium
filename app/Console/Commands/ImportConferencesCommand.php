<?php

namespace App\Console\Commands;

use App\Models\Conference;
use App\Services\CallingAllPaper;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ImportConferencesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cfp:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(private CallingAllPaper $allPaper)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->allPaper->conferences()['cfps'] as $conference) {
            $this->updateOrCreateConferences($conference);
        }
    }

    public function updateOrCreateConferences(mixed $conference)
    {
        Conference::updateOrCreate([
            'callingallpaper_id' => Arr::get($conference, '_rel.cfp_uri'),
        ], [
            'title' => Arr::get($conference, 'name'),
            'location' => Arr::get($conference, 'location'),
            'description' => Arr::get($conference, 'description'),
            'url' => Arr::get($conference, 'uri'),
            'starts_at' => Arr::get($conference, 'dateEventStart'),
            'ends_at' => Arr::get($conference, 'dateEventEnd'),
            'cfp_starts_at' => Arr::get($conference, 'dateCfpStart'),
            'cfp_ends_at' => Arr::get($conference, 'dateCfpEnd'),
        ]);
    }
}
