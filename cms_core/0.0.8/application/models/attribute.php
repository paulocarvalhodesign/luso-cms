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



	public static function text($attribute, $page_id)
		{
			$at = DB::table('page_atributes')->where('name', '=', $attribute)->first();

			if($at){
			
			$attribute = DB::table('text_attribute')->where('page_id', '=', $page_id)->first();

			if(empty($attribute)){

				 return $content = null ;
			}
			else{
				 return $content = $attribute->content;
			}
	    }
		

		

	}


	public static function image($attribute, $page_id)
		{
			$at = DB::table('page_atributes')->where_name($attribute)->first();

			if($at){
			
			$attribute = DB::table('image_attribute')
			->where_name($at->name)
			->where_page_id($page_id)->first();

			if(empty($attribute)){

				 return $image='';
			}
			else{
				 
				$image = DB::table('files')->where_id($attribute->file_id)->first();
				return $image;

			}
	   
		
		}
		

	}


public static function date($attribute, $page_id)
		{
			$at = DB::table('page_atributes')->where('name', '=', $attribute)->first();

			if($at){
			
			$attribute = DB::table('date_attribute')->where('page_id', '=', $page_id)->first();

			if(empty($attribute)){

				 return $date = null ;
			}
			else{
				 return $date = $attribute->content;
			}
	    }
		

		

	}






}