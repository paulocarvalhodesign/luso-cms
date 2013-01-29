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


class Tree
{
	
	 public static function getChildren($parent)
	{
		$children = DB::table('pages')->where_parent_id($parent)->order_by('order','asc')->get();
		return $children;
	}






	public static function navigationTree()

	{
		$tree ='';

		

		
        $tree .= '<div id="navigation_tree"></div>'; 	

 		 $tree .='<script>';
       	
       	 $pages = DB::table('pages')->where_parent_id(0)->order_by('order','asc')->get();

    	$tree .= 'var data = [';        

        foreach($pages as $page){

        $children = Tree::getChildren($page->id);



         $tree .=" { ";
          
         $tree .=" order:".$page->order." ,id:".$page->id.", label: '<div class=\'opts\'><p style=\'display:none\'>".$page->id."</p><i class=\'icon-file\'></i>".$page->name."";

        $tree .= "<div class=\'mov\'><span class=\'btn  btn-success\'> <a href=".url($page->route)."><i class=\'icon-globe\'></i></a></span> ";
        $tree .= "<span class=\'btn btn-info\'> <a href=".url('pages/manage/'.$page->id)."><i class=\'icon-wrench\'></i></a> </span>";
        $tree .= " <span class=\'btn btn-danger\'><a href=".url('pages/delete/'.$page->id)."><i class=\'icon-minus\'></i></a></span></div> ";


         $tree .= "</div>',";

                 if($children){

             $tree .=  'children: [';

                        foreach($children as $child){

                          $tree .=" { ";
          
                            $tree .=" order:".$child->order.", id:".$child->id.", label: '<div class=\'opts\'><p style=\'display:none\'>".$child->id."</p><i class=\'icon-file\'></i>".$child->name."";

                            $tree .= "<div class=\'mov\'> <a href=".url($child->route)."><i class=\'icon-globe\'></i></a> ";
                            $tree .= " <a href=".url('pages/manage/'.$child->id)."><i class=\'icon-wrench\'></i></a> ";
                            $tree .= " <a href=".url('pages/delete/'.$child->id)."><i class=\'icon-minus\'></i></a> </div>";

                            $tree .= "</div>',";

                           $children = Tree::getChildren($child->id);

                            if($children){

                                 $tree .=  'children: [';

                                            foreach($children as $child){

                                                $tree .=" { ";
                              
                                                $tree .=" order:".$child->order.", id:".$child->id.", label: '<div class=\'opts\'><p style=\'display:none\'>".$child->id."</p><i class=\'icon-file\'></i>".$child->name."";

                                                $tree .= "<div class=\'mov\'> <a href=".url($child->route)."><i class=\'icon-globe\'></i></a> ";
                                                $tree .= " <a href=".url('pages/manage/'.$child->id)."><i class=\'icon-wrench\'></i></a> ";
                                                $tree .= " <a href=".url('pages/delete/'.$child->id)."><i class=\'icon-minus\'></i></a> </div>";

                                                $tree .= "</div>',";



                                                $children = Tree::getChildren($child->id);

                                                 if($children){

                                                 $tree .=  'children: [';

                                                            foreach($children as $child){

                                                                $tree .=" { ";
                                              
                                                                $tree .=" order:".$child->order.", id:".$child->id.", label: '<div class=\'opts\'><p style=\'display:none\'>".$child->id."</p><i class=\'icon-file\'></i>".$child->name."";

                                                                $tree .= "<div class=\'mov\'> <a href=".url($child->route)."><i class=\'icon-globe\'></i></a> ";
                                                                $tree .= " <a href=".url('pages/manage/'.$child->id)."><i class=\'icon-wrench\'></i></a> ";
                                                                $tree .= " <a href=".url('pages/delete/'.$child->id)."><i class=\'icon-minus\'></i></a> </div>";

                                                                $tree .= "</div>',";



                                                                $children = Tree::getChildren($child->id);

                                                                    if($children){

                                                                         $tree .=  'children: [';

                                                                                    foreach($children as $child){

                                                                                        $tree .=" { ";
                                                                      
                                                                                        $tree .=" order:".$child->order.", id:".$child->id.", label: '<div class=\'opts\'><p style=\'display:none\'>".$child->id."</p><i class=\'icon-file\'></i>".$child->name."";

                                                                                        $tree .= "<div class=\'mov\'> <a href=".url($child->route)."><i class=\'icon-globe\'></i></a> ";
                                                                                        $tree .= " <a href=".url('pages/manage/'.$child->id)."><i class=\'icon-wrench\'></i></a> ";
                                                                                        $tree .= " <a href=".url('pages/delete/'.$child->id)."><i class=\'icon-minus\'></i></a> </div>";

                                                                                        $tree .= "</div>',";



                                                                                            $children = Tree::getChildren($child->id);

                                                                                                    if($children){

                                                                                                         $tree .=  'children: [';

                                                                                                                    foreach($children as $child){

                                                                                                                        $tree .=" { ";
                                                                                                      
                                                                                                                        $tree .=" order:".$child->order.", id:".$child->id.", label: '<div class=\'opts\'><p style=\'display:none\'>".$child->id."</p><i class=\'icon-file\'></i>".$child->name."";

                                                                                                                        $tree .= "<div class=\'mov\'> <a href=".url($child->route)."><i class=\'icon-globe\'></i></a> ";
                                                                                                                        $tree .= " <a href=".url('pages/manage/'.$child->id)."><i class=\'icon-wrench\'></i></a> ";
                                                                                                                        $tree .= " <a href=".url('pages/delete/'.$child->id)."><i class=\'icon-minus\'></i></a> </div>";

                                                                                                                        $tree .= "</div>',";



                                                                                                                                    // $children = Tree::getChildren($child->id);

                                                                                                                                    //     if($children){

                                                                                                                                    //          $tree .=  'children: [';

                                                                                                                                    //                     foreach($children as $child){

                                                                                                                                    //                         $tree .=" { ";
                                                                                                                                          
                                                                                                                                    //                         $tree .=" order:".$child->order.", id:".$child->id.", label: '<div class=\'opts\'><p style=\'display:none\'>".$child->id."</p><i class=\'icon-file\'></i>".$child->name."";

                                                                                                                                    //                         $tree .= "<div class=\'mov\'> <a href=".url($child->route)."><i class=\'icon-globe\'></i></a> ";
                                                                                                                                    //                         $tree .= " <a href=".url('pages/manage/'.$child->id)."><i class=\'icon-wrench\'></i></a> ";
                                                                                                                                    //                         $tree .= " <a href=".url('pages/delete/'.$child->id)."><i class=\'icon-minus\'></i></a> </div>";

                                                                                                                                    //                         $tree .= "</div>',";









                                                                                                                                                            

                                                                                                                                    //                         $tree .="  },";  


                                                                                                                                    //                         }
                                                                                                                                                            
                                                                                                                                    //              $tree .=  ']';

                                                                                                                                    //                  }






                                                                                                                        

                                                                                                                        $tree .="  },";  


                                                                                                                        }
                                                                                                                        
                                                                                                             $tree .=  ']';

                                                                                                              }


                                                

                                                                                            $tree .="  },";  


                                                                                            }
                                                                                            
                                                                                 $tree .=  ']';

                                                                                     }

                                                                

                                                                $tree .="  },";  


                                                                }
                                                                
                                                     $tree .=  ']';

                                                         }


                                                $tree .="  },";  


                                                }
                                                
                                     $tree .=  ']';

                                         }
                          $tree .="  },";  

                        }
                        
             $tree .=  ']';

                 }


         $tree .="  },";

        }

    $tree .= '];';  

    $tree .='</script>';

        return $tree;      

	}







   









}