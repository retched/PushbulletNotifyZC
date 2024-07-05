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

return [
    'pluginVersion' => 'v1.0.0',
    'pluginName' => 'PushBullet Notifier for ZenCart',
    'pluginDescription' => 'A plugin to generate Pushbullet Pushes whenever an order is created in ZenCart. Useful to coordinate amongst team members when a new order is submitted without using the email system. Uses PushBullet API which requires sign up.',
    'pluginAuthor' => 'Paul Williams (retched)',
    'pluginId' => 2392, // ID from Zen Cart forum
    'zcVersions' => ['v158', 'v200', 'v201'],
    'changelog' => 'changelog.md', // online URL (eg github release tag page, or changelog file there) or local filename only, ie: changelog.txt (in same dir as this manifest file)
    'github_repo' => 'https://github.com/retched/PushbulletNotifyZC', // url
    'pluginGroups' => [],
];