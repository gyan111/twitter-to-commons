<?php

namespace App;
use Illuminate\Http\Request;
use MediaWiki\OAuthClient\ClientConfig;
use MediaWiki\OAuthClient\Consumer;
use MediaWiki\OAuthClient\Client;

class Wiki
{
    public function __construct()
    {
        // set the client first before loading any funciton in this controller
        $endpoint = 'https://meta.wikimedia.org/w/index.php?title=Special:OAuth';
        $redir = 'https://meta.wikimedia.org/w/index.php?title=Special%3AOAuth%2Fauthorize&';

        $consumerKey =  env('WIKI_CONSUMER_KEY');
        $consumerSecret = getenv('WIKI_CONSUMER_SECRET');

        $conf = new ClientConfig( $endpoint );
        $conf->setRedirURL( $redir );
        $conf->setConsumer( new Consumer( $consumerKey, $consumerSecret ) );
        $conf->setUserAgent( 'TwitterToCommons MediaWikiOAuthClient/1.0' );

        $this->client = new Client( $conf );

    }
    
    //check if session tokens valid. It retuens the valid user else it returns null
    public function checkAuth(Request $request)
    {
        $client = $this->client;

        if ($request->session()->has('editToken') && $request->session()->has('accessToken')) {
            $accessToken = $request->session()->get('accessToken');
            $editToken = $request->session()->get('editToken');

            $user = $client->identify( $accessToken );

            if ($user) {
                return $user;
            }
        }
    }

    //redirect the app to authorize
    public function authorizeApp(Request $request) 
    {
        if(isset($request->url)) {
            $request->session()->put('url', $request->url);
        }

        if (isset($request->oauth_token)) {

            $client = $this->client;

            $token = $request->session()->get('token');
            $verifyCode = $request->oauth_verifier;
            
            $accessToken = $client->complete( $token,  $verifyCode );

            $request->session()->put('accessToken', $accessToken);

            $editToken = json_decode( $client->makeOAuthCall(
                $accessToken,
                'https://test.wikipedia.org/w/api.php?action=tokens&format=json'
            ) )->tokens->edittoken;

            $request->session()->put('editToken', $editToken);

            if ($request->session()->has('url')) {
                $url = '/' . $request->session()->get('url');
                $request->session()->forget('url');
            } else {
                $url = '';
            }
            return redirect('wiki' . $url);
        }

        $client = $this->client;
        $client->setCallback('oob');
        // $client->setCallback( url('https://jsahu.me/wiki/authorize'));
        
        list( $next, $token ) = $client->initiate();
        $request->session()->put('token', $token);
        return redirect($next);
    }
}
