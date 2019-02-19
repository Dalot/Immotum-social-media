(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/bulma"],{

/***/ "./resources/js/bulma.js":
/*!*******************************!*\
  !*** ./resources/js/bulma.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// The following code is based off a toggle menu by @Bradcomp
// source: https://gist.github.com/Bradcomp/a9ef2ef322a8e8017443b626208999c1
(function () {
  var burger = document.querySelector('.burger');
  var menu = document.querySelector('#' + burger.dataset.target);
  burger.addEventListener('click', function () {
    burger.classList.toggle('is-active');
    menu.classList.toggle('is-active');
  });
})();

/***/ }),

/***/ 2:
/*!*************************************!*\
  !*** multi ./resources/js/bulma.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/dalot.xyz/laracast/resources/js/bulma.js */"./resources/js/bulma.js");


/***/ })

},[[2,"/js/manifest"]]]);