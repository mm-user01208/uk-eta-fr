$(function () {
  // グローバルナビ オーバーレイ表示切り替え
  $(".global-nav-more,.global-nav-expand").on({
    mouseenter: function () {
      $(".global-nav-expand").show();
    },
    mouseleave: function () {
      $(".global-nav-expand").hide();
    },
  });

  // スマートフォン メニュー開閉
  $("#sp-menu-btn").click(function () {
    $("#global-nav-sp").slideToggle();
    $(this).find("i").toggleClass("icon-menu");
    $(this).find("i").toggleClass("icon-close");
  });

  // スマートフォン メニューリスト開閉
  $(".global-nav.sp-only .global-nav-more").click(function () {
    $(".global-nav.sp-only .common-nav").slideToggle();
    $(this).find("i").toggleClass("icon-plus");
    $(this).find("i").toggleClass("icon-hyphen");
  });
  $(".global-nav.sp-only .common-nav h2 i").click(function () {
    $(this).parents("h2").next("ul").slideToggle();
    $(this).toggleClass("icon-plus");
    $(this).toggleClass("icon-hyphen");
  });

  $("footer .common-nav p i").click(function () {
    $(this).parents("p").next(".list-wrap").slideToggle();
    $(this).toggleClass("icon-plus");
    $(this).toggleClass("icon-hyphen");
  });

  // 申請ボタンのフローティング
  $("#floating-on").waypoint(
    function (direction) {
      if (direction === "down") {
        $(".footer-fixed").fadeIn("fast");
      } else {
        $(".footer-fixed").fadeOut("fast");
      }
    },
    { offset: "0%" }
  );

  $("#floating-off").waypoint(
    function (direction) {
      if (direction === "down") {
        $(".footer-fixed").fadeOut("fast");
      } else {
        $(".footer-fixed").fadeIn("fast");
      }
    },
    { offset: "70%" }
  );

  // 目次開閉
  let tocNav = $('div#ez-toc-container.toggle-contents nav');

  tocNav.css({
    "height": "200px",
  });

  $("#ez-toc-container a.ez-toc-toggle").on("click", function () {
    $(this).toggleClass("on");
  });

  let toc_container = $('div#ez-toc-container');

  function appendContract() {
    toc_container.append(
      '<div class="toc_contract"><p></p></div>'
    );  
  }

  function appendExpand() {
    toc_container.append(
      '<div class="toc_expand"><p></p></div>'
    );  
  }
  
  appendExpand();

  $('body').on('click', '.toc_expand' , function() {
    $(this).remove();
    tocNav.css({
      "height": "auto",
    });
    appendContract();
  });

  $('body').on('click', '.toc_contract' , function() {
    $(this).remove();
    tocNav.css({
      "height": "200px",
    });
    appendExpand();
  });

  // スムーススクロール
  // $(document).on( 'click', 'a[href^="#"]', function(e) {
  //   e.preventDefault(e);
  //   var href = $(this).attr("href");
  //   var target = href == "#" || href == "" ? 'html' : href;
  //   scrollhash(target);
  //   // 課題一度通過しないと高さが正確に取れないため、処理を2回

  // });

  // let scrollhash = (target) => {

  //   let boolFixed = $('header').hasClass('sp-fixed');
  //   let windowWidth = $(window).width();
  //   let speed = 0;
  //   let offset = 0;
  //   if(windowWidth <= 768){
  //     offset -= 50;
  //   }
  //   var position = $(target).get(0).offsetTop - offset;
  //   location.hash = target;
  //   window.scroll(0, position);
  // }

  // ページ内スムーズスクロール
  // $(".scroll-top a").click(function () {
  //   var speed = 700;
  //   var position = 0;
  //   $("body,html").animate({ scrollTop: position }, speed, "swing");
  //   return false;
  // });

  // 目次開閉
  // $("#ez-toc-container a.ez-toc-toggle").on("click", function () {
  //   $(this).toggleClass("on");
  // });

  $('.answer').hide();

  $('.question').on('click', function () {
    $(this).next('.answer').stop().slideToggle(300);
    $(this).toggleClass('is-open');
  });
});


// URLパラメータ取得

var param = location.search;
param = param.slice(1);

