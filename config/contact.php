<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email Recipient
    |--------------------------------------------------------------------------
    |
    | E-mail address of the form submissions.
    |
    */

    'email_recipient' => 'fabiocabralx@gmail.com',

    /*
    |--------------------------------------------------------------------------
    | Specifying options for uploading attachments
    |--------------------------------------------------------------------------
    |
    | The store method on an uploaded file instance to store uploaded
    | attachments. Edit the following variable if you want to specify another
    | disk or other options.
    |
    */

    'options' => [
        'disk' => 'local',
    ],

    /*
    |--------------------------------------------------------------------------
    | Attachment Path
    |--------------------------------------------------------------------------
    |
    | Folder where attachments are stored.
    |
    */

    'path' => 'uploads/attachments',

    /*
    |--------------------------------------------------------------------------
    | Filters and Rules
    |--------------------------------------------------------------------------
    |
    | Filter and rules applied to data validations.
    |
    */

    'request' => [

        'filters' => [
            'attachment' => '',
            'email' => 'trim|lowercase',
            'message' => 'trim',
            'name' => 'trim',
            'phone' => 'trim'
        ],

        'rules' => [
            'attachment' => 'bail|required|file|max:500|mimes:pdf,doc,docx,odt,txt',
            'email' => 'bail|required|min:9|max:90|email',
            'message' => 'bail|required|max:255',
            'name' => 'bail|required|min:3|max:45',
            'phone' => 'bail|required|min:10|max:14|celular_com_ddd'
        ]

    ]
];
