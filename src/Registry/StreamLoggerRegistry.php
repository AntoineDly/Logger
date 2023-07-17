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

use AntoineDly\Logger\Error\LevelNotFoundError;
use AntoineDly\Logger\LoggerFormatter;
use AntoineDly\Logger\LoggerUtils;
use AntoineDly\Logger\LoggerValidator;
use AntoineDly\Logger\LogRecord;
use Psr\Log\LogLevel;

final class StreamLoggerRegistry implements LoggerRegistryInterface
{
    /** @var array<string, resource|false> $outputStreams */
    private array $outputStreams = [
        LogLevel::ALERT => false,
        LogLevel::CRITICAL => false,
        LogLevel::DEBUG => false,
        LogLevel::EMERGENCY => false,
        LogLevel::ERROR => false,
        LogLevel::INFO => false,
        LogLevel::NOTICE => false,
        LogLevel::WARNING => false,
    ];
    private const LOG_DIR = "../logs";
    private const LOG_FILE_EXTENSION = "log";

    public function __construct(
        private readonly bool $logFileAppend = true
    ) {
        if (!file_exists(filename :self::LOG_DIR)) {
            mkdir(directory: self::LOG_DIR);
        }

        $mode = $this->logFileAppend ? "a" : "w";

        foreach (LoggerUtils::getLevels() as $level) {
            $level = LoggerValidator::checkLevel($level);
            $logFilePath = implode(
                separator: DIRECTORY_SEPARATOR,
                array: [self::LOG_DIR, $level]
            ) . "." . self::LOG_FILE_EXTENSION;
            $this->outputStreams[$level] = fopen(filename: $logFilePath, mode: $mode);
        }
    }

    public function save(LogRecord $record): void
    {
        if (!$this->outputStreams[$record->level]) {
            throw new LevelNotFoundError(message: "Level {$record->level} was not found in outputStreams");
        }

        $outputLine = LoggerFormatter::format($record);
        fputs($this->outputStreams[$record->level], $outputLine  . PHP_EOL);
    }
}
