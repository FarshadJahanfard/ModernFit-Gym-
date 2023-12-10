document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('add-exercise').addEventListener('click', function () {
    var exerciseInputs = document.getElementById('exercise-inputs');
    var newExerciseInput = exerciseInputs.children[0].cloneNode(true);

    // Clear values for the new exercise
    newExerciseInput.querySelectorAll('input').forEach(function (input) {
      input.value = '';
    });

    exerciseInputs.appendChild(newExerciseInput);
  });

  // Event delegation to handle remove button clicks
  document.getElementById('exercise-inputs').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-exercise')) {
      event.target.closest('.exercise-group').remove();
    }
  });
});
