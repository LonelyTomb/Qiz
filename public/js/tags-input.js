/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 146);
/******/ })
/************************************************************************/
/******/ ({

/***/ 103:
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;(function(global,factory){if(true){!(__WEBPACK_AMD_DEFINE_ARRAY__ = [exports,module], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));}else if(typeof exports !== 'undefined' && typeof module !== 'undefined'){factory(exports,module);}else {var mod={exports:{}};factory(mod.exports,mod);global.tagsInput = mod.exports;}})(this,function(exports,module){'use strict';module.exports = tagsInput;var BACKSPACE=8,TAB=9,ENTER=13,LEFT=37,RIGHT=39,DELETE=46,COMMA=188;var SEPERATOR=',';var COPY_PROPS='placeholder pattern spellcheck autocomplete autocapitalize autofocus accessKey accept lang minLength maxLength required'.split(' ');function tagsInput(input){function createElement(type,name,text,attributes){var el=document.createElement(type);if(name)el.className = name;if(text)el.textContent = text;for(var key in attributes) {el.setAttribute('data-' + key,attributes[key]);}return el;}function $(selector,all){return all === true?Array.prototype.slice.call(base.querySelectorAll(selector)):base.querySelector(selector);}function getValue(){return $('.tag',true).map(function(tag){return tag.textContent;}).concat(base.input.value || []).join(SEPERATOR);}function setValue(value){$('.tag',true).forEach(function(t){return base.removeChild(t);});savePartialInput(value);}function save(){input.value = getValue();input.dispatchEvent(new Event('change'));}function addTag(text){if(~text.indexOf(SEPERATOR))text = text.split(SEPERATOR);if(Array.isArray(text))return text.forEach(addTag);var tag=text && text.trim();if(!tag)return false;if(!input.getAttribute('duplicates')){var _ret=(function(){var exisingTag=$('[data-tag="' + tag + '"]');if(exisingTag){exisingTag.classList.add('dupe');setTimeout(function(){return exisingTag.classList.remove('dupe');},100);return {v:false};}})();if(typeof _ret === 'object')return _ret.v;}base.insertBefore(createElement('span','tag',tag,{tag:tag}),base.input);}function select(el){var sel=$('.selected');if(sel)sel.classList.remove('selected');if(el)el.classList.add('selected');}function setInputWidth(){var last=$('.tag',true).pop(),w=base.offsetWidth;if(!w)return;base.input.style.width = Math.max(w - (last?last.offsetLeft + last.offsetWidth:5) - 5,w / 4) + 'px';}function savePartialInput(value){if(typeof value !== 'string' && !Array.isArray(value)){value = base.input.value;}if(addTag(value) !== false){base.input.value = '';save();setInputWidth();}}function refocus(e){if(e.target.classList.contains('tag'))select(e.target);if(e.target === base.input)return select();base.input.focus();e.preventDefault();return false;}var base=createElement('div','tags-input'),sib=input.nextSibling;input.parentNode[sib?'insertBefore':'appendChild'](base,sib);input.style.cssText = 'position:absolute;left:0;top:-99px;width:1px;height:1px;opacity:0.01;';input.tabIndex = -1;base.input = createElement('input');base.input.setAttribute('type','text');COPY_PROPS.forEach(function(prop){if(input[prop] !== base.input[prop]){base.input[prop] = input[prop];try{delete input[prop];}catch(e) {}}});base.appendChild(base.input);input.addEventListener('focus',function(){base.input.focus();});base.input.addEventListener('focus',function(){base.classList.add('focus');select();});base.input.addEventListener('blur',function(){base.classList.remove('focus');select();savePartialInput();});base.input.addEventListener('keydown',function(e){var el=base.input,key=e.keyCode || e.which,selectedTag=$('.tag.selected'),pos=el.selectionStart === el.selectionEnd && el.selectionStart,last=$('.tag',true).pop();setInputWidth();if(key === ENTER || key === COMMA || key === TAB){if(!el.value && key !== COMMA)return;savePartialInput();}else if(key === DELETE && selectedTag){if(selectedTag.nextSibling !== base.input)select(selectedTag.nextSibling);base.removeChild(selectedTag);setInputWidth();save();}else if(key === BACKSPACE){if(selectedTag){select(selectedTag.previousSibling);base.removeChild(selectedTag);setInputWidth();save();}else if(last && pos === 0){select(last);}else {return;}}else if(key === LEFT){if(selectedTag){if(selectedTag.previousSibling){select(selectedTag.previousSibling);}}else if(pos !== 0){return;}else {select(last);}}else if(key === RIGHT){if(!selectedTag)return;select(selectedTag.nextSibling);}else {return select();}e.preventDefault();return false;});base.input.addEventListener('input',function(){input.value = getValue();input.dispatchEvent(new Event('input'));});base.input.addEventListener('paste',function(){return setTimeout(savePartialInput,0);});base.addEventListener('mousedown',refocus);base.addEventListener('touchstart',refocus);base.setValue = setValue;base.getValue = getValue;savePartialInput(input.value);}tagsInput.enhance = tagsInput.tagsInput = tagsInput;});
//# sourceMappingURL=tags-input.js.map

/***/ }),

/***/ 146:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(103);


/***/ })

/******/ });