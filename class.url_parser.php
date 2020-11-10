<?php

	class url_parser{
		
		
		public $url;
		public $host;
		#public $page;
		
		
		public function __construct($_url=false){
			$this->parser($_url);
			$this->host($this->url['host']);
		}
		
		
		private function parser($url){
			if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)):
				$this->url = parse_url($url);
				#$this->page = basename($this->url['path']);
			else:
				return false;
			endif;
		}
		
		
		private function host($domain){
			$this->host = $domain;
		}
		
		
	}

?>
