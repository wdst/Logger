<?php

namespace wdst\logger;

use Psr\Log\AbstractLogger as AbstractLogger;

Class Logger extends AbstractLogger
{
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $format = '[%s] [%s] %s';
        printf($format, $this->getDate(), strtoupper($level), $message);
    }

    private function getDate()
    {
        return $this->udate('d.m.Y H:i:s.u');
    }

    private function udate($format = 'u', $utimestamp = null) {
        if (is_null($utimestamp))
            $utimestamp = microtime(true);

        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000000);

        return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
    }

}
