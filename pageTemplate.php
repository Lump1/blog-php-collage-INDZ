<?php

$template = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      form {
        display: flex;
        flex-direction: column;
        flex: end;
        max-width: 250px;
        gap: 10px;
      }  
    </style>
</head>
<body>
    <br/>
    <br/>
    <strong>Task 2</strong>
    <form method="POST" action="index.php">
        Name: <input type="text" name="Task2_name">
        Age: <input type="number" name="Task2_age">
        <textarea name="Task2_message"></textarea>
        <input type="submit">
    </form>

    {body}
</body>
</html>
HTML;

$post = <<<HTML

            <div class="post-container">
                <h2 class="post-title">{POSTTITLE}</h2>
                <p class="post-text">
                    {POSTTEXT}
                </p>
                <div class="post-footer">
                    <a class="post-link" target="_blank" href="{POSTLINK}">
                        Click here!
                    </a>
                    <p class="liked-count" id="amount-{ID}">{LIKESCOUNT}</p>
                    <div class="clickable-like" data-id="{ID}" data-liked="{ISLIKED}">
                        <img class="like-ico" src="{ISLIKEDSRC}" />
                    </div>
                </div>
                
            </div>
HTML;

function getTemplateWithDataFilled($data = "", $search = "", $templateName = "template", $actualTemplate = "") {
    if($actualTemplate == "")
        $template = str_replace("{" . $search . "}", $data, $GLOBALS[$templateName]);
    else
        $template = str_replace("{" . $search . "}", $data, $actualTemplate);

    return $template;
}

function getTemplateWithManyDataFilled($dataSearchKVP, $templateName) {
    $edithTemplate = getTemplateWithDataFilled(templateName: $templateName);

    foreach ($dataSearchKVP as $key => $value) {
        $edithTemplate = getTemplateWithDataFilled($value, $key, actualTemplate: $edithTemplate);
    }   

    return $edithTemplate;
}

function addToBody($data) {
    global $template;

    $template = str_replace("</body>", $data . "</body>", $template);
}

function edithHtml($search, $innerHtml) {
    global $template;

    preg_match('/<(\w+)/', $search, $matches);

    if(!isset($matches[1])) {
        return null;
    }
    else if($matches[1] == "input") {
        preg_match('/<input[^>\/]*/', $search, $matches2);
        $template = str_replace($matches2[0], $matches2[0] . "value='" . $innerHtml . "'", $template);
    } else {
        $template = str_replace($search, $search . "" . $innerHtml, $template);
    }
}

function generateForm($method, $action, $inputs) {
    $inputStrings = buildHtmlStringFromArray($inputs);

    $form = <<<HTML
        <form method="{$method}" action="{$action}">
            {$inputStrings}
        </form>
    HTML;

    return $form;
}

function buildHtmlStringFromArray($array) {
    return implode('<br/>', $array);
}


function getLikedPostsFromCookies() {
    if (isset($_COOKIE['liked_posts'])) {
        return json_decode($_COOKIE['liked_posts'], true); 
    }
    return [];
}