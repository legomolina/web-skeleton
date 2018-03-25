<?php

namespace App\Config;

class Constants
{
    const DISPLAY_ERROR_DETAILS = true; //set false in production
    const DETERMINE_ROUTE_BEFORE_APP_MIDDLEWARE = true;

    const LOGIN_SESSION_NAME = "client";
    const LOGIN_COOKIE_NAME = "session_token";
    const SELECT_APP_SESSION_NAME = "app";

    /**
     * Database constants for connection
     */
    const DB_DRIVER = "mysql";
    const DB_HOST = "localhost";
    const DB_PASS = "password";
    const DB_USER = "username";
    const DB_NAME = "database";
    const DB_CHARSET = "utf8";
    const DB_COLLATE = "utf8_general_ci";
}