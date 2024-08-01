<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Quality Data Entry</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #d0d0e1;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            margin-bottom: 10px;
            color: #007BFF;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .flex-row {
            display: flex;
            justify-content: space-between;
        }
        .flex-row .column {
            flex: 1;
            margin-right: 10px;
        }
        .flex-row .column:last-child {
            margin-right: 0;
        }
        button {
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 200px;
            margin: 0 auto;
        }
        button:hover {
            background-color: #0056b3;
        }
        .button-container {
            text-align: center;
        }
        .logout-button {
            padding: 6px 18px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        .logout-button:hover {
            background-color: #c82333;
        }span{
            float:right;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .validation-errors {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
    <span><a href="<?php echo base_url('logout'); ?>" class="logout-button">Logout</a></span><br>
        <h1>Water Quality Data Entry</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <p class="message success"><?php echo $this->session->flashdata('success'); ?></p>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <p class="message error"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
        <div class="validation-errors">
            <?php echo validation_errors(); ?>
        </div>
        <form id="dataEntryForm" action="<?php echo site_url('addData'); ?>" method="post">
            <div class="section">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>

            <div class="section">
                <h3>Production</h3>
                <label for="distribution_bulkmeter">Distribution Bulk Meter Reading:</label>
                <input type="text" id="distribution_bulkmeter" name="distribution_bulkmeter" required>
                <label for="distribution_pumping">Pumping Bulk Meter Reading:</label>
                <input type="text" id="distribution_pumping" name="distribution_pumping" required>
            </div>

            <div class="section">
                <h3>Water Quality</h3>
                <div class="flex-row">
                    <div class="column">
                        <h4>Raw Water</h4>
                        <label for="raw_turbidity">Turbidity:</label>
                        <input type="text" id="raw_turbidity" name="raw_turbidity" required>
                        <label for="raw_ph">pH:</label>
                        <input type="text" id="raw_ph" name="raw_ph" required>
                        <label for="raw_salinity">Salinity:</label>
                        <input type="text" id="raw_salinity" name="raw_salinity" required>
                    </div>
                    <div class="column">
                        <h4>Settling Water</h4>
                        <label for="settling_turbidity">Turbidity:</label>
                        <input type="text" id="settling_turbidity" name="settling_turbidity" required>
                        <label for="settling_ph">pH:</label>
                        <input type="text" id="settling_ph" name="settling_ph" required>
                        <label for="settling_salinity">Salinity:</label>
                        <input type="text" id="settling_salinity" name="settling_salinity" required>
                    </div>
                    <div class="column">
                        <h4>Treated Water</h4>
                        <label for="treated_turbidity">Turbidity:</label>
                        <input type="text" id="treated_turbidity" name="treated_turbidity" required>
                        <label for="treated_ph">pH:</label>
                        <input type="text" id="treated_ph" name="treated_ph" required>
                        <label for="treated_salinity">Salinity:</label>
                        <input type="text" id="treated_salinity" name="treated_salinity" required>
                        <label for="treated_rcl">RCL:</label>
                        <input type="text" id="treated_rcl" name="treated_rcl" required>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3>Chemical Usage</h3>
                <label for="pacl">PACL:</label>
                <input type="text" id="pacl" name="pacl" required>
                <label for="lime">Lime:</label>
                <input type="text" id="lime" name="lime" required>
                <label for="cl">Cl:</label>
                <input type="text" id="cl" name="cl" required>
            </div>

            <div class="section">
                <h3>Power Consumption</h3>
                <label for="diesel">Diesel:</label>
                <input type="text" id="diesel" name="diesel" required>
            </div>

            <div class="button-container">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</body>
</html>
