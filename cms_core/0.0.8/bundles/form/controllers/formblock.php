<?php

class Form_Formblock_Controller extends Base_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Default Controller
     |--------------------------------------------------------------------------
     |
     | Instead of using RESTful routes and anonymous functions, you might wish
     | to use controllers to organize your application API. You'll love them.
     |
     | This controller responds to URIs beginning with "home", and it also
     | serves as the default controller for the application, meaning it
     | handles requests to the root of the application.
     |
     | You can respond to GET requests to "/home/profile" like so:
     |
     |		public function action_profile()
     |		{
     |			return "This is your profile!";
     |		}
     |
     | Any extra segments are passed to the method as parameters:
     |
     |		public function action_profile($id)
     |		{
     |			return "This is the profile for user {$id}.";
     |		}
     |
     */
    public $restful = true;

    


     
    public function get_render($params) {

       $content = Form\Models\Formblock::find($params['block_id']);


       $form_id = $content->form_id;
       $id = $content->id;
       $handle = 'formblock';
       $global = $params['global'];
       $area = $params['area'];

       

       $fields = Form\Models\Field::where('form_id', '=',$form_id)->order_by('order', 'asc')->get();
       
       $view = Block::template('form', $content->template);

       return View::make($view)
       ->with('fields', $fields)
       ->with('id',$form_id)
       ->with('global',$global)
       ->with('area',$area)
       ->with('handle', $handle);
       
    }

    

    public function get_list(){

     $forms = DB::table('forms')->get();
     $view = View::make('Form::dashboard.form')
        ->with('user',Auth::user())
        ->with('forms', $forms);

      return $view;
    }
    

     public function get_manage_form($id){

         $form  = DB::table('forms')->find($id);
         $fields = DB::table('form_fields')->where_form_id($id)->order_by('order', 'asc')->get();

         $view = View::make('Form::dashboard.manage')
              ->with('user',Auth::user())
              ->with('fields',$fields)
              ->with('form_id',$id)
              ->with('form', $form);

            return $view;


     }
    

      public function post_manage_form(){

        $id = Input::get('id');
  $name = Input::get('name');
  $title = Input::get('title');
  $message = Input::get('message'); 

  $rules = array(
                        'id'  => 'required',
                        'name' => 'required',
                        'title' => 'required',
                        'message' => 'required',
                    );
        $input = Input::all();
        $validation = Validator::make($input, $rules);
   
    if ($validation->fails())
        {
              $errors = $validation->errors->all('<p>:message</p>'); 
    
              $message ='<div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">';    

                  foreach($errors as $error)

                  $message .= $error;

                  $message .=' </span> </div>';



  

            Session::flash('info', $message);     
            return Redirect::to('form/manage_form/'.$id);
        
        }else{

          $data = array(

            'name' => $name,
            'title'=> $title,
            'message'=>$message

            );

           $affected = DB::table('forms')
          ->where('id', '=', $id)
          ->update($data);

       $message ='<div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">';    

              $message .=' Form Updated';
                  
              $message .=' </span> </div>';



  

            Session::flash('info', $message);        

           return Redirect::to('form/manage_form/'.$id);

        }
        
      }

}
