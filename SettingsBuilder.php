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
		<a href="#" class="button sp-trigger" data-modal="modal-1">+ Create New Component</a>

		<div class="sp-modal sp-effect-1" id="modal-1">
			<form action="" method="post">
			<div class="sp-content">
				<h3>Create New Component</h3>
				
					<div class="sp-modal-section">
						<h4>
							<div class="sp-arrow sp-arrow-down"></div>
							<span>Basic Settings</span>
						</h4>
						<div class="sp-modal-section-options">

							<label>
								1. Component Name (for identification purposes, can be customized when making a theme): <br/>
								<input type="text" name="name" placeholder="Component Name..." />
							</label>
							<p>Editable by: </p>
							<label>
								<input type="checkbox" name="editable[]" value="instructor" /> Instructor
							</label>
							<label>
								<input type="checkbox" name="editable[]" value="TA" /> TA
							</label>
							<label>
								<input type="checkbox" name="editable[]" value="student" /> Student
							</label>
							<p>Front-end visible: </p>
							<label>
								<input type="radio" name="visible" value="1" /> Visible
							</label>
							<label>
								<input type="radio" name="visible" value="0" /> Not Visible
							</label>
						</div>
					</div>
					<div class="sp-modal-section">
						<h4>
							<div class="sp-arrow sp-arrow-up"></div>
							<span>Includes Elements</span>
						</h4>
						<div class="sp-modal-section-options" style="display: none;">
							<p>Includes elements: </p>
							<label>
								<input type="checkbox" data="elements" element="text" name="elements[text]"/> Text
							</label> <br/>
							<label>
								<input type="checkbox" data="elements" element="attachment" name="elements[attachment]"/> Attachment
							</label> <br/>
							<label>
								<input type="checkbox" data="elements" element="numeric" name="elements[numeric]"/> Numeric
							</label> <br/>
							<label>
								<input type="checkbox" data="elements" element="selectable" name="elements[selectable]"/> Selectable
							</label> <br/>
						</div>
					</div>
					<div class="sp-modal-section" id="element-settings">
						<h4>
							<div class="sp-arrow sp-arrow-up"></div>
							<span>Element Settings: </span>
						</h4>
						<div class="sp-modal-section-options" style="display: none;">
							<p class="removeable">Please Select some element/s to include.</p>
							<div class="sp-modal-section inner" style="display: none;" id="text-settings">
								<h4>
									<div class="sp-arrow sp-arrow-up"></div>
									<span>Text Settings: </span>
								</h4>
								<div class="sp-modal-section-options" style="display: none;">
									<label>
										<input type="checkbox" class="sp-elements-primary" name="elements[text][autocomplete]" /> Autocomplete
									</label>
									<label class="secondary-options" style="display: none;">
										From:
										<select name="elements[text][from]">
											<option></option>
											<option value="users">Users</option>
											<option value="posts">Posts</option>
											<option value="pages">Pages</option>
											<option value="other">Other?</option>
										</select> 
									</label>
									<br/>
									<label>
										<input type="radio" name="elements[text][length]" value="short" /> Short
									</label>
									<label>
										<input type="radio" name="elements[text][length]" value="long" /> Long (Simple Textbox)
									</label>
									<label>
										<input type="radio" name="elements[text][length]" value="rich" /> Long (Rich-text)
									</label>
								</div>
							</div>
							<div class="sp-modal-section inner" style="display: none;" id="attachment-settings">
								<h4>
									<div class="sp-arrow sp-arrow-up"></div>
									<span>Attachement Settings: </span>
								</h4>
								<div class="sp-modal-section-options" style="display: none;">
									<label>
										<input type="radio" name="elements[attachment][type]" value="image" /> Image
									</label>
									<label>
										<input type="radio" name="elements[attachment][type]" value="video" /> Video
									</label>
									<label>
										<input type="radio" name="elements[attachment][type]" value="other" /> Other
										<br>
										Include allowable file formats: (whitelist)
										<input type="text" class="widefat" disabled="true" name="elements[attachment][whitelist]" />
									</label>
								</div>
							</div>
							<div class="sp-modal-section inner" style="display: none;" id="numeric-settings">
								<h4>
									<div class="sp-arrow sp-arrow-up"></div>
									<span>Numeric Settings: </span>
								</h4>
								<div class="sp-modal-section-options" style="display: none;">
									<label>
										<input type="radio" name="elements[numeric][type]" value="integer" /> Integer
									</label>
									<label>
										<input type="radio" name="elements[numeric][type]" value="nonint" /> Non-Integer
									</label>
									<label>
										<input type="radio" name="elements[numeric][type]" value="fraction" /> fraction
									</label>
									<label>
										<input type="radio" name="elements[numeric][type]" value="percent" /> Percent
									</label>
								</div>
							</div>
							<div class="sp-modal-section inner" style="display: none;" id="selectable-settings">
								<h4>
									<div class="sp-arrow sp-arrow-up"></div>
									<span>Selectable Settings: </span>
								</h4>
								<div class="sp-modal-section-options" style="display: none;">
									<label>
										<input type="radio" name="elements[selectable][type]" value="radio" /> Radio
									</label>
									<label>
										<input type="radio" name="elements[selectable][type]" value="checkbox" /> Checkbox
									</label>
									<label>
										<input type="radio" name="elements[selectable][type]" value="dropdown" /> Dropdown
									</label>
									<label>
										<input type="radio" name="elements[selectable][type]" value="multi" /> Multi-option Select
									</label>
								</div>
							</div>
						</div>
					</div>
			</div>

			<div id="options">
				<div>
					<button class="sp-accept" type="submit">Accept</button>
					<button class="sp-close" type="reset">Cancel</button>
				</div>
			</div>
			</form>
		</div>
		<div class="sp-overlay"></div>

		<div class="sp-all-components">
			<h3>Available Components: </h3>
		</div>
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