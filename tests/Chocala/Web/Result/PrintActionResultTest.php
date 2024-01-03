<?php

namespace Chocala\Web\Result;

use ArgumentCountError;
use Chocala\Http\Headers;
use Chocala\Http\Response\Parts\StatusCode;
use Chocala\Web\Result\Fakes\FakeActionData;
use PHPUnit\Framework\TestCase;

class PrintActionResultTest extends TestCase
{

    private PrintActionResult $defaultActionResult;

    private ActionDataInterface $fakeActionData;

    public function setUp()
    {
        $this->defaultActionResult = new PrintActionResult(
            StatusCode::OK(),
            new Headers([], [])
        );
        $this->fakeActionData = new FakeActionData();
    }

    public function test__construct()
    {
        $actionResult = new PrintActionResult(
            StatusCode::SERVER_ERROR(),
            new Headers(['fooHeader' => 'one'])
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);

        $actionResult = new PrintActionResult(
            StatusCode::SERVER_ERROR()
        );
        self::assertNotNull($actionResult);
        self::assertIsObject($actionResult);

        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessageRegExp('/Too few arguments to function/');
        new PrintActionResult();
    }

    public function testHeaders()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertIsObject($this->defaultActionResult);
        self::assertIsObject($this->defaultActionResult->headers());
        self::assertEmpty($this->defaultActionResult->headers()->headerList());

        $actionResult = new PrintActionResult(
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
    }

    public function testStatus()
    {
        self::assertNotNull($this->defaultActionResult);
        self::assertNotNull($this->defaultActionResult->status());
        self::assertNotNull($this->defaultActionResult->status()->message());
        self::assertNotEmpty($this->defaultActionResult->status()->message());
        self::assertNotEmpty($this->defaultActionResult->status()->code());

        $actionResult = new PrintActionResult(StatusCode::OK(''));
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::OK(''), $actionResult->status());
        self::assertEmpty($actionResult->status()->message());

        $actionResult = new PrintActionResult(StatusCode::MOVED_PERMANENTLY());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::MOVED_PERMANENTLY(), $actionResult->status());

        $actionResult = new PrintActionResult(StatusCode::NOT_FOUND());
        self::assertIsObject($actionResult);
        self::assertNotNull($actionResult->status());
        self::assertIsObject($actionResult->status());
        self::assertEquals(StatusCode::NOT_FOUND(), $actionResult->status());

        $actionResult = new PrintActionResult(StatusCode::SERVER_ERROR());
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
        $expectedString = print_r(FakeActionData::DEFAULT_VARS, true);
        self::assertEquals($expectedString, $result);

        $actionResult = new PrintActionResult(StatusCode::OK());
        self::assertIsObject($actionResult);
        $result = $actionResult->result(new FakeActionData([]));
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        $expectedString = print_r([], true);
        self::assertEquals($expectedString, $result);
    }

}