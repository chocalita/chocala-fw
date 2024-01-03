<?php

namespace Chocala\Web\Result;

use Chocala\Http\Headers;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Web\Result\Fakes\FakeActionData;
use PHPUnit\Framework\TestCase;

class JsonActionResultTest extends TestCase
{

    private JsonActionResult $defaultJsonActionResult;
    private ActionDataInterface $fakeActionData;

    public function setUp()
    {
        $this->defaultJsonActionResult = new JsonActionResult(
            StatusCode::OK(),
            new Headers([], [])
        );
        $this->fakeActionData = new FakeActionData();
    }

    public function testHeaders()
    {
        self::assertNotNull($this->defaultJsonActionResult);
        self::assertIsObject($this->defaultJsonActionResult);
        self::assertIsObject($this->defaultJsonActionResult->headers());
        self::assertEmpty($this->defaultJsonActionResult->headers()->headerList());

        $actionResult = new JsonActionResult(
            StatusCode::OK(),
            new Headers(
                [
                    'fooHeader' => 'one',
                    'barHeader' => 'two'
                ],
                []
            )
        );
        self::assertIsObject($actionResult);
        self::assertIsObject($actionResult->headers());
        self::assertNotEmpty($actionResult->headers()->headerList());
        //print_r($actionResult->headers());
    }

    public function testStatus()
    {
        self::assertNotNull($this->defaultJsonActionResult);
        self::assertNotNull($this->defaultJsonActionResult->status());
        self::assertNotNull($this->defaultJsonActionResult->status()->message());
        self::assertNotEmpty($this->defaultJsonActionResult->status()->message());
        self::assertNotEmpty($this->defaultJsonActionResult->status()->code());

        $actionResult = new JsonActionResult(StatusCode::OK(''));
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::OK(''), $actionResult->status());
        self::assertEmpty($actionResult->status()->message());

        $actionResult = new JsonActionResult(StatusCode::MOVED_PERMANENTLY());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::MOVED_PERMANENTLY(), $actionResult->status());

        $actionResult = new JsonActionResult(StatusCode::NOT_FOUND());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::NOT_FOUND(), $actionResult->status());

        $actionResult = new JsonActionResult(StatusCode::SERVER_ERROR());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::SERVER_ERROR(), $actionResult->status());

    }

    public function testResult()
    {
        self::assertNotNull($this->defaultJsonActionResult);
        $result = $this->defaultJsonActionResult->result($this->fakeActionData);
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        self::assertJson($result);
        $jsonString = json_encode(FakeActionData::DEFAULT_VARS);
        self::assertEquals($jsonString, $result);
        //echo $result;

        $actionResult = new JsonActionResult(StatusCode::OK());
        self::assertIsObject($actionResult);
        $result = $actionResult->result(new FakeActionData([]));
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        self::assertEquals('[]', $result);
        //echo $result;
    }

}