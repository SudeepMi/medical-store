"use strict";
var KTApp = function() {
    var t = {},
        e = function(t) {
            var e = t.data("skin") ? "tooltip-" + t.data("skin") : "",
                n = "auto" == t.data("width") ? "tooltop-auto-width" : "",
                i = t.data("trigger") ? t.data("trigger") : "hover";
            t.data("placement") && t.data("placement"), t.tooltip({
                trigger: i,
                template: '<div class="tooltip ' + e + " " + n + '" role="tooltip">                <div class="arrow"></div>                <div class="tooltip-inner"></div>            </div>'
            })
        },
        n = function() {
            $('[data-toggle="kt-tooltip"]').each(function() {
                e($(this))
            })
        },
        i = function(t) {
            var e = t.data("skin") ? "popover-" + t.data("skin") : "",
                n = t.data("trigger") ? t.data("trigger") : "hover";
            t.popover({
                trigger: n,
                template: '            <div class="popover ' + e + '" role="tooltip">                <div class="arrow"></div>                <h3 class="popover-header"></h3>                <div class="popover-body"></div>            </div>'
            })
        },
        o = function() {
            $('[data-toggle="kt-popover"]').each(function() {
                i($(this))
            })
        },
        a = function(t, e) {
            t = $(t), new KTPortlet(t[0], e)
        },
        r = function() {
            $('[data-ktportlet="true"]').each(function() {
                var t = $(this);
                !0 !== t.data("data-ktportlet-initialized") && (a(t, {}), t.data("data-ktportlet-initialized", !0))
            })
        },
        l = function() {
            new Sticky('[data-sticky="true"]')
        };
    return {
        init: function(e) {
            e && e.colors && (t = e.colors), KTApp.initComponents()
        },
        initComponents: function() {
            $('[data-scroll="true"]').each(function() {
                var t = $(this);
                KTUtil.scrollInit(this, {
                    mobileNativeScroll: !0,
                    handleWindowResize: !0,
                    rememberPosition: "true" == t.data("remember-position"),
                    height: function() {
                        return KTUtil.isInResponsiveRange("tablet-and-mobile") && t.data("mobile-height") ? t.data("mobile-height") : t.data("height")
                    }
                })
            }), n(), o(), $("body").on("click", "[data-close=alert]", function() {
                $(this).closest(".alert").hide()
            }), r(), $(".custom-file-input").on("change", function() {
                var t = $(this).val();
                $(this).next(".custom-file-label").addClass("selected").html(t)
            }), l(), $("body").on("show.bs.dropdown", function(t) {
                if (0 !== $(t.target).find("[data-attach='body']").length) {
                    var e = $(t.target).find(".dropdown-menu");
                    $("body").append(e.detach()), e.css("display", "block"), e.position({
                        my: "right top",
                        at: "right bottom",
                        of: $(t.relatedTarget)
                    })
                }
            }), $("body").on("hide.bs.dropdown", function(t) {
                if (0 !== $(t.target).find("[data-attach='body']").length) {
                    var e = $(t.target).find(".dropdown-menu");
                    $(t.target).append(e.detach()), e.hide()
                }
            })
        },
        initTooltips: function() {
            n()
        },
        initTooltip: function(t) {
            e(t)
        },
        initPopovers: function() {
            o()
        },
        initPopover: function(t) {
            i(t)
        },
        initPortlet: function(t, e) {
            a(t, e)
        },
        initPortlets: function() {
            r()
        },
        initSticky: function() {
            l()
        },
        initAbsoluteDropdown: function(t) {
            ! function(t) {
                var e;
                t && $("body").on("show.bs.dropdown", t, function(t) {
                    e = $(t.target).find(".dropdown-menu"), $("body").append(e.detach()), e.css("display", "block"), e.position({
                        my: "right top",
                        at: "right bottom",
                        of: $(t.relatedTarget)
                    })
                }).on("hide.bs.dropdown", t, function(t) {
                    $(t.target).append(e.detach()), e.hide()
                })
            }(t)
        },
        block: function(t, e) {
            var n, i = $(t),
                o = '<div class="kt-spinner ' + ((e = $.extend(!0, {
                    opacity: .05,
                    overlayColor: "#000000",
                    type: "",
                    size: "",
                    state: "brand",
                    centerX: !0,
                    centerY: !0,
                    message: "",
                    shadow: !0,
                    width: "auto"
                }, e)).type ? "kt-spinner--" + e.type : "") + " " + (e.state ? "kt-spinner--" + e.state : "") + " " + (e.size ? "kt-spinner--" + e.size : "") + '"></div';
            if (e.message && e.message.length > 0) {
                var a = "blockui " + (!1 === e.shadow ? "blockui" : "");
                n = '<div class="' + a + '"><span>' + e.message + "</span><span>" + o + "</span></div>", i = document.createElement("div"), KTUtil.get("body").prepend(i), KTUtil.addClass(i, a), i.innerHTML = "<span>" + e.message + "</span><span>" + o + "</span>", e.width = KTUtil.actualWidth(i) + 10, KTUtil.remove(i), "body" == t && (n = '<div class="' + a + '" style="margin-left:-' + e.width / 2 + 'px;"><span>' + e.message + "</span><span>" + o + "</span></div>")
            } else n = o;
            var r = {
                message: n,
                centerY: e.centerY,
                centerX: e.centerX,
                css: {
                    top: "30%",
                    left: "50%",
                    border: "0",
                    padding: "0",
                    backgroundColor: "none",
                    width: e.width
                },
                overlayCSS: {
                    backgroundColor: e.overlayColor,
                    opacity: e.opacity,
                    cursor: "wait",
                    zIndex: "10"
                },
                onUnblock: function() {
                    i && i[0] && (KTUtil.css(i[0], "position", ""), KTUtil.css(i[0], "zoom", ""))
                }
            };
            "body" == t ? (r.css.top = "50%", $.blockUI(r)) : (i = $(t)).block(r)
        },
        unblock: function(t) {
            t && "body" != t ? $(t).unblock() : $.unblockUI()
        },
        blockPage: function(t) {
            return KTApp.block("body", t)
        },
        unblockPage: function() {
            return KTApp.unblock("body")
        },
        progress: function(t, e) {
            var n = "kt-spinner kt-spinner--" + (e && e.skin ? e.skin : "light") + " kt-spinner--" + (e && e.alignment ? e.alignment : "right") + " kt-spinner--" + (e && e.size ? "kt-spinner--" + e.size : "");
            KTApp.unprogress(t), $(t).addClass(n), $(t).data("progress-classes", n)
        },
        unprogress: function(t) {
            $(t).removeClass($(t).data("progress-classes"))
        },
        getStateColor: function(e) {
            return t.state[e]
        },
        getBaseColor: function(e, n) {
            return t.base[e][n - 1]
        }
    }
}();
$(document).ready(function() {
        KTApp.init(KTAppOptions)
    }), this.Element && function(t) {
        t.matches = t.matches || t.matchesSelector || t.webkitMatchesSelector || t.msMatchesSelector || function(t) {
            for (var e = (this.parentNode || this.document).querySelectorAll(t), n = -1; e[++n] && e[n] != this;);
            return !!e[n]
        }
    }(Element.prototype), this.Element && function(t) {
        t.closest = t.closest || function(t) {
            for (var e = this; e.matches && !e.matches(t);) e = e.parentNode;
            return e.matches ? e : null
        }
    }(Element.prototype), "remove" in Element.prototype || (Element.prototype.remove = function() {
        this.parentNode && this.parentNode.removeChild(this)
    }), this.Element && function(t) {
        t.matches = t.matches || t.matchesSelector || t.webkitMatchesSelector || t.msMatchesSelector || function(t) {
            for (var e = (this.parentNode || this.document).querySelectorAll(t), n = -1; e[++n] && e[n] != this;);
            return !!e[n]
        }
    }(Element.prototype),
    function() {
        for (var t = 0, e = ["webkit", "moz"], n = 0; n < e.length && !window.requestAnimationFrame; ++n) window.requestAnimationFrame = window[e[n] + "RequestAnimationFrame"], window.cancelAnimationFrame = window[e[n] + "CancelAnimationFrame"] || window[e[n] + "CancelRequestAnimationFrame"];
        window.requestAnimationFrame || (window.requestAnimationFrame = function(e) {
            var n = (new Date).getTime(),
                i = Math.max(0, 16 - (n - t)),
                o = window.setTimeout(function() {
                    e(n + i)
                }, i);
            return t = n + i, o
        }), window.cancelAnimationFrame || (window.cancelAnimationFrame = function(t) {
            clearTimeout(t)
        })
    }(), [Element.prototype, Document.prototype, DocumentFragment.prototype].forEach(function(t) {
        t.hasOwnProperty("prepend") || Object.defineProperty(t, "prepend", {
            configurable: !0,
            enumerable: !0,
            writable: !0,
            value: function() {
                var t = Array.prototype.slice.call(arguments),
                    e = document.createDocumentFragment();
                t.forEach(function(t) {
                    var n = t instanceof Node;
                    e.appendChild(n ? t : document.createTextNode(String(t)))
                }), this.insertBefore(e, this.firstChild)
            }
        })
    }), window.KTUtilElementDataStore = {}, window.KTUtilElementDataStoreID = 0, window.KTUtilDelegatedEventHandlers = {};
