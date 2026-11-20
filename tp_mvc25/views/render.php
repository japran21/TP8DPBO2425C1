<?php
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function render_page($view, $data, $title)
{
    extract($data, EXTR_SKIP);
    ob_start();
    require __DIR__ . '/' . $view;
    $content = ob_get_clean();

    $template = file_get_contents(__DIR__ . '/../templates/index.html');
    echo strtr($template, [
        '{{title}}' => e($title),
        '{{content}}' => $content,
    ]);
}

function render_form_template($heading, $action, $fields, $cancelUrl)
{
    $template = file_get_contents(__DIR__ . '/../templates/form.html');
    return strtr($template, [
        '{{heading}}' => e($heading),
        '{{action}}' => e($action),
        '{{fields}}' => $fields,
        '{{cancel_url}}' => e($cancelUrl),
    ]);
}
