<?php
/**
 * @param $errorMessage
 */
function throw_ajax_system_error($errorMessage)
{
    ajax_response(['message'=>$errorMessage ],  500);
    exit;
}

/**
 * @param string $errorMessage Validation error
 */
function throw_ajax_validation_error($errorMessage)
{
    ajax_response(['message'=>$errorMessage ],  422);
    exit;
}

/**
 * @param array $body Body response
 * @param int $status Header status
 */
function ajax_response($body, $status = 200)
{
    header(json_encode($body), true,$status);
    exit;
}