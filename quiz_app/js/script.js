// js/script.js
document.addEventListener('DOMContentLoaded', function(){
  const form = document.getElementById('quizForm');
  if (!form) return;
  form.addEventListener('submit', function(e){
    // simple check: at least one radio selected
    const radios = form.querySelectorAll('input[type="radio"]');
    let chosen = false;
    for (let r of radios) if (r.checked) { chosen = true; break; }
    if (!chosen) {
      if (!confirm('You did not choose any answer. Submit anyway?')) {
        e.preventDefault();
      }
    }
  });
});
