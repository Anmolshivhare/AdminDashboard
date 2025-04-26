import './bootstrap';
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import $ from 'jquery';
import select2 from "select2";
import 'select2/dist/css/select2.min.css';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
import 'laravel-datatables-vite';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'datatables.net';
import 'datatables.net-buttons';
import jszip from 'jszip';

// Assign JSZip globally for DataTables export to work
window.JSZip = jszip;

window.$ = window.jQuery = $;
select2();

$(document).ready(function () {
    let editorInstance;
    // Initialize CKEditor when the Offcanvas is shown
    $('.offcanvasScrolling').on('shown.bs.offcanvas', function () {
        if (!editorInstance) {
            ClassicEditor
                .create($('#editor')[0]) // jQuery selector needs [0] to get the DOM element
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
});

$(document).on('submit', '.dynamic-form', function (event) {
    event.preventDefault();
    let formData = new FormData(this);
    console.log(formData);
    let url = $(this).attr("action");

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false, // Prevent jQuery from automatically transforming the data into a query string
        contentType: false, // Let the browser set the Content-Type
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        success: function (response) {

            $('form')[0].reset();
            // Check if there's a success message and display it
            if (response.status === 'success') {
                window.location.href = response.redirect;
                if (response.message) {
                    toastr.success(response.message); // Show the success message
                }
            }
            // Handle custom errors (not validation)
            else if (response.status === 'error') {
                if (response.message) {
                    toastr.error(response.message); // Show the error message
                }
            } else {
                // Fallback for any unexpected errors
                toastr.error('An unexpected error occurred.');
            }

        },
        error: function (xhr) {
            // Handle validation errors
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                if (xhr.responseJSON.errors.name) {
                    $('#nameError').text(xhr.responseJSON.errors.name[0]).show();
                }

            }

        }
    });

});

//global search 
$(document).ready(function() {
    $('#search-input').select2({
        placeholder: 'Search...',
        ajax: {
            url: '/search/data',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    query: params.term,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                };
            },
            processResults: function (data, params) {
                // Get the current search term
                let term = params.term.toLowerCase();
                
                return {
                    results: data.map(function(item) {
                        // Check if the term matches the name or the email
                        let displayText = '';
                        if (item.name.toLowerCase().includes(term)) {
                            displayText = item.name;
                        } else if (item.email.toLowerCase().includes(term)) {
                            displayText = item.email;
                        }
            
                        return {
                            id: item.id,
                            text: displayText
                        };
                    })
                };
            },
            
            cache: true
        },
        minimumInputLength: 1
    });
});


//other js

let elements = document.getElementsByClassName('sidebar-arrow');
for (let i = 0; i < elements.length; i++) {
    elements[i].onclick = function () {
        let elem = document.body;
        elem.classList.toggle('mini-sidebar'); // Add or remove class
    };
}


//session timeout

let inactivityTime = 0;
let timeoutDuration = 3600 * 1000; // 1 minute (in milliseconds)

// Define the logout URL (it should use POST method)
let logoutUrl = "/logout"; // Laravel's logout route URL
console.log(logoutUrl);
function resetInactivityTimer() {
    inactivityTime = 0; // Reset timer on user activity
}

function checkInactivity() {
    inactivityTime += 1000; // Increase inactivity time by 1 second
    if (inactivityTime >= timeoutDuration) {
        // Perform the logout using a POST request
        logoutUser();
    }
}

function logoutUser() {
    // Create a form and submit it via POST to the logout route
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = logoutUrl;

    // Add CSRF token to the form (required by Laravel)
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    let csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    // Submit the form to trigger the logout action
    document.body.appendChild(form);
    form.submit();
}

// Event listeners for user activity
window.onload = function() {
    setInterval(checkInactivity, 1000); // Check every second for inactivity
    window.onmousemove = resetInactivityTimer; // Reset on mouse move
    window.onkeydown = resetInactivityTimer; // Reset on key press
};

 //role and permission nestedtree
document.addEventListener("DOMContentLoaded", function () {
    // When a parent checkbox is clicked, toggle its child checkboxes
    document
      .querySelectorAll(".parent-checkbox")
      .forEach(function (parentCheckbox) {
        parentCheckbox.addEventListener("change", function () {
          let parentId = this.value;
          let childCheckboxes = document.querySelectorAll(
            'input.child-checkbox[data-parent-id="' + parentId + '"]'
          );
  
          // Check or uncheck all child checkboxes based on the parent checkbox
          childCheckboxes.forEach(function (childCheckbox) {
            childCheckbox.checked = parentCheckbox.checked;
          });
  
          // Check/uncheck "Select All" if necessary
          updateSelectAllStatus();
        });
      });
  
    // "Select All" checkbox functionality
    let selectAllCheckbox = document.getElementById("select-all");
    if (selectAllCheckbox) {
      selectAllCheckbox.addEventListener("change", function () {
        let allCheckboxes = document.querySelectorAll(
          ".parent-checkbox, .child-checkbox"
        );
        allCheckboxes.forEach(function (checkbox) {
          checkbox.checked = selectAllCheckbox.checked;
        });
      });
    }
  
    // Function to update "Select All" checkbox based on individual selections
    function updateSelectAllStatus() {
      let allCheckboxes = document.querySelectorAll(
        ".parent-checkbox, .child-checkbox"
      );
      let allChecked = Array.from(allCheckboxes).every(function (checkbox) {
        return checkbox.checked;
      });
      selectAllCheckbox.checked = allChecked;
    }
  
    // Ensure "Select All" is updated if any individual checkbox is manually changed
    document
      .querySelectorAll(".child-checkbox")
      .forEach(function (childCheckbox) {
        childCheckbox.addEventListener("change", function () {
          // Get the parent checkbox associated with this child
          let parentId = this.getAttribute("data-parent-id");
          let parentCheckbox = document.querySelector(
            'input.parent-checkbox[value="' + parentId + '"]'
          );
          // If any child is checked, ensure the parent iimport { Calendar } from '@fullcalendar/core';
          let childCheckboxes = document.querySelectorAll(
            'input.child-checkbox[data-parent-id="' + parentId + '"]'
          );
          let anyChildChecked = Array.from(childCheckboxes).some(function (
            child
          ) {
            return child.checked;
          });
          parentCheckbox.checked = anyChildChecked;
          // Update "Select All" checkbox status
          updateSelectAllStatus();
        });
      });
  });