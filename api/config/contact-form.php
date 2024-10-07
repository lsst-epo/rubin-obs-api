<?php

use Craft;

$request = Craft::$app->request;

//    'toEmail'             => 'bond@007.com', // override this one with env vars

if (!$request->getIsConsoleRequest()) {
    $topic = $request->getBodyParam("topic");
    $to_list = null;

    if($topic != null) {
        switch($topic) {
            case "website_feedback":
                $to_list = "eric.rosas@noirlab.edu;ericdrosas@gmail.com";
                break;
            case "general":
                $to_list = "erosas@lsst.org;ericdrosas@gmail.com";
                break;
            case "education":
                $to_list = "agoff@lsst.org;ericdrosas@gmail.com";
                break;
            case "media":
                $to_list = "alexandra.goff@noirlab.edu;ericdrosas@gmail.com";
                break;
            case "site_visit":
                $to_list = "ericdrosas@gmail.com";
                break;
            default:
                $to_list = "ericdrosas@gmail.com";
                break;
        }

        Craft::info("to_list : $to_list", "Maddie");
        return [
            'toEmail'             => $to_list
        ];
    }

}


