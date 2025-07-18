<?php

// use Nette\Utils\Arrays;
use Nette\Utils\Strings;
use Helix\Lib\EditorExplodeLib;


class EditorExplodeH extends Controller
{


    private $engLib;
    private $helixFormTableNameMain;

    public function __construct()
    {
        global $wpdb;
        $this->helixFormTableNameMain = $wpdb->prefix . 'helix_words';
        require(HELIX_PLUGIN_PATH . 'app/view/masterPage/common_header.php');

        $this->engLib = new EditorExplodeLib();

        if ((isset($_GET['trigger'])) && ($_GET['trigger'] === 'new')) {
            $this->create();
        }


        if ((isset($_GET['trigger'])) && ($_GET['trigger'] === 'store')) {
            $this->store();
        }


        if ((isset($_GET['trigger'])) && ($_GET['trigger'] === 'edit')) {
            $this->edit();
        }


    }






    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        global $wpdb;

        $date = date('Y-m-d h:i:s');

        $helixFormTableNameMain = $this->helixFormTableNameMain;

        $editId = sanitize_text_field($_GET['id']);

        $data = $wpdb->get_row($wpdb->prepare("SELECT *  FROM " . $helixFormTableNameMain . "  WHERE id = %d", $editId));

        $id = $data->id;
        // $level_cat_id =  $data->level_cat_id;
        // $tense_id =  $data->tense_id;
        // $vocable_level =  $data->vocable_level_id;
        $main_language = $data->main_language;

        $translate = $data->translate;

        $comment = $data->comment;

        $main_language_explode = Strings::split($main_language, '~ \s*~');

        $main_language_json = "";

        $translate_language_json = "";

        foreach ($main_language_explode as $key => $value) {
            $value = Strings::trim($value);
            $value = Strings::lower($value);
            // $value = Strings::fixEncoding($value);
            // echo preg_match( '/\s/', ' ' );   // 1
            $value = $this->engLib->modalVerbs($value);
            $value = $this->engLib->conjunctions($value);
            $value = $this->engLib->prepositions($value);
            $value = $this->engLib->ComplexPrepositions($value);
            $value = $this->engLib->prepositionsOfTime($value);
            $main_language_json .= $this->engLib->mainLanguageHtml($value);
        }

        $piecesTR = Strings::split($translate, '~ \s*~');

        $gruplar = array_chunk($piecesTR, 4);

        // Grupları yazdır
        foreach ($gruplar as $index => $translate_decode) {
            $translate_language_json .= "<tr>";

            foreach ($translate_decode as $key => $value1) {
                $value1 = Strings::trim($value1);
                $value1 = Strings::lower($value1);
                $translate_language_json .= "<td>" . $this->engLib->htmlTranslate($value1) . "</td>";
            }

            $translate_language_json .= "</tr>";
        }



        // echo "<pre>";
        require(HELIX_PLUGIN_PATH . 'app/view/editorExplode/editorExplodeXHTML.php');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

        global $wpdb;
        $helixFormTableNameMain = $this->helixFormTableNameMain;


        $editId = sanitize_text_field($_GET['id']);

        $main_language = ($_POST['main_language_json']);
        $translate_language = ($_POST['translate_language_json']);

        $comment = ($_POST['comment']);

        $main_language_json = json_encode($main_language, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_HEX_APOS);

        $translate_json = json_encode($translate_language, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_HEX_APOS);

        //  $a = json_decode($b, false, 512, JSON_BIGINT_AS_STRING); // echo "<pre>";  // print_r($a);

        $main_language_json = str_replace("\\\u0027", "u0027", $main_language_json);
        $translate_json = str_replace("\\\u0027", "u0027", $translate_json);

        //    echo "<pre>";
        //    print_r($translate_json);
        //    echo "<pre>";
        //    print_r($main_language_json);

        $wpdb->update(
            $helixFormTableNameMain,
            array(
                'main_language_json' => $main_language_json,
                'translate_json' => $translate_json,
                'comment' => $comment,
                'is_json' => 1,
            ),
            array('id' => $editId)
        );
        wp_redirect('/wp-admin/admin.php?page=editor_explodeH&trigger=edit&id=' . $editId, 302);
        die;
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        global $wpdb;
        $helixFormTableNameMain = $this->helixFormTableNameMain;

        // $translate_decode = json_decode($translate_json, false, 512, JSON_BIGINT_AS_STRING);
        $editId = sanitize_text_field($_GET['id']);
        $data = $wpdb->get_row($wpdb->prepare("SELECT *  FROM " . $helixFormTableNameMain . "  WHERE id = %d", $editId));
        $id = $data->id;
        $main_language = $data->main_language;
        $translate = $data->translate;
        $main_language_data = $data->main_language_json;
        $translate_data = $data->translate_json;
        $comment = $data->comment;


        $main_language_decode = json_decode($main_language_data, false, 512, JSON_BIGINT_AS_STRING);
        $main_language_json = "";
        $button_html_json = "";
        foreach ($main_language_decode as $key => $value) {

            $main_language_json .= $this->engLib->mainLanguageHtml($value);
            $button_html_json .= helix_button_html($value, $key);
        }



        $translate_decode = json_decode($translate_data, false, 512, JSON_BIGINT_AS_STRING);
        $translate_language_json = " ";



        $gruplar = array_chunk($translate_decode, 4);

        // Grupları yazdır
        foreach ($gruplar as $index => $translate_decode) {
            $translate_language_json .= "<tr>";
            foreach ($translate_decode as $key => $value) {
                $translate_language_json .= "<td>" . $this->engLib->htmlTranslate($value) . "</td>";
            }
            $translate_language_json .= "</tr>";
        }


        require(HELIX_PLUGIN_PATH . 'app/view/editorExplode/editorExplodeXHTML.php');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete()
    {

    }
}

function editor_explodeH_page()
{
    new EditorExplodeH();
}