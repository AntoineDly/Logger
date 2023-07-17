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

namespace AntoineDly\Logger\Registry;

use AntoineDly\Logger\LoggerFormatter;
use AntoineDly\Logger\LogRecord;
use Psr\Log\LogLevel;

final class LocalLoggerRegistry implements LoggerRegistryInterface
{
    /** @var array<string, array<int, LogRecord>> $logs */
    private array $logs = [
        LogLevel::ALERT => [],
        LogLevel::CRITICAL => [],
        LogLevel::DEBUG => [],
        LogLevel::EMERGENCY => [],
        LogLevel::ERROR => [],
        LogLevel::INFO => [],
        LogLevel::NOTICE => [],
        LogLevel::WARNING => [],
    ];

    public function __construct(
    ) {
    }

    public function clearLogs(): void
    {
        $this->logs = [
            LogLevel::ALERT => [],
            LogLevel::CRITICAL => [],
            LogLevel::DEBUG => [],
            LogLevel::EMERGENCY => [],
            LogLevel::ERROR => [],
            LogLevel::INFO => [],
            LogLevel::NOTICE => [],
            LogLevel::WARNING => [],
        ];
    }

    /** @return array<string, array<int, string>> */
    public function dumpToArray(): array
    {
        /** @var array<string, array<int, string>> $output */
        $output = [
            LogLevel::ALERT => [],
            LogLevel::CRITICAL => [],
            LogLevel::DEBUG => [],
            LogLevel::EMERGENCY => [],
            LogLevel::ERROR => [],
            LogLevel::INFO => [],
            LogLevel::NOTICE => [],
            LogLevel::WARNING => [],
        ];

        foreach (array_keys($output) as $outputLevel) {
            foreach ($this->logs[$outputLevel] as $logEntry) {
                $logLine = LoggerFormatter::format($logEntry);
                $output[$outputLevel][] = $logLine . PHP_EOL;
            }
        }
        return $output;
    }
    public function save(LogRecord $record): void
    {
        $this->logs[$record->level][] = $record;
    }
}
