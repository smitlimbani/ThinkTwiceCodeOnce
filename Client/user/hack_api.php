<?php
/*
Author : Himanshu Jaju (http://facebook.com/himanshu.jaju)
API : http://developer.hackerearth.com
Date : 3rd January, 2014.
Free to Use, Modify and Share.
Send me your hacks related to this api at : himanshu.jaju@gmail.com.
If you make this even more awesome, please send a pull request on github!
*/
class HackApi
{
	private $language=""; // the language of your code
	private $source_code=""; // the source code
	private $input=""; // the input you give
	private $client_secret=""; // your secret client code
	private $time_limit=""; // to set time limit of program
	private $memory_limit=""; // to set memory limit of program
	
	private $curled=""; // this is the data we receive from hackerearth!
	private $parameters=""; // the parameterised version.
	
	private $compile_url = "http://api.hackerearth.com/v3/code/compile/"; // end point of compilation
	private $run_url = "http://api.hackerearth.com/v3/code/run/"; // end point of running the source code
	
	public $id; // code_id on hackerearth
	public $memory_used; // memory used by the code
	public $time_used; // time used to execute the code
	public $message; // message. if any missing arguments.
	public $compile_status; // compilation error or OK
	public $run_stderr; // error details of the code
	public $run_status; // run status of the code
	public $output; // output of the code
	public $output_html; // html format of the output
	public $array_curl; // the entire json converted to array
	public $signal; // signal returned after run
	public $run_status_detail; // run_status_detail
	public $arr=array();
	
	private function curl_it($url,$p,$n)
	{
		/*
		$url -> the url to curl.
		$parameters -> list of parameters to post.
		$n -> count of parameters.
		*/
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($ch, CURLOPT_CAINFO, 'cacert.pem');
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$p);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		$this->curled = json_decode($response,true);
	}
	
	public function set_client_secret($a)
	{
		$this->client_secret = $a;
	}
	
	public function init($lang,$code,$inp,$tlimit,$mlimit)
	{
		$id = "";
		$memory_used = "";
		$time_used = "";
		$message = "";
		$compile_status = "";
		$run_status = "";
		$array_curl = "";
		$output = "";
		$output_html = "";
		$signal = "";
		$run_stderr = "";
		$run_status_detail = "";
		//all values have been reset to avoid any discrepancies.
		$this->input = strip_tags($inp);
		//echo json_encode($this->input);
		//return;
		$this->source_code=stripslashes($code); //removing stray '/'
		// echo "dsaf";
		// die();
		$lang = strtoupper($lang);
		$this->language = $lang;
		$this->time_limit=(int)$tlimit;
		$this->memory_limit=(int)$mlimit;
		
		
		// converting language to hackerearth friendly
		
		//$this->parameters="client_secret=".."&source=".$this->source_code."&lang=".$this->language."&input=".$this->input."&time_limit=".$this->time_limit."&memory_limit=".$this->memory_limit;
		$this->parameters=array(
						'client_secret' => $this->client_secret,
                        'time_limit' => $this->time_limit,
        				'memory_limit' => $this->memory_limit,
        				'source' => $this->source_code,
        				'input' => $this->input,
                        'lang' => $this->language
		);
		//building the entire parameter list.
	}
	// Iniitiate the variables. First Step.
	
	public function compile()
	{
		$this->curl_it($this->compile_url,$this->parameters,4);
		$this->parse_data(1);
	}
	//call this function to compile the code
	
	public function run()
	{
		$this->curl_it($this->run_url,$this->parameters,4);
		$this->parse_data(2);
	}
	//call this function to run the code
	
	private function parse_data($check)
	{
		$this->array_curl = $this->curled;
		/*$this->id = $this->curled['code_id'];
		$this->compile_status = $this->curled['compile_status'];
		if($check==2)
		{
			$this->curled = $this->curled['run_status'];
			$this->time_used = $this->curled['time_used'];
			$this->run_status = $this->curled['status'];
			$this->run_status_detail = $this->curled['status_detail'];
			//echo $this->curled['status_detail'];
			$this->run_stderr=$this->curled['stderr'];
			$this->memory_used = $this->curled['memory_used'];
			$this->output = $this->curled['output'];
			$this->output_html = $this->curled['output_html'];
			$this->signal = $this->curled['signal'];
		}*/
		$this->arr['compile_status'] = $this->curled['compile_status'];
		$this->arr['web_link'] = $this->curled['web_link'];
		$this->arr['id'] = $this->curled['code_id'];
		if($check==2)
		{
			$this->curled = $this->curled['run_status'];
			
			if(isset($this->curled['time_used']))
			{
				$this->arr['time_used'] = $this->curled['time_used'];
			}
			else
			{
				$this->arr['time_used'] =0;
			}
			
			if(isset($this->curled['status']))
			{
				$this->arr['run_status'] = $this->curled['status'];
			}
			else
			{
				$this->arr['run_status'] =null;
			}
			
			if(isset($this->curled['status_detail']))
			{
				$this->arr['run_status_detail'] = $this->curled['status_detail'];
			}
			else
			{
				$this->arr['run_status_detail'] =null;
			}
			
			if(isset($this->curled['stderr']))
			{
				$this->arr['run_stderr'] = $this->curled['stderr'];
			}
			else
			{
				$this->arr['run_stderr'] =null;
			}
			
			if(isset($this->curled['memory_used']))
			{
				$this->arr['memory_used'] = $this->curled['memory_used'];
			}
			else
			{
				$this->arr['memory_used'] =0;
			}
			
			if(isset($this->curled['output']))
			{
				$this->arr['output'] = trim($this->curled['output']);
			}
			else
			{
				$this->arr['output'] ="";
			}
			
			if(isset($this->curled['output_html']))
			{
				$this->arr['output_html'] = trim($this->curled['output_html']);
			}
			else
			{
				$this->arr['output_html'] ="";
			}
			
			if(isset($this->curled['signal']))
			{
				$this->arr['signal'] = $this->curled['signal'];
			}
			else
			{
				$this->arr['signal'] =0;
			}
			if(isset($this->curled['request_NOT_OK_reason']))
			{
				$this->arr['request_NOT_OK_reason'] = $this->curled['request_NOT_OK_reason'];
			}
			else
			{
				$this->arr['request_NOT_OK_reason'] ="";
			}
			//echo $this->curled['status_detail'];
		}
	}
	//final call. get details
}
?>