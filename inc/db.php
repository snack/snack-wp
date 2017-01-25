<?php

/**
 * @see http://codex.wordpress.org/Running_a_Development_Copy_of_WordPress
 */
add_filter('pre_option_home', 'test_localhosts');
add_filter('pre_option_siteurl', 'test_localhosts');

function test_localhosts()
{
    if (isDevEnvironment($_SERVER)) {
        return "http://".$_SERVER['SERVER_NAME']; //Specify your local dev URL here.
    } else {
        return false; // act as normal; will pull main site info from db
    }
}

/**
 * Logic to determine the environment (dev or prod)
 * @return bool 
 */
function isDevEnvironment($serverArray)
{    
    return strpos($serverArray['SERVER_NAME'], 'local') !== false;//Edit this function such that it returns a boolean based on your specific URL naming convention.
}
