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
		<a href="#" class="button sp-trigger" data-modal="modal-1">Create New Component</a>
		<ul id="ui-sortable">
			<li class="ui-state-default">Neshto</li>
			<li class="ui-state-default">Neshto</li>
			<li class="ui-state-default">Neshto</li>
			<li class="ui-state-default">Neshto</li>
		</ul>


		<div class="sp-modal sp-effect-1" id="modal-1">
			<div class="sp-content">
				<h3>Create New Component</h3>
				<div>
					<p>This is a modal window. You can do the following things with it:</p>
					<ul>
						<li><strong>Read:</strong> Modal windows will probably tell you something important so don't forget to read what it says.</li>
						<li><strong>Look:</strong> modal windows enjoy a certain kind of attention; just look at it and appreciate its presence.</li>
						<li><strong>Close:</strong> click on the button below to close the modal.</li>
					</ul>
					<button class="sp-close">Close me!</button>
				</div>
			</div>
		</div>
		<div class="sp-overlay"></div>
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