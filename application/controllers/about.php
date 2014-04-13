<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class About extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_profiles');
	}

	public function index()
	{
		if($this->user_profiles->is_admin()){
			$this->load->view('common/header_admin');
		}
		elseif ($this->session->userdata('logged_in'))
		{
			$this->load->view('common/header');
		}
		else
		{
			$this->load->view('common/header_anon');
		}
		$data['text'] = "<h2>DataDate</h2><p>DataDate is de nieuwe datingsite, met de beste technieken om u zo goed mogelijk te matchen aan een potenti&euml;le partner. DataDate is daarmee h&eacute;t alternatief voor de bekende datingsites!</p><h2>Waarom DataDate?</h2><p>De bijzonderheid in onze site is dat ons dating paradigma gebaseerd is op een unieke en wetenschappelijk correct bewezen profilerings- en matching techniek die zowel de persoonlijkheid als de lifestyle in de &quot;dating equation&quot; meeneemt en leert van de voorkeuren van de gebruiker om de dating ervaring te optimaliseren. Tot op zekere hoogte is dit al eens eerder vertoond (BrandDating.nl voor dating op basis van lifestyle - deze site is kennelijk wegen succes be&euml;indigd - en Parship voor dating op basis van persoonlijkheid), maar wij hebben niet alleen betere technologie&euml;n; we combineren ook nog eens deze systemen en breiden ze uit met &quot;playing field changing&quot; zelflerende functionaliteit.</p>";
		$this->load->view('about_view', $data);
		$this->load->view('common/footer');
	}
	
}