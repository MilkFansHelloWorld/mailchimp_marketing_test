<?php
use MailchimpMarketing\ApiClient;

$mailchimp = new ApiClient();

$mailchimp->setConfig([
    'apiKey' => '4ff179553cdb3561c8b17c8d1a6c3859-us5',
    'server' => 'us5'
]);

// Health check
$health = $mailchimp->ping->get();

// Get all lists
$lists = $mailchimp->lists->getAllLists();

// Create a new list
// $createNewListRes = $mailchimp->lists->createList([
//     'name' => "test-2",
//     'contact' => [
//         'company' => 'sth',
//         'address1' => 'address',
//         'city' => 'Cambridge',
//         'country' => 'GB'
//     ],
//     'permission_reminder' => 'the permission reminder',
//     'campaign_defaults' => [
//         'from_name' => 'Me',
//         'from_email' => 'theo_ck_wang@hotmail.com',
//         'subject' => 'Subject',
//         'language' => 'en'
//     ],
//     'email_type_option' => false
// ]);

// Get list members' info
$listMembersInfo = $mailchimp->lists->getListMembersInfo('48be119774');

// Get List
$listInfo = $mailchimp->lists->getList('48be119774');

// Add User to list
// $addUserRes = $mailchimp->lists->addListMember('48be119774', [
//     'email_address' => 'theowang1@gmail.com',
//     'status' => 'subscribed'
// ]);

// Get all merge fields
// dd($mailchimp->lists->getListMergeFields('48be119774'));

// Update user
$mapEmailMember = [];
foreach($listMembersInfo->members as $member) {
    print_r($member->email_address);
    print_r ("\n");
    $mapEmailMember[$member->email_address] = $member;
}
//dd($mapEmailMember['theo@hackcambridge.com']);

$updateUser = $mailchimp->lists->updateListMember('48be119774', $mapEmailMember['theo@hackcambridge.com']->id, [
    'merge_fields' => [
        'FNAME' => 'Theo',
        'LNAME' => 'Wang'
    ]
]);
dd($updateUser);

?>