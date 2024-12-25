<?php

namespace App\Helpers;

class BaseHp
{
    public static function time_passed($timestamp)
    {
        //type cast, current time, difference in timestamps
        $timestamp      = (int)strtotime($timestamp);
        $current_time   = strtotime(date('Y-m-d H:i:s'));
        $diff           = $current_time - $timestamp;

        //intervals in seconds
        $intervals      = array(
            'ปี' => 31556926, 'เดือน' => 2629744, 'สัปดาห์' => 604800, 'วัน' => 86400, 'ชั่วโมง' => 3600, 'นาที' => 60
        );

        //now we just find the difference
        if ($diff == 0) {
            // return 'ไม่กี่วินาทีที่แล้ว';
            return __('phrase.time-passed.few-second');
        }

        if ($diff < 60) {
            return $diff == 1 ? $diff . ' ' . __('phrase.time-passed.second') : $diff . ' ' . __('phrase.time-passed.seconds');
        }

        if ($diff >= 60 && $diff < $intervals['ชั่วโมง']) {
            $diff = floor($diff / $intervals['นาที']);
            return $diff == 1 ? $diff . ' ' . __('phrase.time-passed.minute') : $diff . ' ' . __('phrase.time-passed.minutes');
        }

        if ($diff >= $intervals['ชั่วโมง'] && $diff < $intervals['วัน']) {
            $diff = floor($diff / $intervals['ชั่วโมง']);
            return $diff == 1 ? $diff . ' ' . __('phrase.time-passed.hour') : $diff . ' ' . __('phrase.time-passed.hours');
        }

        if ($diff >= $intervals['วัน'] && $diff < $intervals['สัปดาห์']) {
            $diff = floor($diff / $intervals['วัน']);
            return $diff == 1 ? $diff . ' ' . __('phrase.time-passed.day') : $diff . ' ' . __('phrase.time-passed.days');
        }

        if ($diff >= $intervals['สัปดาห์'] && $diff < $intervals['เดือน']) {
            $diff = floor($diff / $intervals['สัปดาห์']);
            return $diff == 1 ? $diff . ' ' . __('phrase.time-passed.week') : $diff . ' ' . __('phrase.time-passed.weeks');
        }

        if ($diff >= $intervals['เดือน'] && $diff < $intervals['ปี']) {
            $diff = floor($diff / $intervals['เดือน']);
            return $diff == 1 ? $diff . ' ' . __('phrase.time-passed.month') : $diff . ' ' . __('phrase.time-passed.months');
        }

        if ($diff >= $intervals['ปี']) {
            $diff = floor($diff / $intervals['ปี']);
            return $diff == 1 ? $diff . ' ' . __('phrase.time-passed.year') : $diff . ' ' . __('phrase.time-passed.years');
        }
    }

    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    public static function time_passed_backend($timestamp)
    {
        //type cast, current time, difference in timestamps
        $timestamp      = (int)strtotime($timestamp);
        $current_time   = strtotime(date('Y-m-d H:i:s'));
        $diff           = $current_time - $timestamp;

        //intervals in seconds
        $intervals      = array(
            'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
        );

        //now we just find the difference
        if ($diff == 0) {
            // return 'ไม่กี่วินาทีที่แล้ว';
            return "a few seconds ago";
        }

        if ($diff < 60) {
            return $diff == 1 ? $diff . '  s ago' : $diff . '  s ago';
        }

        if ($diff >= 60 && $diff < $intervals['hour']) {
            $diff = floor($diff / $intervals['minute']);
            return $diff == 1 ? $diff . 'm ago' : $diff . 'm ago';
        }

        if ($diff >= $intervals['hour'] && $diff < $intervals['day']) {
            $diff = floor($diff / $intervals['hour']);
            return $diff == 1 ? $diff . 'h ago' : $diff . 'h ago';
        }

        if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
            $diff = floor($diff / $intervals['day']);
            return $diff == 1 ? $diff . 'd ago' : $diff . 'd ago';
        }

        if ($diff >= $intervals['week'] && $diff < $intervals['month']) {
            $diff = floor($diff / $intervals['week']);
            return $diff == 1 ? $diff . '  week ago' : $diff . '  week ago';
        }

        if ($diff >= $intervals['month'] && $diff < $intervals['year']) {
            $diff = floor($diff / $intervals['month']);
            return $diff == 1 ? $diff . '  month ago' : $diff . '  month ago';
        }

        if ($diff >= $intervals['year']) {
            $diff = floor($diff / $intervals['year']);
            return $diff == 1 ? $diff . '  year ago' : $diff . '  year ago';
        }
    }
    public static function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://get.geojs.io/v1/ip/geo.js",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_TIMEOUT => 30000,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => array(
        //         // Set Here Your Requesred Headers
        //         'Content-Type: application/json',
        //     ),
        // ));
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     $response = str_replace('geoip','', $response);
        //     $response = str_replace('(','', $response);
        //     $response = str_replace(')','', $response);
        //     $response = json_decode($response);
        //     echo "<pre>";
        //     // print_r(json_decode($response));
        //     // print_r($response);
        //     echo $response->ip;
        //     echo "</pre>";
        // }
    }
}
