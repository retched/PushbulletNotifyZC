# PushBullet Notifier for ZenCart
This plugin allows you to configure ZenCart to send "pushes" (what PushBullet calls messages) to be sent to you via various devices when certain events are triggered in ZenCart.

## Getting Started

### Prerequisites
* Sign up for a PushBullet account at [https://www.pushbullet.com](https://www.pushbullet.com) and create an access token for PushBullet in the account settings of the website.
* ZenCart 1.5.8 installed (and onward) (This might work in the earlier versions of ZenCart but as a precaution, you should not be using anything less than the current version of ZC.)
* PushBullet installed on your phone, desktop, or any other computer you want to be notified about having an action taken. Have these apps/applications running.

### Installation Steps

This plugin is an encapsulated plugin for ZenCart versions 1.5.8 and onward. However, it can also be installed by copying the appropriate files/folders and running a MySQL command set in your ZenCart backend.

#### ZenCart 1.5.8 and onward
This plugin is encapsulated and runs almost exclusively from the `zc_plugin` folder.

1. Extract the archive's contents and copy the contents of the `zc_plugin` folder into the `zc_plugin` of your installation. Be sure to retain the paths!
2. Log in to your admin dashboard and visit the Plugin Manager by navigating the navigation menu: Modules > Plugin Manager.
3. From there, click on the row containing the plugin's name and hit `"Install"`.
4. If all is well, the plugin will install.

#### ZenCart 1.5.7 and before
This plugin may or may not work encapsulated but you can simply extract the plugin to a folder, navigate to the `zc_plugins/PushbulletNotify/v1.0.0/catalog` folder, and extract its contents to the appropriate folders of your ZenCart installation.

Additionally, you will need to run the following SQL in your admin dashboard > Tools > Install SQL Patches

```
SET @max = (SELECT MAX(sort_order) as max_sort FROM jg1_configuration WHERE configuration_group_id = 7);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added) VALUES 
        ('Pushbullet: Access Token', 'PUSHBULLET_TOKEN', '', 'This is the API Key that you obtain via the PushBullet account settings page. Be sure that you record it here quickly as it will only be shown to you ONCE. If you lose any of the devices connected to your account, it is STRONGLY encouraged that you reset all of your access tokens. If you reset your tokens, reinsert the new key here.', 1, @max + 1 , now(), now()),
        ('Pushbullet: Channel Tag', 'PUSHBULLET_CHANNEL', '', 'This is the Channel tag that you want to push all notifications to. You MUST have owner permissions to this channel to use this. Additionally, <strong>BE CAREFUL ABOUT SENDING PUSHES WITH THE DASHBOARD URL!!!! If you are sending pushes with the dashboard URL, it is strongly recommended that you DO NOT include the dashboard URL with channel pushes.</strong>', 1, " . @max + 2 . ", now(), now()),
        ('Pushbullet: Include Link in Push', 'PUSHBULLET_LINK', '0', 'Include the link to the dashboard with the push.<br><br>The pushes sent to a channel are generally publicly available! <strong>Be careful about sending a push to a channel!!</strong> If you are using the channel push option, treat the PushBullet Channel tag as a password and make it hard to guess!!!<br><br> 0 = off<br>1= on', 1, " . @max + 3 . ", now(), now()),
        ('Pushbullet: ZenCart Admin Directory', 'PUSHBULLET_ZCADMINDIR', '', 'This is the admin directory of your Zencart install. Be sure that if you change your admin directory for any reason, you also reset this too. Also include the closing backslash as necessary.', 1, @max + 4 , now(), now());
```

**__DO NOT RUN THIS BY COPY/PASTING THE SQL INTO A TOOL LIKE PHPMYADMIN, YOU MAY RUN INTO ERRORS__**
 
When this runs, please also navigate to the dashboard and visit Configuration > My Store > and enter the directory of your ZenCart Admin with regards to the route of your domain. For example, if your ZenCart Admin is installed at `/Troop-Megaphone-Tuba`, you would enter `/Troop-Megaphone-Tuba/`. (**BE SURE TO ENTER THE TRAILING BACKSLASH!**)

## Configuring the Plugin

After installing the plugin by one of the two above methods, visit the Admin Dashboard and navigate to Configuration > My Store, and adjust the Pushbullet options as needed.

### Broadcast Channels
As an optional step, if this plugin will be used by more than one person, you can create  create a channel that will broadcast to all users/devices who are "subscribed" to that channel tag. To do this, simply visit the PushBullet website  and follow the steps to create a broadcast channel.

As a part of the process, you will be prompted to make a "channel tag". The channel tag is effectively a code that will let other users subscribe to your channel broadcasts. Make a note of it and enter it in the backend as part of the configuration as noted above.  If you are planning on adding the link to the Push, **BE SURE THAT YOU SET UP A STRONG "channel tag"**. Your channel pushes are viewable on the website of Pushbullet. If anyone gets a hold of your channel tag, **THEY WILL SEE YOUR LINKS TO THE BACKEND**. 

For that reason, if you are including the link with Pushes, **TREAT YOUR CHANNEL TAG AS A PASSWORD OR ELSE YOUR ADMIN DIRECTORY LOCATION WILL BE EXPOSED**. For that reason, the link is disabled by default and you are only going to be notified on new orders without the quick link to the admin panel.

## List of files
```
zc_plugins\PushbulletNotify\v1.0.0\manifest.php
zc_plugins\PushbulletNotify\v1.0.0\catalog\includes\classes\observers\auto.pushbullet_push.php
zc_plugins\PushbulletNotify\v1.0.0\catalog\includes\functions\extra_functions\functions_pushbullet.php
zc_plugins\PushbulletNotify\v1.0.0\catalog\includes\languages\english\extra_definitions\lang.pushbullet_api.php
zc_plugins\PushbulletNotify\v1.0.0\Installer\ScriptedInstaller.php
```

### License
```
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
```

## Version History
* 1.0.0 (07/04/2024) - Initial Release.