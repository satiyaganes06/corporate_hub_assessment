<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class LogHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Function: Success Log
     * @param string $message
     * @param array $data
     * @return void
     * @author satiyaG <satiyaganes.sg@gmail.com>
     */
    static public function successLog(string $message, array $data = [])
    {
        $log = [
            'message' => $message,
            'data' => $data,    
        ];

        Log::info($log);
    }

    /**
     * Function: Error Log
     * @param string $message
     * @param array $data
     * @return void
     * @author satiyaG <satiyaganes.sg@gmail.com>
     */
    static public function errorLog(string $message, array $data = [])
    {
        $log = [
           'message' => $message,
            'data' => $data,
        ];
        Log::error($log);
    }
}
