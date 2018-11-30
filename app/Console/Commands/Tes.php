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

        $token = "cpP5KYbw70I:APA91bEeW79xC40DQjq9MDg-RqmabCu5MNKOXNzVBGp6zSc1BI21enRAmNk2cqqFY2uWJqhY_RILq-AXcxZhBlnpr7ySqrI5PYIadZ3t1_K0tMqMNGDSCpL6lfTDZzaxwMbyyNtStG42";

        $downstreamResponse = FCM::sendTo($token, null, $notification, $data);
    }
}
