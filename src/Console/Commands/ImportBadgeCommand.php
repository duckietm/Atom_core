<?php

namespace Atom\Core\Console\Commands;

use Atom\Core\Models\Badge;
use Illuminate\Console\Command;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Prompts\Progress;

use function Laravel\Prompts\progress;

class ImportBadgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atom:import-badges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command to import badges directly from the distrubutor.';

    /**
     * The request instance.
     */
    protected PendingRequest $service;

    /**
     * The base URL to fetch the badges from.
     */
    protected string $baseUrl = 'https://www.habbo.com';

    /**
     * The headers to send with the request.
     */
    protected array $headers = [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
    ];

    /**
     * The endpoint to fetch the badges from.
     */
    protected string $endpoint = '/gamedata/external_flash_texts/0';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->service = Http::baseUrl($this->baseUrl)
            ->withHeaders($this->headers);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = $this->service
            ->get($this->endpoint);

        abort_if($response->failed(), 500, 'There was an issue fetching data.');

        $badges = collect(explode("\n", $response->body()))
            ->filter()
            ->mapWithKeys(fn ($line) => [Str::before($line, '=') => Str::after($line, '=')])
            ->filter(fn ($value, $key) => Str::startsWith($key, 'badge_name_') || Str::startsWith($key, 'badge_desc_'));

        progress(
            label: 'Importing badges',
            steps: $badges->keys(),
            callback: fn (string $key, Progress $progress) => $this->import(
                progress: $progress,
                code: Str::after($key, 'badge_name_') === $key ? trim(Str::after($key, 'badge_desc_')) : trim(Str::after($key, 'badge_name_')),
                key: $key,
                value: $badges[$key],
            ),
        );
    }

    /**
     * Import the badge into the database.
     */
    protected function import(Progress $progress, string $code, string $key, string $value): bool
    {
        try {
            $progress
                ->label(sprintf('Importing %s for %s', $key, $code))
                ->hint($value);

            $badge = Badge::firstWhere('code', $code) ?: new Badge;
            $badge->code = $badge->code ?: $code;
            $badge->name = Str::startsWith($key, 'badge_name_') ? (! $badge->name ? $value : $badge->name) : $badge->name;
            $badge->description = Str::startsWith($key, 'badge_desc_') ? (! $badge->description ? $value : $badge->description) : $badge->description;

            if (! $badge->file) {
                $badge->file = sprintf('%s.gif', $code);

                Storage::disk('album1584')->put($badge->file, file_get_contents(sprintf('https://images.habbo.com/c_images/album1584/%s', $badge->file)));

                return $badge->save();
            }

            return $badge->saveQuietly();
        } catch (\Exception $e) {
            return false;
        }
    }
}
