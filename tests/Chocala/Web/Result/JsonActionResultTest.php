<?php

namespace Chocala\Web\Result;

use ArgumentCountError;
use Chocala\Http\Response\Parts\ResponseHeaders;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Web\Result\Fakes\FakeActionData;
use PHPUnit\Framework\TestCase;

class JsonActionResultTest extends TestCase
{

    private JsonActionResult $defaultActionResult;

    private ActionDataInterface $fakeActionData;

    public function setUp()
    {
        $this->defaultActionResult = new JsonActionResult(
            StatusCode::OK(),
            new ResultHeaders()
        );
        $this->fakeActionData = new FakeActionData();
    }

    public function test__construct()
    {
        $actionResult = new JsonActionResult(
            StatusCode::SERVER_ERROR(),
            new ResultHeaders(['fooHeader' => 'one'])
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);

        $actionResult = new JsonActionResult(
            StatusCode::SERVER_ERROR()
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);

        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessageRegExp('/Too few arguments to function/');
        new JsonActionResult();

    }

    public function testHeaders()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertIsObject($this->defaultActionResult);
        self::assertIsObject($this->defaultActionResult->headers());
        self::assertEmpty($this->defaultActionResult->headers()->headerList());

        $actionResult = new JsonActionResult(
            StatusCode::OK(),
            new ResultHeaders(
                [
                    'fooHeader' => 'one',
                    'barHeader' => 'two'
                ]
            )
        );
        self::assertIsObject($actionResult);
        self::assertIsObject($actionResult->headers());
        self::assertNotEmpty($actionResult->headers()->headerList());
        //print_r($actionResult->headers());
    }

    public function testStatus()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertNotNull($this->defaultActionResult->status());
        self::assertNotNull($this->defaultActionResult->status()->message());
        self::assertNotEmpty($this->defaultActionResult->status()->message());
        self::assertNotEmpty($this->defaultActionResult->status()->code());

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
        self::assertNotNull($this->defaultActionResult);
        $result = $this->defaultActionResult->result($this->fakeActionData);
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