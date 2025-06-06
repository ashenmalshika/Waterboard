function showSection(sectionId) {
    // Hide all sections
    document.getElementById('2hour').classList.add('hidden');
    document.getElementById('daily').classList.add('hidden');
    document.getElementById('monthly').classList.add('hidden');
    document.getElementById('8hour').classList.add('hidden');

    // Show the selected section
    document.getElementById(sectionId).classList.remove('hidden');

    // Show the submit button
    document.getElementById('submit-container').classList.remove('hidden');
}

// Add event listeners to the radio buttons
document.addEventListener('DOMContentLoaded', function() {
    var radios = document.querySelectorAll('input[type="radio"][name="form_type"]');
    radios.forEach(radio => {
        radio.addEventListener('click', function() {
            // Use a switch case for clarity and correct section mapping
            let sectionToShow;
            switch (this.value) {
                case '1':
                    sectionToShow = '2hour';
                    break;
                case '2':
                    sectionToShow = 'daily';
                    break;
                case '3':
                    sectionToShow = 'monthly';
                    break;
                case '4':
                    sectionToShow = '8hour';
                    break;
            }
            showSection(sectionToShow);
        });
    });
});

function updatePipeVisibility(pipeCount) {
    // Reset active class for all buttons
    document.getElementById('btn_one_pipe').classList.remove('active');
    document.getElementById('btn_two_pipes').classList.remove('active');
    document.getElementById('btn_three_pipes').classList.remove('active');

    // Hide all pipe details initially
    document.getElementById('pipe1_details').classList.add('hidden');
    document.getElementById('pipe2_details').classList.add('hidden');
    document.getElementById('pipe3_details').classList.add('hidden');

    // Show details for the selected number of pipes and activate button
    if (pipeCount >= 1) {
        document.getElementById('pipe1_details').classList.remove('hidden');
        document.getElementById('btn_one_pipe').classList.add('active');
    }
    if (pipeCount >= 2) {
        document.getElementById('pipe2_details').classList.remove('hidden');
        document.getElementById('btn_two_pipes').classList.add('active');
    }
    if (pipeCount >= 3) {
        document.getElementById('pipe3_details').classList.remove('hidden');
        document.getElementById('btn_three_pipes').classList.add('active');
    }
}
function updateShiftVisibility(shiftCount) {
    // Reset active class for all buttons
    document.getElementById('btn_one_shift').classList.remove('active');
    document.getElementById('btn_two_shift').classList.remove('active');
    document.getElementById('btn_three_shift').classList.remove('active');

    // Hide all pipe details initially
    document.getElementById('shift1_details').classList.add('hidden');
    document.getElementById('shift2_details').classList.add('hidden');
    document.getElementById('shift3_details').classList.add('hidden');

    // Show details for the selected number of pipes and activate button
    if (shiftCount >= 1) {
        document.getElementById('shift1_details').classList.remove('hidden');
        document.getElementById('btn_one_shift').classList.add('active');
    }
    if (shiftCount >= 2) {
        document.getElementById('shift2_details').classList.remove('hidden');
        document.getElementById('btn_two_shift').classList.add('active');
    }
    if (shiftCount >= 3) {
        document.getElementById('shift3_details').classList.remove('hidden');
        document.getElementById('btn_three_shift').classList.add('active');
    }
}
function updateRawPipeVisibility(pipeCount) {
    // Reset active class for all buttons
    document.getElementById('btn_one_pipe').classList.remove('active');
    document.getElementById('btn_two_pipes').classList.remove('active');
    document.getElementById('btn_three_pipes').classList.remove('active');

    // Hide all pipe details initially
    document.getElementById('pipe1_raw').classList.add('hidden');
    document.getElementById('pipe2_raw').classList.add('hidden');
    document.getElementById('pipe3_raw').classList.add('hidden');

    // Show details for the selected number of pipes and activate button
    if (pipeCount >= 1) {
        document.getElementById('pipe1_raw').classList.remove('hidden');
        document.getElementById('btn_one_pipe').classList.add('active');
    }
    if (pipeCount >= 2) {
        document.getElementById('pipe2_raw').classList.remove('hidden');
        document.getElementById('btn_two_pipes').classList.add('active');
    }
    if (pipeCount >= 3) {
        document.getElementById('pipe3_raw').classList.remove('hidden');
        document.getElementById('btn_three_pipes').classList.add('active');
    }
}
function updatePumpingPipeVisibility(pipeCount) {
    // Reset active class for all buttons
    document.getElementById('btn_four_pipe').classList.remove('active');
    document.getElementById('btn_five_pipes').classList.remove('active');
    document.getElementById('btn_six_pipes').classList.remove('active');

    // Hide all pipe details initially
    document.getElementById('pipe1_pumping').classList.add('hidden');
    document.getElementById('pipe2_pumping').classList.add('hidden');
    document.getElementById('pipe3_pumping').classList.add('hidden');

    // Show details for the selected number of pipes and activate button
    if (pipeCount >= 1) {
        document.getElementById('pipe1_pumping').classList.remove('hidden');
        document.getElementById('btn_four_pipe').classList.add('active');
    }
    if (pipeCount >= 2) {
        document.getElementById('pipe2_pumping').classList.remove('hidden');
        document.getElementById('btn_five_pipes').classList.add('active');
    }
    if (pipeCount >= 3) {
        document.getElementById('pipe3_pumping').classList.remove('hidden');
        document.getElementById('btn_six_pipes').classList.add('active');
    }
}
function updateDistributionPipeVisibility(pipeCount) {
    // Reset active class for all buttons
    document.getElementById('btn_seven_pipe').classList.remove('active');
    document.getElementById('btn_eight_pipes').classList.remove('active');
    document.getElementById('btn_nine_pipes').classList.remove('active');

    // Hide all pipe details initially
    document.getElementById('pipe1_distribution').classList.add('hidden');
    document.getElementById('pipe2_distribution').classList.add('hidden');
    document.getElementById('pipe3_distribution').classList.add('hidden');

    // Show details for the selected number of pipes and activate button
    if (pipeCount >= 1) {
        document.getElementById('pipe1_distribution').classList.remove('hidden');
        document.getElementById('btn_seven_pipe').classList.add('active');
    }
    if (pipeCount >= 2) {
        document.getElementById('pipe2_distribution').classList.remove('hidden');
        document.getElementById('btn_eight_pipes').classList.add('active');
    }
    if (pipeCount >= 3) {
        document.getElementById('pipe3_distribution').classList.remove('hidden');
        document.getElementById('btn_nine_pipes').classList.add('active');
    }
}

// function showSection(sectionId, btn) {
//     // Hide all sections
//     document.getElementById('2hour').classList.add('hidden');
//     document.getElementById('daily').classList.add('hidden');
//     document.getElementById('monthly').classList.add('hidden');
//     // Show the selected section
//     document.getElementById(sectionId).classList.remove('hidden');

//     // Reset button colors
//     document.getElementById('btn-2hour').classList.remove('active');
//     document.getElementById('btn-daily').classList.remove('active');
//     document.getElementById('btn-monthly').classList.remove('active');

//     // Set the clicked button to active (green)
//     btn.classList.add('active');

//     // Show the submit button
//     document.getElementById('submit-container').classList.remove('hidden');
// }
function goBack() {
    window.history.back();
}