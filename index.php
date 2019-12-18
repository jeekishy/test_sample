<?php

// JSON data
$people = '{"data":[{"first_name":"cassie","last_name":"zieme","age":32,"email":"marks.giuseppe@mcglynn.com","secret":"VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVu dHM="},{"first_name":"merritt","last_name":"paucek","age":37,"email":"pvandervort@mante.or","secret" :"YWxidXF1ZXJxdWUuIHNub3JrZWwu"}]}';

// Decode JSON into a workable format - array
$people_array = json_decode($people, true);

// Filter record
$result = filterPeople($people_array, 'age');

// VARIABLES
$email_comma_separated = $result['email_cs'];
$original_data_sorted = json_encode($result['sorted_array']);

echo "ORIGINAL JSON: ";
echo "<pre>".$people."</pre>";

echo "=============================================<br><br>";
echo "Comma-separated list of email addresses";
echo "<pre>".$email_comma_separated."</pre>";

echo "=============================================<br><br>";
echo "The original data, sorted by age descending, with a
new field on each record * called \"name\" which is the first and last name joined";
echo "<pre>".$original_data_sorted."</pre>";


// function to filter provided array of values
function filterPeople( $people_data, $field_to_sort){

    if( empty($people_data['data'])){
        return false;
    }

    $emails = [];
    $field_to_sort_data = [];

    foreach ( $people_data['data'] as $key => $person ){

        // capture each persons' email
        $emails[] = $person['email'];

        // capture field to be sorted
        $field_to_sort_data[] = $person[$field_to_sort];

        // add full name of each person
        $people_data['data'][$key]['name'] = $person['first_name'].' '.$person['last_name'];
    }

    // Sort array
    array_multisort($field_to_sort_data, SORT_DESC, $people_data['data']);

    return [
        'email_cs' => implode(",", $emails),
        'sorted_array' => $people_data
    ];
}