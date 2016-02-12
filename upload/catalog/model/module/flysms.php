<?php
class ModelModuleFlySms extends Model {

    public function sendSMS($description, $text, $telephone) {
        $description = htmlspecialchars($description);
        $text = htmlspecialchars($text);
        $start_time = "AUTO";
        $end_time = "AUTO";
        $rate = 1;
        $lifetime = 4;

        $settings = $this->model_setting_setting->getSetting('flysms');
        $source = $settings['alfaname'];
        $login = $settings['login'];
        $password = $settings['password'];

        $myXML 	 = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $myXML 	.= "<request>";
        $myXML 	.= "<operation>SENDSMS</operation>";
        $myXML 	.= '<message start_time="'.$start_time.'" end_time="'.$end_time.'" lifetime="'.$lifetime.'" rate="'.$rate.'" desc="'.$description.'" source="'.$source.'">';
        $myXML 	.= "<body>".$text."</body>";
        $myXML 	.= "<recipient>".preg_replace('/\D+/', '', $telephone)."</recipient>";
        $myXML 	.=  "</message>";
        $myXML 	.= "</request>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD , $login.':'.$password);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, 'http://sms-fly.com/api/api.php');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Accept: text/xml"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myXML);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
?>