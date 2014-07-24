<?php 

	namespace Amar;

	class BootForm{

		public $placeholder = false;
 		
 		public function __construct($form,$session){
			$this->form=$form;
			$this->session=$session;
		}
		
		
		public function model($model, array $options=array()){
			$model_name=str_plural(get_class($model)).'Controller';
			
			if ($model->id) {
				$options['method']='PUT';
			}
			
			if (isset($options['placeholder']) && $options['placeholder'] ===  true) {
				$this->placeholder = true;

			}
			return $this->form->model($model,$options);
		}
		
		public function open($options=array()){
			return $this->form->open($options);
		}
		
		public function text($name, $label = null, $value = null, array $options = array()){
			return $this->input('text',$name, $label, $value , $options);
		}
	
		public function email($name, $label = null, $value = null, array $options = array()){
			return $this->input('email',$name, $label, $value , $options);
		}

		public function password($name, $label = null, $value = null, array $options = array()){
			return $this->input('password',$name, $label, $value , $options);
		}		

		public function hidden($name, $label = null, $value = null, array $options = array()){
			return $this->input('hidden',$name, $label, $value , $options);
		}
		public function file($name, $label = null, $value = null, array $options = array()){
			return $this->input('file',$name, $label, $value , $options);
		}

		public function select($name, $label = null, $value = null,$list =array(), $options = array()){

			if (is_array($label)) {
				$list = $label;
				$label = null;
			}
				
				
			if (is_array($value)) {
				$list = $value;
				$value = null;
			}

			return $this->input('select',$name, $label, $value , $options,$list);
		}	

		public function textarea($name, $label = null, $value = null, array $options = array()){
			return $this->input('textarea',$name, $label, $value , $options);
		}

		public function radio($name, $value,$label=null,$check=null){
			return $this->inputCheckRadio('radio','test','alore','je me teste',true);

		}
		public function checkbox($name,$label=null, $value=null,$check=null){
			return $this->inputCheckRadio('checkbox',$name, $value, $label, $check);

		}
		public function inputCheckRadio($type, $name, $value,$label=null,$check=null){
			if(!isset($label)){
				$label = $name;
			}
			return ' <div class="form-group">
      					<div class="'. $type .'">
       						 <label>'.$this->form->$type($name,$value,$check).$label.
        					'</label> 
      					</div>
 					</div>';
		}

		public function radioInline($name, $value,$label=null,$check=null){
			return $this->inputCheckRadioInline('radio','test','alore','je me teste',true);

		}
		public function checkboxInline($name, $value,$label=null,$check=null){
			return $this->inputCheckRadioInline('checkbox',$name, $value, $label, $check);

		}
		public function inputCheckRadioInline($type, $name, $value,$label=null,$check=null){
			if(!isset($label)){
				$label = $name;
			}
			return '<label class="checkbox-inline">'.$this->form->$type($name,$value,$check).$label.
        		   '</label>';
		}


		public function input($type, $name, $label = null, $value = null, array $options = array(), $list = array()){
			$errors = $this->session->get('errors');
			
			if (is_array($label)) {
				$options = $label;
				$label = null;
			}
			
			
			if (is_array($value)) {
				$options = $value;
				$value = null;
			}
			
			
			if (!$label) {
				$label=trans('validation.attributes.'.$name);
			}

			if($this->placeholder){
				$options['placeholder'] = $label;
				$label = false;
			}
					
			if(isset($options['class'])) {
				$options['class'] .= ' form-control';
			}else{
				$options['class']= 'form-control';
			}
			
			$return  = '<div class="form-group form-' . $type . ($errors && $errors->has($name) ? ' has-error' : ''). '" >';
			
			if($label !== false){
				$return .= $this->form->label($name,$label);				
			}

			
			if ($type == 'textarea') {
				
				$return .= $this->form->textarea($name, $value ,$options);				
			
			}elseif($type == 'select'){

				$return .= $this->form->select($name, $list, $value ,$options);	
			
			}else{
			
				$return .= $this->form->input($type, $name, $value ,$options);				
			}
			if($errors && $errors->has($name)){
			
				$return .= '<p class="help-block">' . $errors->first($name). '</p>';
			
			}
			
			$return .='</div>';
			return $return;
		}
		
		
		public function submit($name = null,$class = null){
			return $this->subForm('submit',$name,$class);
		}

		public function reset($name = null,$class = null){
			return $this->subForm('reset',$name,$class);
		}	

		public function subForm($type,$name = null,$class = null){
			if(!$name){
				$name = trans('validation.attributes.submit');
			}
			if(!$class){
				$class = 'primary';
			}
			return  '<button type='.$type.' class="btn btn-'.$class.'">'.$name.'</button>';			
		}	

		public function close(){
			return $this->form->close();
		}
	}
