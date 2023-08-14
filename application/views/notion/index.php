<?php

  // Options
  $secret_token = 'secret_tCbVAklU7hYKvKuMWXTl208U0Foo8ySKrJGrzmM1y51';
  $database_id = '8d6e2e9d56b9497094318c8f1a62edfe';
  $notion_version = '2022-06-28';

  // Post url
  $post_url = 'https://api.notion.com/v1/pages';

  // Post fields
  $post_fields = [
    'parent'     => [ 'database_id' => $database_id, ],
    'properties' => [
      'effective_date_title' => [
        'title' => [
          [
            'text' => [
              'content' => 'The page name',
            ],
          ],
        ],
      ],
      'emp_id' => [
        'number' => 257
      ],
      'date_approved' => [
        'date' => [
          "start" => "2022-02-14"
        ],
      ],
      'effective_date_details' => [
        'rich_text' => [
          [
            'text' => [
              'content' => 'A dark green leafy vegetable',
            ],
          ],
        ],
      ],
      'effective_date_status' => [
        'number' => 1
      ]
    ],
  ];


  // Init curl
  $ch = curl_init();

  // Set curl options
  curl_setopt_array($ch, [
    CURLOPT_URL            => $post_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_POSTFIELDS     => json_encode($post_fields, JSON_PRETTY_PRINT),
    CURLOPT_HTTPHEADER     => [
      'Content-Type: application/json',
      "Authorization: Bearer {$secret_token}",
      "Notion-Version: {$notion_version}",
    ],
  ]);

  // Get response
  $response = curl_exec( $ch );

  // Close curl
  curl_close( $ch );

  header('Content-Type: application/json');

  die($response);
?>