<?php
/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @version  0.0.1
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */
class Attribute
{



	public static function get($attribute, $page_id, $type)
	{
		$at = DB::table('page_atributes')->where('name', '=', $attribute)->first();

		
		$attribute = DB::table($at->type.'_attribute')->where('page_id', '=', $page_id)->first();

		
			 return $attribute;
		

	}




	public static function text($attribute, $page_id)
		{
			$at = DB::table('page_atributes')->where('name', '=', $attribute)->first();

			
			$attribute = DB::table($at->type.'_attribute')->where('page_id', '=', $page_id)->first();

			if(empty($attribute)){

				 return $content='';
			}
			else{
				 return $content = $attribute->content;
			}
	   
		

		

	}


	public static function image($attribute, $page_id)
		{
			$at = DB::table('page_atributes')->where('name', '=', $attribute)->first();

			
			$attribute = DB::table($at->type.'_attribute')->where('page_id', '=', $page_id)->first();

			if(empty($attribute)){

				 return $image='';
			}
			else{
				 
				$image = DB::table('files')->where_id($attribute->file_id)->first();
				return $image;

			}
	   
		

		

	}









}