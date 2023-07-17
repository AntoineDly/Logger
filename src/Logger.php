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

use AntoineDly\Logger\Exception\InvalidRegistryException;
use AntoineDly\Logger\Registry\LocalLoggerRegistry;
use AntoineDly\Logger\Registry\LoggerRegistryInterface;
use AntoineDly\Logger\Registry\StreamLoggerRegistry;
use DateTimeImmutable;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Stringable;

final class Logger implements LoggerInterface
{
    public function __construct(
        /** @var LoggerRegistryInterface[] */
        private readonly array $loggerRegistries = [new LocalLoggerRegistry(), new StreamLoggerRegistry()]
    ) {
    }

    /** @param array<string, string> $context */
    public function alert(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::ALERT, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function critical(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::CRITICAL, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function debug(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::DEBUG, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function emergency(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::EMERGENCY, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function error(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::ERROR, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function info(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::INFO, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function log($level, Stringable|string $message, array $context = []): void
    {
        /** @var array<string, string> $context */
        $context = LoggerValidator::checkContext(context: $context);
        $level = LoggerValidator::checkLevel(level: $level);

        if ($message instanceof Stringable) {
            $message = (string)$message;
        }

        $this->add(level: $level, message:  $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function notice(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::NOTICE, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    public function warning(Stringable|string $message, array $context = []): void
    {
        $this->log(level: LogLevel::WARNING, message: $message, context: $context);
    }

    /** @param array<string, string> $context */
    private function add(string $level, string $message, array $context = []): void
    {
        $record = new LogRecord(
            context: $context,
            datetime: new DateTimeImmutable(),
            level: $level,
            message: $message
        );

        foreach ($this->loggerRegistries as $loggerRegistry) {
            if(!$loggerRegistry instanceof LoggerRegistryInterface) {
                throw new InvalidRegistryException(
                    message: "{$loggerRegistry} should implement of LoggerRegistryInterface"
                );
            }
            $loggerRegistry->save(record: $record);
        }
    }
}
