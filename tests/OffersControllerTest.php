<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 06/07/2019
 * Time: 10:57
 */

class OffersControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdd() {
        $good_offered_for = factory('App\Good')->create([
            'user_id' => 4
        ]);
        $offered_good1 = factory('App\Good')->create();
        $offered_good2 = factory('App\Good')->create();

        $this->expectsJobs('App\Jobs\SendOfferNotificationJob');

        $response = $this->call('POST', '/offers', [
            'good_offered_for' => $good_offered_for->id,
            'offered_goods' => [$offered_good1->id, $offered_good2->id]
        ]);

        $new_offer = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->status());
        $this->seeInDatabase('offers', ['good_offered_for' => $good_offered_for->id]);
        $this->seeInDatabase('offered_goods', [
            'offer_id' => $new_offer['id'],
        ]);
        $this->seeInDatabase('offered_goods', [
            'good_id' => $offered_good1->id
        ]);
        $this->seeInDatabase('offered_goods', [
            'good_id' => $offered_good2->id
        ]);
    }

    public function testAddWithInvalidParameters() {
        $response = $this->call('POST', '/offers');
        $this->assertEquals(422, $response->status());
    }
}