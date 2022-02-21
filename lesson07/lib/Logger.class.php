<?php

/**
 * Class Logger
 *
 * @author My Name <my.name@example.com>
 * @internal
 *
 */

class Logger 
{
    public static function Write($message, $echo = false)
    {
        if (is_array($message)) {
            $string = 'Array (';
            print_r($message);
            foreach ($message as $key => $value) {
                $string .= " [$key] => id:" . $value['id'] . ";";
            }
            $string .= ' )';

            $message = $string;
        }
        $string = date('Y-m-d H:i:s') . ' ' . $message . "\n";
        file_put_contents(Config::get('path_logs') . '/log.txt', $string, FILE_APPEND);
        if ($echo) {
            echo "<pre>";
            echo $message . "<br>\n";
            echo "</pre>";
        }
    }
}
