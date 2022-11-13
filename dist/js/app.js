/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/app.js":
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
/***/ (() => {

document.addEventListener("DOMContentLoaded", function () {
  var swiper = new Swiper(".centre__slider", {
    slidesPerView: 1,
    // slidesPerGroup: 3,
    // centeredSlides: true,
    spaceBetween: 30,
    initialSlide: 2,
    freeMode: true,
    // grabCursor: true,
    pagination: {
      el: ".swiper-pagination",
      type: "fraction"
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
  $('#formModal').on('shown.bs.modal', function () {
    $('#formModal').trigger('focus');
  });
  $('#formModal').on('shown.bs.modal', function () {
    $("#privacy").modal('hide');
  });
  $('#privacy').on('shown.bs.modal', function () {
    $("#formModal").modal('hide');
  });
  $(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length ? $(document.body).addClass('modal-open') : $(document.body).css({
      paddingRight: 0
    });
  }); //Animate

  var animItems = document.querySelectorAll('._anim-items');

  if (animItems.length > 0) {
    var animOnScroll = function animOnScroll() {
      for (var index = 0; index < animItems.length; index++) {
        var animItem = animItems[index];
        var animItemHeight = animItem.offsetHeight;
        var animItemOffset = offset(animItem).top;
        var animStart = 4;
        var animItemPoint = window.innerHeight - animItemHeight / animStart;

        if (animItemHeight > window.innerHeight) {
          animItemPoint = window.innerHeight - window.innerHeight / animStart;
        }

        if (pageYOffset > animItemOffset - animItemPoint && pageYOffset < animItemOffset + animItemHeight) {
          animItem.classList.add('_active');
        } else {
          animItem.classList.remove('_active');
        }
      }
    };

    var offset = function offset(el) {
      var rect = el.getBoundingClientRect(),
          scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
          scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      return {
        top: rect.top + scrollTop,
        left: rect.left + scrollLeft
      };
    };

    window.addEventListener('scroll', animOnScroll);
  }

  $(window).scroll(function () {
    var height = $(window).scrollTop();
    /*Если сделали скролл на 100px задаём новый класс для header*/

    if (height > 1010) {
      $('header').addClass('header-fixed');
    } else {
      /*Если меньше 100px удаляем класс для header*/
      $('header').removeClass('header-fixed');
    }
  });

  $.fn.setCursorPosition = function (pos) {
    if ($(this).get(0).setSelectionRange) {
      $(this).get(0).setSelectionRange(pos, pos);
    } else if ($(this).get(0).createTextRange) {
      var range = $(this).get(0).createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  };

  $("#phone").click(function () {
    $(this).setCursorPosition(3);
  }).mask("+7 (999) 999-99-99");
  $("#phone").mask("+7 (999) 999-99-99");
  $("#phone1").click(function () {
    $(this).setCursorPosition(3);
  }).mask("+7 (999) 999-99-99");
  $("#phone1").mask("+7 (999) 999-99-99");
  $("#phone2").click(function () {
    $(this).setCursorPosition(3);
  }).mask("+7 (999) 999-99-99");
  $("#phone2").mask("+7 (999) 999-99-99");
  $("#phone3").click(function () {
    $(this).setCursorPosition(3);
  }).mask("+7 (999) 999-99-99");
  $("#phone3").mask("+7 (999) 999-99-99");
  $("#form").validate({
    rules: {
      pnone: {
        required: true,
        minlength: 10
      }
    },
    submitHandler: function submitHandler(form, event) {
      event.preventDefault();
      alert("Do some stuff...");
    }
  });
  /*$(document).ready(function () {
    $('#btn_submit').click(function () {
      // собираем данные с формы
      var phone = $('#phone').val(); // отправляем данные

      $.ajax({
        url: "action.php",
        // куда отправляем
        type: "post",
        // метод передачи
        //dataType: "json",
        // тип передачи данных
        data: {
          // что отправляем
          "phone": phone
        },
        // после получения ответа сервера
        success: function success(data) {
          console.log(data.result);
          $('.messages').html(data.result); // выводим ответ сервера
        }
      });
    });
  });*/ // $(document).ready(function(){
  // 	$("#form").submit(function() { //устанавливаем событие отправки для формы с id=form
  // 			  var form_data = $(this).serialize(); //собераем все данные из формы
  // 			  $.ajax({
  // 			  type: 'POST', //Метод отправки
  // 			  url: 'action.php', //путь до php фаила отправителя
  // 			  data: form_data,
  //           success: function(data){ // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa
  //           alert('все хорошо'); // пoкaжeм eё тeкст
  //           }
  // 			  });
  // 	});
  // });    
});

/***/ }),

/***/ "./src/sass/main.sass":
/*!****************************!*\
  !*** ./src/sass/main.sass ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkmed"] = self["webpackChunkmed"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/main"], () => (__webpack_require__("./src/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/main"], () => (__webpack_require__("./src/sass/main.sass")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;









//тут наш ajax формы

$(document).ready(function(){
    $("#form").submit(function(e) {
            e.preventDefault();
            var form_data = $(this).serialize(); //собераем все данные из формы
            $.ajax({
            type: "POST", //Метод отправки
            url: "action.php", //путь до php фаила отправителя
            data: form_data,
            success: function() {
                   //код в этом блоке выполняется при успешной отправке сообщения
                   alert("Вcе збс!");
            }
    });
});
});