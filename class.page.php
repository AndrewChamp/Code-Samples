<?php

	class page{
		
		public $error;
		public $url;
		public $site = array();
		
		private $crud;
		private $table_content;
		private $table_error;
		
		
		public function __construct($_crud=null, $_table_content=null, $_table_error=null, $_url=null){
			if(!$_crud)
				throw new Exception('You need the database connection argument for '.__CLASS__.' class.');
			if(!$_table_content)
				throw new Exception('You need to declare the content table for '.__CLASS__.' class');
			if(!$_table_error)
				throw new Exception('You need to declare the content table for '.__CLASS__.' class');
			
			$this->crud = $_crud;
			$this->table_content = $_table_content;
			$this->table_error = $_table_error;
			$this->url = $this->filter($_url);
			$this->load();
		}
		
		
		public function __get($name){
			if(isset($this->site[$name]) && $this->site[$name] != null)
				return $this->site[$name];
		}


		public function __set($name, $val){
			if(isset($this->site[$name]) && $this->site[$name] != null)
				$this->site[$name] = $val;
		}
		
		
		private function filter($url){
			if(!isset($url) || $url == '' || $url == '/'):
				return '/';
			else:
				return $url;
			endif;
		}
		
		
		private function load(){
			$status = http_response_code();
			if($status != 200):
				$this->error = true;
			else:
				$page = $this->crud->query("SELECT * FROM ".$this->table_content." WHERE ".$this->table_content.".`page` = '".$this->url."' AND ".$this->table_content.".`active` = '1' LIMIT 1");
				
				if($this->crud->num($page) > 0):
					$site = $page[0];
					$this->site = $site;
					$this->error = false;
				else:
					$this->error = true;
				endif;
			endif;
		}
		
		
	}

?>
