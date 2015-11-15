<?php


class ValidateComponent{

	private $_data, $_errors = array();
	private $validationRequirements = array(
			'name' 					=> 'required|maxlen, 64|minlen, 4',
			'editable'				=> 'required',
			'visible'				=> 'required|boolean',
			'elements'				=> 'required',
			'elements>text'					=> 'depends_on, elements',
			'elements>text>from'				=> 'depends_on, autocomplete|string',
			'elements>text>length'			=> 'depends_on, text|string|values("short", "long", "rich")',
			'elements>attachment'			=> 'depends_on, elements',
			'elements>attachment>type'		=> 'values("image", "video", "other")',
			'elements>attachment>whitelist'	=> 'conditional(attachment-type, other)|string',
			'elements>numeric'				=> 'depends_on, elements',
			'elements>numeric>type'			=> 'values("integer", noint", "fraction", "percent")',
			'elements>selectable'			=> 'depends_on, elements',
			'elements>selectable>type'		=> 'values("radio", "checkbox", "dropdown", "multi")',

		);

	public function validate($data)
	{	
		$this->_data = $data;
		$this->parseValidateRules();
		return $this->_errors;
	}

	private function parseValidateRules(){

				echo '<pre>';
				print_r($this->_data);
				echo '</pre>';

		foreach ($this->validationRequirements as $field => $ruleSet) {
			

			$rules = explode("|", $ruleSet);
			if(strstr($field, ">")) {
				$levels = explode(">", $field);
				$dataPiece = null;
				for ($i=0; $i < count($levels); $i++) { 
					echo $i;
					$dataPiece = $this->_data[$levels[$i]];
					print_r($dataPiece);
					//echo $dataPiece = $this->_data[$levels[$i]];
				}
				echo '<pre>';
				echo $dataPiece;
				echo '</pre>';
			}

		}
	}

}


?>