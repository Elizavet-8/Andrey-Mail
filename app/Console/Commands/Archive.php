<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Sequences;
use App\SequencesRecipients;
use App\SequencesStages;

class Archive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаление архивных записей старше 30 дней';

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
        $sequences = Sequences::where('archive', 1)->get();
        $date = date('Y-m-d h:i:s', strtotime('-30 day'));

        foreach ($sequences as $sequence){
            if ($date > $sequence->updated_at){
                SequencesRecipients::where('sequence_id', $sequence->id)->delete();
                SequencesStages::where('sequence_id', $sequence->id)->delete();
                $sequence->delete();
                echo $sequence->id." удалена\r\n";
            }            
        }
    }
}
