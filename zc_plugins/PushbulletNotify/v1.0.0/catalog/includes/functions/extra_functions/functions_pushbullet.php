<?php
/**
 * ZenCart PushBullet API for Notifications
 * Version 1.0.0
 * @copyright Portions Copyright 2004-2024 Zen Cart Team
 * @author Paul Williams (retched) 
****************************************************************************
    Copyright (C) 2024  Paul Williams

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
****************************************************************************/

function pushbullet_order($data_body, $_orderno) : void
{
    $data_array = [
        'body' => $data_body,
        'title' => PUSHBULLET_NEW . ' ' . STORE_NAME . ': ' . PUSHBULLET_ORN . $_orderno,
    ];

    switch(PUSHBULLET_LINK){
        case 0:
            $data_merge = [
                'type' => 'note',
              ];
            break;
        case 1:
            $data_merge = [
                'type' => 'link',
                'url' => HTTPS_SERVER . PUSHBULLET_ZCADMINDIR . 'index.php?cmd=orders&origin=index&oID='. $_orderno . '&action=edit'
              ];
            break;
    }

    $data_array = array_merge($data_array, $data_merge);

    if (zen_not_null(PUSHBULLET_CHANNEL)) {

            $data_array = array_merge($data_array, ['channel' => PUSHBULLET_CHANNEL ]);
    }
    
    pushbullet_curl($data_array);
}

function pushbullet_curl($data_array) 
{
    $ch = curl_init();
    $data_array = json_encode($data_array);

    curl_setopt($ch, CURLOPT_URL, 'https://api.pushbullet.com/v2/pushes');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_array);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $headers = array();
    $headers[] = 'Access-Token: ' . PUSHBULLET_TOKEN;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    
    curl_close($ch);


}