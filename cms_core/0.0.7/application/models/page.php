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
class Page extends Eloquent
{
	
	public function CurrentPage($page)
	{
		 return   DB::table('pages')->where('name', '=', $page)->get();
	}

	public function Pages()
	{
		 return   DB::table('pages')->get();
	}

	public static function Children($id)
	{
		 return   DB::table('pages')->where('parent_id', '=', $id)->get();
	}


    public static function pagetypes($dir, $array = array()){ 
           $dh = opendir($dir); 
                  
             $files = array(); 
                while (($file = readdir($dh)) !== false) { 
                   $flag = false; 
                  if($file !== '.'&& $file !== '.DS_Store' && $file !== '..' && !in_array($file, $array) && !is_dir($dir.$file.'/')) { 
                 $files[] = basename($file, '.blade.php'); 
                } 
             } 
             return $files; 
           } 
     public static function readFolder($dir, $array = array()){ 
           $dh = opendir($dir); 
                  
             $files = array(); 
                while (($file = readdir($dh)) !== false) { 
                   $flag = false; 
                  if($file !== '.'&& $file !== '.DS_Store' && $file !== '..' && !in_array($file, $array) && !is_dir($dir.$file.'/')) { 
                 $files[] = basename($file, '.blade.php'); 
                } 
             } 
             return $files; 
           }       

    

}