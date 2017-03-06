<?php

namespace dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CrawlerController extends Controller
{
    public function __construct(){
      
   }

   public function create(Request $request){

      $data = array(
      	'url' => $request->input('website'),
      	'list' => $request->input('product-list'),
      	'product' => $request->input('product-url-css'),
      	'next' => $request->input('next-url-css'),
      	'code' => $request->input('product-code-css'),
      	'name' => $request->input('product-name-css'),
      	'price' => $request->input('product-price-css'),
      	'image' => $request->input('product-image-css'),
      	'category' => $request->input('product-category-css')
      );

      $folder_name = self::urlToDomain($data['url']);

      $process = new Process('scripts/spider.sh \''. $folder_name .'\' \'' . $request->input('business_id') . '\'');
      $process->run();

      if (!$process->isSuccessful()) {
          throw new ProcessFailedException($process);
      }

      /*
      * create spider from template
      */

      $filename = self::urlToDomain($data['url']) . '.py';

      $template = file_get_contents('files/spider_template.py');

      $template=str_replace('_base_url', $data['url'] ,$template);
      $template=str_replace('_start_url', $data['list'] ,$template);
      $template=str_replace('_product_url', $data['product'] ,$template);
      $template=str_replace('_next_url', $data['next'] ,$template);
      $template=str_replace('_code', $data['code'] ,$template);
      $template=str_replace('_name', $data['name'] ,$template);
      $template=str_replace('_price', $data['price'] ,$template);
      $template=str_replace('_image', $data['image'] ,$template);
      $template=str_replace('_category', $data['category'] ,$template);

      file_put_contents('/Users/tirmidzi/Cores/Codes/RECO/Outputs/'. $folder_name . '/' . $filename, $template);

      $informations = array(
         'access_key' => $request->input('access_key'),
         'business_id' => $request->input('business_id'),
         'website' => $request->input('website')
      );

      return view('details', $informations);
   }

   public function back(Request $request){
      $informations = array(
         'access_key' => $request->input('access_key'),
         'business_id' => $request->input('business_id'),
         'website' => $request->input('website')
      );

      return view('details', $informations);
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
