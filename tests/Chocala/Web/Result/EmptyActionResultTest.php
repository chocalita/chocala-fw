<?php

namespace Chocala\Web\Result;

use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\Response\Parts\Fakes\FakeResponseBody;
use Chocala\Http\Response\Parts\ResponseHeadersInterface;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Web\Result\Fakes\FakeActionData;
use Chocala\Web\Result\Fakes\FakeResultHeaders;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmptyActionResultTest extends TestCase
{
    private EmptyActionResult $defaultActionResult;

    private ActionDataInterface $fakeActionData;

    public function setUp()
    {
        $this->defaultActionResult = new EmptyActionResult(
            StatusCode::OK(),
            new FakeResultHeaders()
        );
        $this->fakeActionData = new FakeActionData();
    }

    public function test__construct()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertIsObject($this->defaultActionResult);
        self::assertInstanceOf(ActionResultInterface::class, $this->defaultActionResult);
        self::assertInstanceOf(EmptyActionResult::class, $this->defaultActionResult);

        $actionResult = new EmptyActionResult(
            StatusCode::SERVER_ERROR(),
            new FakeResultHeaders()
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);
        self::assertInstanceOf(ActionResultInterface::class, $actionResult);
        self::assertInstanceOf(EmptyActionResult::class, $actionResult);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new EmptyActionResult();
    }

    public function test__constructWithBody()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new EmptyActionResult(
            StatusCode::SERVER_ERROR(),
            new FakeResultHeaders(),
            new FakeResponseBody()
        );
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

        $actionResult = new EmptyActionResult(
            StatusCode::OK(),
            new FakeResultHeaders([])
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

        $actionResult = new EmptyActionResult(StatusCode::MOVED_PERMANENTLY());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::MOVED_PERMANENTLY(), $actionResult->status());

        $actionResult = new EmptyActionResult(StatusCode::NOT_FOUND());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::NOT_FOUND(), $actionResult->status());

        $actionResult = new EmptyActionResult(StatusCode::SERVER_ERROR());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::SERVER_ERROR(), $actionResult->status());

        $actionResult = new EmptyActionResult(StatusCode::OK(''));
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::OK(''), $actionResult->status());
        self::assertEmpty($actionResult->status()->message());
    }

    public function testBody()
    {
        self::assertNotNull($this->defaultActionResult);
        $this->expectException(UnsupportedOperationException::class);
        $this->expectExceptionMessageRegExp('/This class does not have any body/');
        $this->defaultActionResult->body();
    }
}
