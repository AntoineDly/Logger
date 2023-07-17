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

final readonly class LoggerFormatter
{
    public static function format(LogRecord $record): string
    {
        $output = "";
        if (array_key_exists(key: "name", array: $record->context)) {
            $output .= "Name => {$record->context["name"]} | ";
        }
        return "{$output}{$record->datetime->format("Y-m-d-H-i-s")} | " . self::getMessage($record);
    }

    /**
     * This method is inspired by from PSR-3 Logger Interface
     *
     * @see https://www.php-fig.org/psr/psr-3/
     *
     * Interpolates context values into the message placeholders.
     */
    private static function getMessage(LogRecord $record): string
    {
        // build a replacement array with braces around the context keys
        $replace = [];
        foreach ($record->context as $key => $val) {
            $replace["{" . $key . "}"] = $val;
        }

        // interpolate replacement values into the message and return
        return strtr($record->message, $replace);
    }
}
