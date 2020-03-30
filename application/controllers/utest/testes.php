<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classe com os testes unitários
 * @author Vitor Oliveira <vitoro580@gmail.com>
 * 
 */
class Testes extends CI_Controller
{
	private $string_layot;



	/**
	 * Connstrutor da classe
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->model('user_model');
		$this->load->model('plan_model');
		$this->load->library('session');
		$this->layout();
	}




	/**
	 * Chama todos os testes
	 */
	public function index()
	{
		$this->test_if_exists_user_email();
		$this->test_if_user_has_plan_health();
	}






	/**
	 * 
	 * Personalizar o layout
	 * 
	 */
	private function layout()
	{
		$this->string_layot = '
		<style>
		.body {
			background-color:black;
		}
		table {
			border-collapse: collapse;
		}
		table tr {
			border: 1px solid black;
			color:white;
			font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace;
			font-size: 13px;
			font-style: normal;
			font-variant: normal;
			line-height: 10px;
			float:left;
		}
		</style>
		<body class="body">
		<table border="0" cellpadding="4" cellspacing="1">
		{rows}
		<tr>
		<!--<td>{item}</td>-->
		<td>{result}</td>
		</tr>
		{/rows}
		</table>
		</body>';

		$this->unit->set_test_items(array('test_name', 'result'));
		$this->unit->set_template($this->string_layot);
	}


	private function test_if_exists_user_email()
	{
		
		$test = $this->user_model->email_check("pedro@gmail.com");

		$expected_result = true;

		$test_name = '[USER_LOGIN]: teste if exists user email';

		echo $this->unit->run($test, $expected_result, $test_name);
	}

	private function test_if_user_has_plan_health()
	{
		$test_name = '[USER_HAS_PLAN_HEALTH]: test if user has plan health bind';

		$arr = $this->plan_model->return_plans_health();

		if ($arr == null) {

			$expected_result = 'is_true';

			$test = false;

		}

		$user = $this->user_model->return_user_by_name("Vitor");

		if ($user == null) {
			
			$expected_result = 'is_true';

			$test = false;
		}

		if (!empty($arr) AND !empty($user)) {

			if ((int)$arr[0]->fk_user_id == (int)$user[0]->user_id) {

				$expected_result = 'is_true';

				$test = true;

			}else {

				$expected_result = 'is_true';

				$test = false;
			}

		}


		echo $this->unit->run($test, $expected_result, $test_name);

	}
	
}

/* End of file testes.php */
/* Location: ./application/controllers/utestes/testes.php */