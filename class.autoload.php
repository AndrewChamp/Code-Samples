<?php

	class autoload{
		
		public $directories;
		
		public function __construct($_directories){
			$this->directories = (array)$_directories;
			$this->autoload_register();
		}
		
		
		private function autoload_register(){
			spl_autoload_register(function($class){
				foreach($this->directories as $dir):
					if(file_exists($dir.'class.'.$class.'.php') && $this->preset($dir.'class.'.$class.'.php')):
						require($dir.'class.'.$class.'.php');
						return;
					endif;
					return false;
				endforeach;
			});
		}
		
		
		private function preset($file){
			if(!in_array($file, get_included_files()))
				return true;
				
			return false;
		}
		

	}

?>
