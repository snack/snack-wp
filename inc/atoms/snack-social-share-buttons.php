<?php
/**
 * Social share buttons
 *
 * @since  2.0.0
 *
 * @param  int     $width   Width of the image.
 *
 * @return string         Return the social share buttons.
 */
function snack_social_share($facebook = true, $twitter = true, $googleplus = true, $linkedin = true, $small = false){

    $permalink = get_permalink();
    $title     = get_the_title();

    if($small == true ){
        $classe = ' social-small';
    }else{
        $classe = '';
    }

    $html  = '<div class="social-share '.$classe.'">';
    $html .= '<h3 class="compartilhar">Compartilhe</h3>';

    if ($facebook == true) {
        $html .= '<a href="'.$permalink.'" class="social-button social-facebook" alt="Compartilhar via Facebook" data-social="facebook" data-title="'.$title.'">';
        $html .= '<i class="fa fa-facebook"></i>Facebook';
        $html .= '</a>';
    }
    if ($twitter == true) {
        $html .= '<a href="'.$permalink.'" class="social-button social-twitter" alt="Compartilhar via Twitter" data-social="twitter" data-title="'.$title.'" data-hashtags="">';
        $html .= '<i class="fa fa-twitter"></i>Twitter';
        $html .= '</a>';
    }
    if ($googleplus == true) {
        $html .= '<a href="'.$permalink.'" class="social-button social-google-plus" alt="Compartilhar via Google+" data-social="googleplus" data-title="'.$title.'">';
        $html .= '<i class="fa fa-google-plus"></i>Google+';
        $html .= '</a>';
    }
    if ($linkedin == true) {
        $html .= '<a href="'.$permalink.'" class="social-button social-linkedin" alt="Compartilhar via Linkedin" data-social="linkedin" data-title="'.$title.'">';
        $html .= '<i class="fa fa-linkedin"></i>Linkedin';
        $html .= '</a>';
    }
    $html .= '</div>';

    echo $html;
}

