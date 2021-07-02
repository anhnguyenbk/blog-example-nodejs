<?php

namespace App\Utils;

class DateUtils {
    public static function formatDateTime($carbonDate) : string {
        if (!isset($carbonDate)) {
            return "";
        }

        return $carbonDate->format('d-m-Y H:i:s');
    }
}