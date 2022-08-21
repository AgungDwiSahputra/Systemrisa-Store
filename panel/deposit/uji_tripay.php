<?php
require '../include/tripay_api.php';

//echo !empty($err) ? $err : $response;
$result=json_decode($response,true);
if ($result['success'] == 'true') {
    foreach ($result['data'] as $data) {
        $group_id = $data['group_id'];
        $group_name = $data['group_name'];
        foreach ($data['payment'] as $payment) {
            $code = $payment['code'];
            $name = $payment['name'];
            $type = $payment['type'];
            $description = $payment['description'];
            foreach ($payment['instructions'] as $instructions) {
                $title = $instructions['title'];
                $steps = $instructions['steps'];
            }
            foreach ($payment['fee'] as $fee) {
                var_dump($fee);
            }
        }
    }
} else {
    echo $result['message'];
}
?>