var KTUtil = function() {
    var t = [],
        e = {
            sm: 544,
            md: 768,
            lg: 1024,
            xl: 1200
        },
        n = function() {
            var e = !1;
            window.addEventListener("resize", function() {
                clearTimeout(e), e = setTimeout(function() {
                    ! function() {
                        for (var e = 0; e < t.length; e++) t[e].call()
                    }()
                }, 250)
            })
        };
    return {
        init: function(t) {
            t && t.breakpoints && (e = t.breakpoints), n()
        },
        addResizeHandler: function(e) {
            t.push(e)
        },
        removeResizeHandler: function(e) {
            for (var n = 0; n < t.length; n++) e === t[n] && delete t[n]
        },
        runResizeHandlers: function() {
            _runResizeHandlers()
        },
        resize: function() {
            if ("function" == typeof Event) window.dispatchEvent(new Event("resize"));
            else {
                var t = window.document.createEvent("UIEvents");
                t.initUIEvent("resize", !0, !1, window, 0), window.dispatchEvent(t)
            }
        },
        getURLParam: function(t) {
            var e, n, i = window.location.search.substring(1).split("&");
            for (e = 0; e < i.length; e++)
                if ((n = i[e].split("="))[0] == t) return unescape(n[1]);
            return null
        },
        isMobileDevice: function() {
            return this.getViewPort().width < this.getBreakpoint("lg")
        },
        isDesktopDevice: function() {
            return !KTUtil.isMobileDevice()
        },
        getViewPort: function() {
            var t = window,
                e = "inner";
            return "innerWidth" in window || (e = "client", t = document.documentElement || document.body), {
                width: t[e + "Width"],
                height: t[e + "Height"]
            }
        },
        isInResponsiveRange: function(t) {
            var e = this.getViewPort().width;
            return "general" == t || "desktop" == t && e >= this.getBreakpoint("lg") + 1 || "tablet" == t && e >= this.getBreakpoint("md") + 1 && e < this.getBreakpoint("lg") || "mobile" == t && e <= this.getBreakpoint("md") || "desktop-and-tablet" == t && e >= this.getBreakpoint("md") + 1 || "tablet-and-mobile" == t && e <= this.getBreakpoint("lg") || "minimal-desktop-and-below" == t && e <= this.getBreakpoint("xl")
        },
        getUniqueID: function(t) {
            return t + Math.floor(Math.random() * (new Date).getTime())
        },
        getBreakpoint: function(t) {
            return e[t]
        },
        isset: function(t, e) {
            var n;
            if (-1 !== (e = e || "").indexOf("[")) throw new Error("Unsupported object path notation.");
            e = e.split(".");
            do {
                if (void 0 === t) return !1;
                if (n = e.shift(), !t.hasOwnProperty(n)) return !1;
                t = t[n]
            } while (e.length);
            return !0
        },
        getHighestZindex: function(t) {
            for (var e, n, i = KTUtil.get(t); i && i !== document;) {
                if (("absolute" === (e = KTUtil.css(i, "position")) || "relative" === e || "fixed" === e) && (n = parseInt(KTUtil.css(i, "z-index")), !isNaN(n) && 0 !== n)) return n;
                i = i.parentNode
            }
            return null
        },
        hasFixedPositionedParent: function(t) {
            for (; t && t !== document;) {
                if (position = KTUtil.css(t, "position"), "fixed" === position) return !0;
                t = t.parentNode
            }
            return !1
        },
        sleep: function(t) {
            for (var e = (new Date).getTime(), n = 0; n < 1e7 && !((new Date).getTime() - e > t); n++);
        },
        getRandomInt: function(t, e) {
            return Math.floor(Math.random() * (e - t + 1)) + t
        },
        isAngularVersion: function() {
            return void 0 !== window.Zone
        },
        deepExtend: function(t) {
            t = t || {};
            for (var e = 1; e < arguments.length; e++) {
                var n = arguments[e];
                if (n)
                    for (var i in n) n.hasOwnProperty(i) && ("object" == typeof n[i] ? t[i] = KTUtil.deepExtend(t[i], n[i]) : t[i] = n[i])
            }
            return t
        },
        extend: function(t) {
            t = t || {};
            for (var e = 1; e < arguments.length; e++)
                if (arguments[e])
                    for (var n in arguments[e]) arguments[e].hasOwnProperty(n) && (t[n] = arguments[e][n]);
            return t
        },
        get: function(t) {
            var e;
            return t === document ? document : t && 1 === t.nodeType ? t : (e = document.getElementById(t)) ? e : (e = document.getElementsByTagName(t)) ? e[0] : (e = document.getElementsByClassName(t)) ? e[0] : null
        },
        getByID: function(t) {
            return t && 1 === t.nodeType ? t : document.getElementById(t)
        },
        getByTag: function(t) {
            var e;
            return (e = document.getElementsByTagName(t)) ? e[0] : null
        },
        getByClass: function(t) {
            var e;
            return (e = document.getElementsByClassName(t)) ? e[0] : null
        },
        hasClasses: function(t, e) {
            if (t) {
                for (var n = e.split(" "), i = 0; i < n.length; i++)
                    if (0 == KTUtil.hasClass(t, KTUtil.trim(n[i]))) return !1;
                return !0
            }
        },
        hasClass: function(t, e) {
            if (t) return t.classList ? t.classList.contains(e) : new RegExp("\\b" + e + "\\b").test(t.className)
        },
        addClass: function(t, e) {
            if (t && void 0 !== e) {
                var n = e.split(" ");
                if (t.classList)
                    for (var i = 0; i < n.length; i++) n[i] && n[i].length > 0 && t.classList.add(KTUtil.trim(n[i]));
                else if (!KTUtil.hasClass(t, e))
                    for (i = 0; i < n.length; i++) t.className += " " + KTUtil.trim(n[i])
            }
        },
        removeClass: function(t, e) {
            if (t && void 0 !== e) {
                var n = e.split(" ");
                if (t.classList)
                    for (var i = 0; i < n.length; i++) t.classList.remove(KTUtil.trim(n[i]));
                else if (KTUtil.hasClass(t, e))
                    for (i = 0; i < n.length; i++) t.className = t.className.replace(new RegExp("\\b" + KTUtil.trim(n[i]) + "\\b", "g"), "")
            }
        },
        triggerCustomEvent: function(t, e, n) {
            if (window.CustomEvent) var i = new CustomEvent(e, {
                detail: n
            });
            else(i = document.createEvent("CustomEvent")).initCustomEvent(e, !0, !0, n);
            t.dispatchEvent(i)
        },
        triggerEvent: function(t, e) {
            var n;
            if (t.ownerDocument) n = t.ownerDocument;
            else {
                if (9 != t.nodeType) throw new Error("Invalid node passed to fireEvent: " + t.id);
                n = t
            }
            if (t.dispatchEvent) {
                var i = "";
                switch (e) {
                    case "click":
                    case "mouseenter":
                    case "mouseleave":
                    case "mousedown":
                    case "mouseup":
                        i = "MouseEvents";
                        break;
                    case "focus":
                    case "change":
                    case "blur":
                    case "select":
                        i = "HTMLEvents";
                        break;
                    default:
                        throw "fireEvent: Couldn't find an event class for event '" + e + "'."
                }
                var o = "change" != e;
                (a = n.createEvent(i)).initEvent(e, o, !0), a.synthetic = !0, t.dispatchEvent(a, !0)
            } else if (t.fireEvent) {
                var a;
                (a = n.createEventObject()).synthetic = !0, t.fireEvent("on" + e, a)
            }
        },
        index: function(t) {
            for (var e = (t = KTUtil.get(t)).parentNode.children, n = 0; n < e.length; n++)
                if (e[n] == t) return n
        },
        trim: function(t) {
            return t.trim()
        },
        eventTriggered: function(t) {
            return !!t.currentTarget.dataset.triggered || (t.currentTarget.dataset.triggered = !0, !1)
        },
        remove: function(t) {
            t && t.parentNode && t.parentNode.removeChild(t)
        },
        find: function(t, e) {
            if (t = KTUtil.get(t)) return t.querySelector(e)
        },
        findAll: function(t, e) {
            if (t = KTUtil.get(t)) return t.querySelectorAll(e)
        },
        insertAfter: function(t, e) {
            return e.parentNode.insertBefore(t, e.nextSibling)
        },
        parents: function(t, e) {
            Element.prototype.matches || (Element.prototype.matches = Element.prototype.matchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector || Element.prototype.oMatchesSelector || Element.prototype.webkitMatchesSelector || function(t) {
                for (var e = (this.document || this.ownerDocument).querySelectorAll(t), n = e.length; --n >= 0 && e.item(n) !== this;);
                return n > -1
            });
            for (var n = []; t && t !== document; t = t.parentNode) e ? t.matches(e) && n.push(t) : n.push(t);
            return n
        },
        children: function(t, e, n) {
            if (t && t.childNodes) {
                for (var i = [], o = 0, a = t.childNodes.length; o < a; ++o) 1 == t.childNodes[o].nodeType && KTUtil.matches(t.childNodes[o], e, n) && i.push(t.childNodes[o]);
                return i
            }
        },
        child: function(t, e, n) {
            var i = KTUtil.children(t, e, n);
            return i ? i[0] : null
        },
        matches: function(t, e, n) {
            var i = Element.prototype,
                o = i.matches || i.webkitMatchesSelector || i.mozMatchesSelector || i.msMatchesSelector || function(t) {
                    return -1 !== [].indexOf.call(document.querySelectorAll(t), this)
                };
            return !(!t || !t.tagName) && o.call(t, e)
        },
        data: function(t) {
            return t = KTUtil.get(t), {
                set: function(e, n) {
                    void 0 !== t && (void 0 === t.customDataTag && (KTUtilElementDataStoreID++, t.customDataTag = KTUtilElementDataStoreID), void 0 === KTUtilElementDataStore[t.customDataTag] && (KTUtilElementDataStore[t.customDataTag] = {}), KTUtilElementDataStore[t.customDataTag][e] = n)
                },
                get: function(e) {
                    if (void 0 !== t) return void 0 === t.customDataTag ? null : this.has(e) ? KTUtilElementDataStore[t.customDataTag][e] : null
                },
                has: function(e) {
                    return void 0 !== t && void 0 !== t.customDataTag && !(!KTUtilElementDataStore[t.customDataTag] || !KTUtilElementDataStore[t.customDataTag][e])
                },
                remove: function(e) {
                    t && this.has(e) && delete KTUtilElementDataStore[t.customDataTag][e]
                }
            }
        },
        outerWidth: function(t, e) {
            if (!0 === e) {
                var n = parseFloat(t.offsetWidth);
                return n += parseFloat(KTUtil.css(t, "margin-left")) + parseFloat(KTUtil.css(t, "margin-right")), parseFloat(n)
            }
            return parseFloat(t.offsetWidth)
        },
        offset: function(t) {
            var e, n;
            if (t = KTUtil.get(t)) return t.getClientRects().length ? (e = t.getBoundingClientRect(), n = t.ownerDocument.defaultView, {
                top: e.top + n.pageYOffset,
                left: e.left + n.pageXOffset
            }) : {
                top: 0,
                left: 0
            }
        },
        height: function(t) {
            return KTUtil.css(t, "height")
        },
        visible: function(t) {
            return !(0 === t.offsetWidth && 0 === t.offsetHeight)
        },
        attr: function(t, e, n) {
            if (null != (t = KTUtil.get(t))) return void 0 === n ? t.getAttribute(e) : void t.setAttribute(e, n)
        },
        hasAttr: function(t, e) {
            if (null != (t = KTUtil.get(t))) return !!t.getAttribute(e)
        },
        removeAttr: function(t, e) {
            null != (t = KTUtil.get(t)) && t.removeAttribute(e)
        },
        animate: function(t, e, n, i, o, a) {
            var r = {
                linear: function(t, e, n, i) {
                    return n * t / i + e
                }
            };
            if (o = r.linear, "number" == typeof t && "number" == typeof e && "number" == typeof n && "function" == typeof i) {
                "function" != typeof a && (a = function() {});
                var l = window.requestAnimationFrame || function(t) {
                        window.setTimeout(t, 20)
                    },
                    s = e - t;
                i(t);
                var d = window.performance && window.performance.now ? window.performance.now() : +new Date;
                l(function r(c) {
                    var u = (c || +new Date) - d;
                    u >= 0 && i(o(u, t, s, n)), u >= 0 && u >= n ? (i(e), a()) : l(r)
                })
            }
        },
        actualCss: function(t, e, n) {
            var i, o = "";
            if ((t = KTUtil.get(t)) instanceof HTMLElement != 0) return t.getAttribute("kt-hidden-" + e) && !1 !== n ? parseFloat(t.getAttribute("kt-hidden-" + e)) : (o = t.style.cssText, t.style.cssText = "position: absolute; visibility: hidden; display: block;", "width" == e ? i = t.offsetWidth : "height" == e && (i = t.offsetHeight), t.style.cssText = o, t.setAttribute("kt-hidden-" + e, i), parseFloat(i))
        },
        actualHeight: function(t, e) {
            return KTUtil.actualCss(t, "height", e)
        },
        actualWidth: function(t, e) {
            return KTUtil.actualCss(t, "width", e)
        },
        getScroll: function(t, e) {
            return e = "scroll" + e, t == window || t == document ? self["scrollTop" == e ? "pageYOffset" : "pageXOffset"] || browserSupportsBoxModel && document.documentElement[e] || document.body[e] : t[e]
        },
        css: function(t, e, n) {
            if (t = KTUtil.get(t))
                if (void 0 !== n) t.style[e] = n;
                else {
                    var i = (t.ownerDocument || document).defaultView;
                    if (i && i.getComputedStyle) return e = e.replace(/([A-Z])/g, "-$1").toLowerCase(), i.getComputedStyle(t, null).getPropertyValue(e);
                    if (t.currentStyle) return e = e.replace(/\-(\w)/g, function(t, e) {
                        return e.toUpperCase()
                    }), n = t.currentStyle[e], /^\d+(em|pt|%|ex)?$/i.test(n) ? function(e) {
                        var n = t.style.left,
                            i = t.runtimeStyle.left;
                        return t.runtimeStyle.left = t.currentStyle.left, t.style.left = e || 0, e = t.style.pixelLeft + "px", t.style.left = n, t.runtimeStyle.left = i, e
                    }(n) : n
                }
        },
        slide: function(t, e, n, i, o) {
            if (!(!t || "up" == e && !1 === KTUtil.visible(t) || "down" == e && !0 === KTUtil.visible(t))) {
                n = n || 600;
                var a = KTUtil.actualHeight(t),
                    r = !1,
                    l = !1;
                KTUtil.css(t, "padding-top") && !0 !== KTUtil.data(t).has("slide-padding-top") && KTUtil.data(t).set("slide-padding-top", KTUtil.css(t, "padding-top")), KTUtil.css(t, "padding-bottom") && !0 !== KTUtil.data(t).has("slide-padding-bottom") && KTUtil.data(t).set("slide-padding-bottom", KTUtil.css(t, "padding-bottom")), KTUtil.data(t).has("slide-padding-top") && (r = parseInt(KTUtil.data(t).get("slide-padding-top"))), KTUtil.data(t).has("slide-padding-bottom") && (l = parseInt(KTUtil.data(t).get("slide-padding-bottom"))), "up" == e ? (t.style.cssText = "display: block; overflow: hidden;", r && KTUtil.animate(0, r, n, function(e) {
                    t.style.paddingTop = r - e + "px"
                }, "linear"), l && KTUtil.animate(0, l, n, function(e) {
                    t.style.paddingBottom = l - e + "px"
                }, "linear"), KTUtil.animate(0, a, n, function(e) {
                    t.style.height = a - e + "px"
                }, "linear", function() {
                    i(), t.style.height = "", t.style.display = "none"
                })) : "down" == e && (t.style.cssText = "display: block; overflow: hidden;", r && KTUtil.animate(0, r, n, function(e) {
                    t.style.paddingTop = e + "px"
                }, "linear", function() {
                    t.style.paddingTop = ""
                }), l && KTUtil.animate(0, l, n, function(e) {
                    t.style.paddingBottom = e + "px"
                }, "linear", function() {
                    t.style.paddingBottom = ""
                }), KTUtil.animate(0, a, n, function(e) {
                    t.style.height = e + "px"
                }, "linear", function() {
                    i(), t.style.height = "", t.style.display = "", t.style.overflow = ""
                }))
            }
        },
        slideUp: function(t, e, n) {
            KTUtil.slide(t, "up", e, n)
        },
        slideDown: function(t, e, n) {
            KTUtil.slide(t, "down", e, n)
        },
        show: function(t, e) {
            void 0 !== t && (t.style.display = e || "block")
        },
        hide: function(t) {
            void 0 !== t && (t.style.display = "none")
        },
        addEvent: function(t, e, n, i) {
            void 0 !== (t = KTUtil.get(t)) && t.addEventListener(e, n)
        },
        removeEvent: function(t, e, n) {
            (t = KTUtil.get(t)).removeEventListener(e, n)
        },
        on: function(t, e, n, i) {
            if (e) {
                var o = KTUtil.getUniqueID("event");
                return KTUtilDelegatedEventHandlers[o] = function(n) {
                    for (var o = t.querySelectorAll(e), a = n.target; a && a !== t;) {
                        for (var r = 0, l = o.length; r < l; r++) a === o[r] && i.call(a, n);
                        a = a.parentNode
                    }
                }, KTUtil.addEvent(t, n, KTUtilDelegatedEventHandlers[o]), o
            }
        },
        off: function(t, e, n) {
            t && KTUtilDelegatedEventHandlers[n] && (KTUtil.removeEvent(t, e, KTUtilDelegatedEventHandlers[n]), delete KTUtilDelegatedEventHandlers[n])
        },
        one: function(t, e, n) {
            (t = KTUtil.get(t)).addEventListener(e, function t(e) {
                return e.target && e.target.removeEventListener && e.target.removeEventListener(e.type, t), n(e)
            })
        },
        hash: function(t) {
            var e, n = 0;
            if (0 === t.length) return n;
            for (e = 0; e < t.length; e++) n = (n << 5) - n + t.charCodeAt(e), n |= 0;
            return n
        },
        animateClass: function(t, e, n) {
            var i, o = {
                animation: "animationend",
                OAnimation: "oAnimationEnd",
                MozAnimation: "mozAnimationEnd",
                WebkitAnimation: "webkitAnimationEnd",
                msAnimation: "msAnimationEnd"
            };
            for (var a in o) void 0 !== t.style[a] && (i = o[a]);
            KTUtil.addClass(t, "animated " + e), KTUtil.one(t, i, function() {
                KTUtil.removeClass(t, "animated " + e)
            }), n && KTUtil.one(t, i, n)
        },
        transitionEnd: function(t, e) {
            var n, i = {
                transition: "transitionend",
                OTransition: "oTransitionEnd",
                MozTransition: "mozTransitionEnd",
                WebkitTransition: "webkitTransitionEnd",
                msTransition: "msTransitionEnd"
            };
            for (var o in i) void 0 !== t.style[o] && (n = i[o]);
            KTUtil.one(t, n, e)
        },
        animationEnd: function(t, e) {
            var n, i = {
                animation: "animationend",
                OAnimation: "oAnimationEnd",
                MozAnimation: "mozAnimationEnd",
                WebkitAnimation: "webkitAnimationEnd",
                msAnimation: "msAnimationEnd"
            };
            for (var o in i) void 0 !== t.style[o] && (n = i[o]);
            KTUtil.one(t, n, e)
        },
        animateDelay: function(t, e) {
            for (var n = ["webkit-", "moz-", "ms-", "o-", ""], i = 0; i < n.length; i++) KTUtil.css(t, n[i] + "animation-delay", e)
        },
        animateDuration: function(t, e) {
            for (var n = ["webkit-", "moz-", "ms-", "o-", ""], i = 0; i < n.length; i++) KTUtil.css(t, n[i] + "animation-duration", e)
        },
        scrollTo: function(t, e, n) {
            n = n || 500;
            var i, o, a = (t = KTUtil.get(t)) ? KTUtil.offset(t).top : 0,
                r = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            a > r ? (i = a, o = r) : (i = r, o = a), e && (o += e), KTUtil.animate(i, o, n, function(t) {
                document.documentElement.scrollTop = t, document.body.parentNode.scrollTop = t, document.body.scrollTop = t
            })
        },
        scrollTop: function(t, e) {
            KTUtil.scrollTo(null, t, e)
        },
        isArray: function(t) {
            return t && Array.isArray(t)
        },
        ready: function(t) {
            (document.attachEvent ? "complete" === document.readyState : "loading" !== document.readyState) ? t(): document.addEventListener("DOMContentLoaded", t)
        },
        isEmpty: function(t) {
            for (var e in t)
                if (t.hasOwnProperty(e)) return !1;
            return !0
        },
        numberString: function(t) {
            for (var e = (t += "").split("."), n = e[0], i = e.length > 1 ? "." + e[1] : "", o = /(\d+)(\d{3})/; o.test(n);) n = n.replace(o, "$1,$2");
            return n + i
        },
        detectIE: function() {
            var t = window.navigator.userAgent,
                e = t.indexOf("MSIE ");
            if (e > 0) return parseInt(t.substring(e + 5, t.indexOf(".", e)), 10);
            if (t.indexOf("Trident/") > 0) {
                var n = t.indexOf("rv:");
                return parseInt(t.substring(n + 3, t.indexOf(".", n)), 10)
            }
            var i = t.indexOf("Edge/");
            return i > 0 && parseInt(t.substring(i + 5, t.indexOf(".", i)), 10)
        },
        isRTL: function() {
            return "rtl" == KTUtil.attr(KTUtil.get("html"), "direction")
        },
        scrollInit: function(t, e) {
            function n() {
                var n, i;
                if (i = e.height instanceof Function ? parseInt(e.height.call()) : parseInt(e.height), (e.mobileNativeScroll || e.disableForMobile) && KTUtil.isInResponsiveRange("tablet-and-mobile"))(n = KTUtil.data(t).get("ps")) ? (e.resetHeightOnDestroy ? KTUtil.css(t, "height", "auto") : (KTUtil.css(t, "overflow", "auto"), i > 0 && KTUtil.css(t, "height", i + "px")), n.destroy(), n = KTUtil.data(t).remove("ps")) : i > 0 && (KTUtil.css(t, "overflow", "auto"), KTUtil.css(t, "height", i + "px"));
                else if (i > 0 && KTUtil.css(t, "height", i + "px"), e.desktopNativeScroll) KTUtil.css(t, "overflow", "auto");
                else {
                    KTUtil.css(t, "overflow", "hidden"), (n = KTUtil.data(t).get("ps")) ? n.update() : (KTUtil.addClass(t, "kt-scroll"), n = new PerfectScrollbar(t, {
                        wheelSpeed: .5,
                        swipeEasing: !0,
                        wheelPropagation: !1 !== e.windowScroll,
                        minScrollbarLength: 40,
                        maxScrollbarLength: 300,
                        suppressScrollX: "true" != KTUtil.attr(t, "data-scroll-x")
                    }), KTUtil.data(t).set("ps", n));
                    var o = KTUtil.attr(t, "id");
                    if (!0 === e.rememberPosition && Cookies && o) {
                        if (Cookies.get(o)) {
                            var a = parseInt(Cookies.get(o));
                            a > 0 && (t.scrollTop = a)
                        }
                        t.addEventListener("ps-scroll-y", function() {
                            Cookies.set(o, t.scrollTop)
                        })
                    }
                }
            }
            t && (n(), e.handleWindowResize && KTUtil.addResizeHandler(function() {
                n()
            }))
        },
        scrollUpdate: function(t) {
            var e;
            (e = KTUtil.data(t).get("ps")) && e.update()
        },
        scrollUpdateAll: function(t) {
            for (var e = KTUtil.findAll(t, ".ps"), n = 0, i = e.length; n < i; n++) KTUtil.scrollerUpdate(e[n])
        },
        scrollDestroy: function(t) {
            var e;
            (e = KTUtil.data(t).get("ps")) && (e.destroy(), e = KTUtil.data(t).remove("ps"))
        },
        setHTML: function(t, e) {
            KTUtil.get(t) && (KTUtil.get(t).innerHTML = e)
        },
        getHTML: function(t) {
            if (KTUtil.get(t)) return KTUtil.get(t).innerHTML
        }
    }
}();
KTUtil.ready(function() {
    KTUtil.init()
}), window.onload = (jQuery, void KTUtil.removeClass(KTUtil.get("body"), "kt-page--loading"));
var KTAvatar = function(t, e) {
        var n = this,
            i = KTUtil.get(t);
        if (KTUtil.get("body"), i) {
            var o = {},
                a = {
                    construct: function(t) {
                        return KTUtil.data(i).has("avatar") ? n = KTUtil.data(i).get("avatar") : (a.init(t), a.build(), KTUtil.data(i).set("avatar", n)), n
                    },
                    init: function(t) {
                        n.element = i, n.events = [], n.input = KTUtil.find(i, 'input[type="file"]'), n.holder = KTUtil.find(i, ".kt-avatar__holder"), n.cancel = KTUtil.find(i, ".kt-avatar__cancel"), n.src = KTUtil.css(n.holder, "backgroundImage"), n.options = KTUtil.deepExtend({}, o, t)
                    },
                    build: function() {
                        KTUtil.addEvent(n.input, "change", function(t) {
                            if (t.preventDefault(), n.input && n.input.files && n.input.files[0]) {
                                var e = new FileReader;
                                e.onload = function(t) {
                                    KTUtil.css(n.holder, "background-image", "url(" + t.target.result + ")")
                                }, e.readAsDataURL(n.input.files[0]), KTUtil.addClass(n.element, "kt-avatar--changed")
                            }
                        }), KTUtil.addEvent(n.cancel, "click", function(t) {
                            t.preventDefault(), KTUtil.removeClass(n.element, "kt-avatar--changed"), KTUtil.css(n.holder, "background-image", n.src), n.input.value = ""
                        })
                    },
                    eventTrigger: function(t) {
                        for (var e = 0; e < n.events.length; e++) {
                            var i = n.events[e];
                            i.name == t && (1 == i.one ? 0 == i.fired && (n.events[e].fired = !0, i.handler.call(this, n)) : i.handler.call(this, n))
                        }
                    },
                    addEvent: function(t, e, i) {
                        return n.events.push({
                            name: t,
                            handler: e,
                            one: i,
                            fired: !1
                        }), n
                    }
                };
            return n.setDefaults = function(t) {
                o = t
            }, n.on = function(t, e) {
                return a.addEvent(t, e)
            }, n.one = function(t, e) {
                return a.addEvent(t, e, !0)
            }, a.construct.apply(n, [e]), n
        }
    },
    KTDialog = function(t) {
        var e, n = this,
            i = KTUtil.get("body"),
            o = {
                placement: "top center",
                type: "loader",
                width: 100,
                state: "default",
                message: "Loading..."
            },
            a = {
                construct: function(t) {
                    return a.init(t), n
                },
                init: function(t) {
                    n.events = [], n.options = KTUtil.deepExtend({}, o, t), n.state = !1
                },
                show: function() {
                    return a.eventTrigger("show"), e = document.createElement("DIV"), KTUtil.setHTML(e, n.options.message), KTUtil.addClass(e, "kt-dialog kt-dialog--shown"), KTUtil.addClass(e, "kt-dialog--" + n.options.state), KTUtil.addClass(e, "kt-dialog--" + n.options.type), "top center" == n.options.placement && KTUtil.addClass(e, "kt-dialog--top-center"), i.appendChild(e), n.state = "shown", a.eventTrigger("shown"), n
                },
                hide: function() {
                    return e && (a.eventTrigger("hide"), e.remove(), n.state = "hidden", a.eventTrigger("hidden")), n
                },
                eventTrigger: function(t) {
                    for (var e = 0; e < n.events.length; e++) {
                        var i = n.events[e];
                        i.name == t && (1 == i.one ? 0 == i.fired && (n.events[e].fired = !0, i.handler.call(this, n)) : i.handler.call(this, n))
                    }
                },
                addEvent: function(t, e, i) {
                    return n.events.push({
                        name: t,
                        handler: e,
                        one: i,
                        fired: !1
                    }), n
                }
            };
        return n.setDefaults = function(t) {
            o = t
        }, n.shown = function() {
            return "shown" == n.state
        }, n.hidden = function() {
            return "hidden" == n.state
        }, n.show = function() {
            return a.show()
        }, n.hide = function() {
            return a.hide()
        }, n.on = function(t, e) {
            return a.addEvent(t, e)
        }, n.one = function(t, e) {
            return a.addEvent(t, e, !0)
        }, a.construct.apply(n, [t]), n
    },
    KTHeader = function(t, e) {
        var n = this,
            i = KTUtil.get(t),
            o = KTUtil.get("body");
        if (void 0 !== i) {
            var a = {
                    classic: !1,
                    offset: {
                        mobile: 150,
                        desktop: 200
                    },
                    minimize: {
                        mobile: !1,
                        desktop: !1
                    }
                },
                r = {
                    construct: function(t) {
                        return KTUtil.data(i).has("header") ? n = KTUtil.data(i).get("header") : (r.init(t), r.build(), KTUtil.data(i).set("header", n)), n
                    },
                    init: function(t) {
                        n.events = [], n.options = KTUtil.deepExtend({}, a, t)
                    },
                    build: function() {
                        var t = 0,
                            e = !0;
                        KTUtil.getViewPort().height, !1 === n.options.minimize.mobile && !1 === n.options.minimize.desktop || window.addEventListener("scroll", function() {
                            var i, a, l, s = 0;
                            KTUtil.isInResponsiveRange("desktop") ? (s = n.options.offset.desktop, i = n.options.minimize.desktop.on, a = n.options.minimize.desktop.off) : KTUtil.isInResponsiveRange("tablet-and-mobile") && (s = n.options.offset.mobile, i = n.options.minimize.mobile.on, a = n.options.minimize.mobile.off), l = window.pageYOffset, KTUtil.isInResponsiveRange("tablet-and-mobile") && n.options.classic && n.options.classic.mobile || KTUtil.isInResponsiveRange("desktop") && n.options.classic && n.options.classic.desktop ? l > s ? (KTUtil.addClass(o, i), KTUtil.removeClass(o, a), e && (r.eventTrigger("minimizeOn", n), e = !1)) : (KTUtil.addClass(o, a), KTUtil.removeClass(o, i), 0 == e && (r.eventTrigger("minimizeOff", n), e = !0)) : (l > s && t < l ? (KTUtil.addClass(o, i), KTUtil.removeClass(o, a), e && (r.eventTrigger("minimizeOn", n), e = !1)) : (KTUtil.addClass(o, a), KTUtil.removeClass(o, i), 0 == e && (r.eventTrigger("minimizeOff", n), e = !0)), t = l)
                        })
                    },
                    eventTrigger: function(t, e) {
                        for (var i = 0; i < n.events.length; i++) {
                            var o = n.events[i];
                            o.name == t && (1 == o.one ? 0 == o.fired && (n.events[i].fired = !0, o.handler.call(this, n, e)) : o.handler.call(this, n, e))
                        }
                    },
                    addEvent: function(t, e, i) {
                        n.events.push({
                            name: t,
                            handler: e,
                            one: i,
                            fired: !1
                        })
                    }
                };
            return n.setDefaults = function(t) {
                a = t
            }, n.on = function(t, e) {
                return r.addEvent(t, e)
            }, r.construct.apply(n, [e]), n
        }
    },
    KTMenu = function(t, e) {
        var n = this,
            i = !1,
            o = KTUtil.get(t),
            a = KTUtil.get("body");
        if (o) {
            var r = {
                    scroll: {
                        rememberPosition: !1
                    },
                    accordion: {
                        slideSpeed: 200,
                        autoScroll: !1,
                        autoScrollSpeed: 1200,
                        expandAll: !0
                    },
                    dropdown: {
                        timeout: 500
                    }
                },
                l = {
                    construct: function(t) {
                        return KTUtil.data(o).has("menu") ? n = KTUtil.data(o).get("menu") : (l.init(t), l.reset(), l.build(), KTUtil.data(o).set("menu", n)), n
                    },
                    init: function(t) {
                        n.events = [], n.eventHandlers = {}, n.options = KTUtil.deepExtend({}, r, t), n.pauseDropdownHoverTime = 0, n.uid = KTUtil.getUniqueID()
                    },
                    update: function(t) {
                        n.options = KTUtil.deepExtend({}, r, t), n.pauseDropdownHoverTime = 0, l.reset(), n.eventHandlers = {}, l.build(), KTUtil.data(o).set("menu", n)
                    },
                    reload: function() {
                        l.reset(), l.build(), l.resetSubmenuProps()
                    },
                    build: function() {
                        n.eventHandlers.event_1 = KTUtil.on(o, ".kt-menu__toggle", "click", l.handleSubmenuAccordion), ("dropdown" === l.getSubmenuMode() || l.isConditionalSubmenuDropdown()) && (n.eventHandlers.event_2 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="hover"]', "mouseover", l.handleSubmenuDrodownHoverEnter), n.eventHandlers.event_3 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="hover"]', "mouseout", l.handleSubmenuDrodownHoverExit), n.eventHandlers.event_4 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="click"] > .kt-menu__toggle, [data-ktmenu-submenu-toggle="click"] > .kt-menu__link .kt-menu__toggle', "click", l.handleSubmenuDropdownClick), n.eventHandlers.event_5 = KTUtil.on(o, '[data-ktmenu-submenu-toggle="tab"] > .kt-menu__toggle, [data-ktmenu-submenu-toggle="tab"] > .kt-menu__link .kt-menu__toggle', "click", l.handleSubmenuDropdownTabClick)), n.eventHandlers.event_6 = KTUtil.on(o, ".kt-menu__item > .kt-menu__link:not(.kt-menu__toggle):not(.kt-menu__link--toggle-skip)", "click", l.handleLinkClick), n.options.scroll && n.options.scroll.height && l.scrollInit()
                    },
                    reset: function() {
                        KTUtil.off(o, "click", n.eventHandlers.event_1), KTUtil.off(o, "mouseover", n.eventHandlers.event_2), KTUtil.off(o, "mouseout", n.eventHandlers.event_3), KTUtil.off(o, "click", n.eventHandlers.event_4), KTUtil.off(o, "click", n.eventHandlers.event_5), KTUtil.off(o, "click", n.eventHandlers.event_6)
                    },
                    scrollInit: function() {
                        n.options.scroll && n.options.scroll.height ? (KTUtil.scrollDestroy(o), KTUtil.scrollInit(o, {
                            mobileNativeScroll: !0,
                            windowScroll: !1,
                            resetHeightOnDestroy: !0,
                            handleWindowResize: !0,
                            height: n.options.scroll.height,
                            rememberPosition: n.options.scroll.rememberPosition
                        })) : KTUtil.scrollDestroy(o)
                    },
                    scrollUpdate: function() {
                        n.options.scroll && n.options.scroll.height && KTUtil.scrollUpdate(o)
                    },
                    scrollTop: function() {
                        n.options.scroll && n.options.scroll.height && KTUtil.scrollTop(o)
                    },
                    getSubmenuMode: function(t) {
                        return KTUtil.isInResponsiveRange("desktop") ? t && KTUtil.hasAttr(t, "data-ktmenu-submenu-toggle") && "hover" == KTUtil.attr(t, "data-ktmenu-submenu-toggle") ? "dropdown" : KTUtil.isset(n.options.submenu, "desktop.state.body") ? KTUtil.hasClasses(a, n.options.submenu.desktop.state.body) ? n.options.submenu.desktop.state.mode : n.options.submenu.desktop.default : KTUtil.isset(n.options.submenu, "desktop") ? n.options.submenu.desktop : void 0 : KTUtil.isInResponsiveRange("tablet") && KTUtil.isset(n.options.submenu, "tablet") ? n.options.submenu.tablet : !(!KTUtil.isInResponsiveRange("mobile") || !KTUtil.isset(n.options.submenu, "mobile")) && n.options.submenu.mobile
                    },
                    isConditionalSubmenuDropdown: function() {
                        return !(!KTUtil.isInResponsiveRange("desktop") || !KTUtil.isset(n.options.submenu, "desktop.state.body"))
                    },
                    resetSubmenuProps: function(t) {
                        var e = KTUtil.findAll(o, ".kt-menu__submenu");
                        if (e)
                            for (var n = 0, i = e.length; n < i; n++) KTUtil.css(e[0], "display", ""), KTUtil.css(e[0], "overflow", "")
                    },
                    handleSubmenuDrodownHoverEnter: function(t) {
                        "accordion" !== l.getSubmenuMode(this) && !1 !== n.resumeDropdownHover() && ("1" == this.getAttribute("data-hover") && (this.removeAttribute("data-hover"), clearTimeout(this.getAttribute("data-timeout")), this.removeAttribute("data-timeout")), l.showSubmenuDropdown(this))
                    },
                    handleSubmenuDrodownHoverExit: function(t) {
                        if (!1 !== n.resumeDropdownHover() && "accordion" !== l.getSubmenuMode(this)) {
                            var e = this,
                                i = n.options.dropdown.timeout,
                                o = setTimeout(function() {
                                    "1" == e.getAttribute("data-hover") && l.hideSubmenuDropdown(e, !0)
                                }, i);
                            e.setAttribute("data-hover", "1"), e.setAttribute("data-timeout", o)
                        }
                    },
                    handleSubmenuDropdownClick: function(t) {
                        if ("accordion" !== l.getSubmenuMode(this)) {
                            var e = this.closest(".kt-menu__item");
                            "accordion" != e.getAttribute("data-ktmenu-submenu-mode") && (!1 === KTUtil.hasClass(e, "kt-menu__item--hover") ? (KTUtil.addClass(e, "kt-menu__item--open-dropdown"), l.showSubmenuDropdown(e)) : (KTUtil.removeClass(e, "kt-menu__item--open-dropdown"), l.hideSubmenuDropdown(e, !0)), t.preventDefault())
                        }
                    },
                    handleSubmenuDropdownTabClick: function(t) {
                        if ("accordion" !== l.getSubmenuMode(this)) {
                            var e = this.closest(".kt-menu__item");
                            "accordion" != e.getAttribute("data-ktmenu-submenu-mode") && (0 == KTUtil.hasClass(e, "kt-menu__item--hover") && (KTUtil.addClass(e, "kt-menu__item--open-dropdown"), l.showSubmenuDropdown(e)), t.preventDefault())
                        }
                    },
                    handleLinkClick: function(t) {
                        var e = this.closest(".kt-menu__item.kt-menu__item--submenu");
                        !1 !== l.eventTrigger("linkClick", this, t) && e && "dropdown" === l.getSubmenuMode(e) && l.hideSubmenuDropdowns()
                    },
                    handleSubmenuDropdownClose: function(t, e) {
                        if ("accordion" !== l.getSubmenuMode(e)) {
                            var n = o.querySelectorAll(".kt-menu__item.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs)");
                            if (n.length > 0 && !1 === KTUtil.hasClass(e, "kt-menu__toggle") && 0 === e.querySelectorAll(".kt-menu__toggle").length)
                                for (var i = 0, a = n.length; i < a; i++) l.hideSubmenuDropdown(n[0], !0)
                        }
                    },
                    handleSubmenuAccordion: function(t, e) {
                        var i, o = e || this;
                        if ("dropdown" === l.getSubmenuMode(e) && (i = o.closest(".kt-menu__item")) && "accordion" != i.getAttribute("data-ktmenu-submenu-mode")) t.preventDefault();
                        else {
                            var a = o.closest(".kt-menu__item"),
                                r = KTUtil.child(a, ".kt-menu__submenu, .kt-menu__inner");
                            if (!KTUtil.hasClass(o.closest(".kt-menu__item"), "kt-menu__item--open-always") && a && r) {
                                t.preventDefault();
                                var s = n.options.accordion.slideSpeed;
                                if (!1 === KTUtil.hasClass(a, "kt-menu__item--open")) {
                                    if (!1 === n.options.accordion.expandAll) {
                                        var d = o.closest(".kt-menu__nav, .kt-menu__subnav"),
                                            c = KTUtil.children(d, ".kt-menu__item.kt-menu__item--open.kt-menu__item--submenu:not(.kt-menu__item--here):not(.kt-menu__item--open-always)");
                                        if (d && c)
                                            for (var u = 0, f = c.length; u < f; u++) {
                                                var p = c[0],
                                                    g = KTUtil.child(p, ".kt-menu__submenu");
                                                g && KTUtil.slideUp(g, s, function() {
                                                    l.scrollUpdate(), KTUtil.removeClass(p, "kt-menu__item--open")
                                                })
                                            }
                                    }
                                    KTUtil.slideDown(r, s, function() {
                                        l.scrollToItem(o), l.scrollUpdate(), l.eventTrigger("submenuToggle", r, t)
                                    }), KTUtil.addClass(a, "kt-menu__item--open")
                                } else KTUtil.slideUp(r, s, function() {
                                    l.scrollToItem(o), l.eventTrigger("submenuToggle", r, t)
                                }), KTUtil.removeClass(a, "kt-menu__item--open")
                            }
                        }
                    },
                    scrollToItem: function(t) {
                        KTUtil.isInResponsiveRange("desktop") && n.options.accordion.autoScroll && "1" !== o.getAttribute("data-ktmenu-scroll") && KTUtil.scrollTo(t, n.options.accordion.autoScrollSpeed)
                    },
                    hideSubmenuDropdown: function(t, e) {
                        e && (KTUtil.removeClass(t, "kt-menu__item--hover"), KTUtil.removeClass(t, "kt-menu__item--active-tab")), t.removeAttribute("data-hover"), t.getAttribute("data-ktmenu-dropdown-toggle-class") && KTUtil.removeClass(a, t.getAttribute("data-ktmenu-dropdown-toggle-class"));
                        var n = t.getAttribute("data-timeout");
                        t.removeAttribute("data-timeout"), clearTimeout(n)
                    },
                    hideSubmenuDropdowns: function() {
                        var t;
                        if (t = o.querySelectorAll('.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs):not([data-ktmenu-submenu-toggle="tab"])'))
                            for (var e = 0, n = t.length; e < n; e++) l.hideSubmenuDropdown(t[e], !0)
                    },
                    showSubmenuDropdown: function(t) {
                        var e = o.querySelectorAll(".kt-menu__item--submenu.kt-menu__item--hover, .kt-menu__item--submenu.kt-menu__item--active-tab");
                        if (e)
                            for (var n = 0, i = e.length; n < i; n++) {
                                var r = e[n];
                                t !== r && !1 === r.contains(t) && !1 === t.contains(r) && l.hideSubmenuDropdown(r, !0)
                            }
                        KTUtil.addClass(t, "kt-menu__item--hover"), t.getAttribute("data-ktmenu-dropdown-toggle-class") && KTUtil.addClass(a, t.getAttribute("data-ktmenu-dropdown-toggle-class"))
                    },
                    createSubmenuDropdownClickDropoff: function(t) {
                        var e, n = (e = KTUtil.child(t, ".kt-menu__submenu") ? KTUtil.css(e, "z-index") : 0) - 1,
                            i = document.createElement('<div class="kt-menu__dropoff" style="background: transparent; position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: ' + n + '"></div>');
                        a.appendChild(i), KTUtil.addEvent(i, "click", function(e) {
                            e.stopPropagation(), e.preventDefault(), KTUtil.remove(this), l.hideSubmenuDropdown(t, !0)
                        })
                    },
                    pauseDropdownHover: function(t) {
                        var e = new Date;
                        n.pauseDropdownHoverTime = e.getTime() + t
                    },
                    resumeDropdownHover: function() {
                        return (new Date).getTime() > n.pauseDropdownHoverTime
                    },
                    resetActiveItem: function(t) {
                        for (var e, i, a = 0, r = (e = o.querySelectorAll(".kt-menu__item--active")).length; a < r; a++) {
                            var l = e[0];
                            KTUtil.removeClass(l, "kt-menu__item--active"), KTUtil.hide(KTUtil.child(l, ".kt-menu__submenu"));
                            for (var s = 0, d = (i = KTUtil.parents(l, ".kt-menu__item--submenu") || []).length; s < d; s++) {
                                var c = i[a];
                                KTUtil.removeClass(c, "kt-menu__item--open"), KTUtil.hide(KTUtil.child(c, ".kt-menu__submenu"))
                            }
                        }
                        if (!1 === n.options.accordion.expandAll && (e = o.querySelectorAll(".kt-menu__item--open")))
                            for (a = 0, r = e.length; a < r; a++) KTUtil.removeClass(i[0], "kt-menu__item--open")
                    },
                    setActiveItem: function(t) {
                        l.resetActiveItem();
                        for (var e = KTUtil.parents(t, ".kt-menu__item--submenu") || [], n = 0, i = e.length; n < i; n++) KTUtil.addClass(KTUtil.get(e[n]), "kt-menu__item--open");
                        KTUtil.addClass(KTUtil.get(t), "kt-menu__item--active")
                    },
                    getBreadcrumbs: function(t) {
                        var e, n = [],
                            i = KTUtil.child(t, ".kt-menu__link");
                        n.push({
                            text: e = KTUtil.child(i, ".kt-menu__link-text") ? e.innerHTML : "",
                            title: i.getAttribute("title"),
                            href: i.getAttribute("href")
                        });
                        for (var o = KTUtil.parents(t, ".kt-menu__item--submenu"), a = 0, r = o.length; a < r; a++) {
                            var l = KTUtil.child(o[a], ".kt-menu__link");
                            n.push({
                                text: e = KTUtil.child(l, ".kt-menu__link-text") ? e.innerHTML : "",
                                title: l.getAttribute("title"),
                                href: l.getAttribute("href")
                            })
                        }
                        return n.reverse()
                    },
                    getPageTitle: function(t) {
                        return KTUtil.child(t, ".kt-menu__link-text") ? (void 0).innerHTML : ""
                    },
                    eventTrigger: function(t, e, i) {
                        for (var o = 0; o < n.events.length; o++) {
                            var a = n.events[o];
                            if (a.name == t) {
                                if (1 != a.one) return a.handler.call(this, e, i);
                                if (0 == a.fired) return n.events[o].fired = !0, a.handler.call(this, e, i)
                            }
                        }
                    },
                    addEvent: function(t, e, i) {
                        n.events.push({
                            name: t,
                            handler: e,
                            one: i,
                            fired: !1
                        })
                    },
                    removeEvent: function(t) {
                        n.events[t] && delete n.events[t]
                    }
                };
            return n.setDefaults = function(t) {
                r = t
            }, n.scrollUpdate = function() {
                return l.scrollUpdate()
            }, n.scrollReInit = function() {
                return l.scrollInit()
            }, n.scrollTop = function() {
                return l.scrollTop()
            }, n.setActiveItem = function(t) {
                return l.setActiveItem(t)
            }, n.reload = function() {
                return l.reload()
            }, n.update = function(t) {
                return l.update(t)
            }, n.getBreadcrumbs = function(t) {
                return l.getBreadcrumbs(t)
            }, n.getPageTitle = function(t) {
                return l.getPageTitle(t)
            }, n.getSubmenuMode = function(t) {
                return l.getSubmenuMode(t)
            }, n.hideDropdown = function(t) {
                l.hideSubmenuDropdown(t, !0)
            }, n.hideDropdowns = function() {
                l.hideSubmenuDropdowns()
            }, n.pauseDropdownHover = function(t) {
                l.pauseDropdownHover(t)
            }, n.resumeDropdownHover = function() {
                return l.resumeDropdownHover()
            }, n.on = function(t, e) {
                return l.addEvent(t, e)
            }, n.off = function(t) {
                return l.removeEvent(t)
            }, n.one = function(t, e) {
                return l.addEvent(t, e, !0)
            }, l.construct.apply(n, [e]), KTUtil.addResizeHandler(function() {
                i && n.reload()
            }), i = !0, n
        }
    };
