<?php

namespace dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Hashids\Hashids;

use dashboard\Meta;
use dashboard\Site;

class RegisterController extends Controller
{
    public function __construct(){
      
   }

   public function create(Request $request){

      	$data = array(
      		'website' => $request->input('website'),
      		'access_key' => '_d1gZbDsJQn-eOTlcxSMZNLzWhoP_CY_9qR7OaqK67qwXEsVCCPTVSjcRNfX-7Qt'
      	);

      	$base_url = self::urlToDomain($data['website']);

      	$meta = Meta::where('url', $base_url)->first();
      	if(!$meta){
      		$meta = new Meta; 
      		$meta->url = $base_url;
      		$meta->save();

      		$hashids = new Hashids();
      		$meta->hash = $hashids->encode($meta->id);
      		$meta->save();
      	}

      	$site = Site::where('meta_id', $meta->id)->first();
      	if(!$site){
      		$site = new Site;
      		$site->meta_id = $meta->id;
      		$site->full_url = $data['website'];
      		$site->save();

      		$process = new Process('scripts/runner.sh \''. $base_url .'\'');
	      	$process->run();

	      	if (!$process->isSuccessful()) {
		       	throw new ProcessFailedException($process);
	      	}
      	}

      	$data['business_id'] = $meta->hash;

      	return view('register', $data);
   }

   public function edit(Request $request){

         $data = array(
            'website' => $request->input('website'),
            'access_key' => '_d1gZbDsJQn-eOTlcxSMZNLzWhoP_CY_9qR7OaqK67qwXEsVCCPTVSjcRNfX-7Qt'
         );

         $base_url = self::urlToDomain($data['website']);

         $meta = Meta::where('url', $base_url)->first();

         $data['business_id'] = $meta->hash;
         $data['edit'] = true;

         return view('register', $data);
   }

   public function urlToDomain($url) {
   		if ( substr($url, 0, 8) == 'https://' ) {
	      $url = substr($url, 8);
	   }
	   if ( substr($url, 0, 7) == 'http://' ) {
	      $url = substr($url, 7);
	   }
	   if ( substr($url, 0, 4) == 'www.' ) {
	      $url = substr($url, 4);
	   }
	   if ( strpos($url, '/') !== false ) {
	      $explode = explode('/', $url);
	      $domain  = $explode['0'];
	   }
	   if ( strpos($url, ':') !== false ) {
	      $explode = explode(':', $url);
	      $domain  = $explode['0'];
	   }
	   return $domain;
	}
}
