<?php

class HtmlScrap {
	function __construct(){
		$this->captcha = '/class=["\']([^"\']+)["\'][^>]*data-sitekey=["\']([^"\']+)["\'][^>]*>/i';
		$this->input = '/<input[^>]*name=["\'](.*?)["\'][^>]*value=["\'](.*?)["\'][^>]*>/i';
		$this->limit = '/(\d{1,})\/(\d{1,})/';
	}
	private function scrap($pattern, $html){preg_match_all($pattern, $html, $matches);return $matches;}
	private function getCaptcha($html){$scrap = $this->scrap($this->captcha, $html);for($i = 0; $i < count($scrap[1]); $i++){$data[$scrap[1][$i]] = $scrap[2][$i];}return $data;}
	private function getInput($html, $form = 1){$form = explode('<form', $html)[$form];$scrap = $this->scrap($this->input, $form);for($i = 0; $i < count($scrap[1]); $i++){$data[$scrap[1][$i]] = $scrap[2][$i];}return $data;}
	public function Result($html, $form = 1)
	{
		$data['title'] = explode('</title>',explode('<title>', $html)[1])[0];
		$data['cloudflare']=(preg_match('/Just a moment.../',$html))? true:false;
		$data['firewall'] =(preg_match('/Firewall/',$html))? true:false;
		$data['locked'] = (preg_match('/Locked/',$html))? true:false;
		$data["captcha"] = $this->getCaptcha($html);
		
		$input = $this->getInput($html, $form);
		$data["input"] = ($input)? $input:$this->getInput($html, 2);
		$data["faucet"] = $this->scrap($this->limit, $html);
		
		$sukses = explode("icon: 'success',",$html)[1];
		if($sukses){
			$data["response"]["success"] = strip_tags(explode("'",explode("html: '",$sukses)[1])[0]);
		}else{
			$warning = explode("'",explode("html: '",$html)[1])[0];
			$ban = explode('</div>',explode('<div class="alert text-center alert-danger"><i class="fas fa-exclamation-circle"></i> Your account',$html)[1])[0];
			$invalid = (preg_match('/invalid amount/',$html))? "You are sending an invalid amount":false;
			$shortlink = (preg_match('/Shortlink in order to claim from the faucet!/',$html))? $warning:false;
			$sufficient = (preg_match('/sufficient funds/',$html))? "Sufficient funds":false;
			$daily = (preg_match('/Daily claim limit/',$html))? "Daily claim limit":false;
			$data["response"]["unset"] = false;
			$data["response"]["exit"] = false;
			if($ban){
				$data["response"]["warning"] = $ban;
				$data["response"]["exit"] = true;
			}elseif($invalid){
				$data["response"]["warning"] = $invalid;
				$data["response"]["unset"] = true;
			}elseif($shortlink){
				$data["response"]["warning"] = $shortlink;
				$data["response"]["exit"] = true;
			}elseif($sufficient){
				$data["response"]["warning"] = $sufficient;
				$data["response"]["unset"] = true;
			}elseif($warning){
				$data["response"]["warning"] = $warning;
			}else{
				$data["response"]["warning"] = "Not Found";
			}
		}
		return $data;
	}
}