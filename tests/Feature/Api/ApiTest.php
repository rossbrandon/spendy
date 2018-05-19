<?php

namespace Tests\Feature\Api;

use \PassportTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\ApiController;

class ApiTest extends PassportTestCase
{
    use RefreshDatabase;

    /**
     * Test REST API sendResponse method
     *
     * @return void
     */
    public function testSendResponse()
    {
        $apiController = new ApiController();
        $response = $apiController->sendResponse(['key' => 'test'], 'Fake success message');
        $expected = '{"success":true,"data":{"key":"test"},"message":"Fake success message"}';
        $this->assertJsonStringEqualsJsonString(json_encode($response->getData()), $expected);
    }

    /**
     * Test REST API sendError method
     *
     * @return void
     */
    public function testSendError()
    {
        $apiController = new ApiController();
        $response = $apiController->sendError('Fake error message', ['error' => 'required']);
        $expected = '{"success":false,"message":"Fake error message","data":{"error":"required"}}';
        $this->assertJsonStringEqualsJsonString(json_encode($response->getData()), $expected);
    }
}
