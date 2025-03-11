<div>

    <head>
        <script>
            if (navigator.userAgent.match(/MSIE|Internet Explorer/i) || navigator.userAgent.match(/Trident\/7\..*?rv:11/i)) {
                var href = document.location.href;
                if (!href.match(/[?&]nowprocket/)) {
                    if (href.indexOf("?") == -1) {
                        if (href.indexOf("#") == -1) {
                            document.location.href = href + "?nowprocket=1"
                        } else {
                            document.location.href = href.replace("#", "?nowprocket=1#")
                        }
                    } else {
                        if (href.indexOf("#") == -1) {
                            document.location.href = href + "&nowprocket=1"
                        } else {
                            document.location.href = href.replace("#", "&nowprocket=1#")
                        }
                    }
                }
            }
        </script>
        <script>
            class RocketLazyLoadScripts {
                constructor() {
                    this.triggerEvents = ["keydown", "mousedown", "mousemove", "touchmove", "touchstart", "touchend",
                        "wheel"
                    ], this.userEventHandler = this._triggerListener.bind(this), this.touchStartHandler = this
                        ._onTouchStart.bind(this), this.touchMoveHandler = this._onTouchMove.bind(this), this
                            .touchEndHandler = this._onTouchEnd.bind(this), this.clickHandler = this._onClick.bind(this), this
                                .interceptedClicks = [], window.addEventListener("pageshow", (e => {
                                    this.persisted = e.persisted
                                })), window.addEventListener("DOMContentLoaded", (() => {
                                    this._preconnect3rdParties()
                                })), this.delayedScripts = {
                                    normal: [],
                                    async: [],
                                    defer: []
                                }, this.allJQueries = []
                }
                _addUserInteractionListener(e) {
                    document.hidden ? e._triggerListener() : (this.triggerEvents.forEach((t => window.addEventListener(t, e
                        .userEventHandler, {
                        passive: !0
                    }))), window.addEventListener("touchstart", e.touchStartHandler, {
                        passive: !0
                    }), window.addEventListener("mousedown", e.touchStartHandler), document.addEventListener(
                        "visibilitychange", e.userEventHandler))
                }
                _removeUserInteractionListener() {
                    this.triggerEvents.forEach((e => window.removeEventListener(e, this.userEventHandler, {
                        passive: !0
                    }))), document.removeEventListener("visibilitychange", this.userEventHandler)
                }
                _onTouchStart(e) {
                    "HTML" !== e.target.tagName && (window.addEventListener("touchend", this.touchEndHandler), window
                        .addEventListener("mouseup", this.touchEndHandler), window.addEventListener("touchmove", this
                            .touchMoveHandler, {
                            passive: !0
                        }), window.addEventListener("mousemove", this.touchMoveHandler), e.target.addEventListener(
                            "click", this.clickHandler), this._renameDOMAttribute(e.target, "onclick", "rocket-onclick")
                    )
                }
                _onTouchMove(e) {
                    window.removeEventListener("touchend", this.touchEndHandler), window.removeEventListener("mouseup", this
                        .touchEndHandler), window.removeEventListener("touchmove", this.touchMoveHandler, {
                            passive: !0
                        }), window.removeEventListener("mousemove", this.touchMoveHandler), e.target.removeEventListener(
                            "click", this.clickHandler), this._renameDOMAttribute(e.target, "rocket-onclick", "onclick")
                }
                _onTouchEnd(e) {
                    window.removeEventListener("touchend", this.touchEndHandler), window.removeEventListener("mouseup", this
                        .touchEndHandler), window.removeEventListener("touchmove", this.touchMoveHandler, {
                            passive: !0
                        }), window.removeEventListener("mousemove", this.touchMoveHandler)
                }
                _onClick(e) {
                    e.target.removeEventListener("click", this.clickHandler), this._renameDOMAttribute(e.target,
                        "rocket-onclick", "onclick"), this.interceptedClicks.push(e), e.preventDefault(), e
                            .stopPropagation(), e.stopImmediatePropagation()
                }
                _replayClicks() {
                    window.removeEventListener("touchstart", this.touchStartHandler, {
                        passive: !0
                    }), window.removeEventListener("mousedown", this.touchStartHandler), this.interceptedClicks.forEach(
                        (e => {
                            e.target.dispatchEvent(new MouseEvent("click", {
                                view: e.view,
                                bubbles: !0,
                                cancelable: !0
                            }))
                        }))
                }
                _renameDOMAttribute(e, t, n) {
                    e.hasAttribute && e.hasAttribute(t) && (event.target.setAttribute(n, event.target.getAttribute(t)),
                        event.target.removeAttribute(t))
                }
                _triggerListener() {
                    this._removeUserInteractionListener(this), "loading" === document.readyState ? document
                        .addEventListener("DOMContentLoaded", this._loadEverythingNow.bind(this)) : this
                            ._loadEverythingNow()
                }
                _preconnect3rdParties() {
                    let e = [];
                    document.querySelectorAll("script[type=rocketlazyloadscript]").forEach((t => {
                        if (t.hasAttribute("src")) {
                            const n = new URL(t.src).origin;
                            n !== location.origin && e.push({
                                src: n,
                                crossOrigin: t.crossOrigin || "module" === t.getAttribute(
                                    "data-rocket-type")
                            })
                        }
                    })), e = [...new Map(e.map((e => [JSON.stringify(e), e]))).values()], this
                        ._batchInjectResourceHints(e, "preconnect")
                }
                async _loadEverythingNow() {
                    this.lastBreath = Date.now(), this._delayEventListeners(), this._delayJQueryReady(this), this
                        ._handleDocumentWrite(), this._registerAllDelayedScripts(), this._preloadAllScripts(), await this
                            ._loadScriptsFromList(this.delayedScripts.normal), await this._loadScriptsFromList(this
                                .delayedScripts.defer), await this._loadScriptsFromList(this.delayedScripts.async);
                    try {
                        await this._triggerDOMContentLoaded(), await this._triggerWindowLoad()
                    } catch (e) { }
                    window.dispatchEvent(new Event("rocket-allScriptsLoaded")), this._replayClicks()
                }
                _registerAllDelayedScripts() {
                    document.querySelectorAll("script[type=rocketlazyloadscript]").forEach((e => {
                        e.hasAttribute("src") ? e.hasAttribute("async") && !1 !== e.async ? this.delayedScripts
                            .async.push(e) : e.hasAttribute("defer") && !1 !== e.defer || "module" === e
                                .getAttribute("data-rocket-type") ? this.delayedScripts.defer.push(e) : this
                                    .delayedScripts.normal.push(e) : this.delayedScripts.normal.push(e)
                    }))
                }
                async _transformScript(e) {
                    return await this._littleBreath(), new Promise((t => {
                        const n = document.createElement("script");
                        [...e.attributes].forEach((e => {
                            let t = e.nodeName;
                            "type" !== t && ("data-rocket-type" === t && (t = "type"), n
                                .setAttribute(t, e.nodeValue))
                        })), e.hasAttribute("src") ? (n.addEventListener("load", t), n.addEventListener(
                            "error", t)) : (n.text = e.text, t());
                        try {
                            e.parentNode.replaceChild(n, e)
                        } catch (e) {
                            t()
                        }
                    }))
                }
                async _loadScriptsFromList(e) {
                    const t = e.shift();
                    return t ? (await this._transformScript(t), this._loadScriptsFromList(e)) : Promise.resolve()
                }
                _preloadAllScripts() {
                    this._batchInjectResourceHints([...this.delayedScripts.normal, ...this.delayedScripts.defer, ...this
                        .delayedScripts.async
                    ], "preload")
                }
                _batchInjectResourceHints(e, t) {
                    var n = document.createDocumentFragment();
                    e.forEach((e => {
                        if (e.src) {
                            const i = document.createElement("link");
                            i.href = e.src, i.rel = t, "preconnect" !== t && (i.as = "script"), e
                                .getAttribute && "module" === e.getAttribute("data-rocket-type") && (i
                                    .crossOrigin = !0), e.crossOrigin && (i.crossOrigin = e.crossOrigin), n
                                        .appendChild(i)
                        }
                    })), document.head.appendChild(n)
                }
                _delayEventListeners() {
                    let e = {};

                    function t(t, n) {
                        ! function (t) {
                            function n(n) {
                                return e[t].eventsToRewrite.indexOf(n) >= 0 ? "rocket-" + n : n
                            }
                            e[t] || (e[t] = {
                                originalFunctions: {
                                    add: t.addEventListener,
                                    remove: t.removeEventListener
                                },
                                eventsToRewrite: []
                            }, t.addEventListener = function () {
                                arguments[0] = n(arguments[0]), e[t].originalFunctions.add.apply(t, arguments)
                            }, t.removeEventListener = function () {
                                arguments[0] = n(arguments[0]), e[t].originalFunctions.remove.apply(t, arguments)
                            })
                        }(t), e[t].eventsToRewrite.push(n)
                    }

                    function n(e, t) {
                        let n = e[t];
                        Object.defineProperty(e, t, {
                            get: () => n || function () { },
                            set(i) {
                                e["rocket" + t] = n = i
                            }
                        })
                    }
                    t(document, "DOMContentLoaded"), t(window, "DOMContentLoaded"), t(window, "load"), t(window,
                        "pageshow"), t(document, "readystatechange"), n(document, "onreadystatechange"), n(window,
                            "onload"), n(window, "onpageshow")
                }
                _delayJQueryReady(e) {
                    let t = window.jQuery;
                    Object.defineProperty(window, "jQuery", {
                        get: () => t,
                        set(n) {
                            if (n && n.fn && !e.allJQueries.includes(n)) {
                                n.fn.ready = n.fn.init.prototype.ready = function (t) {
                                    e.domReadyFired ? t.bind(document)(n) : document.addEventListener(
                                        "rocket-DOMContentLoaded", (() => t.bind(document)(n)))
                                };
                                const t = n.fn.on;
                                n.fn.on = n.fn.init.prototype.on = function () {
                                    if (this[0] === window) {
                                        function e(e) {
                                            return e.split(" ").map((e => "load" === e || 0 === e.indexOf(
                                                "load.") ? "rocket-jquery-load" : e)).join(" ")
                                        }
                                        "string" == typeof arguments[0] || arguments[0] instanceof String ?
                                            arguments[0] = e(arguments[0]) : "object" == typeof arguments[
                                            0] && Object.keys(arguments[0]).forEach((t => {
                                                delete Object.assign(arguments[0], {
                                                    [e(t)]: arguments[0][t]
                                                })[t]
                                            }))
                                    }
                                    return t.apply(this, arguments), this
                                }, e.allJQueries.push(n)
                            }
                            t = n
                        }
                    })
                }
                async _triggerDOMContentLoaded() {
                    this.domReadyFired = !0, await this._littleBreath(), document.dispatchEvent(new Event(
                        "rocket-DOMContentLoaded")), await this._littleBreath(), window.dispatchEvent(new Event(
                            "rocket-DOMContentLoaded")), await this._littleBreath(), document.dispatchEvent(new Event(
                                "rocket-readystatechange")), await this._littleBreath(), document.rocketonreadystatechange &&
                        document.rocketonreadystatechange()
                }
                async _triggerWindowLoad() {
                    await this._littleBreath(), window.dispatchEvent(new Event("rocket-load")), await this._littleBreath(),
                        window.rocketonload && window.rocketonload(), await this._littleBreath(), this.allJQueries.forEach((
                            e => e(window).trigger("rocket-jquery-load"))), await this._littleBreath();
                    const e = new Event("rocket-pageshow");
                    e.persisted = this.persisted, window.dispatchEvent(e), await this._littleBreath(), window
                        .rocketonpageshow && window.rocketonpageshow({
                            persisted: this.persisted
                        })
                }
                _handleDocumentWrite() {
                    const e = new Map;
                    document.write = document.writeln = function (t) {
                        const n = document.currentScript,
                            i = document.createRange(),
                            r = n.parentElement;
                        let o = e.get(n);
                        void 0 === o && (o = n.nextSibling, e.set(n, o));
                        const s = document.createDocumentFragment();
                        i.setStart(s, 0), s.appendChild(i.createContextualFragment(t)), r.insertBefore(s, o)
                    }
                }
                async _littleBreath() {
                    Date.now() - this.lastBreath > 45 && (await this._requestAnimFrame(), this.lastBreath = Date.now())
                }
                async _requestAnimFrame() {
                    return document.hidden ? new Promise((e => setTimeout(e))) : new Promise((e => requestAnimationFrame(
                        e)))
                }
                static run() {
                    const e = new RocketLazyLoadScripts;
                    e._addUserInteractionListener(e)
                }
            }
            RocketLazyLoadScripts.run();
        </script>


        <title>Phân Bón Hưu Cơ AC2 - Công Ty TNHH Phân Bón Quốc Tế Rồng Xanh</title>
        <link rel="stylesheet" href="/assets/wp-content/cache/min/1/a076c5cd7ed1f4471e4b6951a812550f.css" media="all"
            data-minify="1" />
        <meta property="og:image" content="{{ url('/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg') }}" />
        <meta name="description"
            content="Phân Bón Hưu Cơ AC2 là dòng phân hữu cơ humic được nhập khẩu từ Hoa Kỳ, giúp kích rễ, cải tạo đất, tăng khả năng hấp thu" />
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
        <link rel="prefetch" href="/assets/wp-content/themes/flatsome/assets/js/chunk.countup.fe2c1016.js" />
        <link rel="prefetch" href="/assets/wp-content/themes/flatsome/assets/js/chunk.sticky-sidebar.a58a6557.js" />
        <link rel="prefetch" href="/assets/wp-content/themes/flatsome/assets/js/chunk.tooltips.29144c1c.js" />
        <link rel="prefetch" href="/assets/wp-content/themes/flatsome/assets/js/chunk.vendors-popups.947eca5c.js" />
        <link rel="prefetch" href="/assets/wp-content/themes/flatsome/assets/js/chunk.vendors-slider.f0d2cbc9.js" />
        <style type="text/css">
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 0.07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }
        </style>
        <style id='wp-block-library-inline-css' type='text/css'>
            :root {
                --wp-admin-theme-color: #007cba;
                --wp-admin-theme-color--rgb: 0, 124, 186;
                --wp-admin-theme-color-darker-10: #006ba1;
                --wp-admin-theme-color-darker-10--rgb: 0, 107, 161;
                --wp-admin-theme-color-darker-20: #005a87;
                --wp-admin-theme-color-darker-20--rgb: 0, 90, 135;
                --wp-admin-border-width-focus: 2px;
                --wp-block-synced-color: #7a00df;
                --wp-block-synced-color--rgb: 122, 0, 223
            }

            @media (min-resolution:192dpi) {
                :root {
                    --wp-admin-border-width-focus: 1.5px
                }
            }

            .wp-element-button {
                cursor: pointer
            }

            :root {
                --wp--preset--font-size--normal: 16px;
                --wp--preset--font-size--huge: 42px
            }

            :root .has-very-light-gray-background-color {
                background-color: #eee
            }

            :root .has-very-dark-gray-background-color {
                background-color: #313131
            }

            :root .has-very-light-gray-color {
                color: #eee
            }

            :root .has-very-dark-gray-color {
                color: #313131
            }

            :root .has-vivid-green-cyan-to-vivid-cyan-blue-gradient-background {
                background: linear-gradient(135deg, #00d084, #0693e3)
            }

            :root .has-purple-crush-gradient-background {
                background: linear-gradient(135deg, #34e2e4, #4721fb 50%, #ab1dfe)
            }

            :root .has-hazy-dawn-gradient-background {
                background: linear-gradient(135deg, #faaca8, #dad0ec)
            }

            :root .has-subdued-olive-gradient-background {
                background: linear-gradient(135deg, #fafae1, #67a671)
            }

            :root .has-atomic-cream-gradient-background {
                background: linear-gradient(135deg, #fdd79a, #004a59)
            }

            :root .has-nightshade-gradient-background {
                background: linear-gradient(135deg, #330968, #31cdcf)
            }

            :root .has-midnight-gradient-background {
                background: linear-gradient(135deg, #020381, #2874fc)
            }

            .has-regular-font-size {
                font-size: 1em
            }

            .has-larger-font-size {
                font-size: 2.625em
            }

            .has-normal-font-size {
                font-size: var(--wp--preset--font-size--normal)
            }

            .has-huge-font-size {
                font-size: var(--wp--preset--font-size--huge)
            }

            .has-text-align-center {
                text-align: center
            }

            .has-text-align-left {
                text-align: left
            }

            .has-text-align-right {
                text-align: right
            }

            #end-resizable-editor-section {
                display: none
            }

            .aligncenter {
                clear: both
            }

            .items-justified-left {
                justify-content: flex-start
            }

            .items-justified-center {
                justify-content: center
            }

            .items-justified-right {
                justify-content: flex-end
            }

            .items-justified-space-between {
                justify-content: space-between
            }

            .screen-reader-text {
                clip: rect(1px, 1px, 1px, 1px);
                word-wrap: normal !important;
                border: 0;
                -webkit-clip-path: inset(50%);
                clip-path: inset(50%);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px
            }

            .screen-reader-text:focus {
                clip: auto !important;
                background-color: #ddd;
                -webkit-clip-path: none;
                clip-path: none;
                color: #444;
                display: block;
                font-size: 1em;
                height: auto;
                left: 5px;
                line-height: normal;
                padding: 15px 23px 14px;
                text-decoration: none;
                top: 5px;
                width: auto;
                z-index: 100000
            }

            html :where(.has-border-color) {
                border-style: solid
            }

            html :where([style*=border-top-color]) {
                border-top-style: solid
            }

            html :where([style*=border-right-color]) {
                border-right-style: solid
            }

            html :where([style*=border-bottom-color]) {
                border-bottom-style: solid
            }

            html :where([style*=border-left-color]) {
                border-left-style: solid
            }

            html :where([style*=border-width]) {
                border-style: solid
            }

            html :where([style*=border-top-width]) {
                border-top-style: solid
            }

            html :where([style*=border-right-width]) {
                border-right-style: solid
            }

            html :where([style*=border-bottom-width]) {
                border-bottom-style: solid
            }

            html :where([style*=border-left-width]) {
                border-left-style: solid
            }

            html :where(img[class*=wp-image-]) {
                height: auto;
                max-width: 100%
            }

            :where(figure) {
                margin: 0 0 1em
            }

            html :where(.is-position-sticky) {
                --wp-admin--admin-bar--position-offset: var(--wp-admin--admin-bar--height, 0px)
            }

            @media screen and (max-width:600px) {
                html :where(.is-position-sticky) {
                    --wp-admin--admin-bar--position-offset: 0px
                }
            }
        </style>
        <style id='classic-theme-styles-inline-css' type='text/css'>
            /*! This file is auto-generated */
            .wp-block-button__link {
                color: #fff;
                background-color: #32373c;
                border-radius: 9999px;
                box-shadow: none;
                text-decoration: none;
                padding: calc(.667em + 2px) calc(1.333em + 2px);
                font-size: 1.125em
            }

            .wp-block-file__button {
                background: #32373c;
                color: #fff;
                text-decoration: none
            }
        </style>






        <style id='woocommerce-inline-inline-css' type='text/css'>
            .woocommerce form .form-row .required {
                visibility: visible;
            }
        </style>

        <style id='woo-variation-swatches-inline-css' type='text/css'>
            :root {
                --wvs-tick: url("data:image/svg+xml;utf8,%3Csvg filter='drop-shadow(0px 0px 2px rgb(0 0 0 / .8))' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 30 30'%3E%3Cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='4' d='M4 16L11 23 27 7'/%3E%3C/svg%3E");

                --wvs-cross: url("data:image/svg+xml;utf8,%3Csvg filter='drop-shadow(0px 0px 5px rgb(255 255 255 / .6))' xmlns='http://www.w3.org/2000/svg' width='72px' height='72px' viewBox='0 0 24 24'%3E%3Cpath fill='none' stroke='%23ff0000' stroke-linecap='round' stroke-width='0.6' d='M5 5L19 19M19 5L5 19'/%3E%3C/svg%3E");
                --wvs-single-product-item-width: 30px;
                --wvs-single-product-item-height: 30px;
                --wvs-single-product-item-font-size: 16px
            }
        </style>



        <style id='popup-maker-site-inline-css' type='text/css'>
            /* Popup Google Fonts */
            @import url('//fonts.googleapis.com/css?family=Montserrat:100');

            /* Popup Theme 5162: ngtangnangsuat */
            .pum-theme-5162,
            .pum-theme-ngtangnangsuat {
                background-color: rgba(255, 255, 255, 0.08)
            }

            .pum-theme-5162 .pum-container,
            .pum-theme-ngtangnangsuat .pum-container {
                padding: 18px;
                border-radius: 0px;
                border: 1px none #000000;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.18);
                background-color: rgba(249, 249, 249, 1.00)
            }

            .pum-theme-5162 .pum-title,
            .pum-theme-ngtangnangsuat .pum-title {
                color: #005500;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(0, 85, 0, 0.23);
                font-family: inherit;
                font-weight: 400;
                font-size: 32px;
                line-height: 36px
            }

            .pum-theme-5162 .pum-content,
            .pum-theme-ngtangnangsuat .pum-content {
                color: #8c8c8c;
                font-family: inherit;
                font-weight: 400
            }

            .pum-theme-5162 .pum-content+.pum-close,
            .pum-theme-ngtangnangsuat .pum-content+.pum-close {
                position: absolute;
                height: 44px;
                width: 44px;
                left: auto;
                right: -18px;
                bottom: auto;
                top: -18px;
                padding: 0px;
                color: #ffffff;
                font-family: inherit;
                font-weight: 400;
                font-size: 12px;
                line-height: 36px;
                border: 1px none #ffffff;
                border-radius: 44px;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.23);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.23);
                background-color: rgba(0, 85, 0, 1.00)
            }

            /* Popup Theme 2698: ng */
            .pum-theme-2698,
            .pum-theme-ng {
                background-color: rgba(255, 255, 255, 0.08)
            }

            .pum-theme-2698 .pum-container,
            .pum-theme-ng .pum-container {
                padding: 18px;
                border-radius: 0px;
                border: 1px none #000000;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.23);
                background-color: rgba(249, 249, 249, 1.00)
            }

            .pum-theme-2698 .pum-title,
            .pum-theme-ng .pum-title {
                color: #005500;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 400;
                font-size: 32px;
                line-height: 36px
            }

            .pum-theme-2698 .pum-content,
            .pum-theme-ng .pum-content {
                color: #8c8c8c;
                font-family: inherit;
                font-weight: 400
            }

            .pum-theme-2698 .pum-content+.pum-close,
            .pum-theme-ng .pum-content+.pum-close {
                position: absolute;
                height: 44px;
                width: 44px;
                left: auto;
                right: -16px;
                bottom: auto;
                top: -16px;
                padding: 0px;
                color: #ffffff;
                font-family: inherit;
                font-weight: 400;
                font-size: 12px;
                line-height: 36px;
                border: 1px none #ffffff;
                border-radius: 44px;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.23);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.23);
                background-color: rgba(0, 85, 0, 1.00)
            }

            /* Popup Theme 2686: Default Theme */
            .pum-theme-2686,
            .pum-theme-default-theme {
                background-color: rgba(255, 255, 255, 1.00)
            }

            .pum-theme-2686 .pum-container,
            .pum-theme-default-theme .pum-container {
                padding: 18px;
                border-radius: 0px;
                border: 1px none #000000;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.23);
                background-color: rgba(249, 249, 249, 1.00)
            }

            .pum-theme-2686 .pum-title,
            .pum-theme-default-theme .pum-title {
                color: #000000;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 400;
                font-size: 32px;
                font-style: normal;
                line-height: 36px
            }

            .pum-theme-2686 .pum-content,
            .pum-theme-default-theme .pum-content {
                color: #8c8c8c;
                font-family: inherit;
                font-weight: 400;
                font-style: inherit
            }

            .pum-theme-2686 .pum-content+.pum-close,
            .pum-theme-default-theme .pum-content+.pum-close {
                position: absolute;
                height: auto;
                width: auto;
                left: auto;
                right: 0px;
                bottom: auto;
                top: 0px;
                padding: 8px;
                color: #ffffff;
                font-family: inherit;
                font-weight: 400;
                font-size: 12px;
                font-style: inherit;
                line-height: 36px;
                border: 1px none #ffffff;
                border-radius: 0px;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.23);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.23);
                background-color: rgba(0, 183, 205, 1.00)
            }

            /* Popup Theme 2687: Light Box */
            .pum-theme-2687,
            .pum-theme-lightbox {
                background-color: rgba(0, 0, 0, 0.60)
            }

            .pum-theme-2687 .pum-container,
            .pum-theme-lightbox .pum-container {
                padding: 18px;
                border-radius: 3px;
                border: 8px solid #000000;
                box-shadow: 0px 0px 30px 0px rgba(2, 2, 2, 1.00);
                background-color: rgba(255, 255, 255, 1.00)
            }

            .pum-theme-2687 .pum-title,
            .pum-theme-lightbox .pum-title {
                color: #000000;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 100;
                font-size: 32px;
                line-height: 36px
            }

            .pum-theme-2687 .pum-content,
            .pum-theme-lightbox .pum-content {
                color: #000000;
                font-family: inherit;
                font-weight: 100
            }

            .pum-theme-2687 .pum-content+.pum-close,
            .pum-theme-lightbox .pum-content+.pum-close {
                position: absolute;
                height: 26px;
                width: 26px;
                left: auto;
                right: -13px;
                bottom: auto;
                top: -13px;
                padding: 0px;
                color: #ffffff;
                font-family: Arial;
                font-weight: 100;
                font-size: 24px;
                line-height: 24px;
                border: 2px solid #ffffff;
                border-radius: 26px;
                box-shadow: 0px 0px 15px 1px rgba(2, 2, 2, 0.75);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.23);
                background-color: rgba(0, 0, 0, 1.00)
            }

            /* Popup Theme 2688: Enterprise Blue */
            .pum-theme-2688,
            .pum-theme-enterprise-blue {
                background-color: rgba(0, 0, 0, 0.70)
            }

            .pum-theme-2688 .pum-container,
            .pum-theme-enterprise-blue .pum-container {
                padding: 28px;
                border-radius: 5px;
                border: 1px none #000000;
                box-shadow: 0px 10px 25px 4px rgba(2, 2, 2, 0.50);
                background-color: rgba(255, 255, 255, 1.00)
            }

            .pum-theme-2688 .pum-title,
            .pum-theme-enterprise-blue .pum-title {
                color: #315b7c;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 100;
                font-size: 34px;
                line-height: 36px
            }

            .pum-theme-2688 .pum-content,
            .pum-theme-enterprise-blue .pum-content {
                color: #2d2d2d;
                font-family: inherit;
                font-weight: 100
            }

            .pum-theme-2688 .pum-content+.pum-close,
            .pum-theme-enterprise-blue .pum-content+.pum-close {
                position: absolute;
                height: 28px;
                width: 28px;
                left: auto;
                right: 8px;
                bottom: auto;
                top: 8px;
                padding: 4px;
                color: #ffffff;
                font-family: Times New Roman;
                font-weight: 100;
                font-size: 20px;
                line-height: 20px;
                border: 1px none #ffffff;
                border-radius: 42px;
                box-shadow: 0px 0px 0px 0px rgba(2, 2, 2, 0.23);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.23);
                background-color: rgba(49, 91, 124, 1.00)
            }

            /* Popup Theme 2689: Hello Box */
            .pum-theme-2689,
            .pum-theme-hello-box {
                background-color: rgba(0, 0, 0, 0.75)
            }

            .pum-theme-2689 .pum-container,
            .pum-theme-hello-box .pum-container {
                padding: 30px;
                border-radius: 80px;
                border: 14px solid #81d742;
                box-shadow: 0px 0px 0px 0px rgba(2, 2, 2, 0.00);
                background-color: rgba(255, 255, 255, 1.00)
            }

            .pum-theme-2689 .pum-title,
            .pum-theme-hello-box .pum-title {
                color: #2d2d2d;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: Montserrat;
                font-weight: 100;
                font-size: 32px;
                line-height: 36px
            }

            .pum-theme-2689 .pum-content,
            .pum-theme-hello-box .pum-content {
                color: #2d2d2d;
                font-family: inherit;
                font-weight: 100
            }

            .pum-theme-2689 .pum-content+.pum-close,
            .pum-theme-hello-box .pum-content+.pum-close {
                position: absolute;
                height: auto;
                width: auto;
                left: auto;
                right: -30px;
                bottom: auto;
                top: -30px;
                padding: 0px;
                color: #2d2d2d;
                font-family: Times New Roman;
                font-weight: 100;
                font-size: 32px;
                line-height: 28px;
                border: 1px none #ffffff;
                border-radius: 28px;
                box-shadow: 0px 0px 0px 0px rgba(2, 2, 2, 0.23);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.23);
                background-color: rgba(255, 255, 255, 1.00)
            }

            /* Popup Theme 2690: Cutting Edge */
            .pum-theme-2690,
            .pum-theme-cutting-edge {
                background-color: rgba(0, 0, 0, 0.50)
            }

            .pum-theme-2690 .pum-container,
            .pum-theme-cutting-edge .pum-container {
                padding: 18px;
                border-radius: 0px;
                border: 1px none #000000;
                box-shadow: 0px 10px 25px 0px rgba(2, 2, 2, 0.50);
                background-color: rgba(30, 115, 190, 1.00)
            }

            .pum-theme-2690 .pum-title,
            .pum-theme-cutting-edge .pum-title {
                color: #ffffff;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: Sans-Serif;
                font-weight: 100;
                font-size: 26px;
                line-height: 28px
            }

            .pum-theme-2690 .pum-content,
            .pum-theme-cutting-edge .pum-content {
                color: #ffffff;
                font-family: inherit;
                font-weight: 100
            }

            .pum-theme-2690 .pum-content+.pum-close,
            .pum-theme-cutting-edge .pum-content+.pum-close {
                position: absolute;
                height: 24px;
                width: 24px;
                left: auto;
                right: 0px;
                bottom: auto;
                top: 0px;
                padding: 0px;
                color: #1e73be;
                font-family: Times New Roman;
                font-weight: 100;
                font-size: 32px;
                line-height: 24px;
                border: 1px none #ffffff;
                border-radius: 0px;
                box-shadow: -1px 1px 1px 0px rgba(2, 2, 2, 0.10);
                text-shadow: -1px 1px 1px rgba(0, 0, 0, 0.10);
                background-color: rgba(238, 238, 34, 1.00)
            }

            /* Popup Theme 2691: Framed Border */
            .pum-theme-2691,
            .pum-theme-framed-border {
                background-color: rgba(255, 255, 255, 0.50)
            }

            .pum-theme-2691 .pum-container,
            .pum-theme-framed-border .pum-container {
                padding: 18px;
                border-radius: 0px;
                border: 20px outset #dd3333;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.97) inset;
                background-color: rgba(255, 251, 239, 1.00)
            }

            .pum-theme-2691 .pum-title,
            .pum-theme-framed-border .pum-title {
                color: #000000;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 100;
                font-size: 32px;
                line-height: 36px
            }

            .pum-theme-2691 .pum-content,
            .pum-theme-framed-border .pum-content {
                color: #2d2d2d;
                font-family: inherit;
                font-weight: 100
            }

            .pum-theme-2691 .pum-content+.pum-close,
            .pum-theme-framed-border .pum-content+.pum-close {
                position: absolute;
                height: 20px;
                width: 20px;
                left: auto;
                right: -20px;
                bottom: auto;
                top: -20px;
                padding: 0px;
                color: #ffffff;
                font-family: Tahoma;
                font-weight: 700;
                font-size: 16px;
                line-height: 18px;
                border: 1px none #ffffff;
                border-radius: 0px;
                box-shadow: 0px 0px 0px 0px rgba(2, 2, 2, 0.23);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.23);
                background-color: rgba(0, 0, 0, 0.55)
            }

            /* Popup Theme 2692: Floating Bar - Soft Blue */
            .pum-theme-2692,
            .pum-theme-floating-bar {
                background-color: rgba(255, 255, 255, 0.00)
            }

            .pum-theme-2692 .pum-container,
            .pum-theme-floating-bar .pum-container {
                padding: 8px;
                border-radius: 0px;
                border: 1px none #000000;
                box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.23);
                background-color: rgba(238, 246, 252, 1.00)
            }

            .pum-theme-2692 .pum-title,
            .pum-theme-floating-bar .pum-title {
                color: #505050;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 400;
                font-size: 32px;
                line-height: 36px
            }

            .pum-theme-2692 .pum-content,
            .pum-theme-floating-bar .pum-content {
                color: #505050;
                font-family: inherit;
                font-weight: 400
            }

            .pum-theme-2692 .pum-content+.pum-close,
            .pum-theme-floating-bar .pum-content+.pum-close {
                position: absolute;
                height: 18px;
                width: 18px;
                left: auto;
                right: 5px;
                bottom: auto;
                top: 50%;
                padding: 0px;
                color: #505050;
                font-family: Sans-Serif;
                font-weight: 700;
                font-size: 15px;
                line-height: 18px;
                border: 1px solid #505050;
                border-radius: 15px;
                box-shadow: 0px 0px 0px 0px rgba(2, 2, 2, 0.00);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.00);
                background-color: rgba(255, 255, 255, 0.00);
                transform: translate(0, -50%)
            }

            /* Popup Theme 2693: Content Only - For use with page builders or block editor */
            .pum-theme-2693,
            .pum-theme-content-only {
                background-color: rgba(0, 0, 0, 0.70)
            }

            .pum-theme-2693 .pum-container,
            .pum-theme-content-only .pum-container {
                padding: 0px;
                border-radius: 0px;
                border: 1px none #000000;
                box-shadow: 0px 0px 0px 0px rgba(2, 2, 2, 0.00)
            }

            .pum-theme-2693 .pum-title,
            .pum-theme-content-only .pum-title {
                color: #000000;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 400;
                font-size: 32px;
                line-height: 36px
            }

            .pum-theme-2693 .pum-content,
            .pum-theme-content-only .pum-content {
                color: #8c8c8c;
                font-family: inherit;
                font-weight: 400
            }

            .pum-theme-2693 .pum-content+.pum-close,
            .pum-theme-content-only .pum-content+.pum-close {
                position: absolute;
                height: 18px;
                width: 18px;
                left: auto;
                right: 7px;
                bottom: auto;
                top: 7px;
                padding: 0px;
                color: #000000;
                font-family: inherit;
                font-weight: 700;
                font-size: 20px;
                line-height: 20px;
                border: 1px none #ffffff;
                border-radius: 15px;
                box-shadow: 0px 0px 0px 0px rgba(2, 2, 2, 0.00);
                text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.00);
                background-color: rgba(255, 255, 255, 0.00)
            }

            #pum-5043 {
                z-index: 1999999999
            }

            #pum-5185 {
                z-index: 1999999999
            }

            #pum-5067 {
                z-index: 1999999999
            }

            #pum-2696 {
                z-index: 1999999999
            }

            #pum-2694 {
                z-index: 1999999999
            }
        </style>

        <style id='fixedtoc-style-inline-css' type='text/css'>
            .ftwp-in-post#ftwp-container-outer {
                height: auto;
            }

            #ftwp-container.ftwp-wrap #ftwp-contents {
                width: 250px;
                height: 250px;
            }

            .ftwp-in-post#ftwp-container-outer #ftwp-contents {
                height: auto;
            }

            .ftwp-in-post#ftwp-container-outer.ftwp-float-none #ftwp-contents {
                width: 250px;
            }

            #ftwp-container.ftwp-wrap #ftwp-trigger {
                width: 50px;
                height: 50px;
                font-size: 30px;
            }

            #ftwp-container #ftwp-trigger.ftwp-border-medium {
                font-size: 29px;
            }

            #ftwp-container.ftwp-wrap #ftwp-header {
                font-size: 16px;
                font-family: inherit;
            }

            #ftwp-container.ftwp-wrap #ftwp-header-title {
                font-weight: bold;
            }

            #ftwp-container.ftwp-wrap #ftwp-list {
                font-size: 13px;
                font-family: inherit;
            }

            #ftwp-container.ftwp-wrap #ftwp-list .ftwp-anchor::before {
                font-size: 5.2px;
            }

            #ftwp-container #ftwp-list.ftwp-strong-first>.ftwp-item>.ftwp-anchor .ftwp-text {
                font-size: 14.3px;
            }

            #ftwp-container.ftwp-wrap #ftwp-list.ftwp-strong-first>.ftwp-item>.ftwp-anchor::before {
                font-size: 6.5px;
            }

            #ftwp-container.ftwp-wrap #ftwp-trigger {
                color: #333;
                background: rgba(243, 243, 243, 0.95);
            }

            #ftwp-container.ftwp-wrap #ftwp-trigger {
                border-color: rgba(51, 51, 51, 0.95);
            }

            #ftwp-container.ftwp-wrap #ftwp-contents {
                border-color: rgba(51, 51, 51, 0.95);
            }

            #ftwp-container.ftwp-wrap #ftwp-header {
                color: #333;
                background: rgba(243, 243, 243, 0.95);
            }

            #ftwp-container.ftwp-wrap #ftwp-contents:hover #ftwp-header {
                background: #f3f3f3;
            }

            #ftwp-container.ftwp-wrap #ftwp-list {
                color: #333;
                background: rgba(243, 243, 243, 0.95);
            }

            #ftwp-container.ftwp-wrap #ftwp-contents:hover #ftwp-list {
                background: #f3f3f3;
            }

            #ftwp-container.ftwp-wrap #ftwp-list .ftwp-anchor:hover {
                color: #00A368;
            }

            #ftwp-container.ftwp-wrap #ftwp-list .ftwp-anchor:focus,
            #ftwp-container.ftwp-wrap #ftwp-list .ftwp-active,
            #ftwp-container.ftwp-wrap #ftwp-list .ftwp-active:hover {
                color: #fff;
            }

            #ftwp-container.ftwp-wrap #ftwp-list .ftwp-text::before {
                background: rgba(221, 51, 51, 0.95);
            }

            .ftwp-heading-target::before {
                background: rgba(221, 51, 51, 0.95);
            }
        </style>

        <style id='flatsome-main-inline-css' type='text/css'>
            @font-face {
                font-family: "fl-icons";
                font-display: block;
                src: url(/assets/wp-content/themes/flatsome/assets/css/icons/fl-icons.eot?v=3.15.3);
                src:
                    url(/assets/wp-content/themes/flatsome/assets/css/icons/fl-icons.eot#iefix?v=3.15.3) format("embedded-opentype"),
                    url(/assets/wp-content/themes/flatsome/assets/css/icons/fl-icons.woff2?v=3.15.3) format("woff2"),
                    url(/assets/wp-content/themes/flatsome/assets/css/icons/fl-icons.ttf?v=3.15.3) format("truetype"),
                    url(/assets/wp-content/themes/flatsome/assets/css/icons/fl-icons.woff?v=3.15.3) format("woff"),
                    url(/assets/wp-content/themes/flatsome/assets/css/icons/fl-icons.svg?v=3.15.3#fl-icons) format("svg");
            }
        </style>


        <link rel='stylesheet' id='mystickyelements-google-fonts-css'
            href='https://fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600%2C700&#038;ver=2.0.7'
            type='text/css' media='all' />



        <link rel='stylesheet' id='flatsome-googlefonts-css'
            href='//fonts.googleapis.com/css?family=Roboto%3Aregular%2C700%2Cregular%2C700%7CDancing+Script%3Aregular%2C400&#038;display=swap&#038;ver=3.9'
            type='text/css' media='all' />
        <script type='text/javascript' src='/assets/wp-includes/js/jquery/jquery.min.js?ver=3.7.0'
            id='jquery-core-js' defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1' id='jquery-migrate-js'
            defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.7.0-wc.6.4.1'
            id='jquery-blockui-js' defer></script>
        <script type='text/javascript' id='wc-add-to-cart-js-extra'>
            /* <![CDATA[ */
            var wc_add_to_cart_params = {
                "ajax_url": "\/wp-admin\/admin-ajax.php",
                "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
                "i18n_view_cart": "Xem gi\u1ecf h\u00e0ng",
                "cart_url": "https:\/\/ttpglobal.com.vn\/cart-2\/",
                "is_cart": "",
                "cart_redirect_after_add": "no"
            };
            /* ]]> */
        </script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=6.4.1'
            id='wc-add-to-cart-js' defer></script>
        <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
            src='/assets/wp-content/cache/min/1/wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart.js?ver=1739757361'
            id='vc_woocommerce-add-to-cart-js-js' defer></script>
        <link rel="https://api.w.org/" href="/assets/wp-json/" />
        <link rel="alternate" type="application/json" href="/assets/wp-json/wp/v2/product/2557" />
        <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://ttpglobal.com.vn/xmlrpc.php?rsd" />
        <meta name="generator" content="WordPress 6.3" />
        <meta name="generator" content="Everest Forms 3.0.3.1" />
        <link rel='shortlink' href='https://ttpglobal.com.vn/?p=2557' />
        <link rel="alternate" type="application/json+oembed"
            href="/assets/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fttpglobal.com.vn%2Fphan-bon-huu-co%2Fhumic-hoa-ky-humik-wsp-95-1kg%2F" />
        <link rel="alternate" type="text/xml+oembed"
            href="/assets/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fttpglobal.com.vn%2Fphan-bon-huu-co%2Fhumic-hoa-ky-humik-wsp-95-1kg%2F&#038;format=xml" />
        <script type="application/ld+json">{
    "@context": "https://schema.org/",
    "@type": "CreativeWorkSeries",
    "name": "Humi[K] WSP 95% (1KG)",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "bestRating": "5",
        "ratingCount": "13"
    }
}</script>
        <style>
            .bg {
                opacity: 0;
                transition: opacity 1s;
                -webkit-transition: opacity 1s;
            }

            .bg-loaded {
                opacity: 1;
            }
        </style>
        <!--[if IE]><link rel="stylesheet" type="text/css" href="/assets/wp-content/themes/flatsome/assets/css/ie-fallback.css"><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script><script>
        var head = document.getElementsByTagName('head')[0],
            style = document.createElement('style');
        style.type = 'text/css';
        style.styleSheet.cssText = ':before,:after{content:none !important';
        head.appendChild(style);
        setTimeout(function() {
            head.removeChild(style);
        }, 0);
    </script><script src="/assets/wp-content/themes/flatsome/assets/libs/ie-flexibility.js"></script><![endif]--><!-- Google Tag Manager -->
        <script type="rocketlazyloadscript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5LT9KC48');</script>
        <!-- End Google Tag Manager -->


        <script type="rocketlazyloadscript">window.addEventListener('DOMContentLoaded', function() {

jQuery(function($) {
   var path = window.location.href;

   $('.col-inner a').each(function() {
      if (this.href === path) {
         $(this).addClass('tpactive');
      }
   });
});

});</script>
        <meta name='dmca-site-verification' content='cVdxdXlzejdna2p4c1J2UUhCMXpRait4YlRYMHNObE42eFZsK0VmVk93ST01' />


        <noscript>
            <style>
                .woocommerce-product-gallery {
                    opacity: 1 !important;
                }
            </style>
        </noscript>
        <meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress." />
        <link rel="icon" href="/assets/wp-content/uploads/2022/05/cropped-900-x-900b-32x32.png" sizes="32x32" />
        <link rel="icon" href="/assets/wp-content/uploads/2022/05/cropped-900-x-900b-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="/assets/wp-content/uploads/2022/05/cropped-900-x-900b-180x180.png" />
        <meta name="msapplication-TileImage"
            content="/assets/wp-content/uploads/2022/05/cropped-900-x-900b-270x270.png" />
        <style id="custom-css" type="text/css">
            :root {
                --primary-color: #1a622b;
            }

            .full-width .ubermenu-nav,
            .container,
            .row {
                max-width: 1170px
            }

            .row.row-collapse {
                max-width: 1140px
            }

            .row.row-small {
                max-width: 1162.5px
            }

            .row.row-large {
                max-width: 1200px
            }

            .header-main {
                height: 75px
            }

            #logo img {
                max-height: 75px
            }

            #logo {
                width: 125px;
            }

            .header-bottom {
                min-height: 77px
            }

            .header-top {
                min-height: 20px
            }

            .transparent .header-main {
                height: 30px
            }

            .transparent #logo img {
                max-height: 30px
            }

            .has-transparent+.page-title:first-of-type,
            .has-transparent+#main>.page-title,
            .has-transparent+#main>div>.page-title,
            .has-transparent+#main .page-header-wrapper:first-of-type .page-title {
                padding-top: 80px;
            }

            .header.show-on-scroll,
            .stuck .header-main {
                height: 80px !important
            }

            .stuck #logo img {
                max-height: 80px !important
            }

            .search-form {
                width: 15%;
            }

            .header-bg-color {
                background-color: #ffffff
            }

            .header-bottom {
                background-color: #ffffff
            }

            .top-bar-nav>li>a {
                line-height: 16px
            }

            .header-main .nav>li>a {
                line-height: 16px
            }

            .stuck .header-main .nav>li>a {
                line-height: 36px
            }

            .header-bottom-nav>li>a {
                line-height: 10px
            }

            @media (max-width: 549px) {
                .header-main {
                    height: 75px
                }

                #logo img {
                    max-height: 75px
                }
            }

            .nav-dropdown {
                border-radius: 3px
            }

            .nav-dropdown {
                font-size: 100%
            }

            .header-top {
                background-color: rgba(94, 94, 94, 0.42) !important;
            }

            /* Color */
            .accordion-title.active,
            .has-icon-bg .icon .icon-inner,
            .logo a,
            .primary.is-underline,
            .primary.is-link,
            .badge-outline .badge-inner,
            .nav-outline>li.active>a,
            .nav-outline>li.active>a,
            .cart-icon strong,
            [data-color='primary'],
            .is-outline.primary {
                color: #1a622b;
            }

            /* Color !important */
            [data-text-color="primary"] {
                color: #1a622b !important;
            }

            /* Background Color */
            [data-text-bg="primary"] {
                background-color: #1a622b;
            }

            /* Background */
            .scroll-to-bullets a,
            .featured-title,
            .label-new.menu-item>a:after,
            .nav-pagination>li>.current,
            .nav-pagination>li>span:hover,
            .nav-pagination>li>a:hover,
            .has-hover:hover .badge-outline .badge-inner,
            button[type="submit"],
            .button.wc-forward:not(.checkout):not(.checkout-button),
            .button.submit-button,
            .button.primary:not(.is-outline),
            .featured-table .title,
            .is-outline:hover,
            .has-icon:hover .icon-label,
            .nav-dropdown-bold .nav-column li>a:hover,
            .nav-dropdown.nav-dropdown-bold>li>a:hover,
            .nav-dropdown-bold.dark .nav-column li>a:hover,
            .nav-dropdown.nav-dropdown-bold.dark>li>a:hover,
            .header-vertical-menu__opener,
            .is-outline:hover,
            .tagcloud a:hover,
            .grid-tools a,
            input[type='submit']:not(.is-form),
            .box-badge:hover .box-text,
            input.button.alt,
            .nav-box>li>a:hover,
            .nav-box>li.active>a,
            .nav-pills>li.active>a,
            .current-dropdown .cart-icon strong,
            .cart-icon:hover strong,
            .nav-line-bottom>li>a:before,
            .nav-line-grow>li>a:before,
            .nav-line>li>a:before,
            .banner,
            .header-top,
            .slider-nav-circle .flickity-prev-next-button:hover svg,
            .slider-nav-circle .flickity-prev-next-button:hover .arrow,
            .primary.is-outline:hover,
            .button.primary:not(.is-outline),
            input[type='submit'].primary,
            input[type='submit'].primary,
            input[type='reset'].button,
            input[type='button'].primary,
            .badge-inner {
                background-color: #1a622b;
            }

            /* Border */
            .nav-vertical.nav-tabs>li.active>a,
            .scroll-to-bullets a.active,
            .nav-pagination>li>.current,
            .nav-pagination>li>span:hover,
            .nav-pagination>li>a:hover,
            .has-hover:hover .badge-outline .badge-inner,
            .accordion-title.active,
            .featured-table,
            .is-outline:hover,
            .tagcloud a:hover,
            blockquote,
            .has-border,
            .cart-icon strong:after,
            .cart-icon strong,
            .blockUI:before,
            .processing:before,
            .loading-spin,
            .slider-nav-circle .flickity-prev-next-button:hover svg,
            .slider-nav-circle .flickity-prev-next-button:hover .arrow,
            .primary.is-outline:hover {
                border-color: #1a622b
            }

            .nav-tabs>li.active>a {
                border-top-color: #1a622b
            }

            .widget_shopping_cart_content .blockUI.blockOverlay:before {
                border-left-color: #1a622b
            }

            .woocommerce-checkout-review-order .blockUI.blockOverlay:before {
                border-left-color: #1a622b
            }

            /* Fill */
            .slider .flickity-prev-next-button:hover svg,
            .slider .flickity-prev-next-button:hover .arrow {
                fill: #1a622b;
            }

            body {
                font-size: 100%;
            }

            @media screen and (max-width: 549px) {
                body {
                    font-size: 100%;
                }
            }

            body {
                font-family: "Roboto", sans-serif
            }

            body {
                font-weight: 0
            }

            body {
                color: #000000
            }

            .nav>li>a {
                font-family: "Roboto", sans-serif;
            }

            .mobile-sidebar-levels-2 .nav>li>ul>li>a {
                font-family: "Roboto", sans-serif;
            }

            .nav>li>a {
                font-weight: 700;
            }

            .mobile-sidebar-levels-2 .nav>li>ul>li>a {
                font-weight: 700;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .heading-font,
            .off-canvas-center .nav-sidebar.nav-vertical>li>a {
                font-family: "Roboto", sans-serif;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .heading-font,
            .banner h1,
            .banner h2 {
                font-weight: 700;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .heading-font {
                color: #075f33;
            }

            .nav>li>a,
            .links>li>a {
                text-transform: none;
            }

            .alt-font {
                font-family: "Dancing Script", sans-serif;
            }

            .alt-font {
                font-weight: 400 !important;
            }

            .header:not(.transparent) .header-nav-main.nav>li>a {
                color: #000000;
            }

            .header:not(.transparent) .header-nav-main.nav>li>a:hover,
            .header:not(.transparent) .header-nav-main.nav>li.active>a,
            .header:not(.transparent) .header-nav-main.nav>li.current>a,
            .header:not(.transparent) .header-nav-main.nav>li>a.active,
            .header:not(.transparent) .header-nav-main.nav>li>a.current {
                color: #075f33;
            }

            .header-nav-main.nav-line-bottom>li>a:before,
            .header-nav-main.nav-line-grow>li>a:before,
            .header-nav-main.nav-line>li>a:before,
            .header-nav-main.nav-box>li>a:hover,
            .header-nav-main.nav-box>li.active>a,
            .header-nav-main.nav-pills>li>a:hover,
            .header-nav-main.nav-pills>li.active>a {
                color: #FFF !important;
                background-color: #075f33;
            }

            .header:not(.transparent) .header-bottom-nav.nav>li>a {
                color: #000000;
            }

            .header:not(.transparent) .header-bottom-nav.nav>li>a:hover,
            .header:not(.transparent) .header-bottom-nav.nav>li.active>a,
            .header:not(.transparent) .header-bottom-nav.nav>li.current>a,
            .header:not(.transparent) .header-bottom-nav.nav>li>a.active,
            .header:not(.transparent) .header-bottom-nav.nav>li>a.current {
                color: #075f33;
            }

            .header-bottom-nav.nav-line-bottom>li>a:before,
            .header-bottom-nav.nav-line-grow>li>a:before,
            .header-bottom-nav.nav-line>li>a:before,
            .header-bottom-nav.nav-box>li>a:hover,
            .header-bottom-nav.nav-box>li.active>a,
            .header-bottom-nav.nav-pills>li>a:hover,
            .header-bottom-nav.nav-pills>li.active>a {
                color: #FFF !important;
                background-color: #075f33;
            }

            a {
                color: #075f33;
            }

            a:hover {
                color: #13990f;
            }

            .tagcloud a:hover {
                border-color: #13990f;
                background-color: #13990f;
            }

            .shop-page-title.featured-title .title-overlay {
                background-color: #1a622b;
            }

            .has-equal-box-heights .box-image {
                padding-top: 100%;
            }

            .shop-page-title.featured-title .title-bg {
                background-image: url(/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg) !important;
            }

            @media screen and (min-width: 550px) {
                .products .box-vertical .box-image {
                    min-width: 300px !important;
                    width: 300px !important;
                }
            }

            .header-main .social-icons,
            .header-main .cart-icon strong,
            .header-main .menu-title,
            .header-main .header-button>.button.is-outline,
            .header-main .nav>li>a>i:not(.icon-angle-down) {
                color: #1a622b !important;
            }

            .header-main .header-button>.button.is-outline,
            .header-main .cart-icon strong:after,
            .header-main .cart-icon strong {
                border-color: #1a622b !important;
            }

            .header-main .header-button>.button:not(.is-outline) {
                background-color: #1a622b !important;
            }

            .header-main .current-dropdown .cart-icon strong,
            .header-main .header-button>.button:hover,
            .header-main .header-button>.button:hover i,
            .header-main .header-button>.button:hover span {
                color: #FFF !important;
            }

            .header-main .menu-title:hover,
            .header-main .social-icons a:hover,
            .header-main .header-button>.button.is-outline:hover,
            .header-main .nav>li>a:hover>i:not(.icon-angle-down) {
                color: #075f33 !important;
            }

            .header-main .current-dropdown .cart-icon strong,
            .header-main .header-button>.button:hover {
                background-color: #075f33 !important;
            }

            .header-main .current-dropdown .cart-icon strong:after,
            .header-main .current-dropdown .cart-icon strong,
            .header-main .header-button>.button:hover {
                border-color: #075f33 !important;
            }

            .footer-1 {
                background-image: url('/assets/wp-content/uploads/2022/10/bg-footer-1.jpg');
            }

            .footer-1 {
                background-color: rgba(255, 255, 255, 0)
            }

            .header-vertical-menu__opener,
            .header-vertical-menu__fly-out {
                width: 189px
            }

            .header-vertical-menu__fly-out {
                background-color: #ffffff
            }

            /* Custom CSS */
            .entry-author.author-box {
                display: none;
            }

            .everest-forms-field-limit-text {
                display: none;
            }

            .label-new.menu-item>a:after {
                content: "New";
            }

            .label-hot.menu-item>a:after {
                content: "Hot";
            }

            .label-sale.menu-item>a:after {
                content: "Sale";
            }

            .label-popular.menu-item>a:after {
                content: "Popular";
            }
        </style>
        <style type="text/css" id="wp-custom-css">
            /***** CSS trên Desktop ******/

            @media only screen and (min-width: 850px) {
                /*/     CSS LOGO     /*/

                #logo img {
                    max-height: 125px;
                    padding-top: 18px;
                }


                /*==    DONE CSS LOGO   ==*/
                /*/ LINE HEADER MAIN AND BOTTOM  /*/
                .header-main .inner {
                    width: 85%;
                    height: 1px;
                    margin-left: auto;
                    border-bottom: 1px solid #ddd;
                }

                .header-main {
                    height: 100px !important;
                }

                /*== DONE LINE HEADER MAIN AND BOTTOM ==*/
                /*/   CSS SUB MENU MAIN     /*/
                .header-main .header-inner a {
                    font-size: 13px;
                    font-weight: 450 !important;
                }

                .header-main .gt-current-lang img {
                    margin-right: 6px;
                }

                /*== DONE CSS SUB MENU MAIN ==*/
                /*/ CHƯA PHÂN LOẠI /*/
                .header-main .social-icons .is-outline {
                    border-color: #ddd !important;
                    color: black;
                }

                .header-bottom {
                    min-height: 40px;
                }

                .stuck .header-bottom {
                    min-height: 0px !important;
                }

                .stuck #logo img {

                    max-height: 105px !important;
                    padding-top: 18px;
                    margin: auto;
                }

                .nav-dropdown {
                    margin-top: 5px;
                    background-color: translate;
                }

                .nav-dropdown li {
                    margin-top: 2px;
                    background-color: #2c7e3c !important;
                    border-radius: 5px;

                }

                .nav-dropdown {
                    color: #fff !important;
                    background-color: transparent !important;

                }

                .nav-dropdown li:hover {
                    background-color: #06ae5a !important;
                }

                .loi {
                    font-size: 180px !important;
                    margin-top: -90px !important;
                }

                .loiich {
                    font-size: 38px !important;
                }

                .gioi-thieu .col {
                    padding-bottom: 0px !important;
                }

                .nhom-san-pham .col {
                    padding-bottom: 0px !important;
                }


                .category-filter-row {
                    display: none;
                }




                .flickity-slider .post-item {
                    height: 450px !important;
                }

                .flickity-slider .post-item .col-inner .box-blog-post .blog-post-inner {
                    height: 300px !important;
                }

                .blog-post-inner button {
                    position: absolute;
                    bottom: 0px;
                    right: 25%;
                }




                #logo:after,
                #logo:before {
                    transform: skewX(-25deg) translateY(-50%);
                    content: "";
                    position: absolute;
                    top: 50%;
                    width: 40px;
                    height: 100%;
                    background-color: white;
                    z-index: 0
                }

                #logo:before {
                    left: 0%;
                    animation: light-left 5s infinite alternate linear
                }

                #logo:after {
                    right: -5%;
                    animation: light-right 5s infinite alternate linear
                }

                @keyframes light-left {
                    0% {
                        left: -5%;
                        opacity: 0
                    }

                    50% {
                        left: 50%;
                        opacity: 1
                    }

                    to {
                        left: 105%;
                        opacity: 0
                    }
                }

                @keyframes light-right {
                    0% {
                        right: -5%;
                        opacity: 0
                    }

                    50% {
                        right: 50%;
                        opacity: 1
                    }

                    to {
                        right: 105%;
                        opacity: 0
                    }
                }



            }

            /*   DONE CSS trên Desktop     */
            /** CSS Cho Tất Cả Thiết Bị **/

            /*/ CSS thanh tìm kiếm /*/
            .header-nav .searchform {
                width: 267px;
            }

            .header-nav .button.submit-button.button.submit-button {
                border-top: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
                border-left: 0px;
                box-sizing: border-box;
                padding: 0 0.75em;
                height: 2.507em;
                font-size: .97em;
                border-radius: 0;
                max-width: 100%;
                width: 100%;
                vertical-align: middle;
                background-color: #fff;
                color: #333;
                transition: color .3s, border .3s, background .3s, opacity .3s;
                -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
                box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
                -webkit-transition: color .3s, border .3s, background .3s, opacity .3s;
                -o-transition: color .3s, border .3s, background .3s, opacity .3s;
            }

            @media only screen and (max-width: 850px) {

                .loi {
                    font-size: 100px !important;
                    margin-top: -30px !important;
                }

                .loiich {
                    font-size: 20px !important;
                    padding-top: 20px;
                }

                .loi-ich-phan-bon {
                    padding: 0px 20px;
                }

                /*/          DONE         /*/
                /*/ CSS Lướt Bóng cho LOGO /*/

                #logo:after,
                #logo:before {
                    transform: skewX(-25deg) translateY(-50%);
                    content: "";
                    position: absolute;
                    top: 50%;
                    width: 40px;
                    height: 100%;
                    background-color: white;
                    z-index: 0
                }

                #logo:before {
                    left: 0%;
                    animation: light-left 5s infinite alternate linear
                }

                #logo:after {
                    right: -5%;
                    animation: light-right 5s infinite alternate linear
                }

                @keyframes light-left {
                    0% {
                        left: -5%;
                        opacity: 0
                    }

                    50% {
                        left: 50%;
                        opacity: 1
                    }

                    to {
                        left: 105%;
                        opacity: 0
                    }
                }

                @keyframes light-right {
                    0% {
                        right: -5%;
                        opacity: 0
                    }

                    50% {
                        right: 50%;
                        opacity: 1
                    }

                    to {
                        right: 105%;
                        opacity: 0
                    }
                }
            }

            /*/          DONE         /*/
            /*/ CSS Lướt Bóng cho LOGO /*/


            .header-nav .search-field {
                border-right: 0px;
            }

            /** CSS phần Menu Contact **/
            .mystickyelements-icon-below-text {
                color: black;
            }

            .mystickyelements-fixed.mystickyelements-position-mobile-bottom ul li.mystickyelements-minimize {
                display: none
            }

            .mystickyelements-fixed.mystickyelements-position-mobile-bottom ul li,
            .mystickyelements-fixed.mystickyelements-position-mobile-bottom.mystickyelements-bottom-social-channel-6 ul li {
                width: 20%;
            }

            element.style {}

            span.mystickyelements-social-icon,
            span.mystickyelements-social-icon a {
                width: 80px;
            }


            .mystickyelements-position-mobile-bottom ul.mystickyno-minimize li,
            .mystickyelements-position-mobile-bottom.mystickyelements-bottom-social-channel-5 ul.mystickyno-minimize li {
                width: 20%;
            }

            .mystickyelements-mobile-size-large.mystickyelements-position-mobile-bottom {
                height: 80px;
            }

            .mystickyelements-mobile-size-large.mystickyelements-position-mobile-bottom span.mystickyelements-social-icon {
                height: 65px;
            }

            .social-custom_channel_4 img {
                width: 45px !important;
                height: 45px !important;
            }

            .mystickyno-minimize img:hover {
                width: 45px !important;
                height: 45px !important;

            }

            .social-custom_channel_4 {
                padding-bottom: 15px;
            }

            .social-custom_channel_4 .mystickyelements-icon-below-text {
                padding-top: 5px;
            }

            .mystickyelement-lists-wrap {
                border-radius: 10px;
                background: #F5F5F5;
                margin: 5px;
            }

            /** Done **/
            .mystickyelements-fixed {
                z-index: 100;
            }


            .accordion-title.active {
                background-color: #075f33 !important;
                color: white !important;
                font-weight: 500;
            }

            .blog-post-inner .from_the_blog_excerpt {
                text-align: justify;
            }

            .accordion-inner {
                padding: 1em;
                text-align: justify;
            }




            .product-small .box-text .category {
                color: black;
                font-weight: 600 !important;
            }

            .product-small .box-text .product-title {
                font-weight: 600 !important;
                height: 45px;
            }



            .text-justify {
                text-align: justify;
            }


            .product-footer {
                color: #0A0A0A !important;
            }

            .nav-tabs+.tab-panels {
                border: 0px solid #fff;
                background-color: #fff;
                padding: 0px;
            }


            .tab-panels h2 {
                color: white;
                background: #1a622b;
                line-height: 2;
                text-align: center;
            }

            #product-2600 h2,
            #product-2603 h2,
            #product-2593 h2,
            #product-2596 h2,
            #product-2545 h2,
            #product-2551 h2,
            #product-2571 h2 {
                color: white;
                background: #FFD700;
                line-height: 2;
                text-align: center;
            }

            #product-2557 h2 {
                color: white;
                background: #CC0000;
                line-height: 2;
                text-align: center;
            }



            #product-2600 .product-container,
            #product-2567 .product-container,
            #product-2575 .product-container,
            #product-2579 .product-container,
            #product-2585 .product-container,
            #product-2590 .product-container,
            #product-2593 .product-container,
            #product-2596 .product-container {
                background-image: url("/assets/wp-content/uploads/2023/07/HumiK-Bio-head.jpg") !important;
                background-repeat: no-repeat;
                background-position: center top;
            }


            #product-2545 .product-container,
            #product-2571 .product-container,
            #product-2603 .product-container {
                background-image: url("/assets/wp-content/uploads/2023/07/Ful-Grow-NBG.jpg") !important;
                background-repeat: no-repeat;
                background-position: center top;
            }


            .product-info,
            .product-gallery-slider img {
                background-color: #ffffffd4;
                border-radius: 10px;
            }

            .yikes-custom-woo-tab-title {
                display: none;
            }

            .product-info {
                color: #0A0A0A;
            }

            .product-info h1 {
                padding-top: 20px;
                color: #1a622b;
                text-transform: uppercase;
                text-align: center;
            }


            .humikwsg {
                background-image: url("/assets/wp-content/uploads/2023/07/Humi-K-WSG-VBG-OPT2-1.gif") !important;
                background-size: 83%;
                background-repeat: no-repeat;
                background-position: center top;
            }

            div#div_video {
                margin-top: 30px;
                position: absolute;
            }


            .nav-dark .nav>li.html {
                text-align: center;
                padding-left: 25%;
            }


            .box-image {
                border-radius: 5px;
            }

            .menu-gia-nong-san .col {
                height: 100px;
            }

            .menu-gia-nong-san .col .icon-box .icon-box-img {
                height: 50px;
            }

            .menu-gia-nong-san .col .icon-box .icon-box-text {
                line-height: 18px;
            }

            .menu-gia-nong-san .col .icon-box:hover .icon-box-text.last-reset h4 {
                color: #ff0000;
            }

            .menu-gia-nong-san .col a.tpactive .icon-box-text.last-reset h4 {
                color: #ff0000;
            }

            .ftwp-in-post#ftwp-container-outer.ftwp-float-none #ftwp-contents {
                width: 100%;
            }

            .wp-block-image figcaption {
                text-align: center;
            }

            .post .wp-block-image {
                text-align: center;
                padding-bottom: 15px;
            }



            span.amount {
                color: red;
            }

            @media (max-width:764px) {
                .product-small .box-text .product-title {
                    height: 60px;
                }

                .bgtruyenhinh .fill {
                    background-size: 100% !important;
                }
            }

            div#pum_popup_title_5043 {
                padding-left: 15px;
            }

            .pum-theme-2698.pum-content,
            .pum-theme-ng .pum-content {
                padding: 0px !important;
            }

            div#pum_popup_title_5043 {
                background: #005500 !important;
            }

            div#pum_popup_title_5043 {
                font-size: 20px;
                padding-left: 10px;
                color: #FFF;
                font-weight: bold;
                background: #005500;
            }

            div#popmake-5043 {
                padding: 0px !important;
            }

            #popmake-5043 .pum-title {
                margin-bottom: 0px !important;
            }

            #popmake-5043 img.size-full.alignnone {
                margin-bottom: 0em;
                width: 100%;
            }

            div#popmake-5067 {
                box-shadow: unset;
                border: 0px;
                background: transparent;
            }

            .color-footer a {
                color: white;
            }

            .woocommerce-form-coupon-toggle {
                display: none !important;
            }

            .checkout_coupon.woocommerce-form-coupon {
                display: block !important;
                margin-top: 20px !important;
            }

            .checkout_coupon.woocommerce-form-coupon p:first-child {
                font-weight: 700;
            }

            .checkout_coupon.woocommerce-form-coupon p {
                display: block !important;
            }

            .checkout_coupon.woocommerce-form-coupon input[name="coupon_code"] {
                min-width: 171px !important;
            }

            .checkout_coupon.woocommerce-form-coupon button {
                width: 160px;
                margin-top: 4px !important;
                font-size: 12px !important;
                line-height: 12px !important;
                font-weight: 500 !important;
            }

            .article-inner .relative {
                display: none;
            }

            div#pum_popup_title_2696 {
                padding-bottom: 10px;
                padding-top: 10px;
                padding-left: 10px;
                color: #FFF;
            }

            .pum-theme-2698.pum-content {
                /*
background:#FFF;
 */
            }

            div#evf-2695-field_message-container {
                margin-bottom: 0px;

            }

            .pum-theme-2698 .pum-container {
                height: fit-content;
                bottom: 0;
                padding: 0px;
                border-radius: 0px;
                /*
    border: 1px none #000000;
    box-shadow: 1px 1px 3px 0px rgba(2, 2, 2, 0.23);
    background-color: rgba(249, 249, 249, 1.00);
*/
            }

            .pum-theme-2698 .pum-title {
                padding-bottom: 8px;
                padding-top: 8px;
                padding-left: 10px color: #FFF;
                background: #005500;
                text-align: left;
                text-shadow: 0px 0px 0px rgba(2, 2, 2, 0.23);
                font-family: inherit;
                font-weight: 400;
                font-size: 22px;
                line-height: 22px;
            }

            #evf-form-2695 .evf-submit-container {
                float: right;
                margin: 0px;
                padding: 0px
            }

            button#evf-submit-2695 {
                color: #FFF;
                background: #005500;
                display: none;
            }

            .badge-inner {
                background-color: #DD0000;
            }

            .badge-container {
                margin: 35% 0 0 0;
                display: none;
            }

            .markdown-main-panel ul,
            ol {
                margin-left: 3%;
            }

            div#banner-263840242 .fill {
                background-size: contain !important;
            }

            .bgtruyenhinh {
                background-size: contain !important;
            }

            .bgtruyenhinh .fill {
                background-size: 100% !important;
            }

            .bgtruyenhinh .bg.bg-loaded {
                background-size: contain !important;
                background-size: 100% 100% !important;
            }


            @media (max-width:764px) {

                .bannertrangchu {
                    height: 124px !important;
                }

                .bgtruyenhinh .bg.bg-loaded {
                    background-size: 100% !important;
                }

                .bannerphanhuuconhapkhau h1,
                .phanbonhhuco h1,
                .phanbonhhuco h2,
                .phanbonhhuco h3 {
                    font-size: 0.9rem;
                    margin-top: -125px;
                }

                .phanbonhhuco h3 {
                    font-size: 0.9rem;
                    margin-top: 15px;
                }
            }

            .pum-theme-2698 .pum-container,
            .pum-theme-ng .pum-container {
                padding: 18px;
                border-radius: 0px;
                border: 1px none #000000;
                box-shadow: unset !important;
                background-color: unset !important;
            }

            .classcolbanner {
                margin-bottom: -40px;
                padding: 0px;
            }

            #metaslider_9062 .flex-control-paging li a.flex-active {
                background: #fff;

                cursor: default;
            }

            #metaslider_9062 .flex-control-paging li a {
                background: #fff;
                background: rgb(255 255 255 / 50%);
            }

            #metaslider_9062 ol.flex-control-nav.flex-control-paging {
                bottom: 10px;
            }

            div#evf-2695 {
                background: #FFF;
            }
        </style>
        <noscript>
            <style>
                .wpb_animate_when_almost_visible {
                    opacity: 1;
                }
            </style>
        </noscript><noscript>
            <style id="rocket-lazyload-nojs-css">
                .rll-youtube-player,
                [data-lazy-src] {
                    display: none !important;
                }
            </style>
        </noscript>
    </head>

    <body
        class="product-template-default single single-product postid-2557 wp-custom-logo theme-flatsome everest-forms-no-js woocommerce woocommerce-page woocommerce-no-js woo-variation-swatches wvs-behavior-blur wvs-theme-flatsome wvs-show-label wvs-tooltip full-width lightbox nav-dropdown-has-arrow mobile-submenu-toggle wpb-js-composer js-comp-ver-6.2.0 vc_responsive has-ftoc">

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5LT9KC48" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>

        <div id="wrapper">




            <div class="shop-page-title product-page-title dark  page-title featured-title ">

                <div class="page-title-bg fill">
                    <div class="title-bg fill bg-fill" data-parallax-fade="true" data-parallax="-2"
                        data-parallax-background data-parallax-container=".page-title"></div>
                    <div class="title-overlay fill"></div>
                </div>

                <div class="page-title-inner flex-row  medium-flex-wrap container">
                    <div class="flex-col flex-grow medium-text-center">
                        <div class="is-large">
                            <nav class="woocommerce-breadcrumb breadcrumbs uppercase"><a
                                    href="https://ttpglobal.com.vn">Trang chủ</a> <span class="divider">&#47;</span> <a
                                    href="https://ttpglobal.com.vn/danh-muc/phan-bon-huu-co/">Phân Bón Hữu Cơ</a></nav>
                        </div>
                    </div>

                    <div class="flex-col nav-right medium-text-center">

                    </div>
                </div>
            </div>

            <main id="main" class="">

                <div class="shop-container">

                    <div class="container">
                        <div class="woocommerce-notices-wrapper"></div>
                    </div>
                    <div id="product-2557"
                        class="post-ftoc product type-product post-2557 status-publish first instock product_cat-phan-bon-huu-co has-post-thumbnail shipping-taxable purchasable product-type-simple">
                        <div class="product-container">
                            <div class="product-main">
                                <!-------->
                                <style type="text/css">
                                    div#div_video {
                                        top: 0px;
                                        position: absolute;

                                    }
                                </style>
                                <div id="div_video" style="margin: 0 !important">
                                    <div id="content_video">
                                        <video style="width: 100%; height: 100%;" autoplay muted loop playsinline
                                            id="myVideo">
                                            <source
                                                src="/assets/wp-content/uploads/2023/03/new-humik-wsp-video-no-fade.mp4"
                                                type="video/mp4">
                                        </video>
                                    </div>

                                </div>

                                <!------>

                                <div class="row content-row mb-0">

                                    <div class="product-gallery large-6 col">

                                        <div class="product-images relative mb-half has-hover woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                            data-columns="4">

                                            <div class="badge-container is-larger absolute left top z-1">
                                            </div>

                                            <div class="image-tools absolute top show-on-hover right z-3">
                                            </div>

                                            <figure
                                                class="woocommerce-product-gallery__wrapper product-gallery-slider slider slider-nav-small mb-half"
                                                data-flickity-options='{
                "cellAlign": "center",
                "wrapAround": true,
                "autoPlay": false,
                "prevNextButtons":true,
                "adaptiveHeight": true,
                "imagesLoaded": true,
                "lazyLoad": 1,
                "dragThreshold" : 15,
                "pageDots": false,
                "rightToLeft": false       }'>
                                                <div data-thumb="/assets/wp-content/uploads/2023/03/Artboard-11-copy-2-100x100.jpg"
                                                    data-thumb-alt="Phân bón hữu cơ dạng bột"
                                                    class="woocommerce-product-gallery__image slide first"><a
                                                        href="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"><img
                                                            width="496" height="496"
                                                            src="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"
                                                            class="wp-post-image skip-lazy"
                                                            alt="Phân bón hữu cơ dạng bột" decoding="async"
                                                            title="phân bón hữu cơ dạng bột" data-caption=""
                                                            data-src="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"
                                                            data-large_image="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"
                                                            data-large_image_width="496" data-large_image_height="496"
                                                            srcset="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg 496w, /assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg 300w, /assets/wp-content/uploads/2023/03/Artboard-11-copy-2-100x100.jpg 100w"
                                                            sizes="(max-width: 496px) 100vw, 496px" data-
                                                            data-large_image_></a></div>
                                                <style>
                                                    .product-thumbnails img {
                                                        height: 80px;
                                                        object-fit: cover
                                                    }
                                                </style>
                                                <div data-thumb="/assets/wp-content/uploads/2023/03/humic-my-100x100.jpg"
                                                    data-thumb-alt="Phân Humic TTP GLOBAL"
                                                    class="woocommerce-product-gallery__image slide"><a
                                                        href="/assets/wp-content/uploads/2023/03/humic-my.jpg"><img
                                                            width="600" height="450"
                                                            src="/assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg"
                                                            class="skip-lazy" alt="Phân Humic TTP GLOBAL"
                                                            decoding="async" title="humic-my" data-caption=""
                                                            data-src="/assets/wp-content/uploads/2023/03/humic-my.jpg"
                                                            data-large_image="/assets/wp-content/uploads/2023/03/humic-my.jpg"
                                                            data-large_image_width="1000" data-large_image_height="750"
                                                            srcset="/assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg 600w, /assets/wp-content/uploads/2023/03/humic-my-300x225.jpg 300w, /assets/wp-content/uploads/2023/03/humic-my-768x576.jpg 768w, /assets/wp-content/uploads/2023/03/humic-my.jpg 1000w"
                                                            sizes="(max-width: 600px) 100vw, 600px"></a></div>

                                            </figure>

                                            <div class="image-tools absolute bottom left z-3">
                                                <a href="#product-zoom"
                                                    class="zoom-button button is-outline circle icon tooltip hide-for-small"
                                                    title="Zoom">
                                                    <i class="icon-expand"></i> </a>
                                            </div>
                                        </div>

                                        <div class="product-thumbnails thumbnails slider row row-small row-slider slider-nav-small small-columns-4"
                                            data-flickity-options='{
			"cellAlign": "left",
			"wrapAround": false,
			"autoPlay": false,
			"prevNextButtons": true,
			"asNavFor": ".product-gallery-slider",
			"percentPosition": true,
			"imagesLoaded": true,
			"pageDots": false,
			"rightToLeft": false,
			"contain": true
		}'>
                                            <div class="col is-nav-selected first">
                                                <a>
                                                    <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20300'%3E%3C/svg%3E"
                                                        alt="Phân bón hữu cơ dạng bột" width="300" height="300"
                                                        class="attachment-woocommerce_thumbnail"
                                                        data-lazy-src="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg" /><noscript><img
                                                            src="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"
                                                            alt="Phân bón hữu cơ dạng bột" width="300" height="300"
                                                            class="attachment-woocommerce_thumbnail" /></noscript> </a>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="product-info summary col-fit col entry-summary product-summary">

                                        <h1 class="product-title product_title entry-title">
                                            Phân Bón Hưu Cơ AC2</h1>

                                        <div class="is-divider small"></div>
                                        <p id="0pprice" class="price">
                                            <style type="text/css">
                                                form.cart {
                                                    display: none;
                                                }

                                                ;

                                                p#pprice {
                                                    visibility: hidden;
                                                }
                                            </style>
                                        </p>
                                        <div class="product-short-description">
                                            <p><strong>Phân Bón Hữu Cơ AC2</strong> là dòng <a
                                                    href="https://ttpglobal.com.vn/phan-bon-huu-co/"><strong>phân hữu cơ
                                                        cao cấp</strong></a> có hàm lượng axit humic cao và khả năng tan
                                                100% trong nước, sản phẩm giúp cải thiện cấu trúc đất, tăng cường hấp
                                                thụ dinh dưỡng, kích thích sự phát triển của rễ, nâng cao khả năng chống
                                                chịu stress. Điều này không chỉ tăng sản lượng mà còn nâng cao chất
                                                lượng cây trồng.</p>
                                            <p><strong>Tên đầy đủ</strong>: Phân bón AC2<br />

                                            </p>

                                            <div>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <th>Loại phân bón</th>
                                                            <td>Hữu cơ</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tên phân bón</th>
                                                            <td>Phân bón AC2</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mã số phân bón</th>
                                                            <td>28627</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Thành phần hàm lượng dinh dưỡng</th>
                                                            <td>Chất hữu cơ: 20%</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phương thức sử dụng</th>
                                                            <td>Bón rễ</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tỷ lệ CN</th>
                                                            <td>12%</td>
                                                        </tr>
                                                        <tr>
                                                            <th>pH</th>
                                                            <td>6.0</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tỷ trọng (dạng lỏng)</th>
                                                            <td>1.1</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Độ ẩm (dạng rắn)</th>
                                                            <td>28%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <p><strong>PHÙ HỢP CHO SẢN XUẤT NÔNG NGHIỆP HỮU CƠ VÀ GLOBAL GAP</strong>
                                            </p>
                                            <a rel="noopener noreferrer" href="https://m.me/TTPGLOBAL.COM.VN"
                                                target="_blank" class="button primary is-outline is-large"
                                                style="border-radius:99px;">
                                                <span>LIÊN HỆ TƯ VẤN MIỄN PHÍ</span>
                                                <i class="icon-gift"></i>
                                            </a>
                                            <a rel="noopener noreferrer" href="https://m.me/TTPGLOBAL.COM.VN"
                                                target="_blank" class="button primary is-gloss is-large"
                                                style="border-radius:99px;">
                                                <span>FACEBOOK</span>
                                                <i class="icon-facebook"></i>
                                            </a>
                                        </div>


                                        <form class="cart"
                                            action="https://ttpglobal.com.vn/phan-bon-huu-co/humic-hoa-ky-humik-wsp-95-1kg/"
                                            method="post" enctype='multipart/form-data'>

                                            <div class="quantity buttons_added">
                                                <input type="button" value="-" class="minus button is-form"> <label
                                                    class="screen-reader-text" for="quantity_67bbf08fd9398">Humi[K] WSP
                                                    95% (1KG) số lượng</label>
                                                <input type="number" id="quantity_67bbf08fd9398"
                                                    class="input-text qty text" step="1" min="1" max="" name="quantity"
                                                    value="1" title="Qty" size="4" placeholder="" inputmode="numeric" />
                                                <input type="button" value="+" class="plus button is-form">
                                            </div>
                                            <button type="submit" name="buy-now" value="2557"
                                                class="wpcbn-btn wpcbn-btn-single wpcbn-btn-simple single_add_to_cart_button button alt"
                                                data-product_id="2557">Mua Ngay</button>
                                            <button type="submit" name="add-to-cart" value="2557"
                                                class="single_add_to_cart_button button alt">Thêm vào giỏ hàng</button>

                                        </form>


                                        <div class="product_meta">





                                        </div>
                                        <div class="social-icons share-icons share-row relative"><a
                                                data-action="share/whatsapp/share"
                                                class="icon primary button round tooltip whatsapp show-for-medium"
                                                title="Share on WhatsApp" aria-label="Share on WhatsApp"><i
                                                    class="icon-whatsapp"></i></a><a
                                                href="https://www.facebook.com/sharer.php?u={{ url('/products') }}"
                                                data-label="Facebook"
                                                onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                                rel="noopener noreferrer nofollow" target="_blank"
                                                class="icon primary button round tooltip facebook"
                                                title="Share on Facebook" aria-label="Share on Facebook"><i
                                                    class="icon-facebook"></i></a><a
                                                href="https://twitter.com/share?url={{ url('/products') }}"
                                                onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                                rel="noopener noreferrer nofollow" target="_blank"
                                                class="icon primary button round tooltip twitter"
                                                title="Share on Twitter" aria-label="Share on Twitter"><i
                                                    class="icon-twitter"></i></a><a
                                                href="mailto:enteryour@addresshere.com?subject=Humi%5BK%5D%20WSP%2095%25%20%281KG%29&amp;body=Check%20this%20out:%20{{ url('/products') }}"
                                                rel="nofollow" class="icon primary button round tooltip email"
                                                title="Email to a Friend" aria-label="Email to a Friend"><i
                                                    class="icon-envelop"></i></a><a
                                                href="https://pinterest.com/pin/create/button/?url={{ url('/products') }}&amp;media={{ url('/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg') }}&amp;description=Humi%5BK%5D%20WSP%2095%25%20%281KG%29"
                                                onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                                rel="noopener noreferrer nofollow" target="_blank"
                                                class="icon primary button round tooltip pinterest"
                                                title="Pin on Pinterest" aria-label="Pin on Pinterest"><i
                                                    class="icon-pinterest"></i></a><a
                                                href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('/products') }}&title=Humi%5BK%5D%20WSP%2095%25%20%281KG%29"
                                                onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                                rel="noopener noreferrer nofollow" target="_blank"
                                                class="icon primary button round tooltip linkedin"
                                                title="Share on LinkedIn" aria-label="Share on LinkedIn"><i
                                                    class="icon-linkedin"></i></a></div>
                                    </div>



                                </div>
                            </div>

                            <div class="container">

                                <p>Sở Nông nghiệp và Phát triển nông thôn tỉnh Long An xác nhận đã tiếp nhận hồ sơ công
                                    bố hợp quy số 01/CBHQ/AMERICAN ngày 10/12/2023 của: CÔNG TY TNHH AMERICAN.</p>
                                <p>Địa chỉ trụ sở: 250/8 đường số 6, phường 7, quận Gò Vấp, TP Hồ Chí Minh.</p>
                                <p>Địa chỉ sản xuất: Lô F, đường số 5, CCN Đức Thuận, ấp Tràm Lạc, xã Mỹ Hạnh Bắc, huyện
                                    Đức Hòa, tỉnh Long An.</p>
                                <p>Cho sản phẩm phân bón:</p>

                                <p>Phù hợp tiêu chuẩn/quy chuẩn kỹ thuật: QCVN 01-189:2019/BNNPTNT.</p>
                                <p>Có giá trị 03 năm kể từ ngày 10/12/2023.</p>
                                <p>Thông báo này ghi nhận sự cam kết của tổ chức, cá nhân. Thông báo này không có giá
                                    trị chứng nhận cho sản phẩm, hàng hóa, quá trình, dịch vụ, môi trường phù hợp với
                                    tiêu chuẩn/quy chuẩn kỹ thuật tương ứng.</p>
                                <p>Công ty TNHH American phải hoàn toàn chịu trách nhiệm về tính phù hợp của sản phẩm,
                                    hàng hóa, quá trình, dịch vụ, môi trường do mình sản xuất, kinh doanh, bảo quản, vận
                                    chuyển, sử dụng, khai thác.</p>

                            </div>



                            <div id="login-form-popup" class="lightbox-content mfp-hide">
                                <div class="woocommerce-notices-wrapper"></div>
                                <div class="account-container lightbox-inner">


                                    <div class="account-login-inner">

                                        <h3 class="uppercase">Đăng nhập</h3>

                                        <form class="woocommerce-form woocommerce-form-login login" method="post">


                                            <p
                                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="username">Tên tài khoản hoặc địa chỉ email&nbsp;<span
                                                        class="required">*</span></label>
                                                <input type="text"
                                                    class="woocommerce-Input woocommerce-Input--text input-text"
                                                    name="username" id="username" autocomplete="username" value="" />
                                            </p>
                                            <p
                                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="password">Mật khẩu&nbsp;<span
                                                        class="required">*</span></label>
                                                <input class="woocommerce-Input woocommerce-Input--text input-text"
                                                    type="password" name="password" id="password"
                                                    autocomplete="current-password" />
                                            </p>


                                            <p class="form-row">
                                                <label
                                                    class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                                    <input
                                                        class="woocommerce-form__input woocommerce-form__input-checkbox"
                                                        name="rememberme" type="checkbox" id="rememberme"
                                                        value="forever" /> <span>Ghi
                                                        nhớ mật khẩu</span>
                                                </label>
                                                <input type="hidden" id="woocommerce-login-nonce"
                                                    name="woocommerce-login-nonce" value="8613c8747b" /><input
                                                    type="hidden" name="_wp_http_referer"
                                                    value="/phan-bon-huu-co/humic-hoa-ky-humik-wsp-95-1kg/" /> <button
                                                    type="submit"
                                                    class="woocommerce-button button woocommerce-form-login__submit"
                                                    name="login" value="Đăng nhập">Đăng nhập</button>
                                            </p>
                                            <p class="woocommerce-LostPassword lost_password">
                                                <a href="https://ttpglobal.com.vn/my-account/lost-password/">Quên mật
                                                    khẩu?</a>
                                            </p>


                                        </form>
                                    </div>


                                </div>

                            </div>

                            <!-- Root element of PhotoSwipe. Must have class pswp. -->
                            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                                <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
                                <div class="pswp__bg"></div>

                                <!-- Slides wrapper with overflow:hidden. -->
                                <div class="pswp__scroll-wrap">

                                    <!-- Container that holds slides.
  PhotoSwipe keeps only 3 of them in the DOM to save memory.
  Don't modify these 3 pswp__item elements, data is added later on. -->
                                    <div class="pswp__container">
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                    </div>

                                    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                    <div class="pswp__ui pswp__ui--hidden">

                                        <div class="pswp__top-bar">

                                            <!--  Controls are self-explanatory. Order can be changed. -->

                                            <div class="pswp__counter"></div>

                                            <button class="pswp__button pswp__button--close"
                                                aria-label="Đóng (Esc)"></button>

                                            <button class="pswp__button pswp__button--zoom"
                                                aria-label="Phóng to/ thu nhỏ"></button>

                                            <div class="pswp__preloader">
                                                <div class="loading-spin"></div>
                                            </div>
                                        </div>

                                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                            <div class="pswp__share-tooltip"></div>
                                        </div>

                                        <button class="pswp__button--arrow--left"
                                            aria-label="Ảnh trước (mũi tên trái)"></button>

                                        <button class="pswp__button--arrow--right"
                                            aria-label="Ảnh tiếp (mũi tên phải)"></button>

                                        <div class="pswp__caption">
                                            <div class="pswp__caption__center"></div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <!--[if lte IE 9]>
        <script>
            'use strict';
            (function($) {
                $(document).ready(function() {
                    $('#ftwp-container').addClass('ftwp-ie9');
                });
            })(jQuery);
        </script>
        <![endif]-->
                            <script type="rocketlazyloadscript" data-rocket-type="text/javascript">
		var c = document.body.className;
		c = c.replace( /everest-forms-no-js/, 'everest-forms-js' );
		document.body.className = c;
	</script>
                            <script type="rocketlazyloadscript" data-rocket-type="text/javascript">
		(function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})();
	</script>
                            <style id='global-styles-inline-css' type='text/css'>
                                body {
                                    --wp--preset--color--black: #000000;
                                    --wp--preset--color--cyan-bluish-gray: #abb8c3;
                                    --wp--preset--color--white: #ffffff;
                                    --wp--preset--color--pale-pink: #f78da7;
                                    --wp--preset--color--vivid-red: #cf2e2e;
                                    --wp--preset--color--luminous-vivid-orange: #ff6900;
                                    --wp--preset--color--luminous-vivid-amber: #fcb900;
                                    --wp--preset--color--light-green-cyan: #7bdcb5;
                                    --wp--preset--color--vivid-green-cyan: #00d084;
                                    --wp--preset--color--pale-cyan-blue: #8ed1fc;
                                    --wp--preset--color--vivid-cyan-blue: #0693e3;
                                    --wp--preset--color--vivid-purple: #9b51e0;
                                    --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
                                    --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
                                    --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
                                    --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
                                    --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
                                    --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
                                    --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
                                    --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
                                    --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
                                    --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
                                    --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
                                    --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
                                    --wp--preset--font-size--small: 13px;
                                    --wp--preset--font-size--medium: 20px;
                                    --wp--preset--font-size--large: 36px;
                                    --wp--preset--font-size--x-large: 42px;
                                    --wp--preset--spacing--20: 0.44rem;
                                    --wp--preset--spacing--30: 0.67rem;
                                    --wp--preset--spacing--40: 1rem;
                                    --wp--preset--spacing--50: 1.5rem;
                                    --wp--preset--spacing--60: 2.25rem;
                                    --wp--preset--spacing--70: 3.38rem;
                                    --wp--preset--spacing--80: 5.06rem;
                                    --wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
                                    --wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
                                    --wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
                                    --wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);
                                    --wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);
                                }

                                :where(.is-layout-flex) {
                                    gap: 0.5em;
                                }

                                :where(.is-layout-grid) {
                                    gap: 0.5em;
                                }

                                body .is-layout-flow>.alignleft {
                                    float: left;
                                    margin-inline-start: 0;
                                    margin-inline-end: 2em;
                                }

                                body .is-layout-flow>.alignright {
                                    float: right;
                                    margin-inline-start: 2em;
                                    margin-inline-end: 0;
                                }

                                body .is-layout-flow>.aligncenter {
                                    margin-left: auto !important;
                                    margin-right: auto !important;
                                }

                                body .is-layout-constrained>.alignleft {
                                    float: left;
                                    margin-inline-start: 0;
                                    margin-inline-end: 2em;
                                }

                                body .is-layout-constrained>.alignright {
                                    float: right;
                                    margin-inline-start: 2em;
                                    margin-inline-end: 0;
                                }

                                body .is-layout-constrained>.aligncenter {
                                    margin-left: auto !important;
                                    margin-right: auto !important;
                                }

                                body .is-layout-constrained> :where(:not(.alignleft):not(.alignright):not(.alignfull)) {
                                    max-width: var(--wp--style--global--content-size);
                                    margin-left: auto !important;
                                    margin-right: auto !important;
                                }

                                body .is-layout-constrained>.alignwide {
                                    max-width: var(--wp--style--global--wide-size);
                                }

                                body .is-layout-flex {
                                    display: flex;
                                }

                                body .is-layout-flex {
                                    flex-wrap: wrap;
                                    align-items: center;
                                }

                                body .is-layout-flex>* {
                                    margin: 0;
                                }

                                body .is-layout-grid {
                                    display: grid;
                                }

                                body .is-layout-grid>* {
                                    margin: 0;
                                }

                                :where(.wp-block-columns.is-layout-flex) {
                                    gap: 2em;
                                }

                                :where(.wp-block-columns.is-layout-grid) {
                                    gap: 2em;
                                }

                                :where(.wp-block-post-template.is-layout-flex) {
                                    gap: 1.25em;
                                }

                                :where(.wp-block-post-template.is-layout-grid) {
                                    gap: 1.25em;
                                }

                                .has-black-color {
                                    color: var(--wp--preset--color--black) !important;
                                }

                                .has-cyan-bluish-gray-color {
                                    color: var(--wp--preset--color--cyan-bluish-gray) !important;
                                }

                                .has-white-color {
                                    color: var(--wp--preset--color--white) !important;
                                }

                                .has-pale-pink-color {
                                    color: var(--wp--preset--color--pale-pink) !important;
                                }

                                .has-vivid-red-color {
                                    color: var(--wp--preset--color--vivid-red) !important;
                                }

                                .has-luminous-vivid-orange-color {
                                    color: var(--wp--preset--color--luminous-vivid-orange) !important;
                                }

                                .has-luminous-vivid-amber-color {
                                    color: var(--wp--preset--color--luminous-vivid-amber) !important;
                                }

                                .has-light-green-cyan-color {
                                    color: var(--wp--preset--color--light-green-cyan) !important;
                                }

                                .has-vivid-green-cyan-color {
                                    color: var(--wp--preset--color--vivid-green-cyan) !important;
                                }

                                .has-pale-cyan-blue-color {
                                    color: var(--wp--preset--color--pale-cyan-blue) !important;
                                }

                                .has-vivid-cyan-blue-color {
                                    color: var(--wp--preset--color--vivid-cyan-blue) !important;
                                }

                                .has-vivid-purple-color {
                                    color: var(--wp--preset--color--vivid-purple) !important;
                                }

                                .has-black-background-color {
                                    background-color: var(--wp--preset--color--black) !important;
                                }

                                .has-cyan-bluish-gray-background-color {
                                    background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
                                }

                                .has-white-background-color {
                                    background-color: var(--wp--preset--color--white) !important;
                                }

                                .has-pale-pink-background-color {
                                    background-color: var(--wp--preset--color--pale-pink) !important;
                                }

                                .has-vivid-red-background-color {
                                    background-color: var(--wp--preset--color--vivid-red) !important;
                                }

                                .has-luminous-vivid-orange-background-color {
                                    background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
                                }

                                .has-luminous-vivid-amber-background-color {
                                    background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
                                }

                                .has-light-green-cyan-background-color {
                                    background-color: var(--wp--preset--color--light-green-cyan) !important;
                                }

                                .has-vivid-green-cyan-background-color {
                                    background-color: var(--wp--preset--color--vivid-green-cyan) !important;
                                }

                                .has-pale-cyan-blue-background-color {
                                    background-color: var(--wp--preset--color--pale-cyan-blue) !important;
                                }

                                .has-vivid-cyan-blue-background-color {
                                    background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
                                }

                                .has-vivid-purple-background-color {
                                    background-color: var(--wp--preset--color--vivid-purple) !important;
                                }

                                .has-black-border-color {
                                    border-color: var(--wp--preset--color--black) !important;
                                }

                                .has-cyan-bluish-gray-border-color {
                                    border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
                                }

                                .has-white-border-color {
                                    border-color: var(--wp--preset--color--white) !important;
                                }

                                .has-pale-pink-border-color {
                                    border-color: var(--wp--preset--color--pale-pink) !important;
                                }

                                .has-vivid-red-border-color {
                                    border-color: var(--wp--preset--color--vivid-red) !important;
                                }

                                .has-luminous-vivid-orange-border-color {
                                    border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
                                }

                                .has-luminous-vivid-amber-border-color {
                                    border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
                                }

                                .has-light-green-cyan-border-color {
                                    border-color: var(--wp--preset--color--light-green-cyan) !important;
                                }

                                .has-vivid-green-cyan-border-color {
                                    border-color: var(--wp--preset--color--vivid-green-cyan) !important;
                                }

                                .has-pale-cyan-blue-border-color {
                                    border-color: var(--wp--preset--color--pale-cyan-blue) !important;
                                }

                                .has-vivid-cyan-blue-border-color {
                                    border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
                                }

                                .has-vivid-purple-border-color {
                                    border-color: var(--wp--preset--color--vivid-purple) !important;
                                }

                                .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
                                    background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
                                }

                                .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
                                    background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
                                }

                                .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
                                    background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
                                }

                                .has-luminous-vivid-orange-to-vivid-red-gradient-background {
                                    background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
                                }

                                .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
                                    background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
                                }

                                .has-cool-to-warm-spectrum-gradient-background {
                                    background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
                                }

                                .has-blush-light-purple-gradient-background {
                                    background: var(--wp--preset--gradient--blush-light-purple) !important;
                                }

                                .has-blush-bordeaux-gradient-background {
                                    background: var(--wp--preset--gradient--blush-bordeaux) !important;
                                }

                                .has-luminous-dusk-gradient-background {
                                    background: var(--wp--preset--gradient--luminous-dusk) !important;
                                }

                                .has-pale-ocean-gradient-background {
                                    background: var(--wp--preset--gradient--pale-ocean) !important;
                                }

                                .has-electric-grass-gradient-background {
                                    background: var(--wp--preset--gradient--electric-grass) !important;
                                }

                                .has-midnight-gradient-background {
                                    background: var(--wp--preset--gradient--midnight) !important;
                                }

                                .has-small-font-size {
                                    font-size: var(--wp--preset--font-size--small) !important;
                                }

                                .has-medium-font-size {
                                    font-size: var(--wp--preset--font-size--medium) !important;
                                }

                                .has-large-font-size {
                                    font-size: var(--wp--preset--font-size--large) !important;
                                }

                                .has-x-large-font-size {
                                    font-size: var(--wp--preset--font-size--x-large) !important;
                                }
                            </style>
                            <script type='text/javascript' id='kk-star-ratings-js-extra'>
                                /* <![CDATA[ */
                                var kk_star_ratings = {
                                    "action": "kk-star-ratings",
                                    "endpoint": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "nonce": "358649a149"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/kk-star-ratings/src/core/public/js/kk-star-ratings.min.js?ver=5.2.9'
                                id='kk-star-ratings-js' defer></script>
                            <script type='text/javascript'
                                src='/assets/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe.min.js?ver=4.1.1-wc.6.4.1'
                                id='photoswipe-js' defer></script>
                            <script type='text/javascript'
                                src='/assets/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe-ui-default.min.js?ver=4.1.1-wc.6.4.1'
                                id='photoswipe-ui-default-js' defer></script>
                            <script type='text/javascript' id='wc-single-product-js-extra'>
                                /* <![CDATA[ */
                                var wc_single_product_params = {
                                    "i18n_required_rating_text": "Vui l\u00f2ng ch\u1ecdn m\u1ed9t m\u1ee9c \u0111\u00e1nh gi\u00e1",
                                    "review_rating_required": "yes",
                                    "flexslider": {
                                        "rtl": false,
                                        "animation": "slide",
                                        "smoothHeight": true,
                                        "directionNav": false,
                                        "controlNav": "thumbnails",
                                        "slideshow": false,
                                        "animationSpeed": 500,
                                        "animationLoop": false,
                                        "allowOneSlide": false
                                    },
                                    "zoom_enabled": "",
                                    "zoom_options": [],
                                    "photoswipe_enabled": "1",
                                    "photoswipe_options": {
                                        "shareEl": false,
                                        "closeOnScroll": false,
                                        "history": false,
                                        "hideAnimationDuration": 0,
                                        "showAnimationDuration": 0
                                    },
                                    "flexslider_enabled": ""
                                };
                                /* ]]> */
                            </script>
                            <script type='text/javascript'
                                src='/assets/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js?ver=6.4.1'
                                id='wc-single-product-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4-wc.6.4.1'
                                id='js-cookie-js' defer></script>
                            <script type='text/javascript' id='woocommerce-js-extra'>
                                /* <![CDATA[ */
                                var woocommerce_params = {
                                    "ajax_url": "\/wp-admin\/admin-ajax.php",
                                    "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=6.4.1'
                                id='woocommerce-js' defer></script>
                            <script type='text/javascript' id='wc-cart-fragments-js-extra'>
                                /* <![CDATA[ */
                                var wc_cart_fragments_params = {
                                    "ajax_url": "\/wp-admin\/admin-ajax.php",
                                    "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
                                    "cart_hash_key": "wc_cart_hash_7347a1ce29733545b4f2768d9a844644",
                                    "fragment_name": "wc_fragments_7347a1ce29733545b4f2768d9a844644",
                                    "request_timeout": "5000"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=6.4.1'
                                id='wc-cart-fragments-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/underscore.min.js?ver=1.13.4'
                                id='underscore-js' defer></script>
                            <script type='text/javascript' id='wp-util-js-extra'>
                                /* <![CDATA[ */
                                var _wpUtilSettings = {
                                    "ajax": {
                                        "url": "\/wp-admin\/admin-ajax.php"
                                    }
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/wp-util.min.js?ver=6.3' id='wp-util-js'
                                defer></script>
                            <script type='text/javascript' id='wp-api-request-js-extra'>
                                /* <![CDATA[ */
                                var wpApiSettings = {
                                    "root": "https:\/\/ttpglobal.com.vn\/wp-json\/",
                                    "nonce": "f55b83b67f",
                                    "versionString": "wp\/v2\/"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/api-request.min.js?ver=6.3'
                                id='wp-api-request-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/dist/vendor/wp-polyfill-inert.min.js?ver=3.1.2'
                                id='wp-polyfill-inert-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/dist/vendor/regenerator-runtime.min.js?ver=0.13.11'
                                id='regenerator-runtime-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0'
                                id='wp-polyfill-js'></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/dist/hooks.min.js?ver=c6aec9a8d4e5a5d543a1'
                                id='wp-hooks-js'></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/dist/i18n.min.js?ver=7701b0c3857f914212ef'
                                id='wp-i18n-js'></script>
                            <script type="rocketlazyloadscript" id="wp-i18n-js-after"
                                data-rocket-type="text/javascript">
wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
</script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/dist/url.min.js?ver=8814d23f2d64864d280d'
                                id='wp-url-js'></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                id='wp-api-fetch-js-translations'>
( function( domain, translations ) {
	var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
	localeData[""].domain = domain;
	wp.i18n.setLocaleData( localeData, domain );
} )( "default", {"translation-revision-date":"2023-07-15 15:30:50+0000","generator":"GlotPress\/4.0.0-alpha.4","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=1; plural=0;","lang":"vi_VN"},"You are probably offline.":["C\u00f3 th\u1ec3 b\u1ea1n \u0111ang ngo\u1ea1i tuy\u1ebfn."],"Media upload failed. If this is a photo or a large image, please scale it down and try again.":["T\u1ea3i l\u00ean media kh\u00f4ng th\u00e0nh c\u00f4ng. N\u1ebfu \u0111\u00e2y l\u00e0 h\u00ecnh \u1ea3nh c\u00f3 k\u00edch th\u01b0\u1edbc l\u1edbn, vui l\u00f2ng thu nh\u1ecf n\u00f3 xu\u1ed1ng v\u00e0 th\u1eed l\u1ea1i."],"The response is not a valid JSON response.":["Ph\u1ea3n h\u1ed3i kh\u00f4ng ph\u1ea3i l\u00e0 m\u1ed9t JSON h\u1ee3p l\u1ec7."],"An unknown error occurred.":["C\u00f3 l\u1ed7i n\u00e0o \u0111\u00f3 \u0111\u00e3 x\u1ea3y ra."]}},"comment":{"reference":"wp-includes\/js\/dist\/api-fetch.js"}} );
</script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/dist/api-fetch.min.js?ver=0fa4dabf8bf2c7adf21a'
                                id='wp-api-fetch-js'></script>
                            <script type="rocketlazyloadscript" id="wp-api-fetch-js-after"
                                data-rocket-type="text/javascript">
wp.apiFetch.use( wp.apiFetch.createRootURLMiddleware( "/assets/wp-json/" ) );
wp.apiFetch.nonceMiddleware = wp.apiFetch.createNonceMiddleware( "f55b83b67f" );
wp.apiFetch.use( wp.apiFetch.nonceMiddleware );
wp.apiFetch.use( wp.apiFetch.mediaUploadMiddleware );
wp.apiFetch.nonceEndpoint = "/assets/wp-admin/admin-ajax.php?action=rest-nonce";
</script>
                            <script type='text/javascript' id='woo-variation-swatches-js-extra'>
                                /* <![CDATA[ */
                                var woo_variation_swatches_options = {
                                    "show_variation_label": "1",
                                    "clear_on_reselect": "",
                                    "variation_label_separator": ":",
                                    "is_mobile": "",
                                    "show_variation_stock": "",
                                    "stock_label_threshold": "5",
                                    "cart_redirect_after_add": "no",
                                    "enable_ajax_add_to_cart": "yes",
                                    "cart_url": "https:\/\/ttpglobal.com.vn\/cart-2\/",
                                    "is_cart": ""
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/woo-variation-swatches/assets/js/frontend.min.js?ver=1721201711'
                                id='woo-variation-swatches-js' defer></script>
                            <script type="rocketlazyloadscript" id="rocket-browser-checker-js-after"
                                data-rocket-type="text/javascript">
"use strict";var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}return function(Constructor,protoProps,staticProps){return protoProps&&defineProperties(Constructor.prototype,protoProps),staticProps&&defineProperties(Constructor,staticProps),Constructor}}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}var RocketBrowserCompatibilityChecker=function(){function RocketBrowserCompatibilityChecker(options){_classCallCheck(this,RocketBrowserCompatibilityChecker),this.passiveSupported=!1,this._checkPassiveOption(this),this.options=!!this.passiveSupported&&options}return _createClass(RocketBrowserCompatibilityChecker,[{key:"_checkPassiveOption",value:function(self){try{var options={get passive(){return!(self.passiveSupported=!0)}};window.addEventListener("test",null,options),window.removeEventListener("test",null,options)}catch(err){self.passiveSupported=!1}}},{key:"initRequestIdleCallback",value:function(){!1 in window&&(window.requestIdleCallback=function(cb){var start=Date.now();return setTimeout(function(){cb({didTimeout:!1,timeRemaining:function(){return Math.max(0,50-(Date.now()-start))}})},1)}),!1 in window&&(window.cancelIdleCallback=function(id){return clearTimeout(id)})}},{key:"isDataSaverModeOn",value:function(){return"connection"in navigator&&!0===navigator.connection.saveData}},{key:"supportsLinkPrefetch",value:function(){var elem=document.createElement("link");return elem.relList&&elem.relList.supports&&elem.relList.supports("prefetch")&&window.IntersectionObserver&&"isIntersecting"in IntersectionObserverEntry.prototype}},{key:"isSlowConnection",value:function(){return"connection"in navigator&&"effectiveType"in navigator.connection&&("2g"===navigator.connection.effectiveType||"slow-2g"===navigator.connection.effectiveType)}}]),RocketBrowserCompatibilityChecker}();
</script>
                            <script type='text/javascript' id='rocket-preload-links-js-extra'>
                                /* <![CDATA[ */
                                var RocketPreloadLinksConfig = {
                                    "excludeUris": "\/(?:.+\/)?feed(?:\/(?:.+\/?)?)?$|\/(?:.+\/)?embed\/|\/checkout\/|\/cart-2\/|\/my-account\/|\/wc-api\/v(.*)|\/(index\\.php\/)?wp\\-json(\/.*|$)|\/wp-admin\/|\/logout\/|\/wp-login.php|\/refer\/|\/go\/|\/recommend\/|\/recommends\/",
                                    "usesTrailingSlash": "1",
                                    "imageExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php",
                                    "fileExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php|html|htm",
                                    "siteUrl": "https:\/\/ttpglobal.com.vn",
                                    "onHoverDelay": "100",
                                    "rateThrottle": "3"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" id="rocket-preload-links-js-after"
                                data-rocket-type="text/javascript">
(function() {
"use strict";var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e=function(){function i(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}}();function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=function(){function n(e,t){i(this,n),this.browser=e,this.config=t,this.options=this.browser.options,this.prefetched=new Set,this.eventTime=null,this.threshold=1111,this.numOnHover=0}return e(n,[{key:"init",value:function(){!this.browser.supportsLinkPrefetch()||this.browser.isDataSaverModeOn()||this.browser.isSlowConnection()||(this.regex={excludeUris:RegExp(this.config.excludeUris,"i"),images:RegExp(".("+this.config.imageExt+")$","i"),fileExt:RegExp(".("+this.config.fileExt+")$","i")},this._initListeners(this))}},{key:"_initListeners",value:function(e){-1<this.config.onHoverDelay&&document.addEventListener("mouseover",e.listener.bind(e),e.listenerOptions),document.addEventListener("mousedown",e.listener.bind(e),e.listenerOptions),document.addEventListener("touchstart",e.listener.bind(e),e.listenerOptions)}},{key:"listener",value:function(e){var t=e.target.closest("a"),n=this._prepareUrl(t);if(null!==n)switch(e.type){case"mousedown":case"touchstart":this._addPrefetchLink(n);break;case"mouseover":this._earlyPrefetch(t,n,"mouseout")}}},{key:"_earlyPrefetch",value:function(t,e,n){var i=this,r=setTimeout(function(){if(r=null,0===i.numOnHover)setTimeout(function(){return i.numOnHover=0},1e3);else if(i.numOnHover>i.config.rateThrottle)return;i.numOnHover++,i._addPrefetchLink(e)},this.config.onHoverDelay);t.addEventListener(n,function e(){t.removeEventListener(n,e,{passive:!0}),null!==r&&(clearTimeout(r),r=null)},{passive:!0})}},{key:"_addPrefetchLink",value:function(i){return this.prefetched.add(i.href),new Promise(function(e,t){var n=document.createElement("link");n.rel="prefetch",n.href=i.href,n.onload=e,n.onerror=t,document.head.appendChild(n)}).catch(function(){})}},{key:"_prepareUrl",value:function(e){if(null===e||"object"!==(void 0===e?"undefined":r(e))||!1 in e||-1===["http:","https:"].indexOf(e.protocol))return null;var t=e.href.substring(0,this.config.siteUrl.length),n=this._getPathname(e.href,t),i={original:e.href,protocol:e.protocol,origin:t,pathname:n,href:t+n};return this._isLinkOk(i)?i:null}},{key:"_getPathname",value:function(e,t){var n=t?e.substring(this.config.siteUrl.length):e;return n.startsWith("/")||(n="/"+n),this._shouldAddTrailingSlash(n)?n+"/":n}},{key:"_shouldAddTrailingSlash",value:function(e){return this.config.usesTrailingSlash&&!e.endsWith("/")&&!this.regex.fileExt.test(e)}},{key:"_isLinkOk",value:function(e){return null!==e&&"object"===(void 0===e?"undefined":r(e))&&(!this.prefetched.has(e.href)&&e.origin===this.config.siteUrl&&-1===e.href.indexOf("?")&&-1===e.href.indexOf("#")&&!this.regex.excludeUris.test(e.href)&&!this.regex.images.test(e.href))}}],[{key:"run",value:function(){"undefined"!=typeof RocketPreloadLinksConfig&&new n(new RocketBrowserCompatibilityChecker({capture:!0,passive:!0}),RocketPreloadLinksConfig).init()}}]),n}();t.run();
}());
</script>
                            <script type='text/javascript' id='wpcbn-frontend-js-extra'>
                                /* <![CDATA[ */
                                var wpcbn_vars = {
                                    "nonce": "3fb069b97b",
                                    "ajax_url": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "instant_checkout": "",
                                    "perfect_scrollbar": "1",
                                    "wc_checkout_js": "https:\/\/ttpglobal.com.vn\/wp-content\/plugins\/woocommerce\/assets\/js\/frontend\/checkout.js"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
                                src='/assets/wp-content/cache/min/1/wp-content/plugins/wpc-buy-now-button/assets/js/frontend.js?ver=1739757361'
                                id='wpcbn-frontend-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/hoverIntent.min.js?ver=1.10.2'
                                id='hoverIntent-js' defer></script>
                            <script type='text/javascript' id='flatsome-js-js-extra'>
                                /* <![CDATA[ */
                                var flatsomeVars = {
                                    "theme": {
                                        "version": "3.15.3"
                                    },
                                    "ajaxurl": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "rtl": "",
                                    "sticky_height": "80",
                                    "assets_url": "https:\/\/ttpglobal.com.vn\/wp-content\/themes\/flatsome\/assets\/js\/",
                                    "lightbox": {
                                        "close_markup": "<button title=\"%title%\" type=\"button\" class=\"mfp-close\"><svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" width=\"28\" height=\"28\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-x\"><line x1=\"18\" y1=\"6\" x2=\"6\" y2=\"18\"><\/line><line x1=\"6\" y1=\"6\" x2=\"18\" y2=\"18\"><\/line><\/svg><\/button>",
                                        "close_btn_inside": false
                                    },
                                    "user": {
                                        "can_edit_pages": false
                                    },
                                    "i18n": {
                                        "mainMenu": "Main Menu"
                                    },
                                    "options": {
                                        "cookie_notice_version": "1",
                                        "swatches_layout": false,
                                        "swatches_box_select_event": false,
                                        "swatches_box_behavior_selected": false,
                                        "swatches_box_update_urls": "1",
                                        "swatches_box_reset": false,
                                        "swatches_box_reset_extent": false,
                                        "swatches_box_reset_time": 300,
                                        "search_result_latency": "0"
                                    },
                                    "is_mini_cart_reveal": "1"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
                                src='/assets/wp-content/cache/min/1/wp-content/themes/flatsome/assets/js/flatsome.js?ver=1739757361'
                                id='flatsome-js-js' defer></script>
                            <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
                                src='/assets/wp-content/cache/min/1/wp-content/themes/flatsome/inc/integrations/wp-rocket/flatsome-wp-rocket.js?ver=1739757361'
                                id='flatsome-wp-rocket-js' defer></script>
                            <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
                                src='/assets/wp-content/cache/min/1/wp-content/themes/flatsome/inc/extensions/flatsome-live-search/flatsome-live-search.js?ver=1739757361'
                                id='flatsome-live-search-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=6.2.0'
                                id='wpb_composer_front_js-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/inputmask/jquery.inputmask.bundle.min.js?ver=4.0.0-beta.58'
                                id='inputmask-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/jquery-validate/jquery.validate.min.js?ver=1.19.2'
                                id='jquery-validate-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/intlTelInput/jquery.intlTelInput.min.js?ver=16.0.7'
                                id='jquery-intl-tel-input-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/selectWoo/selectWoo.full.min.js?ver=1.0.8'
                                id='selectWoo-js' defer></script>
                            <script type='text/javascript' id='everest-forms-js-extra'>
                                /* <![CDATA[ */
                                var everest_forms_params = {
                                    "ajax_url": "\/wp-admin\/admin-ajax.php",
                                    "submit": "Submit",
                                    "disable_user_details": "no",
                                    "everest_forms_data_save": "eded99bb8a",
                                    "everest_forms_slot_booking": "530e603d95",
                                    "i18n_messages_required": "This field is required.",
                                    "i18n_messages_url": "Please enter a valid URL.",
                                    "i18n_messages_email": "Please enter a valid email address.",
                                    "i18n_messages_email_suggestion": "Did you mean {suggestion}?",
                                    "i18n_messages_email_suggestion_title": "Click to accept this suggestion.",
                                    "i18n_messages_confirm": "Field values do not match.",
                                    "i18n_messages_check_limit": "You have exceeded number of allowed selections: {#}.",
                                    "i18n_messages_number": "Please enter a valid number.",
                                    "i18n_no_matches": "No matches found",
                                    "mailcheck_enabled": "1",
                                    "mailcheck_domains": [],
                                    "mailcheck_toplevel_domains": ["dev"],
                                    "il8n_min_word_length_err_msg": "Please enter at least {0} words.",
                                    "il8n_min_character_length_err_msg": "Please enter at least {0} characters.",
                                    "plugin_url": "https:\/\/ttpglobal.com.vn\/wp-content\/plugins\/everest-forms\/",
                                    "i18n_messages_phone": "Please enter a valid phone number.",
                                    "i18n_field_rating_greater_than_max_value_error": "Please enter in a value less than 100."
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/frontend/everest-forms.min.js?ver=3.0.3.1'
                                id='everest-forms-js' defer></script>
                            <script type='text/javascript' id='everest-forms-survey-polls-quiz-script-js-extra'>
                                /* <![CDATA[ */
                                var everest_forms_survey_polls_quiz_script_params = {
                                    "ajax_url": "\/wp-admin\/admin-ajax.php",
                                    "ajax_nonce": "ce9768fb45",
                                    "form_id": ""
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/frontend/everest-forms-survey-polls-quiz.min.js?ver=3.0.3.1'
                                id='everest-forms-survey-polls-quiz-script-js' defer></script>
                            <script type='text/javascript' id='everest-forms-text-limit-js-extra'>
                                /* <![CDATA[ */
                                var everest_forms_text_limit_params = {
                                    "i18n_messages_limit_characters": "{count} of {limit} max characters.",
                                    "i18n_messages_limit_words": "{count} of {limit} max words."
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/frontend/text-limit.min.js?ver=3.0.3.1'
                                id='everest-forms-text-limit-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/dropzone/dropzone.min.js?ver=5.5.0'
                                id='dropzone-js' defer></script>
                            <script type='text/javascript' id='everest-forms-file-upload-js-extra'>
                                /* <![CDATA[ */
                                var everest_forms_upload_parms = {
                                    "url": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "errors": {
                                        "file_not_uploaded": "This file was not uploaded.",
                                        "file_limit": "File limit has been reached ({fileLimit}).",
                                        "file_extension": false,
                                        "file_size": "File exceeds max size allowed.",
                                        "post_max_size": "File exceeds the upload limit allowed (256 MB)."
                                    },
                                    "max_timeout": "30000",
                                    "loading_message": "Do not submit the form until the upload process is finished"
                                };
                                var everest_forms_upload_parms = {
                                    "url": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "errors": {
                                        "file_not_uploaded": "This file was not uploaded.",
                                        "file_limit": "File limit has been reached ({fileLimit}).",
                                        "file_extension": false,
                                        "file_size": "File exceeds max size allowed.",
                                        "post_max_size": "File exceeds the upload limit allowed (256 MB)."
                                    },
                                    "max_timeout": "30000",
                                    "loading_message": "Do not submit the form until the upload process is finished"
                                };
                                var everest_forms_upload_parms = {
                                    "url": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "errors": {
                                        "file_not_uploaded": "This file was not uploaded.",
                                        "file_limit": "File limit has been reached ({fileLimit}).",
                                        "file_extension": false,
                                        "file_size": "File exceeds max size allowed.",
                                        "post_max_size": "File exceeds the upload limit allowed (256 MB)."
                                    },
                                    "max_timeout": "30000",
                                    "loading_message": "Do not submit the form until the upload process is finished"
                                };
                                var everest_forms_upload_parms = {
                                    "url": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "errors": {
                                        "file_not_uploaded": "This file was not uploaded.",
                                        "file_limit": "File limit has been reached ({fileLimit}).",
                                        "file_extension": false,
                                        "file_size": "File exceeds max size allowed.",
                                        "post_max_size": "File exceeds the upload limit allowed (256 MB)."
                                    },
                                    "max_timeout": "30000",
                                    "loading_message": "Do not submit the form until the upload process is finished"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/frontend/everest-forms-file-upload.min.js?ver=3.0.3.1'
                                id='everest-forms-file-upload-js' defer></script>
                            <script type='text/javascript' id='everest-forms-ajax-submission-js-extra'>
                                /* <![CDATA[ */
                                var everest_forms_ajax_submission_params = {
                                    "ajax_url": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "evf_ajax_submission": "c6c92bff7e",
                                    "submit": "Submit",
                                    "error": "Something went wrong while making an AJAX submission",
                                    "required": "This field is required.",
                                    "pdf_download": "Click here to download your pdf submission"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/everest-forms/assets/js/frontend/ajax-submission.min.js?ver=3.0.3.1'
                                id='everest-forms-ajax-submission-js' defer></script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-includes/js/jquery/ui/core.min.js?ver=1.13.2'
                                id='jquery-ui-core-js' defer></script>
                            <script type='text/javascript' id='popup-maker-site-js-extra'>
                                /* <![CDATA[ */
                                var pum_vars = {
                                    "version": "1.16.4",
                                    "pm_dir_url": "https:\/\/ttpglobal.com.vn\/wp-content\/plugins\/popup-maker\/",
                                    "ajaxurl": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "restapi": "https:\/\/ttpglobal.com.vn\/wp-json\/pum\/v1",
                                    "rest_nonce": null,
                                    "default_theme": "2686",
                                    "debug_mode": "",
                                    "disable_tracking": "",
                                    "home_url": "\/",
                                    "message_position": "top",
                                    "core_sub_forms_enabled": "1",
                                    "popups": [],
                                    "analytics_route": "analytics",
                                    "analytics_api": "https:\/\/ttpglobal.com.vn\/wp-json\/pum\/v1"
                                };
                                var pum_sub_vars = {
                                    "ajaxurl": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "message_position": "top"
                                };
                                var pum_popups = {
                                    "pum-5185": {
                                        "triggers": [{
                                            "type": "auto_open",
                                            "settings": {
                                                "cookie_name": ["pum-5185"],
                                                "delay": "5000"
                                            }
                                        }],
                                        "cookies": [{
                                            "event": "on_popup_close",
                                            "settings": {
                                                "name": "pum-5185",
                                                "key": "",
                                                "session": false,
                                                "path": "1",
                                                "time": "1 month"
                                            }
                                        }],
                                        "disable_on_mobile": false,
                                        "disable_on_tablet": false,
                                        "atc_promotion": null,
                                        "explain": null,
                                        "type_section": null,
                                        "theme_id": "5162",
                                        "size": "medium",
                                        "responsive_min_width": "0%",
                                        "responsive_max_width": "100%",
                                        "custom_width": "640px",
                                        "custom_height_auto": false,
                                        "custom_height": "380px",
                                        "scrollable_content": false,
                                        "animation_type": "fade",
                                        "animation_speed": "350",
                                        "animation_origin": "center top",
                                        "open_sound": "none",
                                        "custom_sound": "",
                                        "location": "center",
                                        "position_top": "100",
                                        "position_bottom": "0",
                                        "position_left": "0",
                                        "position_right": "0",
                                        "position_from_trigger": false,
                                        "position_fixed": false,
                                        "overlay_disabled": false,
                                        "stackable": false,
                                        "disable_reposition": false,
                                        "zindex": "1999999999",
                                        "close_button_delay": "0",
                                        "fi_promotion": null,
                                        "close_on_form_submission": true,
                                        "close_on_form_submission_delay": "0",
                                        "close_on_overlay_click": false,
                                        "close_on_esc_press": false,
                                        "close_on_f4_press": false,
                                        "disable_form_reopen": false,
                                        "disable_accessibility": false,
                                        "theme_slug": "ngtangnangsuat",
                                        "id": 5185,
                                        "slug": "dang-ki-tu-van"
                                    },
                                    "pum-2696": {
                                        "triggers": [],
                                        "cookies": [],
                                        "disable_on_mobile": false,
                                        "disable_on_tablet": false,
                                        "atc_promotion": null,
                                        "explain": null,
                                        "type_section": null,
                                        "theme_id": "2698",
                                        "size": "medium",
                                        "responsive_min_width": "0%",
                                        "responsive_max_width": "100%",
                                        "custom_width": "640px",
                                        "custom_height_auto": false,
                                        "custom_height": "380px",
                                        "scrollable_content": false,
                                        "animation_type": "fade",
                                        "animation_speed": "350",
                                        "animation_origin": "center top",
                                        "open_sound": "none",
                                        "custom_sound": "",
                                        "location": "center",
                                        "position_top": "100",
                                        "position_bottom": "0",
                                        "position_left": "0",
                                        "position_right": "0",
                                        "position_from_trigger": false,
                                        "position_fixed": false,
                                        "overlay_disabled": false,
                                        "stackable": false,
                                        "disable_reposition": false,
                                        "zindex": "1999999999",
                                        "close_button_delay": "0",
                                        "fi_promotion": null,
                                        "close_on_form_submission": false,
                                        "close_on_form_submission_delay": "0",
                                        "close_on_overlay_click": false,
                                        "close_on_esc_press": false,
                                        "close_on_f4_press": false,
                                        "disable_form_reopen": false,
                                        "disable_accessibility": false,
                                        "theme_slug": "ng",
                                        "id": 2696,
                                        "slug": "dang-ky-mua-hang"
                                    }
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/popup-maker/assets/js/site.min.js?defer&#038;ver=1.16.4'
                                id='popup-maker-site-js' defer></script>
                            <script type='text/javascript' id='fixedtoc-js-js-extra'>
                                /* <![CDATA[ */
                                var fixedtocOption = {
                                    "showAdminbar": "",
                                    "inOutEffect": "zoom",
                                    "isNestedList": "1",
                                    "isColExpList": "1",
                                    "showColExpIcon": "1",
                                    "isAccordionList": "",
                                    "isQuickMin": "1",
                                    "isEscMin": "1",
                                    "isEnterMax": "1",
                                    "fixedMenu": "",
                                    "scrollOffset": "160",
                                    "fixedOffsetX": "100",
                                    "fixedOffsetY": "0",
                                    "fixedPosition": "middle-right",
                                    "contentsFixedHeight": "250",
                                    "inPost": "1",
                                    "contentsFloatInPost": "none",
                                    "contentsWidthInPost": "250",
                                    "contentsHeightInPost": "0",
                                    "contentsColexpInitMobile": "1",
                                    "inWidget": "",
                                    "fixedWidget": "",
                                    "triggerBorder": "medium",
                                    "contentsBorder": "medium",
                                    "triggerSize": "50",
                                    "isClickableHeader": "",
                                    "debug": "0",
                                    "postContentSelector": "#ftwp-postcontent",
                                    "mobileMaxWidth": "768",
                                    "disappearPoint": "content-bottom",
                                    "contentsColexpInit": ""
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/fixed-toc/frontend/assets/js/ftoc.min.js?ver=3.1.24'
                                id='fixedtoc-js-js' defer></script>
                            <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
                                src='/assets/wp-content/cache/min/1/wp-content/themes/flatsome/assets/js/woocommerce.js?ver=1739757361'
                                id='flatsome-theme-woocommerce-js-js' defer></script>
                            <!--[if IE]>
<script type='text/javascript'
    src='https://cdn.jsdelivr.net/npm/intersection-observer-polyfill@0.1.0/dist/IntersectionObserver.js?ver=0.1.0'
    id='intersection-observer-polyfill-js'></script>
<![endif]-->
                            <script type='text/javascript' id='intl-tel-input-js-js-extra'>
                                /* <![CDATA[ */
                                var mystickyelement_obj = {
                                    "plugin_url": "https:\/\/ttpglobal.com.vn\/wp-content\/plugins\/mystickyelements-pro\/"
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
                                src='/assets/wp-content/cache/min/1/wp-content/plugins/mystickyelements-pro/intl-tel-input-src/build/js/intlTelInput.js?ver=1739757361'
                                id='intl-tel-input-js-js' defer></script>
                            <script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
                                src='/assets/wp-content/cache/min/1/wp-content/plugins/mystickyelements-pro/js/jquery.cookie.js?ver=1739757361'
                                id='mystickyelements-cookie-js-js' defer></script>
                            <script type='text/javascript' id='mystickyelements-fronted-js-js-extra'>
                                /* <![CDATA[ */
                                var mystickyelements = {
                                    "ajaxurl": "https:\/\/ttpglobal.com.vn\/wp-admin\/admin-ajax.php",
                                    "ajax_nonce": "7ace138d1c",
                                    "google_analytics": ""
                                };
                                /* ]]> */
                            </script>
                            <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
                                src='/assets/wp-content/plugins/mystickyelements-pro/js/mystickyelements-fronted.min.js?ver=2.0.7'
                                id='mystickyelements-fronted-js-js' defer></script>
                            <script type="rocketlazyloadscript" id="gt_widget_script_39969443-js-before"
                                data-rocket-type="text/javascript">
window.gtranslateSettings = /* document.write */ window.gtranslateSettings || {};window.gtranslateSettings['39969443'] = {"default_language":"vi","languages":["km","lo","vi"],"dropdown_languages":["km","lo","vi"],"url_structure":"none","add_new_line":1,"flag_style":"3d","flag_size":16,"wrapper_selector":"li.menu-item-gtranslate.gt-menu-22451","alt_flags":[],"horizontal_position":"inline","flags_location":"\/wp-content\/plugins\/gtranslate\/flags\/"};
</script>
                            <script type="rocketlazyloadscript"
                                src="/assets/wp-content/plugins/gtranslate/js/fd.js?ver=6.3" data-no-optimize="1"
                                data-no-minify="1" data-gt-orig-url="/phan-bon-huu-co/humic-hoa-ky-humik-wsp-95-1kg/"
                                data-gt-orig-domain="ttpglobal.com.vn" data-gt-widget-id="39969443" defer></script>
                            <input type="hidden" class="mystickyelement-country-list-hidden" value="" />
                            <div class="mystickyelements-fixed mystickyelements-fixed-widget-0 mystickyelements-position-screen-center mystickyelements-position-mobile-bottom mystickyelements-on-click mystickyelements-size-medium mystickyelements-mobile-size-large mystickyelements-position-right mystickyelements-templates-default mystickyelements-entry-effect-slide-in"
                                data-custom-position="" data-custom-position-mobile="" data-mystickyelement-widget="0"
                                data-widget-time-delay="0" id="mystickyelement-widget-0" data-istimedelay="0">

                            </div>
                            <style>
                                form#stickyelements-form input::-moz-placeholder {
                                    color: #4F4F4F;
                                }

                                form#stickyelements-form input::-ms-input-placeholder {
                                    color: #4F4F4F
                                }

                                form#stickyelements-form input::-webkit-input-placeholder {
                                    color: #4F4F4F
                                }

                                form#stickyelements-form input::placeholder {
                                    color: #4F4F4F
                                }

                                form#stickyelements-form textarea::placeholder {
                                    color: #4F4F4F
                                }

                                form#stickyelements-form textarea::-moz-placeholder {
                                    color: #4F4F4F
                                }
                            </style>
                            <script>
                                window.lazyLoadOptions = {
                                    elements_selector: "img[data-lazy-src],.rocket-lazyload,iframe[data-lazy-src]",
                                    data_src: "lazy-src",
                                    data_srcset: "lazy-srcset",
                                    data_sizes: "lazy-sizes",
                                    class_loading: "lazyloading",
                                    class_loaded: "lazyloaded",
                                    threshold: 300,
                                    callback_loaded: function (element) {
                                        if (element.tagName === "IFRAME" && element.dataset.rocketLazyload == "fitvidscompatible") {
                                            if (element.classList.contains("lazyloaded")) {
                                                if (typeof window.jQuery != "undefined") {
                                                    if (jQuery.fn.fitVids) {
                                                        jQuery(element).parent().fitVids()
                                                    }
                                                }
                                            }
                                        }
                                    }
                                };
                                window.addEventListener('LazyLoad::Initialized', function (e) {
                                    var lazyLoadInstance = e.detail.instance;
                                    if (window.MutationObserver) {
                                        var observer = new MutationObserver(function (mutations) {
                                            var image_count = 0;
                                            var iframe_count = 0;
                                            var rocketlazy_count = 0;
                                            mutations.forEach(function (mutation) {
                                                for (var i = 0; i < mutation.addedNodes.length; i++) {
                                                    if (typeof mutation.addedNodes[i].getElementsByTagName !== 'function') {
                                                        continue
                                                    }
                                                    if (typeof mutation.addedNodes[i].getElementsByClassName !==
                                                        'function') {
                                                        continue
                                                    }
                                                    images = mutation.addedNodes[i].getElementsByTagName('img');
                                                    is_image = mutation.addedNodes[i].tagName == "IMG";
                                                    iframes = mutation.addedNodes[i].getElementsByTagName('iframe');
                                                    is_iframe = mutation.addedNodes[i].tagName == "IFRAME";
                                                    rocket_lazy = mutation.addedNodes[i].getElementsByClassName(
                                                        'rocket-lazyload');
                                                    image_count += images.length;
                                                    iframe_count += iframes.length;
                                                    rocketlazy_count += rocket_lazy.length;
                                                    if (is_image) {
                                                        image_count += 1
                                                    }
                                                    if (is_iframe) {
                                                        iframe_count += 1
                                                    }
                                                }
                                            });
                                            if (image_count > 0 || iframe_count > 0 || rocketlazy_count > 0) {
                                                lazyLoadInstance.update()
                                            }
                                        });
                                        var b = document.getElementsByTagName("body")[0];
                                        var config = {
                                            childList: !0,
                                            subtree: !0
                                        };
                                        observer.observe(b, config)
                                    }
                                }, !1)
                            </script>
                            <script data-no-minify="1" async
                                src="/assets/wp-content/plugins/wp-rocket/assets/js/lazyload/17.5/lazyload.min.js"></script>
                            <style type='text/css'>
                                .product-main .product-info p#pprice {
                                    display: block;
                                    color: white;
                                    text-align: center;
                                    width: 140px;
                                    margin: auto;
                                    margin-bottom: 20px;

                                    background-color: #ee4d2d;
                                    padding: 10px;
                                    border-radius: 10px;
                                }

                                ;

                                form.cart {
                                    display: none !important;
                                    visibility: hidden;
                                    position: absolute;
                                    z-index: -9999;
                                }
                            </style>
                            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T26K6WS" height="0"
                                    width="0" style="display:none;visibility:hidden"></iframe></noscript>
    </body>

</div>
