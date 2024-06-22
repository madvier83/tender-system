<?php

namespace App\Console\Commands;

use App\Models\stok;
use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessTenders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-tenders';

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
        $today = Carbon::today();

        $tenders = Tender::whereDate('tgl_tutup', $today)
            ->with(['penawaran' => function ($query) {
                $query->orderBy('ranking', 'desc');
            }])
            ->get();

        foreach ($tenders as $tender) {
            if (!$tender->is_complete) {
                $highestRankingPenawaran = $tender->penawaran->first();

                if ($highestRankingPenawaran) {
                    $data = [
                        'barang_id' => $tender->barang_id,
                        'tipe' => 'masuk',
                        'kuantitas' => $highestRankingPenawaran->kuantitas,
                        'stok_awal' => 0,
                        'stok_setelah_exp' => 0,
                        'tanggal_exp' => $highestRankingPenawaran->tgl_exp,
                        'tanggal' => $highestRankingPenawaran->tgl_masuk,
                    ];

                    // Create new stok record
                    stok::create($data);

                    // Mark Tender as complete
                    $tender->update(['is_complete' => true]);
                }
            }
        }

        $this->info('Tenders processed successfully.');
        return 0;
    }
}
