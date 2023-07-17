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

use DateTimeImmutable;

final readonly class LogRecord
{
    public function __construct(
        /** @var array<string, string> */
        public array $context,
        public DateTimeImmutable $datetime,
        public string $level,
        public string $message
    ) {
    }
}
