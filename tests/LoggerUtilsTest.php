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

final class LoggerUtilsTest extends TestCase
{
    public function testGetLevels(): void
    {
        $this->assertSame(expected: [
            "EMERGENCY" => "emergency",
            "ALERT" => "alert",
            "CRITICAL" => "critical",
            "ERROR" => "error",
            "WARNING" => "warning",
            "NOTICE" => "notice",
            "INFO" => "info",
            "DEBUG" => "debug"
        ], actual: LoggerUtils::getLevels());
    }
}
