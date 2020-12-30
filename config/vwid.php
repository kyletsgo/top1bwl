<?php

return [
    'client_id' => env('VWID_CLIENT_ID'),
    'client_secret' => env('VWID_CLIENT_SECRET'),
    'issuer' => env('VWID_ISSUER', 'https://identity-sandbox.vwgroup.io'),
    'audience' => env('VWID_AUDIENCE', '35f670e0-f120-44db-99fe-f4082f8470cb@apps_vw-dilab_com'),
    'nonce' => env('VWID_NONCE', '8jYKt0sTiPS7eeTx9KeRg6Wq12eOppa3'),
    'redirect_uri' => env('VWID_REDIRECT_URI', 'myvolkswagen-dev://'),
    'redirect_uri_web' => 'http://localhost:8080/oauth/callback',
    'token_endpoint' => env('VWID_TOKEN_ENDPOINT', 'https://identity-sandbox.vwgroup.io/oidc/v1/token'),
    'jwks_uri' => env('VWID_JWKS_URI', 'https://identity-sandbox.vwgroup.io/oidc/v1/keys'),
];
