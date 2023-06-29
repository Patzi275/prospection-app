const dgi = x => document.getElementById(x);
resetValidation();

/* Form validation */
const start_time = dgi('start_time');
const end_time = dgi('end_time');
const duration = dgi('duration');

if (start_time && end_time && duration) {
    start_time.addEventListener('change', manageFormDates);
    end_time.addEventListener('change', manageFormDates);
    manageFormDates();
}


function resetValidation() {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')
    if (forms) {
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
    
                    form.classList.add('was-validated')
                }, false)
            })
    }
}

function manageFormDates() {
    const start = start_time.valueAsDate;
    const end = end_time.valueAsDate;
    if (start && end) {
        if (end > start) {
            duration.valueAsDate = new Date(end - start);
        } else {
            end_time.value = null;
            duration.valueAsTime = end - start;
        }
    } else {
        duration.value = null;
    }
}