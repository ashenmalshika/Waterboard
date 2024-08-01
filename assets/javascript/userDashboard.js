
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

function showSection(sectionId, btn) {
    // Hide all sections
    document.getElementById('2hour').classList.add('hidden');
    document.getElementById('daily').classList.add('hidden');
    document.getElementById('monthly').classList.add('hidden');
    // Show the selected section
    document.getElementById(sectionId).classList.remove('hidden');

    // Reset button colors
    document.getElementById('btn-2hour').classList.remove('active');
    document.getElementById('btn-daily').classList.remove('active');
    document.getElementById('btn-monthly').classList.remove('active');

    // Set the clicked button to active (green)
    btn.classList.add('active');

    // Show the submit button
    document.getElementById('submit-container').classList.remove('hidden');
}
  