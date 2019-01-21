<?php

namespace App\Http\Controllers;



class AllBreedsController extends Controller
{
    const BOT_API_KEY = '779486044:AAE9G5EjIGrS-NCrP0Yswdttw2d-rmhxEi4';
    const BOT_USERNAME = 'username_bot';
    const HOOK_URL = 'https://www.dimayashchuk.icu/hook';


    public function set()
    {
        $bot_api_key = self::BOT_API_KEY;
        $bot_username = self::BOT_USERNAME;
        $hook_url = self::HOOK_URL;

        try {
            $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
            $result = $telegram->setWebhook($hook_url);
            if ($result->isOk()) {
                echo $result->getDescription();
            }

        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            echo $e->getMessage();
        }
    }

    public function unset()
    {
        $bot_api_key = self::BOT_API_KEY;
        $bot_username = self::BOT_USERNAME;

        try {

            $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

            $result = $telegram->deleteWebhook();

            if ($result->isOk()) {
                echo $result->getDescription();
            }
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            echo $e->getMessage();
        }
    }

    public function manager()
    {
        $bot_username = self::BOT_USERNAME;
        $bot_api_key = self::BOT_API_KEY;
        try {
            $bot = new TelegramBot\TelegramBotManager\BotManager([
                'api_key'      => $bot_api_key,
                'bot_username' => $bot_username,
                'secret'       => 'super_secret',
                'limiter'      => ['enabled' => TRUE],
            ]);

            $bot->run();

        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            Longman\TelegramBot\TelegramLog::error($e);
        } catch (Longman\TelegramBot\Exception\TelegramLogException $e) {

        }
    }

    public function hook()
    {
        $bot_api_key = self::BOT_API_KEY;
        $bot_username = self::BOT_USERNAME;

        $admin_users = [
//    123,
        ];


        $commands_paths = [
            __DIR__ . '/Commands/',
        ];

        try {
            $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
            $telegram->addCommandsPaths($commands_paths);
            $telegram->enableAdmins($admin_users);
            $telegram->enableLimiter();
            $telegram->handle();

        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            Longman\TelegramBot\TelegramLog::error($e);
        } catch (Longman\TelegramBot\Exception\TelegramLogException $e) {

        }

    }
}
