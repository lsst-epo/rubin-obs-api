<?php

use Craft;
use craft\helpers\App;

$request = Craft::$app->request;

if (!$request->getIsConsoleRequest()) {
    $topic = $request->getBodyParam("topic");
    $to_list = null;

    if($topic != null) {
        switch($topic) {
            case "website_feedback":
                $to_list = App::env('CONTACT_FORM_TO_ADDRESSES_FOR_FEEDBACK');
                break;
            case "general":
                $to_list = App::env('CONTACT_FORM_TO_ADDRESSES_FOR_GENERAL');
                break;
            case "education":
                $to_list = App::env('CONTACT_FORM_TO_ADDRESSES_FOR_EDUCATION');
                break;
            case "media":
                $to_list = App::env('CONTACT_FORM_TO_ADDRESSES_FOR_MEDIA');
                break;
            case "site_visit":
                $to_list = App::env('CONTACT_FORM_TO_ADDRESSES_FOR_VISITS');
                break;
            default:
                break;
        }

        Craft::info("to_list : $to_list", "Maddie");
        return [
            'toEmail'             => $to_list
        ];
    }

}


