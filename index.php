<?php

// JSON data
$people = '{"data":[{"first_name":"cassie","last_name":"zieme","age":32,"email":"marks.giuseppe@mcglynn.com","secret":"VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVu dHM="},{"first_name":"merritt","last_name":"paucek","age":37,"email":"pvandervort@mante.or","secret" :"YWxidXF1ZXJxdWUuIHNub3JrZWwu"}]}';
// Decode JSON into a workable format - array
$people_array = json_decode($people, true);


    foreach ( $people_array['data'] as $key => $person ){

        // capture each persons' email
        $emails[] = $person['email'];

        // capture age to be sorted
        $field_to_sort_data[] = $person['age'];

        // add full name of each person
        $people_array['data'][$key]['name'] = $person['first_name'].' '.$person['last_name'];
    }

    // Sort array
    array_multisort($field_to_sort_data, SORT_DESC, $people_array['data']);

    if( isset($emails) ){
        echo "<pre>".implode(",", $emails)."</pre>";
    }
    
    echo "<br>=====================<br>";
    echo "<pre>".json_encode($people_array)."</pre>";