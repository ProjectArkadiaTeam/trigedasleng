<?php
// This is a very early implementation of a public API that can be used for 3rd party applications.
// Please contact me first before using this endpoint!
//
// TODO:
//  - OAuth authentication to prevent abuse

    // Pretty print json
    header('Content-Type: application/json');

    //Connects us to the database
    require_once("../includes/common.inc.php");

    // Call the chosen action
    if (isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['query'])){
        //Check if action exists
        if(function_exists($_GET['action'])) {
            //Call action
            $_GET['action']($db, $_GET['query']);

        } else {
            //TODO: Error reporting
        }
    }

    function search($db, $query){
        $query = mysqli_real_escape_string($db, $query);
        $words_query = "SELECT * FROM `dict_words` WHERE (`word` LIKE '%".$query."%') OR (`translation` LIKE '%".$query."%')";
        $translation_query = "SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE '%".$query."%') OR (`translation` LIKE '%".$query."%')";
        $words_result = $db->query($words_query);
        $translation_result = $db->query($translation_query);

        $data = array();

        while($word = mysqli_fetch_array($words_result, MYSQLI_ASSOC)){
            $data['words'][] = $word;
        }

        while($translation = mysqli_fetch_array($translation_result, MYSQLI_ASSOC)){
            $data['translations'][] = $translation;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }
