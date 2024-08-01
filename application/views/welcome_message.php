<div class="section">
    <h3>Select number of Pipes:</h3>
    <div>
        <button type="button" id="btn_one_pipe" class="form-selection-button" onclick="updatePipeVisibility(1)">One Pipe</button>
        <button type="button" id="btn_two_pipes" class="form-selection-button" onclick="updatePipeVisibility(2)">Two Pipes</button>
        <button type="button" id="btn_three_pipes" class="form-selection-button" onclick="updatePipeVisibility(3)">Three Pipes</button>
    </div>
</div>

<div id="pipe1_details" class="unique-card hidden">
    <!-- Details for Pipe 1 -->
    <h4>PIPE 1</h4>
    <div class="unique-column">
		<div>
			<h4>Distribution</h4>
			<label class="unique-label" for="distribution_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="distribution_diameter" name="distribution_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="bulkmeter_id" name="bulkmeter_id" required>

			<label class="unique-label" for="bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="bulkmeter_reading" name="bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
		<div>
			<h4>Pumping</h4>
			<label class="unique-label" for="pumping_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="pumping_diameter" name="pumping_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="pumping_bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="pumping_bulkmeter_id" name="pumping_bulkmeter_id" required">

			<label class="unique-label" for="pumping_bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="pumping_bulkmeter_reading" name="pumping_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
		<div>
			<h4>Raw Water</h4>
			<label class="unique-label" for="raw_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="raw_diameter" name="raw_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="raw_bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="raw_bulkmeter_id" name="raw_bulkmeter_id" required">

			<label class="unique-label" for="raw_bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="raw_bulkmeter_reading" name="raw_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
	</div>
</div>

<div id="pipe2_details" class="unique-card hidden">
    <!-- Details for Pipe 2 -->
    <h4>PIPE 2</h4>
    <div class="unique-column">
		<div>
			<h4>Distribution</h4>
			<label class="unique-label" for="distribution_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="distribution_diameter" name="distribution_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="bulkmeter_id" name="bulkmeter_id" required>

			<label class="unique-label" for="bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="bulkmeter_reading" name="bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
		<div>
			<h4>Pumping</h4>
			<label class="unique-label" for="pumping_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="pumping_diameter" name="pumping_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="pumping_bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="pumping_bulkmeter_id" name="pumping_bulkmeter_id" required">

			<label class="unique-label" for="pumping_bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="pumping_bulkmeter_reading" name="pumping_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
		<div>
			<h4>Raw Water</h4>
			<label class="unique-label" for="raw_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="raw_diameter" name="raw_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="raw_bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="raw_bulkmeter_id" name="raw_bulkmeter_id" required">

			<label class="unique-label" for="raw_bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="raw_bulkmeter_reading" name="raw_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
	</div>
</div>

<div id="pipe3_details" class="unique-card hidden">
    <!-- Details for Pipe 3 -->
    <h4>PIPE 3</h4>
    <div class="unique-column">
		<div>
			<h4>Distribution</h4>
			<label class="unique-label" for="distribution_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="distribution_diameter" name="distribution_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="bulkmeter_id" name="bulkmeter_id" required>

			<label class="unique-label" for="bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="bulkmeter_reading" name="bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
		<div>
			<h4>Pumping</h4>
			<label class="unique-label" for="pumping_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="pumping_diameter" name="pumping_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="pumping_bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="pumping_bulkmeter_id" name="pumping_bulkmeter_id" required">

			<label class="unique-label" for="pumping_bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="pumping_bulkmeter_reading" name="pumping_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
		<div>
			<h4>Raw Water</h4>
			<label class="unique-label" for="raw_diameter">Diameter:</label>
			<input class="unique-input" type="text" id="raw_diameter" name="raw_diameter" required pattern="\d+" title="Please enter a whole number">

			<label class="unique-label" for="raw_bulkmeter_id">Bulk Meter ID:</label>
			<input class="unique-input" type="text" id="raw_bulkmeter_id" name="raw_bulkmeter_id" required">

			<label class="unique-label" for="raw_bulkmeter_reading">Bulk Meter Reading:</label>
			<input class="unique-input" type="text" id="raw_bulkmeter_reading" name="raw_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
		</div>
	</div>
</div>
