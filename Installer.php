<?php

namespace richweber\content\manager;

use \Composer\Script\Event;

class Installer
{
    public static function makeMigration(Event $event) {
        $io = $event->getIO();
        $io->write("<info>[content-manager]</info> Apply the above manager migrations? (yes|no) [no]:");
        echo exec("php yii migrate/up --migrationPath=@vendor/richweber/yii2-content-manager/migrations");
        $io->write("\n<info>[content-manager]</info> Include content-manager module in your config file.");
    }
}