document.addEventListener("click", function(t) {
    var e;
    if (e = KTUtil.get("body").querySelectorAll('.kt-menu__nav .kt-menu__item.kt-menu__item--submenu.kt-menu__item--hover:not(.kt-menu__item--tabs)[data-ktmenu-submenu-toggle="click"]'))
        for (var n = 0, i = e.length; n < i; n++) {
            var o = e[n].closest(".kt-menu__nav").parentNode;
            if (o) {
                var a = KTUtil.data(o).get("menu");
                if (!a) break;
                if (!a || "dropdown" !== a.getSubmenuMode()) break;
                t.target !== o && !1 === o.contains(t.target) && a.hideDropdowns()
            }
        }
});
var KTOffcanvas = function(t, e) {
        var n = this,
            i = KTUtil.get(t),
            o = KTUtil.get("body");
        if (i) {
            var a = {},
                r = {
                    construct: function(t) {
                        return KTUtil.data(i).has("offcanvas") ? n = KTUtil.data(i).get("offcanvas") : (r.init(t), r.build(), KTUtil.data(i).set("offcanvas", n)), n
                    },
                    init: function(t) {
                        n.events = [], n.options = KTUtil.deepExtend({}, a, t), n.overlay, n.classBase = n.options.baseClass, n.classShown = n.classBase + "--on", n.classOverlay = n.classBase + "-overlay", n.state = KTUtil.hasClass(i, n.classShown) ? "shown" : "hidden"
                    },
                    build: function() {
                        if (n.options.toggleBy)
                            if ("string" == typeof n.options.toggleBy) KTUtil.addEvent(n.options.toggleBy, "click", function(t) {
                                t.preventDefault(), r.toggle()
                            });
                            else if (n.options.toggleBy && n.options.toggleBy[0])
                            if (n.options.toggleBy[0].target)
                                for (var t in n.options.toggleBy) KTUtil.addEvent(n.options.toggleBy[t].target, "click", function(t) {
                                    t.preventDefault(), r.toggle()
                                });
                            else
                                for (var t in n.options.toggleBy) KTUtil.addEvent(n.options.toggleBy[t], "click", function(t) {
                                    t.preventDefault(), r.toggle()
                                });
                        else n.options.toggleBy && n.options.toggleBy.target && KTUtil.addEvent(n.options.toggleBy.target, "click", function(t) {
                            t.preventDefault(), r.toggle()
                        });
                        var e = KTUtil.get(n.options.closeBy);
                        e && KTUtil.addEvent(e, "click", function(t) {
                            t.preventDefault(), r.hide()
                        }), KTUtil.addResizeHandler(function() {
                            (parseInt(KTUtil.css(i, "left")) >= 0 || parseInt(KTUtil.css(i, "right") >= 0) || "fixed" != KTUtil.css(i, "position")) && KTUtil.css(i, "opacity", "1")
                        })
                    },
                    isShown: function(t) {
                        return "shown" == n.state
                    },
                    toggle: function() {
                        r.eventTrigger("toggle"), "shown" == n.state ? r.hide(this) : r.show(this)
                    },
                    show: function(t) {
                        "shown" != n.state && (r.eventTrigger("beforeShow"), r.togglerClass(t, "show"), KTUtil.addClass(o, n.classShown), KTUtil.addClass(i, n.classShown), KTUtil.css(i, "opacity", "1"), n.state = "shown", n.options.overlay && (n.overlay = KTUtil.insertAfter(document.createElement("DIV"), i), KTUtil.addClass(n.overlay, n.classOverlay), KTUtil.addEvent(n.overlay, "click", function(e) {
                            e.stopPropagation(), e.preventDefault(), r.hide(t)
                        })), r.eventTrigger("afterShow"))
                    },
                    hide: function(t) {
                        "hidden" != n.state && (r.eventTrigger("beforeHide"), r.togglerClass(t, "hide"), KTUtil.removeClass(o, n.classShown), KTUtil.removeClass(i, n.classShown), n.state = "hidden", n.options.overlay && n.overlay && KTUtil.remove(n.overlay), KTUtil.transitionEnd(i, function() {
                            KTUtil.css(i, "opacity", "0")
                        }), r.eventTrigger("afterHide"))
                    },
                    togglerClass: function(t, e) {
                        var i, o = KTUtil.attr(t, "id");
                        if (n.options.toggleBy && n.options.toggleBy[0] && n.options.toggleBy[0].target)
                            for (var a in n.options.toggleBy) n.options.toggleBy[a].target === o && (i = n.options.toggleBy[a]);
                        else n.options.toggleBy && n.options.toggleBy.target && (i = n.options.toggleBy);
                        if (i) {
                            var r = KTUtil.get(i.target);
                            "show" === e && KTUtil.addClass(r, i.state), "hide" === e && KTUtil.removeClass(r, i.state)
                        }
                    },
                    eventTrigger: function(t, e) {
                        for (var i = 0; i < n.events.length; i++) {
                            var o = n.events[i];
                            o.name == t && (1 == o.one ? 0 == o.fired && (n.events[i].fired = !0, o.handler.call(this, n, e)) : o.handler.call(this, n, e))
                        }
                    },
                    addEvent: function(t, e, i) {
                        n.events.push({
                            name: t,
                            handler: e,
                            one: i,
                            fired: !1
                        })
                    }
                };
            return n.setDefaults = function(t) {
                a = t
            }, n.isShown = function() {
                return r.isShown()
            }, n.hide = function() {
                return r.hide()
            }, n.show = function() {
                return r.show()
            }, n.on = function(t, e) {
                return r.addEvent(t, e)
            }, n.one = function(t, e) {
                return r.addEvent(t, e, !0)
            }, r.construct.apply(n, [e]), n
        }
    },
    KTPortlet = function(t, e) {
        var n = this,
            i = KTUtil.get(t),
            o = KTUtil.get("body");
        if (i) {
            var a = {
                    bodyToggleSpeed: 400,
                    tooltips: !0,
                    tools: {
                        toggle: {
                            collapse: "Collapse",
                            expand: "Expand"
                        },
                        reload: "Reload",
                        remove: "Remove",
                        fullscreen: {
                            on: "Fullscreen",
                            off: "Exit Fullscreen"
                        }
                    },
                    sticky: {
                        offset: 300,
                        zIndex: 101
                    }
                },
                r = {
                    construct: function(t) {
                        return KTUtil.data(i).has("portlet") ? n = KTUtil.data(i).get("portlet") : (r.init(t), r.build(), KTUtil.data(i).set("portlet", n)), n
                    },
                    init: function(t) {
                        n.element = i, n.events = [], n.options = KTUtil.deepExtend({}, a, t), n.head = KTUtil.child(i, ".kt-portlet__head"), n.foot = KTUtil.child(i, ".kt-portlet__foot"), KTUtil.child(i, ".kt-portlet__body") ? n.body = KTUtil.child(i, ".kt-portlet__body") : KTUtil.child(i, ".kt-form") && (n.body = KTUtil.child(i, ".kt-form"))
                    },
                    build: function() {
                        var t = KTUtil.find(n.head, "[data-ktportlet-tool=remove]");
                        t && KTUtil.addEvent(t, "click", function(t) {
                            t.preventDefault(), r.remove()
                        });
                        var e = KTUtil.find(n.head, "[data-ktportlet-tool=reload]");
                        e && KTUtil.addEvent(e, "click", function(t) {
                            t.preventDefault(), r.reload()
                        });
                        var i = KTUtil.find(n.head, "[data-ktportlet-tool=toggle]");
                        i && KTUtil.addEvent(i, "click", function(t) {
                            t.preventDefault(), r.toggle()
                        });
                        var o = KTUtil.find(n.head, "[data-ktportlet-tool=fullscreen]");
                        o && KTUtil.addEvent(o, "click", function(t) {
                            t.preventDefault(), r.fullscreen()
                        }), r.setupTooltips()
                    },
                    initSticky: function() {
                        n.options.sticky.offset, n.head && window.addEventListener("scroll", r.onScrollSticky)
                    },
                    onScrollSticky: function(t) {
                        var e = n.options.sticky.offset;
                        if (!isNaN(e)) {
                            var a = document.documentElement.scrollTop;
                            a >= e && !1 === KTUtil.hasClass(o, "kt-portlet--sticky") ? (r.eventTrigger("stickyOn"), KTUtil.addClass(o, "kt-portlet--sticky"), KTUtil.addClass(i, "kt-portlet--sticky"), r.updateSticky()) : 1.5 * a <= e && KTUtil.hasClass(o, "kt-portlet--sticky") && (r.eventTrigger("stickyOff"), KTUtil.removeClass(o, "kt-portlet--sticky"), KTUtil.removeClass(i, "kt-portlet--sticky"), r.resetSticky())
                        }
                    },
                    updateSticky: function() {
                        var t, e, i;
                        n.head && KTUtil.hasClass(o, "kt-portlet--sticky") && (t = n.options.sticky.position.top instanceof Function ? parseInt(n.options.sticky.position.top.call(this, n)) : parseInt(n.options.sticky.position.top), e = n.options.sticky.position.left instanceof Function ? parseInt(n.options.sticky.position.left.call(this, n)) : parseInt(n.options.sticky.position.left), i = n.options.sticky.position.right instanceof Function ? parseInt(n.options.sticky.position.right.call(this, n)) : parseInt(n.options.sticky.position.right), KTUtil.css(n.head, "z-index", n.options.sticky.zIndex), KTUtil.css(n.head, "top", t + "px"), KTUtil.css(n.head, "left", e + "px"), KTUtil.css(n.head, "right", i + "px"))
                    },
                    resetSticky: function() {
                        n.head && !1 === KTUtil.hasClass(o, "kt-portlet--sticky") && (KTUtil.css(n.head, "z-index", ""), KTUtil.css(n.head, "top", ""), KTUtil.css(n.head, "left", ""), KTUtil.css(n.head, "right", ""))
                    },
                    remove: function() {
                        !1 !== r.eventTrigger("beforeRemove") && (KTUtil.hasClass(o, "kt-portlet--fullscreen") && KTUtil.hasClass(i, "kt-portlet--fullscreen") && r.fullscreen("off"), r.removeTooltips(), KTUtil.remove(i), r.eventTrigger("afterRemove"))
                    },
                    setContent: function(t) {
                        t && (n.body.innerHTML = t)
                    },
                    getBody: function() {
                        return n.body
                    },
                    getSelf: function() {
                        return i
                    },
                    setupTooltips: function() {
                        if (n.options.tooltips) {
                            var t = KTUtil.hasClass(i, "kt-portlet--collapse") || KTUtil.hasClass(i, "kt-portlet--collapsed"),
                                e = KTUtil.hasClass(o, "kt-portlet--fullscreen") && KTUtil.hasClass(i, "kt-portlet--fullscreen"),
                                a = KTUtil.find(n.head, "[data-ktportlet-tool=remove]");
                            if (a) {
                                var r = e ? "bottom" : "top",
                                    l = new Tooltip(a, {
                                        title: n.options.tools.remove,
                                        placement: r,
                                        offset: e ? "0,10px,0,0" : "0,5px",
                                        trigger: "hover",
                                        template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + r + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                    });
                                KTUtil.data(a).set("tooltip", l)
                            }
                            var s = KTUtil.find(n.head, "[data-ktportlet-tool=reload]");
                            s && (r = e ? "bottom" : "top", l = new Tooltip(s, {
                                title: n.options.tools.reload,
                                placement: r,
                                offset: e ? "0,10px,0,0" : "0,5px",
                                trigger: "hover",
                                template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + r + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                            }), KTUtil.data(s).set("tooltip", l));
                            var d = KTUtil.find(n.head, "[data-ktportlet-tool=toggle]");
                            d && (r = e ? "bottom" : "top", l = new Tooltip(d, {
                                title: t ? n.options.tools.toggle.expand : n.options.tools.toggle.collapse,
                                placement: r,
                                offset: e ? "0,10px,0,0" : "0,5px",
                                trigger: "hover",
                                template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + r + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                            }), KTUtil.data(d).set("tooltip", l));
                            var c = KTUtil.find(n.head, "[data-ktportlet-tool=fullscreen]");
                            c && (r = e ? "bottom" : "top", l = new Tooltip(c, {
                                title: e ? n.options.tools.fullscreen.off : n.options.tools.fullscreen.on,
                                placement: r,
                                offset: e ? "0,10px,0,0" : "0,5px",
                                trigger: "hover",
                                template: '<div class="tooltip tooltip-portlet tooltip bs-tooltip-' + r + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                            }), KTUtil.data(c).set("tooltip", l))
                        }
                    },
                    removeTooltips: function() {
                        if (n.options.tooltips) {
                            var t = KTUtil.find(n.head, "[data-ktportlet-tool=remove]");
                            t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").dispose();
                            var e = KTUtil.find(n.head, "[data-ktportlet-tool=reload]");
                            e && KTUtil.data(e).has("tooltip") && KTUtil.data(e).get("tooltip").dispose();
                            var i = KTUtil.find(n.head, "[data-ktportlet-tool=toggle]");
                            i && KTUtil.data(i).has("tooltip") && KTUtil.data(i).get("tooltip").dispose();
                            var o = KTUtil.find(n.head, "[data-ktportlet-tool=fullscreen]");
                            o && KTUtil.data(o).has("tooltip") && KTUtil.data(o).get("tooltip").dispose()
                        }
                    },
                    reload: function() {
                        r.eventTrigger("reload")
                    },
                    toggle: function() {
                        KTUtil.hasClass(i, "kt-portlet--collapse") || KTUtil.hasClass(i, "kt-portlet--collapsed") ? r.expand() : r.collapse()
                    },
                    collapse: function() {
                        if (!1 !== r.eventTrigger("beforeCollapse")) {
                            KTUtil.slideUp(n.body, n.options.bodyToggleSpeed, function() {
                                r.eventTrigger("afterCollapse")
                            }), KTUtil.addClass(i, "kt-portlet--collapse");
                            var t = KTUtil.find(n.head, "[data-ktportlet-tool=toggle]");
                            t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").updateTitleContent(n.options.tools.toggle.expand)
                        }
                    },
                    expand: function() {
                        if (!1 !== r.eventTrigger("beforeExpand")) {
                            KTUtil.slideDown(n.body, n.options.bodyToggleSpeed, function() {
                                r.eventTrigger("afterExpand")
                            }), KTUtil.removeClass(i, "kt-portlet--collapse"), KTUtil.removeClass(i, "kt-portlet--collapsed");
                            var t = KTUtil.find(n.head, "[data-ktportlet-tool=toggle]");
                            t && KTUtil.data(t).has("tooltip") && KTUtil.data(t).get("tooltip").updateTitleContent(n.options.tools.toggle.collapse)
                        }
                    },
                    fullscreen: function(t) {
                        if ("off" === t || KTUtil.hasClass(o, "kt-portlet--fullscreen") && KTUtil.hasClass(i, "kt-portlet--fullscreen")) r.eventTrigger("beforeFullscreenOff"), KTUtil.removeClass(o, "kt-portlet--fullscreen"), KTUtil.removeClass(i, "kt-portlet--fullscreen"), r.removeTooltips(), r.setupTooltips(), n.foot && (KTUtil.css(n.body, "margin-bottom", ""), KTUtil.css(n.foot, "margin-top", "")), r.eventTrigger("afterFullscreenOff");
                        else {
                            if (r.eventTrigger("beforeFullscreenOn"), KTUtil.addClass(i, "kt-portlet--fullscreen"), KTUtil.addClass(o, "kt-portlet--fullscreen"), r.removeTooltips(), r.setupTooltips(), n.foot) {
                                var e = parseInt(KTUtil.css(n.foot, "height")),
                                    a = parseInt(KTUtil.css(n.foot, "height")) + parseInt(KTUtil.css(n.head, "height"));
                                KTUtil.css(n.body, "margin-bottom", e + "px"), KTUtil.css(n.foot, "margin-top", "-" + a + "px")
                            }
                            r.eventTrigger("afterFullscreenOn")
                        }
                    },
                    eventTrigger: function(t) {
                        for (var e = 0; e < n.events.length; e++) {
                            var i = n.events[e];
                            i.name == t && (1 == i.one ? 0 == i.fired && (n.events[e].fired = !0, i.handler.call(this, n)) : i.handler.call(this, n))
                        }
                    },
                    addEvent: function(t, e, i) {
                        return n.events.push({
                            name: t,
                            handler: e,
                            one: i,
                            fired: !1
                        }), n
                    }
                };
            return n.setDefaults = function(t) {
                a = t
            }, n.remove = function() {
                return r.remove(html)
            }, n.initSticky = function() {
                return r.initSticky()
            }, n.updateSticky = function() {
                return r.updateSticky()
            }, n.resetSticky = function() {
                return r.resetSticky()
            }, n.destroySticky = function() {
                r.resetSticky(), window.removeEventListener("scroll", r.onScrollSticky)
            }, n.reload = function() {
                return r.reload()
            }, n.setContent = function(t) {
                return r.setContent(t)
            }, n.toggle = function() {
                return r.toggle()
            }, n.collapse = function() {
                return r.collapse()
            }, n.expand = function() {
                return r.expand()
            }, n.fullscreen = function() {
                return r.fullscreen("on")
            }, n.unFullscreen = function() {
                return r.fullscreen("off")
            }, n.getBody = function() {
                return r.getBody()
            }, n.getSelf = function() {
                return r.getSelf()
            }, n.on = function(t, e) {
                return r.addEvent(t, e)
            }, n.one = function(t, e) {
                return r.addEvent(t, e, !0)
            }, r.construct.apply(n, [e]), n
        }
    },
    KTToggle = function(t, e) {
        var n = this,
            i = KTUtil.get(t);
        if (KTUtil.get("body"), i) {
            var o = {
                    togglerState: "",
                    targetState: ""
                },
                a = {
                    construct: function(t) {
                        return KTUtil.data(i).has("toggle") ? n = KTUtil.data(i).get("toggle") : (a.init(t), a.build(), KTUtil.data(i).set("toggle", n)), n
                    },
                    init: function(t) {
                        n.element = i, n.events = [], n.options = KTUtil.deepExtend({}, o, t), n.target = KTUtil.get(n.options.target), n.targetState = n.options.targetState, n.togglerState = n.options.togglerState, n.state = KTUtil.hasClasses(n.target, n.targetState) ? "on" : "off"
                    },
                    build: function() {
                        KTUtil.addEvent(i, "mouseup", a.toggle)
                    },
                    toggle: function(t) {
                        return a.eventTrigger("beforeToggle"), "off" == n.state ? a.toggleOn() : a.toggleOff(), a.eventTrigger("afterToggle"), t.preventDefault(), n
                    },
                    toggleOn: function() {
                        return a.eventTrigger("beforeOn"), KTUtil.addClass(n.target, n.targetState), n.togglerState && KTUtil.addClass(i, n.togglerState), n.state = "on", a.eventTrigger("afterOn"), a.eventTrigger("toggle"), n
                    },
                    toggleOff: function() {
                        return a.eventTrigger("beforeOff"), KTUtil.removeClass(n.target, n.targetState), n.togglerState && KTUtil.removeClass(i, n.togglerState), n.state = "off", a.eventTrigger("afterOff"), a.eventTrigger("toggle"), n
                    },
                    eventTrigger: function(t) {
                        for (var e = 0; e < n.events.length; e++) {
                            var i = n.events[e];
                            i.name == t && (1 == i.one ? 0 == i.fired && (n.events[e].fired = !0, i.handler.call(this, n)) : i.handler.call(this, n))
                        }
                    },
                    addEvent: function(t, e, i) {
                        return n.events.push({
                            name: t,
                            handler: e,
                            one: i,
                            fired: !1
                        }), n
                    }
                };
            return n.setDefaults = function(t) {
                o = t
            }, n.getState = function() {
                return n.state
            }, n.toggle = function() {
                return a.toggle()
            }, n.toggleOn = function() {
                return a.toggleOn()
            }, n.toggleOff = function() {
                return a.toggleOff()
            }, n.on = function(t, e) {
                return a.addEvent(t, e)
            }, n.one = function(t, e) {
                return a.addEvent(t, e, !0)
            }, a.construct.apply(n, [e]), n
        }
    },
    KTWizard = function(t, e) {
        var n = this,
            i = KTUtil.get(void 0);
        if (KTUtil.get("body"), i) {
            var o = {
                    startStep: 1,
                    manualStepForward: !1
                },
                a = {
                    construct: function(t) {
                        return KTUtil.data(i).has("wizard") ? n = KTUtil.data(i).get("wizard") : (a.init(t), a.build(), KTUtil.data(i).set("wizard", n)), n
                    },
                    init: function(t) {
                        n.element = i, n.events = [], n.options = KTUtil.deepExtend({}, o, t), n.steps = KTUtil.findAll(i, '[data-ktwizard-type="step"]'), n.btnSubmit = KTUtil.find(i, '[data-ktwizard-type="action-submit"]'), n.btnNext = KTUtil.find(i, '[data-ktwizard-type="action-next"]'), n.btnPrev = KTUtil.find(i, '[data-ktwizard-type="action-prev"]'), n.btnLast = KTUtil.find(i, '[data-ktwizard-type="action-last"]'), n.btnFirst = KTUtil.find(i, '[data-ktwizard-type="action-first"]'), n.events = [], n.currentStep = 1, n.stopped = !1, n.totalSteps = n.steps.length, n.options.startStep > 1 && a.goTo(n.options.startStep), a.updateUI()
                    },
                    build: function() {
                        KTUtil.addEvent(n.btnNext, "click", function(t) {
                            t.preventDefault(), a.goNext()
                        }), KTUtil.addEvent(n.btnPrev, "click", function(t) {
                            t.preventDefault(), a.goPrev()
                        }), KTUtil.addEvent(n.btnFirst, "click", function(t) {
                            t.preventDefault(), a.goFirst()
                        }), KTUtil.addEvent(n.btnLast, "click", function(t) {
                            t.preventDefault(), a.goLast()
                        }), KTUtil.on(i, 'a[data-ktwizard-type="step"]', "click", function() {
                            var t = KTUtil.index(this) + 1;
                            t !== n.currentStep && a.goTo(t)
                        })
                    },
                    goTo: function(t) {
                        if (!(t === n.currentStep || t > n.totalSteps || t < 0)) {
                            var e;
                            if (e = (t = t ? parseInt(t) : a.getNextStep()) > n.currentStep ? a.eventTrigger("beforeNext") : a.eventTrigger("beforePrev"), !0 !== n.stopped) return !1 !== e && (a.eventTrigger("beforeChange"), n.currentStep = t, a.updateUI(), a.eventTrigger("change")), t > n.startStep ? a.eventTrigger("afterNext") : a.eventTrigger("afterPrev"), n;
                            n.stopped = !1
                        }
                    },
                    stop: function() {
                        n.stopped = !0
                    },
                    start: function() {
                        n.stopped = !1
                    },
                    isLastStep: function() {
                        return n.currentStep === n.totalSteps
                    },
                    isFirstStep: function() {
                        return 1 === n.currentStep
                    },
                    isBetweenStep: function() {
                        return !1 === a.isLastStep() && !1 === a.isFirstStep()
                    },
                    goNext: function() {
                        return a.goTo(a.getNextStep())
                    },
                    goPrev: function() {
                        return a.goTo(a.getPrevStep())
                    },
                    goLast: function() {
                        return a.goTo(n.totalSteps)
                    },
                    goFirst: function() {
                        return a.goTo(1)
                    },
                    updateUI: function() {
                        var t, e = n.currentStep - 1;
                        t = a.isLastStep() ? "last" : a.isFirstStep() ? "first" : "between", KTUtil.attr(n.element, "data-ktwizard-state", t);
                        var i = KTUtil.findAll(n.element, '[data-ktwizard-type="step"]');
                        if (i && i.length > 0)
                            for (var o = 0, r = i.length; o < r; o++) o == e ? KTUtil.attr(i[o], "data-ktwizard-state", "current") : o < e ? KTUtil.attr(i[o], "data-ktwizard-state", "done") : KTUtil.attr(i[o], "data-ktwizard-state", "pending");
                        var l = KTUtil.findAll(n.element, '[data-ktwizard-type="step-info"]');
                        if (l && l.length > 0)
                            for (o = 0, r = l.length; o < r; o++) o == e ? KTUtil.attr(l[o], "data-ktwizard-state", "current") : KTUtil.removeAttr(l[o], "data-ktwizard-state");
                        var s = KTUtil.findAll(n.element, '[data-ktwizard-type="step-content"]');
                        if (s && s.length > 0)
                            for (o = 0, r = s.length; o < r; o++) o == e ? KTUtil.attr(s[o], "data-ktwizard-state", "current") : KTUtil.removeAttr(s[o], "data-ktwizard-state")
                    },
                    getNextStep: function() {
                        return n.totalSteps >= n.currentStep + 1 ? n.currentStep + 1 : n.totalSteps
                    },
                    getPrevStep: function() {
                        return n.currentStep - 1 >= 1 ? n.currentStep - 1 : 1
                    },
                    eventTrigger: function(t) {
                        for (var e = 0; e < n.events.length; e++) {
                            var i = n.events[e];
                            i.name == t && (1 == i.one ? 0 == i.fired && (n.events[e].fired = !0, i.handler.call(this, n)) : i.handler.call(this, n))
                        }
                    },
                    addEvent: function(t, e, i) {
                        return n.events.push({
                            name: t,
                            handler: e,
                            one: i,
                            fired: !1
                        }), n
                    }
                };
            return n.setDefaults = function(t) {
                o = t
            }, n.goNext = function() {
                return a.goNext()
            }, n.goPrev = function() {
                return a.goPrev()
            }, n.goLast = function() {
                return a.goLast()
            }, n.stop = function() {
                return a.stop()
            }, n.start = function() {
                return a.start()
            }, n.goFirst = function() {
                return a.goFirst()
            }, n.goTo = function(t) {
                return a.goTo(t)
            }, n.getStep = function() {
                return n.currentStep
            }, n.isLastStep = function() {
                return a.isLastStep()
            }, n.isFirstStep = function() {
                return a.isFirstStep()
            }, n.on = function(t, e) {
                return a.addEvent(t, e)
            }, n.one = function(t, e) {
                return a.addEvent(t, e, !0)
            }, a.construct.apply(n, [void 0]), n
        }
    }(),
    KTOffcanvasPanel = function() {
        var t = KTUtil.get("kt_offcanvas_toolbar_notifications"),
            e = KTUtil.get("kt_offcanvas_toolbar_quick_actions"),
            n = KTUtil.get("kt_offcanvas_toolbar_profile"),
            i = KTUtil.get("kt_offcanvas_toolbar_search");
        return {
            init: function() {
                ! function() {
                    var e = KTUtil.find(t, ".kt-offcanvas-panel__head"),
                        n = KTUtil.find(t, ".kt-offcanvas-panel__body");
                    new KTOffcanvas(t, {
                        overlay: !0,
                        baseClass: "kt-offcanvas-panel",
                        closeBy: "kt_offcanvas_toolbar_notifications_close",
                        toggleBy: "kt_offcanvas_toolbar_notifications_toggler_btn"
                    }), KTUtil.scrollInit(n, {
                        mobileNativeScroll: !0,
                        resetHeightOnDestroy: !0,
                        handleWindowResize: !0,
                        height: function() {
                            var n = parseInt(KTUtil.getViewPort().height);
                            return e && (n -= parseInt(KTUtil.actualHeight(e)), n -= parseInt(KTUtil.css(e, "marginBottom"))), (n -= parseInt(KTUtil.css(t, "paddingTop"))) - parseInt(KTUtil.css(t, "paddingBottom"))
                        }
                    })
                }(),
                function() {
                    var t = KTUtil.find(e, ".kt-offcanvas-panel__head"),
                        n = KTUtil.find(e, ".kt-offcanvas-panel__body");
                    new KTOffcanvas(e, {
                        overlay: !0,
                        baseClass: "kt-offcanvas-panel",
                        closeBy: "kt_offcanvas_toolbar_quick_actions_close",
                        toggleBy: "kt_offcanvas_toolbar_quick_actions_toggler_btn"
                    }), KTUtil.scrollInit(n, {
                        mobileNativeScroll: !0,
                        resetHeightOnDestroy: !0,
                        handleWindowResize: !0,
                        height: function() {
                            var n = parseInt(KTUtil.getViewPort().height);
                            return t && (n -= parseInt(KTUtil.actualHeight(t)), n -= parseInt(KTUtil.css(t, "marginBottom"))), (n -= parseInt(KTUtil.css(e, "paddingTop"))) - parseInt(KTUtil.css(e, "paddingBottom"))
                        }
                    })
                }(),
                function() {
                    var t = KTUtil.find(n, ".kt-offcanvas-panel__head"),
                        e = KTUtil.find(n, ".kt-offcanvas-panel__body");
                    new KTOffcanvas(n, {
                        overlay: !0,
                        baseClass: "kt-offcanvas-panel",
                        closeBy: "kt_offcanvas_toolbar_profile_close",
                        toggleBy: "kt_offcanvas_toolbar_profile_toggler_btn"
                    }), KTUtil.scrollInit(e, {
                        mobileNativeScroll: !0,
                        resetHeightOnDestroy: !0,
                        handleWindowResize: !0,
                        height: function() {
                            var e = parseInt(KTUtil.getViewPort().height);
                            return t && (e -= parseInt(KTUtil.actualHeight(t)), e -= parseInt(KTUtil.css(t, "marginBottom"))), (e -= parseInt(KTUtil.css(n, "paddingTop"))) - parseInt(KTUtil.css(n, "paddingBottom"))
                        }
                    })
                }(),
                function() {
                    var t = KTUtil.find(i, ".kt-offcanvas-panel__head"),
                        e = KTUtil.find(i, ".kt-offcanvas-panel__body");
                    new KTOffcanvas(i, {
                        overlay: !0,
                        baseClass: "kt-offcanvas-panel",
                        closeBy: "kt_offcanvas_toolbar_search_close",
                        toggleBy: "kt_offcanvas_toolbar_search_toggler_btn"
                    }), KTUtil.scrollInit(e, {
                        mobileNativeScroll: !0,
                        resetHeightOnDestroy: !0,
                        handleWindowResize: !0,
                        height: function() {
                            var e = parseInt(KTUtil.getViewPort().height);
                            return t && (e -= parseInt(KTUtil.actualHeight(t)), e -= parseInt(KTUtil.css(t, "marginBottom"))), (e -= parseInt(KTUtil.css(i, "paddingTop"))) - parseInt(KTUtil.css(i, "paddingBottom"))
                        }
                    })
                }()
            }
        }
    }();
