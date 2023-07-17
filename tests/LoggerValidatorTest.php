<?php

declare(strict_types=1);

/*
 * This file is part of the AntoineDly/Logger package.
 *
 * (c) Antoine Delaunay <antoine.delaunay333@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AntoineDly\Logger;

use PHPUnit\Framework\TestCase;

class LoggerValidatorTest extends TestCase
{
    public function testCheckContext(): void
    {
        $context = ["test" => "test"];
        $this->assertSame(expected: $context, actual: LoggerValidator::checkContext(context: ["test" => "test"]));
    }

    public function testCheckContextKeyError(): void
    {
        $this->expectExceptionMessage(message: "Key of context's element should be a string, integer provided.");
        /** @phpstan-ignore-next-line */
        LoggerValidator::checkContext(context: ["test"]);
    }

    public function testCheckContextValueError(): void
    {
        $this->expectExceptionMessage(message: "Value of context's element should be a string, integer provided.");
        /** @phpstan-ignore-next-line */
        LoggerValidator::checkContext(context: ["test" => 0]);
    }

    public function testCheckLevel(): void
    {
        $level = "alert";
        $this->assertSame(expected: $level, actual: LoggerValidator::checkLevel(level: $level));
    }

    public function testCheckLevelNotString(): void
    {
        $this->expectExceptionMessage(message: "Level parameter should be a string, integer provided.");
        LoggerValidator::checkLevel(level: 2);
    }

    public function testCheckLevelNotALevel(): void
    {
        $this->expectExceptionMessage(message: "Level definitelyNotALogLevel does not exist.");
        LoggerValidator::checkLevel(level: "definitelyNotALogLevel");
    }
}