if (navigator.cookieEnabled) {
  if (param) {
    document.cookie = param;
  }
}
/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-webp-setclasses !*/
!(function (e, n, A) {
  function o(e) {
    var n = u.className,
      A = Modernizr._config.classPrefix || "";
    if ((c && (n = n.baseVal), Modernizr._config.enableJSClass)) {
      var o = new RegExp("(^|\\s)" + A + "no-js(\\s|$)");
      n = n.replace(o, "$1" + A + "js$2");
    }
    Modernizr._config.enableClasses &&
      ((n += " " + A + e.join(" " + A)),
      c ? (u.className.baseVal = n) : (u.className = n));
  }
  function t(e, n) {
    return typeof e === n;
  }
  function a() {
    var e, n, A, o, a, i, l;
    for (var f in r)
      if (r.hasOwnProperty(f)) {
        if (
          ((e = []),
          (n = r[f]),
          n.name &&
            (e.push(n.name.toLowerCase()),
            n.options && n.options.aliases && n.options.aliases.length))
        )
          for (A = 0; A < n.options.aliases.length; A++)
            e.push(n.options.aliases[A].toLowerCase());
        for (o = t(n.fn, "function") ? n.fn() : n.fn, a = 0; a < e.length; a++)
          (i = e[a]),
            (l = i.split(".")),
            1 === l.length
              ? (Modernizr[l[0]] = o)
              : (!Modernizr[l[0]] ||
                  Modernizr[l[0]] instanceof Boolean ||
                  (Modernizr[l[0]] = new Boolean(Modernizr[l[0]])),
                (Modernizr[l[0]][l[1]] = o)),
            s.push((o ? "" : "no-") + l.join("-"));
      }
  }
  function i(e, n) {
    if ("object" == typeof e) for (var A in e) f(e, A) && i(A, e[A]);
    else {
      e = e.toLowerCase();
      var t = e.split("."),
        a = Modernizr[t[0]];
      if ((2 == t.length && (a = a[t[1]]), "undefined" != typeof a))
        return Modernizr;
      (n = "function" == typeof n ? n() : n),
        1 == t.length
          ? (Modernizr[t[0]] = n)
          : (!Modernizr[t[0]] ||
              Modernizr[t[0]] instanceof Boolean ||
              (Modernizr[t[0]] = new Boolean(Modernizr[t[0]])),
            (Modernizr[t[0]][t[1]] = n)),
        o([(n && 0 != n ? "" : "no-") + t.join("-")]),
        Modernizr._trigger(e, n);
    }
    return Modernizr;
  }
  var s = [],
    r = [],
    l = {
      _version: "3.6.0",
      _config: {
        classPrefix: "",
        enableClasses: !0,
        enableJSClass: !0,
        usePrefixes: !0,
      },
      _q: [],
      on: function (e, n) {
        var A = this;
        setTimeout(function () {
          n(A[e]);
        }, 0);
      },
      addTest: function (e, n, A) {
        r.push({ name: e, fn: n, options: A });
      },
      addAsyncTest: function (e) {
        r.push({ name: null, fn: e });
      },
    },
    Modernizr = function () {};
  (Modernizr.prototype = l), (Modernizr = new Modernizr());
  var f,
    u = n.documentElement,
    c = "svg" === u.nodeName.toLowerCase();
  !(function () {
    var e = {}.hasOwnProperty;
    f =
      t(e, "undefined") || t(e.call, "undefined")
        ? function (e, n) {
            return n in e && t(e.constructor.prototype[n], "undefined");
          }
        : function (n, A) {
            return e.call(n, A);
          };
  })(),
    (l._l = {}),
    (l.on = function (e, n) {
      this._l[e] || (this._l[e] = []),
        this._l[e].push(n),
        Modernizr.hasOwnProperty(e) &&
          setTimeout(function () {
            Modernizr._trigger(e, Modernizr[e]);
          }, 0);
    }),
    (l._trigger = function (e, n) {
      if (this._l[e]) {
        var A = this._l[e];
        setTimeout(function () {
          var e, o;
          for (e = 0; e < A.length; e++) (o = A[e])(n);
        }, 0),
          delete this._l[e];
      }
    }),
    Modernizr._q.push(function () {
      l.addTest = i;
    }),
    Modernizr.addAsyncTest(function () {
      function e(e, n, A) {
        function o(n) {
          var o = n && "load" === n.type ? 1 == t.width : !1,
            a = "webp" === e;
          i(e, a && o ? new Boolean(o) : o), A && A(n);
        }
        var t = new Image();
        (t.onerror = o), (t.onload = o), (t.src = n);
      }
      var n = [
          {
            uri: "data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",
            name: "webp",
          },
          {
            uri: "data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",
            name: "webp.alpha",
          },
          {
            uri: "data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",
            name: "webp.animation",
          },
          {
            uri: "data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",
            name: "webp.lossless",
          },
        ],
        A = n.shift();
      e(A.name, A.uri, function (A) {
        if (A && "load" === A.type)
          for (var o = 0; o < n.length; o++) e(n[o].name, n[o].uri);
      });
    }),
    a(),
    o(s),
    delete l.addTest,
    delete l.addAsyncTest;
  for (var p = 0; p < Modernizr._q.length; p++) Modernizr._q[p]();
  e.Modernizr = Modernizr;
})(window, document);
