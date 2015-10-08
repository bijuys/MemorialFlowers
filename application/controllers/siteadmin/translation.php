<?php

class Translation extends CI_Controller {
	
	function Translation()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('translation'))
		{
			redirect('/siteadmin');
			exit;
		}

		$this->load->helper('file');
		
	}
	
	function index()
	{

		if($_POST)
		{
			if(isset($_POST['english']))
			{
				$encontents = '<?php'."\n\r";
				$frcontents = '<?php'."\n\r";

				foreach($_POST['english'] as $key=>$val) 
				{
					$encontents .= '$lang["'.$val.'"] = "'.$val.'";'."\n\r";
					$frcontents .= '$lang["'.$val.'"] = "'.$_POST['french'][$key].'";'."\n\r";
				}


				if (!write_file('language/english/main_lang.php', $encontents))
				{
				     echo 'Unable to write the file';
				}

				if (!write_file('language/french/main_lang.php', $frcontents))
				{
				     echo 'Unable to write the file';
				}


			}

			redirect('siteadmin/translation');
			exit;

		}
		else
		{
			include_once('language/french/main_lang.php');

			$french = $lang;
			ksort($french);


			$lang = '';

			include_once('language/english/main_lang.php');	

			$english = $lang;
			ksort($english);
			ksort($lang);

			$data['english']=$english;

			$data['french']=$french;
			$data['lang'] = $lang;

			$this->load->view('admin/translation',$data);
		}

	}

	function delete($id)
	{

			include_once('language/english/main_lang.php');
			$eng = $lang;

			include_once('language/french/main_lang.php');
			$fre = $lang;

			$encontents = '<?php'."\n\r";
			$frcontents = '<?php'."\n\r";

			foreach($eng as $key=>$val)
			{
				if($key!=html_entity_decode($id))
				{
					$encontents .= '$lang["'.$key.'"] = "'.$val.'";'."\n\r";
					$frcontents .= '$lang["'.$key.'"] = "'.$fre[$key].'";'."\n\r";					
				}

			}


			if (!write_file('language/english/main_lang.php', $encontents))
			{
			     echo 'Unable to write the file';
			}

			if (!write_file('language/french/main_lang.php', $frcontents))
			{
			     echo 'Unable to write the file';
			}

			redirect('siteadmin/translation');

	}
	
	
	
	function create()
	{

		$english = $_POST['english'];
		$french = $_POST['french'];

		if(!empty($_POST['english']))
		{

			include_once('language/english/main_lang.php');
			$eng = $lang;

			include_once('language/french/main_lang.php');
			$fre = $lang;

			if(!array_key_exists($english,$eng))
			{
				$eng[$english] = $english;
				$fre[$english] = $french;
			}
			
			$encontents = '<?php'."\n\r";
			$frcontents = '<?php'."\n\r";

			foreach($eng as $key=>$val)
			{
				$encontents .= '$lang["'.$key.'"] = "'.$val.'";'."\n\r";
				$frcontents .= '$lang["'.$key.'"] = "'.$fre[$key].'";'."\n\r";
			}

			if (!write_file('language/english/main_lang.php', $encontents))
			{
			     echo 'Unable to write the file';
			}

			if (!write_file('language/french/main_lang.php', $frcontents))
			{
			     echo 'Unable to write the file';
			}
			

		}

		redirect('siteadmin/translation');
		exit;		

	}
	
	
}