$(document).ready(function() {
    KTOffcanvasPanel.init()
});
var KTQuickPanel = function() {
    var t = KTUtil.get("kt_quick_panel"),
        e = KTUtil.get("kt_quick_panel_tab_notifications"),
        n = KTUtil.get("kt_quick_panel_tab_logs"),
        i = KTUtil.get("kt_quick_panel_tab_settings"),
        o = function() {
            var e = KTUtil.find(t, ".kt-quick-panel__nav");
            return KTUtil.find(t, ".kt-quick-panel__content"), parseInt(KTUtil.getViewPort().height) - parseInt(KTUtil.actualHeight(e)) - 2 * parseInt(KTUtil.css(e, "padding-top")) - 10
        };
    return {
        init: function() {
            new KTOffcanvas(t, {
                overlay: !0,
                baseClass: "kt-quick-panel",
                closeBy: "kt_quick_panel_close_btn",
                toggleBy: "kt_quick_panel_toggler_btn"
            }), KTUtil.scrollInit(e, {
                mobileNativeScroll: !0,
                resetHeightOnDestroy: !0,
                handleWindowResize: !0,
                height: function() {
                    return o()
                }
            }), KTUtil.scrollInit(n, {
                mobileNativeScroll: !0,
                resetHeightOnDestroy: !0,
                handleWindowResize: !0,
                height: function() {
                    return o()
                }
            }), KTUtil.scrollInit(i, {
                mobileNativeScroll: !0,
                resetHeightOnDestroy: !0,
                handleWindowResize: !0,
                height: function() {
                    return o()
                }
            }), $(t).find('a[data-toggle="tab"]').on("shown.bs.tab", function(t) {
                KTUtil.scrollUpdate(e), KTUtil.scrollUpdate(n), KTUtil.scrollUpdate(i)
            })
        }
    }
}();
$(document).ready(function() {
    KTQuickPanel.init()
});
var KTLayout = function() {
    var t, e, n, i, o = function() {
        return new KTPortlet("kt_page_portlet", {
            sticky: {
                offset: parseInt(KTUtil.css(KTUtil.get("kt_header"), "height")) + 200,
                zIndex: 90,
                position: {
                    top: function() {
                        return KTUtil.isInResponsiveRange("desktop") ? 60 : parseInt(KTUtil.css(KTUtil.get("kt_header_mobile"), "height"))
                    },
                    left: function(t) {
                        var e = t.getSelf();
                        return KTUtil.offset(e).left
                    },
                    right: function(t) {
                        var e = t.getSelf(),
                            n = parseInt(KTUtil.css(e, "width"));
                        return parseInt(KTUtil.css(KTUtil.get("body"), "width")) - n - KTUtil.offset(e).left
                    }
                }
            }
        })
    };
    return {
        init: function() {
            KTUtil.get("body"), this.initHeader(), this.initAside(), this.initPageStickyPortlet(), $("#kt_aside_menu, #kt_header_menu").on("click", '.kt-menu__link[href="#"]', function() {
                location.hostname.match("keenthemes.com") ? swal.fire("You have clicked on a dummy link!", "To browse the theme features please refer to the header menu.", "warning") : swal.fire("You have clicked on a dummy link!", "This demo shows only its unique layout features. <b>Keen's</b> all available features can be re-used in this and any other demos by refering to <b>the default demo</b>.", "warning")
            })
        },
        initHeader: function() {
            var i, o;
            i = KTUtil.get("kt_header"), (o = {
                classic: {
                    desktop: !0,
                    mobile: !1
                },
                offset: {},
                minimize: {}
            }).minimize.mobile = !1, "on" == KTUtil.attr(i, "data-ktheader-minimize") ? (o.minimize.desktop = {}, o.minimize.desktop.on = "kt-header--minimize", o.offset.desktop = parseInt(KTUtil.css(i, "height")) - 10) : o.minimize.desktop = !1, t = new KTHeader("kt_header", o), n && (t.on("minimizeOn", function() {
                n.scrollReInit()
            }), t.on("minimizeOff", function() {
                n.scrollReInit()
            })), e = new KTOffcanvas("kt_header_menu_wrapper", {
                overlay: !0,
                baseClass: "kt-header-menu-wrapper",
                closeBy: "kt_header_menu_mobile_close_btn",
                toggleBy: {
                    target: "kt_header_mobile_toggler",
                    state: "kt-header-mobile__toolbar-toggler--active"
                }
            }), new KTMenu("kt_header_menu", {
                submenu: {
                    desktop: "dropdown",
                    tablet: "accordion",
                    mobile: "accordion"
                },
                accordion: {
                    slideSpeed: 200,
                    expandAll: !1
                }
            }), new KTToggle("kt_header_mobile_topbar_toggler", {
                target: "body",
                targetState: "kt-header__topbar--mobile-on",
                togglerState: "kt-header-mobile__toolbar-topbar-toggler--active"
            })
        },
        initAside: function() {
            var t, e, i, o, a;
            t = KTUtil.get("kt_aside"), KTUtil.get("kt_aside_brand"), e = KTUtil.hasClass(t, "kt-aside--offcanvas-default") ? "kt-aside--offcanvas-default" : "kt-aside", new KTOffcanvas("kt_aside", {
                baseClass: e,
                overlay: !0,
                closeBy: "kt_aside_close_btn",
                toggleBy: [{
                    target: "kt_aside_mobile_toggler",
                    state: "kt-aside-toggler--active"
                }, {
                    target: "kt_aside_toggler",
                    state: "kt-aside-toggler--active"
                }]
            }), o = KTUtil.get("kt_aside_menu"), a = "1" === KTUtil.attr(o, "data-ktmenu-dropdown") ? "dropdown" : "accordion", "1" === KTUtil.attr(o, "data-ktmenu-scroll") && (i = {
                rememberPosition: !0,
                height: function() {
                    return KTUtil.isInResponsiveRange("desktop") ? parseInt(KTUtil.getViewPort().height) - parseInt(KTUtil.css(o, "marginTop")) - parseInt(KTUtil.css(o, "marginBottom")) : parseInt(KTUtil.getViewPort().height)
                }
            }), n = new KTMenu("kt_aside_menu", {
                scroll: i,
                submenu: {
                    desktop: a,
                    tablet: "accordion",
                    mobile: "accordion"
                },
                accordion: {
                    expandAll: !1
                }
            })
        },
        getAsideMenu: function() {
            return n
        },
        initPageStickyPortlet: function() {
            KTUtil.get("kt_page_portlet") && ((i = o()).initSticky(), KTUtil.addResizeHandler(function() {
                i.updateSticky()
            }), o())
        },
        closeMobileAsideMenuOffcanvas: function() {
            KTUtil.isMobileDevice() && (void 0).hide()
        },
        closeMobileHeaderMenuOffcanvas: function() {
            KTUtil.isMobileDevice() && e.hide()
        },
        getContentHeight: function() {
            return t = KTUtil.getViewPort().height, KTUtil.getByID("kt_header") && (t -= KTUtil.actualHeight("kt_header")), KTUtil.getByID("kt_subheader") && (t -= KTUtil.actualHeight("kt_subheader")), KTUtil.getByID("kt_footer") && (t -= parseInt(KTUtil.css("kt_footer", "height"))), KTUtil.getByID("kt_content") && (t = t - parseInt(KTUtil.css("kt_content", "padding-top")) - parseInt(KTUtil.css("kt_content", "padding-bottom"))), t;
            var t
        }
    }
}();
$(document).ready(function() {
    KTLayout.init()
});