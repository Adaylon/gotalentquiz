<?php
namespace SimpleQuiz\Utils\Base;

class Config 
{
    static $dbhost = 'localhost';
    static $dbname = 'gotalentquiz';
    static $dbuser = 'admin';
    static $dbpassword = '123456';
    static $requireauth = true;//change to false if no auth required for quizzes
    //only used if requireauth == false
    static $defaultUser = 'default';
}