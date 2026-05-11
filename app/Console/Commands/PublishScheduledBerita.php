<?php

namespace App\Console\Commands;

use App\Models\Berita;
use Illuminate\Console\Command;

class PublishScheduledBerita extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'berita:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled berita articles that have reached their publish date';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = Berita::where('status', 'scheduled')
            ->where('published_at', '<=', now())
            ->update(['status' => 'published']);

        if ($count > 0) {
            $this->info("{$count} berita berhasil dipublikasikan.");
        } else {
            $this->info('Tidak ada berita terjadwal yang perlu dipublikasikan.');
        }

        return self::SUCCESS;
    }
}
