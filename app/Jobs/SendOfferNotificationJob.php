<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 06/07/2019
 * Time: 13:44
 */

namespace App\Jobs;


use App\Offer;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\ServiceAccount;

class SendOfferNotificationJob
{

    private $offer;
    private $messaging;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;

        $serviceAccount = ServiceAccount::fromJsonFile(
            __DIR__. '/../../swap-good-1561739858237-firebase-adminsdk-kpho9-57ead51a21.json');

        $firebase = (new Firebase\Factory())
            ->withServiceAccount($serviceAccount)
            ->create();

        $this->messaging = $firebase->getMessaging();
    }

    public function handle()
    {
        $to_user = $this->offer->good->User;
        $from_user = $this->offer->offered_goods->first()->good->User;

        Log::error("To_User ". $to_user->first_name);

//        $notification = Notification::create()
//            ->withTitle("Swap Offer")
//            ->withBody("An offer offer has been made for a product you posted: ". $this->offer->good()->first()->name);
//
//        $androidConfig = AndroidConfig::fromArray([
//            'ttl' => '3600s',
//            'priority' => 'normal',
//            'notification' => [
//                'title' => 'up 1.43% on the day',
//                'body' => 'gained 11.80 points to close at 835.67, up 1.43% on the day.'
//            ],
//        ]);

//        $message = CloudMessage::withTarget('token', $to_user->fcm_instance_id);
//        $message->withNotification($notification);
//        $message->withAndroidConfig($androidConfig);

        if($to_user->fcm_instance_id) {
            $this->messaging->send([
                'token' => $to_user->fcm_instance_id,
                'notification' => [
                    'title' => "Swap Offer",
                    'body' => "An offer offer has been made for a product you posted: " . $this->offer->good()->first()->name,
                ],
                'data' => [
                    'key_1' => 'Value 1',
                    'key_2' => 'Value 2',
                ],
                'android' => [
                    'ttl' => '3600s',
                    'priority' => 'normal',
                    'notification' => [
                        'title' => "Swap Offer",
                        'body' => "An offer offer has been made for a product you posted: " . $this->offer->good()->first()->name,
                        'icon' => 'stock_ticker_update',
                        'color' => '#f45342',
                        'click_action' => "com.johngachihi.example.swap.OFFERS_ACTIVITY"
                    ],
                ],
            ]);
        }
    }
}