<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class Tes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {

        $notificationBuilder = new PayloadNotificationBuilder('Pemberitahuan');
        $notificationBuilder->setBody('Kami telah melakukan verifikasi pembayaran tiket anda, Terimakasih')
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "e1IJmsJm7Bw:APA91bFB8o5qU9I89YhhIBYT4OrrAzMzNxVn1YIlhBbey6h7YFHYbFkIQOLw5_TxuIk95g7Ggi6pTlV9mzjq65RmL9_qP69TKnR3XsNdXz5Ltu1PI2jUWn0iNtKyx-FCNDKso17ovzgV";

        $downstreamResponse = FCM::sendTo($token, null, $notification, $data);
    }
}
