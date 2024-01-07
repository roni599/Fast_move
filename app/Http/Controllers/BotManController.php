<?php

namespace App\Http\Controllers;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public function index()
    {
        try {
            return view('botman-chatbot');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function handle()
    {
        try {
            $botman = app('botman');
            $botman->hears('{message}', function ($botman, $message) {
                if ($message == 'Hi' || $message == 'hi') {
                    $this->askName($botman);
                } else {
                    $botman->reply("Write 'Hi' for testing...");
                }
            });
            $botman->listen();
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function askName($botman)
    {
        try {
            $botman->ask("Hello, What's your name?", function (Answer $answer, $coversation) {
                $name = $answer->getText();

                $this->say('Thank you for visiting our website, ' . $name);

                $coversation->ask('Are you looking to take advangtage of courier service as a merchant?', function (Answer $answer, $coversation) {
                    $this->say('Registration as a Merchant from http://127.0.0.1:8000/register');

                    $coversation->ask('If you need other information, please contact with this number: 01610158095', function (Answer $answer, $coversation) {
                        // $this->say('Registration as a Merchant from http://127.0.0.1:8000/register');
                    });
                });
            });
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
}
