<?php

use App\Offer;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetUserOffers()
    {
        $user = factory('App\User')->create();
        $good = factory('App\Good')->create();
        $offer = new Offer();
        $bidder = factory('App\User')->create();
        $user->
        $good->offers()->save($offer);
        $user->goods()->save($good);

        $jsonResponse = $this->json('GET', "users/$user->id/offers");
        $jsonResponse->seeJson([
            'id' => $offer->id,
            'good_offered_for' => $offer->good_offered_for,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
        ]);
        $jsonResponse->assertResponseStatus(200);

        /*$response = $this->call('GET', "users/$user->id/offers");
        $jsonResponse = json_decode($response->getContent(), true);
        print_r($jsonResponse);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArra*/
    }
}
