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
use Psr\Log\LogLevel;

final class LoggerFormatterTests extends TestCase
{
    public function testFormatWithNameAndParam(): void
    {
        $record = new LogRecord(
            context: ["name" => "test"],
            datetime: new \DateTimeImmutable("2023-07-17 11:51:56.048289"),
            level: LogLevel::INFO,
            message: "This Log has as name {name}."
        );
        $formattedMessage = "Name => test | 2023-07-17-11-51-56 | This Log has as name test.";
        $this->assertSame(expected: $formattedMessage, actual: LoggerFormatter::format($record));
    }

    public function testFormatWithOnlyParam(): void
    {
        $record = new LogRecord(
            context: ["testName" => "test"],
            datetime: new \DateTimeImmutable("2023-07-17 11:51:56.048289"),
            level: LogLevel::INFO,
            message: "This Log has a {testName}."
        );
        $formattedMessage = "2023-07-17-11-51-56 | This Log has a test.";
        $this->assertSame(expected: $formattedMessage, actual: LoggerFormatter::format($record));
    }

    public function testFormatWithoutContext(): void
    {
        $record = new LogRecord(
            context: [],
            datetime: new \DateTimeImmutable("2023-07-17 11:51:56.048289"),
            level: LogLevel::INFO,
            message: "This Log has a {testName}."
        );
        $formattedMessage = "2023-07-17-11-51-56 | This Log has a {testName}.";
        $this->assertSame(expected: $formattedMessage, actual: LoggerFormatter::format($record));
    }
}
