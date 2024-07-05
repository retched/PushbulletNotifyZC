<?php
/**
 * ZenCart PushBullet API for Notifications
 * Version 1.0.0
 * @copyright Portions Copyright 2004-2006 Zen Cart Team
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

class zcObserverPushbulletPush extends base
{
    public function __construct()
    {
        // This is currently only configured for new order creation notifiers but others can be created too.
        $this->attach($this, ['NOTIFY_ORDER_DURING_CREATE_ADDED_ORDER_COMMENT']);
    }

    public function update(&$class, $eventID, $paramsArray = [])
    {
        global $db;
        
        if ($eventID == 'NOTIFY_ORDER_DURING_CREATE_ADDED_ORDER_COMMENT') 
        {
            $_orderno = $paramsArray['orders_id'];
       
            $data  = 'SELECT o.*, os.orders_status_name, ot.text as "order_total" FROM ' . TABLE_ORDERS . ' o
                      INNER JOIN ' . TABLE_ORDERS_STATUS . ' os ON o.orders_status = os.orders_status_id
                      INNER JOIN ' . TABLE_ORDERS_TOTAL . ' ot ON ot.orders_id = o.orders_id
                      WHERE o.orders_id = ' . $_orderno . ' AND os.language_id = 1 AND ot.class = "ot_total"';

            $output = $db->Execute($data);

            $pmt       = $output->fields['payment_method'];
            $status    = $output->fields['orders_status_name'];
            $shipping  = $output->fields['shipping_method'];
            $total     = $output->fields['order_total'];
            
            $body_str = '';
            $body_str .= PUSHBULLET_PMT . html_entity_decode($pmt) . "\n";
            $body_str .= PUSHBULLET_STA . html_entity_decode($status) . "\n";
            $body_str .= PUSHBULLET_SHP . html_entity_decode($shipping) . "\n";
            $body_str .= PUSHBULLET_ORD . html_entity_decode($total);

            pushbullet_order($body_str, $_orderno);

        }
    }
}