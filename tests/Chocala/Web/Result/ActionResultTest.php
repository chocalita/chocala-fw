<?php

namespace Chocala\Web\Result;

use Chocala\Http\Response\Parts\Fakes\FakeResponseBody;
use Chocala\Http\Response\Parts\ResponseHeadersInterface;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Web\Result\Fakes\FakeActionData;
use Chocala\Web\Result\Fakes\FakeResultHeaders;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ActionResultTest extends TestCase
{

    private ActionResult $defaultActionResult;
    private ActionDataInterface $fakeActionData;

    public function setUp()
    {
        $this->defaultActionResult = new ActionResult(
            StatusCode::OK(),
            new FakeResultHeaders(),
            new FakeResponseBody()
        );
        $this->fakeActionData = new FakeActionData();
    }

    public function test__construct()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertIsObject($this->defaultActionResult);
        self::assertInstanceOf(ActionResultInterface::class, $this->defaultActionResult);
        self::assertInstanceOf(ActionResult::class, $this->defaultActionResult);

        $actionResult = new ActionResult(
            StatusCode::SERVER_ERROR(),
            new FakeResultHeaders(),
            new FakeResponseBody()
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);
        self::assertInstanceOf(ActionResultInterface::class, $actionResult);
        self::assertInstanceOf(ActionResult::class, $actionResult);

        $actionResult = new ActionResult(
            $this->defaultActionResult,
            new FakeResponseBody()
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);
        self::assertInstanceOf(ActionResultInterface::class, $actionResult);
        self::assertInstanceOf(ActionResult::class, $actionResult);

        $wrappedActionResult = new EmptyActionResult(
            StatusCode::OK(),
            new FakeResultHeaders()
        );
        $actionResult = new ActionResult(
            $wrappedActionResult,
            new FakeResponseBody()
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);
        self::assertInstanceOf(ActionResultInterface::class, $actionResult);
        self::assertInstanceOf(ActionResult::class, $actionResult);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new ActionResult();
    }

    public function testHeaders()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertIsObject($this->defaultActionResult);
        $headers = $this->defaultActionResult->headers();
        self::assertIsObject($headers);
        self::assertInstanceOf(ResponseHeadersInterface::class, $headers);
        self::assertInstanceOf(ResultHeadersInterface::class, $headers);
        self::assertNotEmpty($headers->headerList());
        //print_r($headers);

        $actionResult = new ActionResult(
            StatusCode::OK(),
            new FakeResultHeaders([]),
            new FakeResponseBody()
        );
        self::assertIsObject($actionResult);
        self::assertIsObject($actionResult->headers());
        $headers = $actionResult->headers();
        self::assertIsObject($headers);
        self::assertInstanceOf(ResponseHeadersInterface::class, $headers);
        self::assertInstanceOf(ResultHeadersInterface::class, $headers);
        self::assertEmpty($headers->headerList());
        //print_r($headers);
    }

    public function testStatus()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertNotNull($this->defaultActionResult->status());
        self::assertNotNull($this->defaultActionResult->status()->message());
        self::assertNotEmpty($this->defaultActionResult->status()->message());
        self::assertNotEmpty($this->defaultActionResult->status()->code());

        $actionResult = new ActionResult(
            StatusCode::MOVED_PERMANENTLY(),
            new FakeResultHeaders(),
            new FakeResponseBody()
        );
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::MOVED_PERMANENTLY(), $actionResult->status());

        $actionResult = new ActionResult(
            StatusCode::NOT_FOUND(),
            new FakeResultHeaders(),
            new FakeResponseBody()
        );
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::NOT_FOUND(), $actionResult->status());

        $actionResult = new ActionResult(
            StatusCode::SERVER_ERROR(),
            new FakeResultHeaders(),
            new FakeResponseBody()
        );
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::SERVER_ERROR(), $actionResult->status());

        $actionResult = new ActionResult(
            StatusCode::OK(''),
            new FakeResultHeaders(),
            new FakeResponseBody()
        );
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::OK(''), $actionResult->status());
        self::assertEmpty($actionResult->status()->message());
    }

    public function testBody()
    {
        self::assertIsObject($this->defaultActionResult);
        $body = $this->defaultActionResult->body();
        self::assertNotNull($body);
        self::assertIsObject($body);
        self::assertEmpty($body->data());
        self::assertEquals('', $body->data());

        $actionResult = new ActionResult(
            StatusCode::OK(),
            new FakeResultHeaders(),
            new FakeResponseBody(json_encode([]))
        );
        self::assertIsObject($actionResult);
        $body = $actionResult->body();
        self::assertNotNull($body);
        self::assertIsObject($body);
        self::assertNotEmpty($body->data());
        self::assertEquals('[]', $body->data());
        //echo $body->data();

        $jsonString = json_encode(FakeActionData::DEFAULT_DATA);
        $actionResult = new ActionResult(
            StatusCode::OK(),
            new FakeResultHeaders(),
            new FakeResponseBody($jsonString)
        );
        self::assertIsObject($actionResult);
        $body = $actionResult->body();
        self::assertNotNull($body);
        self::assertIsObject($body);
        self::assertNotEmpty($body->data());
        self::assertJson($body->data());
        self::assertEquals($jsonString, $body->data());
        //echo $body->data();

        $actionResult = new ActionResult(
            StatusCode::OK(),
            new FakeResultHeaders(),
            new FakeResponseBody(FakeActionData::DEFAULT_DATA)
        );
        self::assertIsObject($actionResult);
        $body = $actionResult->body();
        self::assertNotNull($body);
        self::assertIsObject($body);
        self::assertNotEmpty($body->data());
        self::assertIsArray($body->data());
        self::assertEquals(FakeActionData::DEFAULT_DATA, $body->data());
        //print_r($body->data());
    }

}