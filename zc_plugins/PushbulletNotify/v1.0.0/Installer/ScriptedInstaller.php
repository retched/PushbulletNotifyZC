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

use Zencart\PluginSupport\ScriptedInstaller as ScriptedInstallBase;

class ScriptedInstaller extends ScriptedInstallBase
{
    protected function executeInstall(): void
    {
        global $db;
        if (!defined('PUSHBULLET_TOKEN')) {

            // Get the highest value of the sort order from the configuration table.
            $sql = $db->Execute("SELECT MAX(sort_order) as max_sort FROM " . TABLE_CONFIGURATION . " WHERE configuration_group_id = 7");
            $max_sort = $sql->fields['max_sort'];

            unset($sql);

            // Insert two values into the main configuration table that is +1 and +2 away from the max value.
            $install_sql = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, last_modified, date_added) 
                            VALUES ('Pushbullet: Access Token', 'PUSHBULLET_TOKEN', '', 'This is the API Key that you obtain via the PushBullet account settings page. Be sure that you record it here quickly as it will only be shown to you ONCE. If you lose any of the devices connected to your account, it is STRONGLY encouraged that you reset all of your access tokens. If you reset your tokens, reinsert the new key here.', 1, " . $max_sort + 1 . ", NULL, now(), now()),
                                   ('Pushbullet: Channel Tag', 'PUSHBULLET_CHANNEL', '', 'This is the Channel tag that you want to push all notifications to. You MUST have owner permissions to this channel in order to use this. Additionally, <strong>BE CAREFUL ABOUT SENDING PUSHES WITH THE DASHBOARD URL!!!! If you are sending pushes with the dashboard URL, it is strongly recommended that you DO NOT include the dashboard URL with channel pushes.</strong>',  1, " . $max_sort + 2 . ", NULL, now(), now()),
                                   ('Pushbullet: Include Link in Push', 'PUSHBULLET_LINK', '0', 'Include the link to the dashboard with the push.<br><br>The pushes sent to a channel are generally publicly available! <strong>Be careful about sending a push to a channel!!</strong> If you are using the channel push option, treat the PushBullet Channel tag as a password and make it hard to guess!!!<br><br> 0 = off<br>1 = on', 1, " . $max_sort + 3 . ", 'zen_cfg_select_option(array(\'0\', \'1\'),' , now(), now()), 
                                   ('Pushbullet: ZenCart Admin Directory', 'PUSHBULLET_ZCADMINDIR', '" . DIR_WS_ADMIN . "', 'This is the admin directory of your zencart install. Be sure that if you change your admin directory for any reason, you also reset this too. Also include the closing backslash as necessary.', 1, " . $max_sort + 4 . ", NULL, now(), now())";
            
            $this->executeInstallerSql($install_sql);
        }
    }

    protected function executeUninstall(): void
    {

        // On uninstallation, remove the configuration values.
        $uninstall_sql = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '%PUSHBULLET_%'";

        $this->executeInstallerSql($uninstall_sql);

    }
}