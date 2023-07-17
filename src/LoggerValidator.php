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

use AntoineDly\Logger\Exception\InvalidContextKeyTypeException;
use AntoineDly\Logger\Exception\InvalidContextValueTypeException;
use InvalidArgumentException;

final class LoggerValidator
{
    /**
     * @param array<string, string> $context
     * @return array<string, string>
     */
    public static function checkContext(array $context): array
    {
        foreach ($context as $key => $value) {
            if (!is_string($key)) {
                throw new InvalidContextKeyTypeException(
                    message: "Key of context's element should be a string, " . gettype($key) . " provided."
                );
            }

            if (!is_string($value)) {
                throw new InvalidContextValueTypeException(
                    message: "Value of context's element should be a string, " . gettype($value) . " provided."
                );
            }
        }

        return $context;
    }

    public static function checkLevel(mixed $level): string
    {
        if (!is_string($level)) {
            throw new InvalidArgumentException(
                message: "Level parameter should be a string, " . gettype($level) . " provided."
            );
        }
        if (!in_array($level, LoggerUtils::getLevels())) {
            throw new InvalidArgumentException(message: "Level {$level} does not exist.");
        }

        return $level;
    }
}
