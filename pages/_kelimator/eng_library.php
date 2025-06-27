<?php
function modal_verbs($value)
{
    $arr = array(
        "can",
        "can not",
        "cannot",
        "can’t",
        "could",
        "could not",
        "could’ not",
        "will",
        "will not",
        "won't",
        "would",
        "would not",
        "wouldn't",
        "shall",
        "shall not",
        "shan't",
        "may",
        "may not",
        "might",
        "might not",
        "must",
        "must not",
        "ought",
        "ought not",

    );

    if (in_array($value, $arr)) {
        return   "[helix_modalVerbs value='" . $value . "']";
    } else {
        return $value;
    }
}


function prepositions($value)
{
    $arr = array(
        "about",
        "like",
        "above",
        "near",
        "of",
        "with",
        "within",
        "without",
        "into",
        "inside",
        "from",
        "for",
        "upon",
        "except",
        "up",
        "except",
        "down",
        "underneath",
        "despite",
        "by",
        "under",
        "towards",
        "beyond",
        "towards",
        "between",
        "to",
        "through",
        "beneath",
        "than",
        "below",
        "round",
        "behind",
        "before",
        "over",
        "outside",
        "as",
        "out",
        "around",
        "opposite",
        "among",
        "onto",
        "along",
        "against",
        "off",
        "after",
        "of",
        "across"
    );

    if (in_array($value, $arr)) {
        return  "[helix_preposition value='" . $value . "']";
    } else {
        return $value;
    }
}



function ComplexPrepositions($value)
{
    $arr = array(
        "ahead of",
        "inside of",
        "apart from",
        "instead of",
        "as for",
        "near to",
        "as well as",
        "on account of",
        "because of",
        "on top of",
        "due to",
        "out of",
        "except for",
        "outside of",
        "in addition to",
        "owing to",
        "in front of",
        "such as",
        "in place of",
        "thanks to",
        "in spite of",
        "up to",


    );

    if (in_array($value, $arr)) {
        return  "[helix_ComplexPreposition value='" . $value . "']";
    } else {
        return $value;
    }
}




function prepositionsOfTime($value)
{
    $arr = array(
        "at",
        "during",
        "for",
        "in",
        "on",
        "until",
    );

    if (in_array($value, $arr)) {
        return  "[helix_prepositionsOfTime value='" . $value . "']";
    } else {
        return $value;
    }
}

function conjunctions($value)
{
    $arr = array(
        "after",
        "before",
        "since",
        "than",
        "that",
        "though",
        "unless",
        "when",
        "until",
        "where",
        "while",
        "yet",
        "both",
        "either",
        "neither",
    );

    if (in_array($value, $arr)) {
        return  "[helix_conjunction value='" . $value . "']";
    } else {
        return $value;
    }
}

function main_language_html($value)
{


    
return '<div class="mb-3 col-md-3">
        <input type="text" class="form-control" name="main_language_json[]" value="'.  $value .'">
        <a href="javascript:void(0);" class="remove_button"><img src="/wp-content/uploads/2025/03/remove-icon.png"></a>
    </div>';
}


function subscribe_link($atts){
    $default = array(
        'value' => '#',
    );

    $a = shortcode_atts($default, $atts);

    return '<a style="color: black;" href="'.$a['value'].'">'.$a['value'].'</a>' ;
}


add_shortcode('helix_conjunction', 'subscribe_link');






function helix_shortcode_exists($value){

 
    if ( shortcode_exists( 'gallery' ) ){
        return do_shortcode( $value );
    } else {
        return $value;
    }



}



function button_html($value, $no)
{
return '<div class="mb-2 col-md-2">

    <span id="demo-default" class="tooltipstered   helixColor'.  $no .'">'.do_shortcode( $value ).' </span>
    </div>';
}



function html_translate($value)
{

return '<div class="redips-drag orange"  style="border-style: solid; cursor: move;">
        <input type="text"  class="form-control" name="translate_language_json[]" value="'.  $value .'">
        <a href="javascript:void(0);" class="remove_button"><img src="/wp-content/uploads/2025/03/remove-icon.png"></a>
    </div>';

 }
?>

