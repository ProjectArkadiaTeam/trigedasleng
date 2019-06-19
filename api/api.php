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
    if (isset($_GET['action']) && !empty($_GET['action'])){
        //Check if action exists
        if(function_exists($_GET['action'])) {
            //Call action
            $_GET['action']($db);

        } else {
            echo 'Action is INVALID';
            exit();
        }
    }

    function search($db){
        if(!isset($_GET['query']) || empty($_GET['query'])) {
            echo "A search query is required!";
            exit();
        }

        $query = mysqli_real_escape_string($db, $_GET['query']);
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

        echo json_encode(utf8ize($data), JSON_PRETTY_PRINT);
    }

    function getDictionary($db) {
        if(!isset($_GET['filter']) || empty($_GET['filter'])) {
            echo "Dictionary filter is required!";
            exit();
        }

        $filter = mysqli_real_escape_string($db, $_GET['filter']);
        $filterTerms = explode(' ', $filter);
        $filterTermBits = array();
        foreach ($filterTerms as $term) {
            $term = trim($term);
            if (!empty($term)) {
                $filterTermBits[] = "`filter` RLIKE '[[:<:]]".$term."[[:>:]]'";
            }
        }

        $sql = "SELECT * FROM `dict_words` WHERE ".implode(' AND ', $filterTermBits)." ";
        $result = $db->query($sql);

        $data = array();
        while ($word = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $data[] = $word;
        }

        echo json_encode(utf8ize($data), JSON_PRETTY_PRINT);
    }

    function liveSearch($db) {
        if(!isset($_GET['query']) || empty($_GET['query'])) {
            exit();
        }

        // We want html output
        header('Content-Type: text/html');

        $query = mysqli_real_escape_string($db, $_GET['query']);
        $words_query = "SELECT * FROM `dict_words` WHERE (`word` LIKE '".$query."%') OR (`translation` LIKE '".$query."%')";
        $translation_query = "SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE '".$query."%') OR (`translation` LIKE '".$query."%')";
        $words_result = $db->query($words_query);
        $translation_result = $db->query($translation_query);

        // Check number of rows in the result set
        if(mysqli_num_rows($words_result) + mysqli_num_rows($translation_result) > 0){
            $count = 0;

            // Fetch result rows as an associative array
            while($row = mysqli_fetch_array($words_result, MYSQLI_ASSOC)){
                echo "<p>" . $row["word"] . "</p>";
                if($count++ > 10) exit();
            }
            while($row = mysqli_fetch_array($translation_result, MYSQLI_ASSOC)){
                echo "<p>" . $row["trigedasleng"] . "</p>";
                if($count++ > 10) exit();
            }
        } else{
            echo "<p>No matches found for $query</p>";
        }
        exit();
    }

    function utf8ize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = utf8ize($value);
            }
        } else if (is_string ($data)) {
            return utf8_encode($data);
        }
        return $data;
    }
