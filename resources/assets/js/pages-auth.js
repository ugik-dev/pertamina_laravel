/**
 *  Pages Authentication
 */

'use strict';
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'Please enter username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Please enter your email'
              },
              emailAddress: {
                message: 'Please enter valid email address'
              }
            }
          },
          'email-username': {
            validators: {
              notEmpty: {
                message: 'Please enter email / username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter your password'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'Please agree terms & conditions'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),

          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    // var loginForm = $("#loginForm");

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();
});

// formAuthenticationJq.on("submit", (ev) => {
//     ev.preventDefault();
//     Swal.fire({
//         title: "Please Wait !",
//         html: "Loggin ..", // add html attribute if you want or remove
//         allowOutsideClick: false,
//         allowEscapeKey: false,
//         customClass: {
//             confirmButton: "btn btn-primary waves-effect waves-light d-none",
//         },
//         buttonsStyling: false,
//         showCancelButton: false,
//         showConfirmButton: false,
//         showLoaderOnConfirm: false,
//     });
//     Swal.showLoading();
//     $.ajax({
//         url: "<?= url('login-process') ?>",
//         type: "POST",
//         data: loginForm.serialize(),
//         success: (data) => {
//             // buttonIdle(submitBtn);
//             json = JSON.parse(data);
//             if (json["error"]) {
//                 Swal.fire({
//                     icon: "error",
//                     title: "Login Gagal",
//                     text: json["message"],
//                 });
//                 // swal("Login Gagal", json['message'], "error");
//                 return;
//             }
//             // $(location).attr("href", "");
//         },
//         error: () => {
//             // buttonIdle(submitBtn);
//         },
//     });
// });
