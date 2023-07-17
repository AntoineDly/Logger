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

use Psr\Log\LogLevel;
use ReflectionClass;

final class LoggerUtils
{
    /** @return array<string, mixed> */
    public static function getLevels(): array
    {
        return (new ReflectionClass(objectOrClass: LogLevel::class))->getConstants();
    }
}
