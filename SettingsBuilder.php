<?php

/*

This is the class that builds the HTML inside of each tab;

*/

class SettingsBuilder {


	public function __construct($tab = 'components'){
		switch ($tab) {
            case 'components':
                $this->buildComponents();
                break;
            case 'themes':
                $this->buildThemes();
                break;
            case 'general':
                $this->buildGeneral();
                break;
            case 'style':
                $this->buildStyle();
                break;
            default:
                # code...
                break;
        }
	}

	// Method to display the settings inside of the Components tab;
	private function buildComponents() {

		?>
		<a href="#" class="button">Create New Component</a>
		<ul id="ui-sortable">
			<li class="ui-state-default">Neshto</li>
			<li class="ui-state-default">Neshto</li>
			<li class="ui-state-default">Neshto</li>
			<li class="ui-state-default">Neshto</li>
		</ul>
		<?php

	}

	// Method to display the settings inside the Themes tab;
	private function buildThemes() {

	}

	// Method to display the settings inside the General tab;
	private function buildGeneral() {

	}

	// Method to display the settings inside the Styles tab;
	private function buildStyle() {

	}

}
?>