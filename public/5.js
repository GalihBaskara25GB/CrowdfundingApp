(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Register.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Register.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'register',
  components: {
    'validation-errors': function validationErrors() {
      return __webpack_require__.e(/*! import() */ 10).then(__webpack_require__.bind(null, /*! ./ValidationError */ "./resources/js/components/ValidationError.vue"));
    }
  },
  data: function data() {
    var _ref;

    return _ref = {
      valid: true,
      email: '',
      emailRules: [function (v) {
        return !!v || 'Email is required';
      }, function (v) {
        return /([a-zA-Z0-9_]{1,})(@)([a-zA-Z0-9_]{2,}).([a-zA-Z0-9_]{2,})+/.test(v) || 'Email is not valid';
      }],
      fullName: ''
    }, _defineProperty(_ref, "email", ''), _defineProperty(_ref, "password", ''), _defineProperty(_ref, "password_confirmation", ''), _defineProperty(_ref, "showPassword", false), _defineProperty(_ref, "showConfirmationPassword", false), _defineProperty(_ref, "passwordRules", [function (v) {
      return !!v || 'Password is required';
    }, function (v) {
      return v && v.length >= 6 || 'Type at least 6 characters';
    }]), _defineProperty(_ref, "rules", {
      required: function required(value) {
        return !!value || 'Required.';
      },
      min: function min(v) {
        return v && v.length >= 8 || 'Min 8 characters';
      }
    }), _defineProperty(_ref, "message", ''), _defineProperty(_ref, "otpCode", ''), _defineProperty(_ref, "showRegisterForm", true), _defineProperty(_ref, "showVerifyOtp", false), _defineProperty(_ref, "showUpdatePassword", false), _defineProperty(_ref, "validationErrors", ''), _ref;
  },
  computed: _objectSpread(_objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])({
    user: 'auth/user'
  })), {}, {
    passwordMatch: function passwordMatch() {
      var _this = this;

      return function () {
        return _this.password === _this.password_confirmation || "Password must match";
      };
    }
  }),
  methods: _objectSpread(_objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])({
    setAlert: 'alert/set',
    setAuth: 'auth/set'
  })), {}, {
    reset: function reset() {
      this.$refs.registerForm.reset();
    },
    resetValidation: function resetValidation() {
      this.$refs.registerForm.resetValidation();
    },
    registerSubmit: function registerSubmit() {
      var _this2 = this;

      if (this.$refs.registerForm.validate()) {
        var formData = {
          'name': this.fullName,
          'email': this.email
        };
        axios.post('/api/auth/register', formData).then(function (response) {
          _this2.message = response.data.response_message;

          if (response.data.response_code == '00') {
            _this2.setAlert({
              status: true,
              color: 'success',
              text: _this2.message
            });

            _this2.showRegisterForm = false;
            _this2.showVerifyOtp = true;
            _this2.showUpdatePassword = false;
            _this2.validationErrors = '';
          } else {
            _this2.setAlert({
              status: true,
              color: 'error',
              text: _this2.message
            });
          }
        })["catch"](function (error) {
          var errMessages = '';
          var errMessage = 'Something Went Wrong :(';

          if (error.response.status == 422 && error.response.status !== undefined) {
            errMessage = error.response.data.message;
            _this2.validationErrors = error.response.data.errors;
          }

          _this2.setAlert({
            status: true,
            color: 'error',
            text: errMessage
          });
        });
      }
    },
    verifyOtp: function verifyOtp() {
      var _this3 = this;

      if (this.$refs.registerForm.validate()) {
        var formData = {
          'otp_code': this.otpCode
        };
        axios.post('/api/auth/verification', formData).then(function (response) {
          _this3.message = response.data.response_message;

          if (response.data.response_code == '00') {
            _this3.setAlert({
              status: true,
              color: 'success',
              text: _this3.message
            });

            _this3.showRegisterForm = false;
            _this3.showVerifyOtp = false;
            _this3.showUpdatePassword = true;
          } else {
            _this3.setAlert({
              status: true,
              color: 'error',
              text: _this3.message
            });
          }
        })["catch"](function (error) {
          var responses = error.response;

          _this3.setAlert({
            status: true,
            color: 'error',
            text: responses.data.error
          });
        });
      }
    },
    regenerateOtp: function regenerateOtp() {
      var _this4 = this;

      var formData = {
        'email': this.email
      };
      axios.post('/api/auth/regenerate-otp', formData).then(function (response) {
        var data = response.data.data;
        _this4.message = response.data.response_message;

        if (response.data.response_code == '00') {
          _this4.setAlert({
            status: true,
            color: 'success',
            text: _this4.message
          });
        } else {
          _this4.setAlert({
            status: true,
            color: 'error',
            text: _this4.message
          });
        }
      })["catch"](function (error) {
        var responses = error.response;

        _this4.setAlert({
          status: true,
          color: 'error',
          text: responses.data.error
        });
      });
    },
    updatePassword: function updatePassword() {
      var _this5 = this;

      if (this.$refs.registerForm.validate()) {
        var formData = {
          'email': this.email,
          'password': this.password,
          'password_confirmation': this.password_confirmation
        };
        axios.post('/api/auth/update-password', formData).then(function (response) {
          var regristrateUser = response.data.data.user;
          _this5.message = response.data.response_message;

          if (response.data.response_code == '00') {
            _this5.setAlert({
              status: true,
              color: 'success',
              text: _this5.message
            });

            _this5.showRegisterForm = false;
            _this5.showVerifyOtp = false;
            _this5.showUpdatePassword = false;

            _this5.login(formData.email, formData.password);

            _this5.close();
          } else {
            _this5.setAlert({
              status: true,
              color: 'error',
              text: _this5.message
            });
          }
        })["catch"](function (error) {
          var responses = error.response;

          _this5.setAlert({
            status: true,
            color: 'error',
            text: responses.data.error
          });
        });
      }
    },
    close: function close() {
      this.$emit('closed', false);
    },
    login: function login(email, password) {
      var _this6 = this;

      var formData = {
        'email': email,
        'password': password
      };
      axios.post('/api/auth/login', formData).then(function (response) {
        var data = response.data.data;

        _this6.setAuth(data);

        if (_this6.user.user.id.length > 0) {
          _this6.setAlert({
            status: true,
            color: 'success',
            text: 'Login Success'
          });
        } else {
          _this6.setAlert({
            status: true,
            color: 'error',
            text: 'Login Failed'
          });
        }
      })["catch"](function (error) {
        var responses = error.response;

        _this6.setAlert({
          status: true,
          color: 'error',
          text: responses.data.error
        });
      });
    }
  })
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Register.vue?vue&type=template&id=97358ae4&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Register.vue?vue&type=template&id=97358ae4& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-card",
    [
      _c(
        "v-toolbar",
        { attrs: { dark: "", color: "orange" } },
        [
          _c(
            "v-btn",
            {
              attrs: { icon: "", dark: "" },
              nativeOn: {
                click: function($event) {
                  return _vm.close($event)
                }
              }
            },
            [_c("v-icon", [_vm._v("mdi-close")])],
            1
          ),
          _vm._v(" "),
          _c("v-toolbar-title", [_vm._v("Register")])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-container",
        { attrs: { fluid: "" } },
        [
          _c(
            "v-form",
            {
              ref: "registerForm",
              attrs: { "lazy-validation": "" },
              model: {
                value: _vm.valid,
                callback: function($$v) {
                  _vm.valid = $$v
                },
                expression: "valid"
              }
            },
            [
              _vm.validationErrors
                ? _c("validation-errors", {
                    attrs: { errors: _vm.validationErrors }
                  })
                : _vm._e(),
              _vm._v(" "),
              _vm.showRegisterForm
                ? _c(
                    "div",
                    [
                      _c("v-text-field", {
                        attrs: {
                          rules: [_vm.rules.required],
                          label: "Full Name",
                          maxlength: "40",
                          required: ""
                        },
                        model: {
                          value: _vm.fullName,
                          callback: function($$v) {
                            _vm.fullName = $$v
                          },
                          expression: "fullName"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: {
                          rules: _vm.emailRules,
                          label: "E-mail",
                          required: ""
                        },
                        model: {
                          value: _vm.email,
                          callback: function($$v) {
                            _vm.email = $$v
                          },
                          expression: "email"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-spacer"),
                      _vm._v(" "),
                      _c(
                        "v-col",
                        {
                          staticClass: "d-flex ml-auto",
                          attrs: { cols: "12", sm: "3", xsm: "12" }
                        },
                        [
                          _c(
                            "v-btn",
                            {
                              attrs: {
                                block: "",
                                disabled: !_vm.valid,
                                color: "orange"
                              },
                              on: { click: _vm.registerSubmit }
                            },
                            [
                              _vm._v(
                                "\n                      Get My OTP Codes\n                  "
                              )
                            ]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.showVerifyOtp
                ? _c(
                    "div",
                    [
                      _c("v-col", { attrs: { cols: "12" } }, [
                        _c("p", [
                          _vm._v(
                            "\n                  Hi, " +
                              _vm._s(_vm.fullName) +
                              "\n                  Check Your Email, we have sent OTP Code to " +
                              _vm._s(_vm.email) +
                              "\n                "
                          )
                        ])
                      ]),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: {
                          label: "OTP Codes",
                          rules: [_vm.rules.required],
                          required: ""
                        },
                        model: {
                          value: _vm.otpCode,
                          callback: function($$v) {
                            _vm.otpCode = $$v
                          },
                          expression: "otpCode"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-spacer"),
                      _vm._v(" "),
                      _c(
                        "v-col",
                        {
                          staticClass: "d-flex ml-auto",
                          attrs: { cols: "12", sm: "3", xsm: "12" }
                        },
                        [
                          _c(
                            "v-btn",
                            {
                              attrs: {
                                block: "",
                                disabled: !_vm.valid,
                                color: "orange",
                                outlined: ""
                              },
                              on: { click: _vm.verifyOtp }
                            },
                            [
                              _vm._v(
                                "\n                      Verify\n                  "
                              )
                            ]
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "v-col",
                        {
                          staticClass: "d-flex ml-auto",
                          attrs: { cols: "12", sm: "3", xsm: "12" }
                        },
                        [
                          _c(
                            "v-btn",
                            {
                              attrs: { block: "", color: "orange" },
                              on: { click: _vm.regenerateOtp }
                            },
                            [
                              _vm._v(
                                "\n                      Regenerate OTP Code\n                  "
                              )
                            ]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.showUpdatePassword
                ? _c(
                    "div",
                    [
                      _c("v-col", { attrs: { cols: "12" } }, [
                        _vm._v("\n                welcome "),
                        _c("b", [_vm._v(_vm._s(_vm.fullName))]),
                        _vm._v(
                          ", please set your account password.\n              "
                        )
                      ]),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: {
                          rules: _vm.passwordRules,
                          type: _vm.showPassword ? "text" : "password",
                          label: "Password",
                          hint: "At least 6 characters",
                          required: "",
                          "append-icon": _vm.showPassword
                            ? "mdi-eye"
                            : "mdi-eye-off"
                        },
                        on: {
                          "click:append": function($event) {
                            _vm.showPassword = !_vm.showPassword
                          }
                        },
                        model: {
                          value: _vm.password,
                          callback: function($$v) {
                            _vm.password = $$v
                          },
                          expression: "password"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: {
                          rules: [_vm.passwordRules, _vm.passwordMatch],
                          type: _vm.showConfirmationPassword
                            ? "text"
                            : "password",
                          label: "Password",
                          hint: "At least 6 characters",
                          required: "",
                          "append-icon": _vm.showPassword
                            ? "mdi-eye"
                            : "mdi-eye-off"
                        },
                        on: {
                          "click:append": function($event) {
                            _vm.showConfirmationPassword = !_vm.showConfirmationPassword
                          }
                        },
                        model: {
                          value: _vm.password_confirmation,
                          callback: function($$v) {
                            _vm.password_confirmation = $$v
                          },
                          expression: "password_confirmation"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-spacer"),
                      _vm._v(" "),
                      _c(
                        "v-col",
                        {
                          staticClass: "d-flex ml-auto",
                          attrs: { cols: "12", sm: "3", xsm: "12" }
                        },
                        [
                          _c(
                            "v-btn",
                            {
                              attrs: {
                                block: "",
                                disabled: !_vm.valid,
                                color: "orange",
                                outlined: ""
                              },
                              on: { click: _vm.updatePassword }
                            },
                            [
                              _vm._v(
                                "\n                      Register\n                  "
                              )
                            ]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                : _vm._e()
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Register.vue":
/*!**********************************************!*\
  !*** ./resources/js/components/Register.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Register_vue_vue_type_template_id_97358ae4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Register.vue?vue&type=template&id=97358ae4& */ "./resources/js/components/Register.vue?vue&type=template&id=97358ae4&");
/* harmony import */ var _Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Register.vue?vue&type=script&lang=js& */ "./resources/js/components/Register.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Register_vue_vue_type_template_id_97358ae4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Register_vue_vue_type_template_id_97358ae4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Register.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Register.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/components/Register.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Register.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Register.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Register.vue?vue&type=template&id=97358ae4&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/Register.vue?vue&type=template&id=97358ae4& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_97358ae4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Register.vue?vue&type=template&id=97358ae4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Register.vue?vue&type=template&id=97358ae4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_97358ae4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_97358ae4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);