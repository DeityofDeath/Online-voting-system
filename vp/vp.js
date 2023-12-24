function toggleCandidateDetails(candidate) {
    const detailsContent = candidate.querySelector('.details-content');
    detailsContent.style.display = detailsContent.style.display === 'none' ? 'block' : 'none';

    const selectedCandidate = document.querySelector('.candidate-selected');
    if (selectedCandidate) {
        selectedCandidate.classList.remove('candidate-selected');
    }

    candidate.classList.add('candidate-selected');
}

function submitVote() {
    const selectedCandidateInput = document.querySelector('.candidate-selected input[name="vote"]');
    const candidateNumberInput = document.getElementById('candidateNumber');
    const candidateValue = selectedCandidateInput ? selectedCandidateInput.value : candidateNumberInput.value;

    if (candidateValue) {
        console.log(`Vote submitted for ${candidateValue}`);
        confirmVoteSubmission();
    } else {
        alert('Please select a candidate or enter a candidate number before submitting your vote.');
    }
}


function confirmVoteSubmission() {
    const confirmation = confirm('Are you sure you want to submit your vote?');
}