<?php
/**
 * ZenCart PushBullet API for New Order Notifications
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

$define = [
    // Be sure to leave the trailing spaces!
    'PUSHBULLET_PMT' => 'Payment Method: ',
    'PUSHBULLET_STA' => 'Order Status: ',
    'PUSHBULLET_SHP' => 'Shipping Method: ',
    'PUSHBULLET_ORD' => 'Order Total: ',
    
    // No space typically for these
    'PUSHBULLET_NEW' => '[New Order]',
    'PUSHBULLET_ORN' => 'Order #',
];

return $define;