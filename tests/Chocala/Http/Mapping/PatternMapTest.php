<?php

namespace Chocala\Http\Mapping;

use PHPUnit\Framework\TestCase;

class PatternMapTest extends TestCase
{
    public function testMap()
    {
        $pattern = '/{module}/{controller}/{action}/{id}';
        $map = ['module', 'controller', 'action', 'id'];
        $patternMap = new PatternMap($pattern);
        self::assertEquals($map, $patternMap->map());
        self::assertEquals(array_keys($map), array_keys($patternMap->map()));

        $pattern = '/{controller}/{module}/{action}/{id}';
        $map = ['controller', 'module', 'action', 'id'];
        $patternMap = new PatternMap($pattern);
        self::assertEquals($map, $patternMap->map());
        self::assertEquals(array_keys($map), array_keys($patternMap->map()));

        $pattern = '/{module}/{controller}/{id}/{action}';
        $map = ['module', 'controller', 'id', 'action'];
        $patternMap = new PatternMap($pattern);
        self::assertEquals($map, $patternMap->map());
        self::assertEquals(array_keys($map), array_keys($patternMap->map()));

        $pattern = '/{controller}/{action}/{id}';
        $map = ['controller', 'action', 'id'];
        $patternMap = new PatternMap($pattern);
        self::assertEquals($map, $patternMap->map());
        self::assertEquals(array_keys($map), array_keys($patternMap->map()));

        $pattern = '/{controller}/{id}';
        $map = ['controller', 'id'];
        $patternMap = new PatternMap($pattern);
        self::assertEquals($map, $patternMap->map());
        self::assertEquals(array_keys($map), array_keys($patternMap->map()));

        $charSet = '([_0-9a-zA-Z]+)';
        $uri = '/{controller}Mo/{id}Co/';
        $r = 1;
        $pattern = $uri;
        $pattern = str_replace('{' . PatternMap::MODULE . '}', $charSet, $pattern, $r);
        $pattern = str_replace('{' . PatternMap::CONTROLLER . '}', $charSet, $pattern, $r);
        $pattern = str_replace('{' . PatternMap::ACTION . '}', $charSet, $pattern, $r);
        $pattern = str_replace('{' . PatternMap::ID . '}', $charSet, $pattern, $r);
        $pattern = str_replace('/', '\/', $pattern, $r);

        print_r($r);
        print_r("\n");

        print_r('/^' . $pattern . '/i');
        print_r("\n");

        $var = '/testMo/ActiontestCo/testMo/testC/1';
        $t = preg_match('/^' . $pattern . '/i', $var, $out, PREG_OFFSET_CAPTURE);
        //$t = preg_match_all('/^'.$pattern.'/i', $var, $out, PREG_PATTERN_ORDER);
        print_r($t);
        print_r("\n");
        print_r($out);
        print_r("\n");


//        $t = preg_match_all('/\/controller\/[0-9a-zA-Z-_]+\/([0-9a-zA-Z-_]+)/', '/controller/asa-aaapo/123', $out, PREG_OFFSET_CAPTURE);
//        print_r($t);
//        print_r("\n");
//        print_r($out);
    }

    public function testInvalidCreation()
    {
        $this->expectException(\InvalidArgumentException::class);
        new PatternMap();
    }
}
