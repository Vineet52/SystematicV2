<?php
$name=$_GET['name'];
$email=$_GET['email'];
$mailjetApiKey = '962a0c6bb1e35b09640053dadd79c38e';
$mailjetApiSecret = 'd8601378a7597741833fe768d76e03e4';
$messageData = [
    'Messages' => [
        [
            'From' => [
                'Email' => 'u17174572@tuks.co.za',
                'Name' => 'Greens Supermarket'
            ],
            'To' => [
                [
                    'Email' => $email,
                    'Name' =>  $name
                ]
            ],
            'Subject' => 'Stockpath Registration',
            'TextPart' => 'Mailjet test body email message',
            'HTMLPart' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">
</head>

<body>
    <div class="es-wrapper-color">
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>

                <tr>
                    <td class="esd-email-paddings" valign="top">
                
                        <table class="es-header" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="6339" align="center">
                                        <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p10b es-p10r es-p10l" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-image es-p25t es-p25b es-p10r es-p10l" align="center"><a href target="_blank"><img src="https://tlr.stripocdn.email/content/guids/CABINET_3df254a10a99df5e44cb27b842c2c69e/images/7331519201751184.png" alt style="display: block;" width="40"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" style="background-color: rgb(255, 167, 59);" esd-custom-block-id="6340" bgcolor="#ffa73b" align="center">
                                        <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                        <table style="background-color: rgb(255, 255, 255); border-radius: 4px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-image es-infoblock" align="center"><a target="_blank" href="http://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=software2&utm_content=trigger_newsletter"><img src="http://dithulaganyo.co.za/stockpath/assets/img/brand/blue.png" alt width="400"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p35t es-p5b es-p30r es-p30l" align="center">
                                                                                        <h1>Welcome! '.$name.'</h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-spacer es-p5t es-p5b es-p20r es-p20l" bgcolor="#ffffff" align="center">
                                                                                        <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-bottom: 1px solid rgb(255, 255, 255); background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                        <table style="border-radius: 4px; border-collapse: separate; background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p20b es-p30r es-p30l es-m-txt-l" bgcolor="#ffffff" align="left">
                                                                                        <p>We are excited to have you on board. For info and queries please send a mail to info@stockpath.co.za or call us on 012 242 2541.</p>
                                                                                    </td>
                                                                                </tr>
                                                                          
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p30r es-p30l es-m-txt-l" align="left">
                                                                                        <p>If you have any questions, just reply to this email—were always happy to help out.</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p40b es-p30r es-p30l es-m-txt-l" align="left">
                                                                                        <p>Cheers,</p>
                                                                                        <p>The Greens Supermarket Team</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-spacer es-p10t es-p20b es-p20r es-p20l" align="center">
                                                                                        <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-bottom: 1px solid rgb(244, 244, 244); background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="6341" align="center">
                                        <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="600" valign="top" align="center">
                                                                        <table style="background-color: rgb(132, 183, 99); border-radius: 4px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffecd1">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p30t es-p30r es-p30l" align="center">
                                                                                        <h3 style="color:white;">Greens Supermarket</h3>
                                                                                    </td>
                                                                                </tr>
                                                                   
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>'
        ]
    ]
]; 
$jsonData = json_encode($messageData);
$ch = curl_init('https://api.mailjet.com/v3.1/send');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
]);
$response = json_decode(curl_exec($ch));
echo "success";
//var_dump($response);