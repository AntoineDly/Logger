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

use AntoineDly\Logger\Registry\LocalLoggerRegistry;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

final class LoggerTest extends TestCase
{
    private Logger $logger;
    private LocalLoggerRegistry $localLoggerRegistry;

    protected function setUp(): void
    {
        $this->localLoggerRegistry = new LocalLoggerRegistry();
        $this->logger = new Logger(loggerRegistries: [$this->localLoggerRegistry]);
    }

    protected function tearDown(): void
    {
        $this->localLoggerRegistry->clearLogs();
    }

    public function testAlert(): void
    {
        $message = "test";
        $this->logger->alert(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::ALERT][0]);
    }

    public function testCritical(): void
    {
        $message = "test";
        $this->logger->critical(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::CRITICAL][0]);
    }

    public function testDebug(): void
    {
        $message = "test";
        $this->logger->debug(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::DEBUG][0]);
    }

    public function testEmergency(): void
    {
        $message = "test";
        $this->logger->emergency(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::EMERGENCY][0]);
    }

    public function testError(): void
    {
        $message = "test";
        $this->logger->error(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::ERROR][0]);
    }

    public function testInfo(): void
    {
        $message = "test";
        $this->logger->info(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::INFO][0]);
    }

    public function testLog(): void
    {
        $message = "test";
        $this->logger->log(LogLevel::ALERT, $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::ALERT][0]);
    }

    public function testNotice(): void
    {
        $message = "test";
        $this->logger->notice(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::NOTICE][0]);
    }

    public function testWarning(): void
    {
        $message = "test";
        $this->logger->warning(message: $message);
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringContainsString(needle: $message, haystack: $result[LogLevel::WARNING][0]);
    }

    public function testDebugNotPresentInError(): void
    {
        $message = "variable x is false";
        $this->logger->debug(message: "test");
        $this->logger->error(message: "variable x is true");
        $result = $this->localLoggerRegistry->dumpToArray();

        $this::assertStringNotContainsString(needle: $message, haystack: $result[LogLevel::ERROR][0]);
    }

    public function testClearLogs(): void
    {
        $message = "variable x is false";
        $this->logger->debug(message: $message);
        $this->localLoggerRegistry->clearLogs();

        $result = $this->localLoggerRegistry->dumpToArray();
        $this::assertEmpty(actual: $result[LogLevel::DEBUG]);
    }
}
