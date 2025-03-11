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




        <script
            type="rocketlazyloadscript">(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
        <title>Phân Bón Hữu Cơ Cao Cấp - Công Ty TNHH Phân Bón Quốc Tế Rồng Xanh</title>
        <link rel="stylesheet" href="/assets/wp-content/cache/min/1/500c304f3e76b16e1ada912557c9404f.css" media="all"
            data-minify="1" />

        <script type="application/ld+json"
            class="rank-math-schema-pro">{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"https://ttpglobal.com.vn/#organization","name":"C\u00f4ng ty c\u1ed5 ph\u1ea7n \u0111\u00e2u t\u01b0 TTP GLOBAL","url":"https://ttpglobal.com.vn","logo":{"@type":"ImageObject","@id":"https://ttpglobal.com.vn/#logo","url":"/assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg","caption":"C\u00f4ng ty c\u1ed5 ph\u1ea7n \u0111\u00e2u t\u01b0 TTP GLOBAL","inLanguage":"vi","width":"1080","height":"1080"}},{"@type":"WebSite","@id":"https://ttpglobal.com.vn/#website","url":"https://ttpglobal.com.vn","name":"C\u00f4ng ty c\u1ed5 ph\u1ea7n \u0111\u00e2u t\u01b0 TTP GLOBAL","publisher":{"@id":"https://ttpglobal.com.vn/#organization"},"inLanguage":"vi","potentialAction":{"@type":"SearchAction","target":"https://ttpglobal.com.vn/?s={search_term_string}","query-input":"required name=search_term_string"}},{"@type":"ImageObject","@id":"/assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg","url":"/assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg","width":"1080","height":"1080","inLanguage":"vi"},{"@type":"Person","@id":"https://ttpglobal.com.vn/author/nam-lenhigia-vn/","name":"Nam MK","url":"https://ttpglobal.com.vn/author/nam-lenhigia-vn/","image":{"@type":"ImageObject","@id":"https://secure.gravatar.com/avatar/b1562ce95013b30bc86e4b84f4a9466d?s=96&amp;d=mm&amp;r=g","url":"https://secure.gravatar.com/avatar/b1562ce95013b30bc86e4b84f4a9466d?s=96&amp;d=mm&amp;r=g","caption":"Nam MK","inLanguage":"vi"},"worksFor":{"@id":"https://ttpglobal.com.vn/#organization"}},{"@type":"WebPage","@id":"https://ttpglobal.com.vn/#webpage","url":"https://ttpglobal.com.vn/","name":"Ph\u00e2n B\u00f3n H\u1eefu C\u01a1 Cao C\u1ea5p - Nh\u1eadp Kh\u1ea9u T\u1eeb M\u1ef9 | TTP Global","datePublished":"2023-05-26T08:21:46+07:00","dateModified":"2025-03-01T14:16:44+07:00","author":{"@id":"https://ttpglobal.com.vn/author/nam-lenhigia-vn/"},"isPartOf":{"@id":"https://ttpglobal.com.vn/#website"},"primaryImageOfPage":{"@id":"/assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg"},"inLanguage":"vi"},{"headline":"Ph\u00e2n B\u00f3n H\u1eefu C\u01a1 Cao C\u1ea5p - Nh\u1eadp Kh\u1ea9u T\u1eeb M\u1ef9 | TTP Global","description":"Ph\u00e2n b\u00f3n h\u1eefu c\u01a1 cao c\u1ea5p \u0111\u01b0\u1ee3c nh\u1eadp kh\u1ea9u tr\u1ef1c ti\u1ebfp t\u1eeb M\u1ef9 c\u00f3 h\u00e0m l\u01b0\u1ee3ng humic v\u00e0 fulvic cao gi\u00fap c\u1ea3i t\u1ea1o \u0111\u1ea5t, k\u00edch r\u1ec5 v\u00e0 t\u0103ng n\u0103ng su\u1ea5t c\u00e2y tr\u1ed3ng.","datePublished":"2023-05-26+0708:21:46+07:00","dateModified":"2025-03-01+0714:16:44+07:00","author":{"@id":"https://ttpglobal.com.vn/author/nam-lenhigia-vn/"},"@type":"NewsArticle","name":"Ph\u00e2n B\u00f3n H\u1eefu C\u01a1 Cao C\u1ea5p - Nh\u1eadp Kh\u1ea9u T\u1eeb M\u1ef9 | TTP Global","@id":"https://ttpglobal.com.vn/#schema-6199","isPartOf":{"@id":"https://ttpglobal.com.vn/#webpage"},"publisher":{"@id":"https://ttpglobal.com.vn/#organization"},"image":{"@id":"/assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg"},"inLanguage":"vi","mainEntityOfPage":{"@id":"https://ttpglobal.com.vn/#webpage"}},{"@type":"VideoObject","name":"\ud83d\udce2 PH\u00c2N B\u00d3N H\u1eeeU C\u01a0 HUMI[K] HOA K\u1ef2 NGUY\u00caN G\u1ed0C 100% \ud83c\udf3f\ud83c\udf3f","description":"Th\u1ea5u hi\u1ec3u nhu c\u1ea7u s\u1eed d\u1ee5ng ph\u00e2n h\u1eefu c\u01a1 ch\u1ea5t l\u01b0\u1ee3ng cao c\u1ee7a Qu\u00fd kh\u00e1ch h\u00e0ng/Qu\u00fd b\u00e0 con n\u00f4ng d\u00e2n, c\u00f4ng ty TTP GLOBAL \u0111\u00e3 - \u0111ang nh\u1eadp kh\u1ea9u v\u00e0 ph\u00e2n ph\u1ed1i nguy\u00ean g\u1ed1c c...","uploadDate":"2023-05-12","thumbnailUrl":"/assets/wp-content/uploads/2023/06/maxresdefault.jpg","embedUrl":"https://www.youtube.com/embed/0scHElan0hk","duration":"PT2M36S","width":"1280","height":"720","isFamilyFriendly":"True","@id":"https://ttpglobal.com.vn/#schema-6200","isPartOf":{"@id":"https://ttpglobal.com.vn/#webpage"},"publisher":{"@id":"https://ttpglobal.com.vn/#organization"},"inLanguage":"vi"},{"@type":"VideoObject","name":"\ud83d\udce2 PH\u00c2N B\u00d3N H\u1eeeU C\u01a0 HUMI[K] HOA K\u1ef2 NGUY\u00caN G\u1ed0C 100% \ud83c\udf3f\ud83c\udf3f","description":"Th\u1ea5u hi\u1ec3u nhu c\u1ea7u s\u1eed d\u1ee5ng ph\u00e2n h\u1eefu c\u01a1 ch\u1ea5t l\u01b0\u1ee3ng cao c\u1ee7a Qu\u00fd kh\u00e1ch h\u00e0ng/Qu\u00fd b\u00e0 con n\u00f4ng d\u00e2n, c\u00f4ng ty TTP GLOBAL \u0111\u00e3 - \u0111ang nh\u1eadp kh\u1ea9u v\u00e0 ph\u00e2n ph\u1ed1i nguy\u00ean g\u1ed1c c...","uploadDate":"2023-11-27T19:56:56-08:00","thumbnailUrl":"/assets/wp-content/uploads/2024/07/maxresdefault.jpg","embedUrl":"https://www.youtube.com/embed/80j86G5tU9U","duration":"PT2M32S","width":"1280","height":"720","isFamilyFriendly":"True","@id":"https://ttpglobal.com.vn/#schema-17653","isPartOf":{"@id":"https://ttpglobal.com.vn/#webpage"},"publisher":{"@id":"https://ttpglobal.com.vn/#organization"},"inLanguage":"vi","mainEntityOfPage":{"@id":"https://ttpglobal.com.vn/#webpage"}}]}</script>
        <!-- /Rank Math WordPress SEO plugin -->

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
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/jquery/jquery.min.js?ver=3.7.0' id='jquery-core-js' defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1' id='jquery-migrate-js' defer></script>
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
        class="home page-template page-template-page-blank page-template-page-blank-php page page-id-2753 wp-custom-logo theme-flatsome everest-forms-no-js woocommerce-no-js woo-variation-swatches wvs-behavior-blur wvs-theme-flatsome wvs-show-label wvs-tooltip full-width lightbox nav-dropdown-has-arrow mobile-submenu-toggle wpb-js-composer js-comp-ver-6.2.0 vc_responsive">

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5LT9KC48" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>

        <div id="wrapper">




            <main id="main" class="">


                <div id="content" role="main" class="content-area">



                    <section class="section" id="section_164794011">
                        <div class="bg section-bg fill bg-fill  bg-loaded">




                            <div class="is-border" style="border-width:0 0px 0px 0px;margin:0 0px 0px 0px;">
                            </div>

                        </div>



                        <div class="section-content relative">


                            <div class="row row-full-width" id="row-103177237">


                                <div id="col-9734193" class="col classcolbanner small-12 large-12">
                                    <div class="col-inner">

                                        <div class="is-border" style="border-width:0 0px 0px 0px;margin:0 0px 0px 0px;">
                                        </div>




                                        <div id="metaslider-id-9062" style="width: 100%;"
                                            class="ml-slider-3-92-1 metaslider metaslider-flex metaslider-9062 ml-slider ms-theme-default"
                                            role="region" aria-roledescription="Slideshow" aria-label="New Slideshow">
                                            <div id="metaslider_container_9062">
                                                <div id="metaslider_9062">
                                                    <ul class='slides'>
                                                        <li style="display: block; width: 100%;"
                                                            class="slide-9434 ms-image " aria-roledescription="slide"
                                                            aria-label="slide-9434"><a href="/products" target="_self"
                                                                class="metaslider_image_link"><img style="
                                                            max-height: 700px; object-fit: fill;
                                                        " width="1920" height="610"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201920%20610'%3E%3C/svg%3E"
                                                                    class="slider-9062 slide-9434"
                                                                    alt="1920X610 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                    decoding="async" rel=""
                                                                    title="chuong-trinh-cham-soc-lua-dau-mua"
                                                                    fetchpriority="high"
                                                                    data-lazy-sizes="(max-width: 1920px) 100vw, 1920px"
                                                                    width="1920" height="610"
                                                                    src="/assets/wp-content/uploads/2025/03/1920X610.jpg"
                                                                    class="slider-9062 slide-9434"
                                                                    alt="1920X610 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                    decoding="async" rel=""
                                                                    title="chuong-trinh-cham-soc-lua-dau-mua"
                                                                    fetchpriority="high"
                                                                    srcset="  /assets/z6392182784286_d34206c2d3a0d56b396160be9ea0b279.jpg"
                                                                    sizes="(max-width: 1920px) 100vw, 1920px"></noscript></a>
                                                        </li>
                                                        <li style="display: none; width: 100%;"
                                                            class="slide-9064 ms-image " aria-roledescription="slide"
                                                            aria-label="slide-9064"><a
                                                                href="/products"
                                                                target="_blank" class="metaslider_image_link"
                                                                rel="noopener"><img style="
                                                            max-height: 700px; object-fit: fill;
                                                        " width="1920" height="610" class="slider-9062 slide-9064"
                                                                    alt="chuong trinh huu co cho nong san viet"
                                                                    decoding="async" rel=""
                                                                    title="chuong trinh huu co cho nong san viet"
                                                                    data-lazy-sizes="(max-width: 1920px) 100vw, 1920px"
                                                                    width="1920" height="610"
                                                                    class="slider-9062 slide-9064"
                                                                    alt="chuong trinh huu co cho nong san viet"
                                                                    decoding="async" rel=""
                                                                    title="chuong trinh huu co cho nong san viet"
                                                                    src="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"
                                                                    sizes="(max-width: 1920px) 100vw, 1920px"></noscript></a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                    <style>
                                        #col-9734193>.col-inner {
                                            padding: 0 0px 0px 0px;
                                        }
                                    </style>
                                </div>



                            </div>

                        </div>


                        <style>
                            #section_164794011 {
                                padding-top: 0px;
                                padding-bottom: 0px;
                            }

                            #section_164794011 .ux-shape-divider--top svg {
                                height: 150px;
                                --divider-top-width: 100%;
                            }

                            #section_164794011 .ux-shape-divider--bottom svg {
                                height: 150px;
                                --divider-width: 100%;
                            }
                        </style>
                    </section>


                    <section class="section" id="section_20344233">
                        <div class="bg section-bg fill bg-fill  ">


                            <div class="section-bg-overlay absolute fill"></div>


                        </div>



                        <div class="section-content relative">


                            <div class="row row-collapse loi-ich-phan-bon" id="row-1737863260">


                                <div id="col-1868667861" class="col medium-6 small-12 large-6">
                                    <div class="col-inner">



                                        <div class="row" id="row-1230171295">


                                            <div id="col-1900862358" class="col medium-3 small-3 large-3">
                                                <div class="col-inner">



                                                    <div id="text-772686211" class="text">


                                                        <p class="loi"><strong>5</strong></p>

                                                        <style>
                                                            #text-772686211 {
                                                                font-size: 2.85rem;
                                                                text-align: right;
                                                                color: rgb(255, 255, 255);
                                                            }

                                                            #text-772686211>* {
                                                                color: rgb(255, 255, 255);
                                                            }
                                                        </style>
                                                    </div>


                                                </div>
                                            </div>



                                            <div id="col-964970829" class="col medium-9 small-9 large-9">
                                                <div class="col-inner">



                                                    <div id="text-2681046097" class="text">


                                                        <h2 class="loiich">LỢI ÍCH PHÂN BÓN HỮU CƠ CAO CẤP MANG LẠI</h2>

                                                        <style>
                                                            #text-2681046097 {
                                                                color: rgb(255, 255, 255);
                                                            }

                                                            #text-2681046097>* {
                                                                color: rgb(255, 255, 255);
                                                            }
                                                        </style>
                                                    </div>

                                                    <div id="text-606604512" class="text">


                                                        <ul>
                                                            <li>Cải tạo độ phì nhiêu của đất, bổ sung VSV cho đất</li>
                                                            <li>Ra rễ mạnh, phát triển cành nhánh khỏe</li>
                                                            <li>Tăng khả năng hấp thu chất dinh dưỡng</li>
                                                            <li>Tăng năng suất và tăng chất lượng nông sản</li>
                                                            <li>Giảm chi phí phân bón hóa học</li>
                                                        </ul>

                                                        <style>
                                                            #text-606604512 {
                                                                color: rgb(255, 255, 255);
                                                            }

                                                            #text-606604512>* {
                                                                color: rgb(255, 255, 255);
                                                            }
                                                        </style>
                                                    </div>


                                                </div>
                                            </div>



                                        </div>

                                    </div>
                                </div>



                                <div id="col-391043179" class="col hide-for-small medium-6 small-12 large-6">
                                    <div class="col-inner">



                                        <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_598821701">
                                            <div class="img-inner dark">
                                                <img width="626" height="406"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20626%20406'%3E%3C/svg%3E"
                                                    class="attachment-large size-large"
                                                    alt="la cay Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                    decoding="async"
                                                    data-lazy-srcset="/assets/wp-content/uploads/2022/10/la-cay-600x389.png 626w, /assets/wp-content/uploads/2022/10/la-cay-300x195.png 300w, /assets/wp-content/uploads/2022/10/la-cay-600x389.png 600w"
                                                    data-lazy-sizes="(max-width: 626px) 100vw, 626px"
                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                    data-lazy-src="/assets/wp-content/uploads/2022/10/la-cay-600x389.png"><noscript><img
                                                        width="626" height="406"
                                                        src="/assets/wp-content/uploads/2022/10/la-cay-600x389.png"
                                                        class="attachment-large size-large"
                                                        alt="la cay Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                        decoding="async"
                                                        srcset="/assets/wp-content/uploads/2022/10/la-cay-600x389.png 626w, /assets/wp-content/uploads/2022/10/la-cay-300x195.png 300w, /assets/wp-content/uploads/2022/10/la-cay-600x389.png 600w"
                                                        sizes="(max-width: 626px) 100vw, 626px"
                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                            </div>

                                            <style>
                                                #image_598821701 {
                                                    width: 100%;
                                                }
                                            </style>
                                        </div>



                                    </div>
                                </div>



                            </div>

                        </div>


                        <style>
                            #section_20344233 {
                                padding-top: 30px;
                                padding-bottom: 30px;
                                min-height: 300px;
                            }

                            #section_20344233 .section-bg-overlay {
                                background-color: rgba(44, 126, 60, 0.8);
                            }

                            #section_20344233 .section-bg.bg-loaded {
                                background-image: url(/assets/wp-content/uploads/2024/03/anh-banner-cay-lua-2.jpg);
                            }

                            #section_20344233 .ux-shape-divider--top svg {
                                height: 150px;
                                --divider-top-width: 100%;
                            }

                            #section_20344233 .ux-shape-divider--bottom svg {
                                height: 150px;
                                --divider-width: 100%;
                            }

                            @media (min-width:550px) {
                                #section_20344233 {
                                    min-height: 534px;
                                }
                            }
                        </style>
                    </section>

                    <section class="section" id="section_1085737502">
                        <div class="bg section-bg fill bg-fill  bg-loaded">





                        </div>



                        <div class="section-content relative">


                            <div class="row row-collapse align-middle" id="row-2096261220">


                                <div id="col-175735855" class="col small-12 large-12">
                                    <div class="col-inner">



                                        <h3 style="margin-bottom: 0px; font-size: 20px;"><strong>GIỚI</strong> THIỆU
                                        </h3>

                                    </div>

                                    <style>
                                        #col-175735855>.col-inner {
                                            padding: 0 0px 0px 0px;
                                            margin: 0 0px 0px 0px;
                                        }
                                    </style>
                                </div>



                                <div id="col-1773651664" class="col medium-6 small-12 large-6">
                                    <div class="col-inner">



                                        <div id="text-1314885602" class="text">


                                            <h2 style="margin-bottom: 0px; font-size:180%
"><span style="color:#075f33"><strong>PB</strong></span><strong>
                                                    Rồng Xanh</strong></h2>

                                            <style>
                                                #text-1314885602 {
                                                    font-size: 2.3rem;
                                                }

                                                @media (min-width:550px) {
                                                    #text-1314885602 {
                                                        font-size: 2.05rem;
                                                    }
                                                }

                                                @media (min-width:850px) {
                                                    #text-1314885602 {
                                                        font-size: 2.55rem;
                                                    }
                                                }
                                            </style>
                                        </div>


                                    </div>
                                </div>



                                <div id="col-967690785" class="col medium-6 small-12 large-6">
                                    <div class="col-inner">



                                        <div id="text-3519577514" class="text">


                                            <p style="font-size: 14px; margin-bottom: 0px;"><strong>Công ty TNHH Phân
                                                    Bón Quốc Tế
                                                    Rồng Xanh</strong> &#8211; đơn vị phân phối chính thức các sản phẩm
                                                phân bón hữu cơ cao cấp nhập khẩu từ Mỹ tại Việt Nam và khu vực Đông Nam
                                                Á
                                            </p>

                                            <style>
                                                #text-3519577514 {
                                                    font-size: 0.85rem;
                                                }
                                            </style>
                                        </div>


                                    </div>
                                </div>




                                <style>
                                    #row-2096261220>.col>.col-inner {
                                        padding: 0px 20px 0px 20px;
                                    }

                                    @media (min-width:550px) {
                                        #row-2096261220>.col>.col-inner {
                                            padding: 0px 20px 0px 20px;
                                        }
                                    }
                                </style>
                            </div>
                            <div class="row row-collapse" id="row-1879344127">


                                <div id="col-165072601" class="col medium-1 small-1 large-1">
                                    <div class="col-inner">



                                        <div class="is-divider divider clearfix"
                                            style="max-width:100%;height:2px;background-color:rgb(16, 163, 22);"></div>


                                    </div>
                                </div>



                                <div id="col-76230673" class="col medium-11 small-11 large-11">
                                    <div class="col-inner">



                                        <div class="is-divider divider clearfix"
                                            style="max-width:100%;height:2px;background-color:rgb(211, 211, 211);">
                                        </div>


                                    </div>
                                </div>



                            </div>

                        </div>


                        <style>
                            #section_1085737502 {
                                padding-top: 30px;
                                padding-bottom: 30px;
                            }

                            #section_1085737502 .ux-shape-divider--top svg {
                                height: 150px;
                                --divider-top-width: 100%;
                            }

                            #section_1085737502 .ux-shape-divider--bottom svg {
                                height: 150px;
                                --divider-width: 100%;
                            }
                        </style>
                    </section>

                    <div class="row row-large align-bottom gioi-thieu" id="row-2074979404">


                        <div id="col-533297166" class="col medium-6 small-12 large-6">
                            <div class="col-inner">



                                <div class="row row-collapse" id="row-1082941059">


                                    <div id="col-1047149829" class="col medium-1 small-1 large-1">
                                        <div class="col-inner">



                                            <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_1957207914">
                                                <div class="img-inner dark">
                                                    <img width="640" height="480" class="attachment-large size-large"
                                                        alt="daunhay1.svg Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                        decoding="async"
                                                        src="/assets/wp-content/uploads/2023/05/daunhay1.svg-600x450.png"
                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                </div>

                                                <style>
                                                    #image_1957207914 {
                                                        width: 100%;
                                                    }
                                                </style>
                                            </div>



                                        </div>
                                    </div>



                                    <div id="col-380525328" class="col medium-11 small-11 large-11">
                                        <div class="col-inner">



                                            <div id="text-2719140047" class="text">


                                                <p style="text-align: center;"><em>Chúng tôi cam kết mang đến sản phẩm
                                                        hữu
                                                        cơ chất lượng cao, tạo lòng tin tuyệt đối với bà con nông
                                                        dân&#8221;</em></p>

                                                <style>
                                                    #text-2719140047 {
                                                        color: rgb(0, 0, 0);
                                                    }

                                                    #text-2719140047>* {
                                                        color: rgb(0, 0, 0);
                                                    }
                                                </style>
                                            </div>


                                        </div>
                                    </div>



                                </div>
                                <div class="img has-hover hide-for-small x md-x lg-x y md-y lg-y" id="image_375737501">
                                    <div class="img-inner dark" style="margin:0px 0px 0px -80px;">
                                        <img width="531" height="326"
                                            src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20531%20326'%3E%3C/svg%3E"
                                            class="attachment-original size-original"
                                            alt="ban tay Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                            decoding="async"
                                            data-lazy-srcset="/assets/wp-content/uploads/2022/10/ban-tay.png 531w, /assets/wp-content/uploads/2022/10/ban-tay-300x184.png 300w"
                                            data-lazy-sizes="(max-width: 531px) 100vw, 531px"
                                            title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                            data-lazy-src="/assets/wp-content/uploads/2022/10/ban-tay.png"><noscript><img
                                                width="531" height="326"
                                                src="/assets/wp-content/uploads/2022/10/ban-tay.png"
                                                class="attachment-original size-original"
                                                alt="ban tay Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                decoding="async"
                                                srcset="/assets/wp-content/uploads/2022/10/ban-tay.png 531w, /assets/wp-content/uploads/2022/10/ban-tay-300x184.png 300w"
                                                sizes="(max-width: 531px) 100vw, 531px"
                                                title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                    </div>

                                    <style>
                                        #image_375737501 {
                                            width: 100%;
                                        }
                                    </style>
                                </div>



                            </div>
                        </div>



                        <div id="col-1513980308" class="col medium-6 small-12 large-6">
                            <div class="col-inner text-left">



                                {{-- <div class="video video-fit mb" style="padding-top:56.25%;"><iframe loading="lazy"
                                        title="📢 PHÂN BÓN HỮU CƠ HUMI[K] HOA KỲ NGUYÊN GỐC 100% 🌿🌿" width="1020"
                                        height="574" src="about:blank" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                        data-rocket-lazyload="fitvidscompatible"
                                        data-lazy-src="https://www.youtube.com/embed/80j86G5tU9U?feature=oembed"></iframe><noscript><iframe
                                            title="📢 PHÂN BÓN HỮU CƠ HUMI[K] HOA KỲ NGUYÊN GỐC 100% 🌿🌿" width="1020"
                                            height="574" src="https://www.youtube.com/embed/80j86G5tU9U?feature=oembed"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen></iframe></noscript></div> --}}

                                <div class="row" id="row-2140533928">


                                    <div id="col-1467779998" class="col small-12 large-12">
                                        <div class="col-inner">



                                            <div class="row row-collapse align-middle" id="row-630564318">


                                                <div id="col-2114586854" class="col medium-1 small-1 large-1">
                                                    <div class="col-inner text-center">



                                                        <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                            id="image_1019013052">
                                                            <div class="img-inner dark">
                                                                <img width="512" height="512"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20512%20512'%3E%3C/svg%3E"
                                                                    class="attachment-original size-original"
                                                                    alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                    decoding="async"
                                                                    data-lazy-srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                    data-lazy-sizes="(max-width: 512px) 100vw, 512px"
                                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                    data-lazy-src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"><noscript><img
                                                                        width="512" height="512"
                                                                        src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"
                                                                        class="attachment-original size-original"
                                                                        alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                        decoding="async"
                                                                        srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                        sizes="(max-width: 512px) 100vw, 512px"
                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                            </div>

                                                            <style>
                                                                #image_1019013052 {
                                                                    width: 80%;
                                                                }
                                                            </style>
                                                        </div>



                                                    </div>
                                                </div>



                                                <div id="col-299657924" class="col medium-11 small-11 large-11">
                                                    <div class="col-inner">



                                                        <p style="margin-bottom: 0px;">Chất lượng ưu việt</p>

                                                    </div>
                                                </div>



                                            </div>
                                            <div class="row row-collapse align-middle" id="row-1021653251">


                                                <div id="col-403565905" class="col medium-1 small-1 large-1">
                                                    <div class="col-inner text-center">



                                                        <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                            id="image_570605807">
                                                            <div class="img-inner dark">
                                                                <img width="512" height="512"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20512%20512'%3E%3C/svg%3E"
                                                                    class="attachment-original size-original"
                                                                    alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                    decoding="async"
                                                                    data-lazy-srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                    data-lazy-sizes="(max-width: 512px) 100vw, 512px"
                                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                    data-lazy-src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"><noscript><img
                                                                        width="512" height="512"
                                                                        src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"
                                                                        class="attachment-original size-original"
                                                                        alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                        decoding="async"
                                                                        srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                        sizes="(max-width: 512px) 100vw, 512px"
                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                            </div>

                                                            <style>
                                                                #image_570605807 {
                                                                    width: 80%;
                                                                }
                                                            </style>
                                                        </div>



                                                    </div>
                                                </div>



                                                <div id="col-1552165640" class="col medium-11 small-11 large-11">
                                                    <div class="col-inner">



                                                        <p style="margin-bottom: 0px;">Sản phẩm đa dạng</p>

                                                    </div>
                                                </div>



                                            </div>
                                            <div class="row row-collapse align-middle" id="row-1306216841">


                                                <div id="col-1359214789" class="col medium-1 small-1 large-1">
                                                    <div class="col-inner text-center">



                                                        <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                            id="image_476733177">
                                                            <div class="img-inner dark">
                                                                <img width="512" height="512"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20512%20512'%3E%3C/svg%3E"
                                                                    class="attachment-original size-original"
                                                                    alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                    decoding="async"
                                                                    data-lazy-srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                    data-lazy-sizes="(max-width: 512px) 100vw, 512px"
                                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                    data-lazy-src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"><noscript><img
                                                                        width="512" height="512"
                                                                        src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"
                                                                        class="attachment-original size-original"
                                                                        alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                        decoding="async"
                                                                        srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                        sizes="(max-width: 512px) 100vw, 512px"
                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                            </div>

                                                            <style>
                                                                #image_476733177 {
                                                                    width: 80%;
                                                                }
                                                            </style>
                                                        </div>



                                                    </div>
                                                </div>



                                                <div id="col-1304913090" class="col medium-11 small-11 large-11">
                                                    <div class="col-inner">



                                                        <p style="margin-bottom: 0px;">Dịch vụ tận tâm</p>

                                                    </div>
                                                </div>



                                            </div>
                                            <div class="row row-collapse align-middle" id="row-2045792118">


                                                <div id="col-2028480744" class="col medium-1 small-1 large-1">
                                                    <div class="col-inner text-center">



                                                        <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                            id="image_1489525696">
                                                            <div class="img-inner dark">
                                                                <img width="512" height="512"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20512%20512'%3E%3C/svg%3E"
                                                                    class="attachment-original size-original"
                                                                    alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                    decoding="async"
                                                                    data-lazy-srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                    data-lazy-sizes="(max-width: 512px) 100vw, 512px"
                                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                    data-lazy-src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"><noscript><img
                                                                        width="512" height="512"
                                                                        src="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png"
                                                                        class="attachment-original size-original"
                                                                        alt="Tick mark icon png 66191 Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                        decoding="async"
                                                                        srcset="/assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191.png 512w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-300x300.png 300w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-150x150.png 150w, /assets/wp-content/uploads/2023/06/Tick-mark-icon-png-66191-100x100.png 100w"
                                                                        sizes="(max-width: 512px) 100vw, 512px"
                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                            </div>

                                                            <style>
                                                                #image_1489525696 {
                                                                    width: 80%;
                                                                }
                                                            </style>
                                                        </div>



                                                    </div>
                                                </div>



                                                <div id="col-1832941528" class="col medium-11 small-11 large-11">
                                                    <div class="col-inner">



                                                        <p style="margin-bottom: 0px;">Chứng nhận đạt chuẩn</p>

                                                    </div>
                                                </div>



                                            </div>

                                        </div>
                                    </div>



                                </div>

                            </div>
                        </div>



                    </div>
                    <div id="gap-876394222" class="gap-element clearfix hide-for-small"
                        style="display:block; height:auto;">

                        <style>
                            #gap-876394222 {
                                padding-top: 50px;
                            }
                        </style>
                    </div>


                    <div class="row align-middle align-center" id="row-15216740">


                        <div id="col-1249795852" class="col small-12 large-12">
                            <div class="col-inner">



                                <div id="text-2680654009" class="text">


                                    <h2>Chứng Nhận Hữu Cơ</h2>
                                    <p><strong>Phân bón hữu cơ cao cấp</strong>&nbsp;thường đi kèm với chứng nhận hữu cơ
                                        đạt
                                        chuẩn quốc tế như:&nbsp;<strong>OMRI, ECOCERT, CDFA, WSDA,</strong>… đảm bảo
                                        nguồn
                                        gốc và quy trình sản xuất tuân thủ các tiêu chuẩn về bảo vệ môi trường và sức
                                        khỏe
                                        con người.</p>

                                    <style>
                                        #text-2680654009 {
                                            text-align: center;
                                        }

                                        @media (min-width:550px) {
                                            #text-2680654009 {
                                                text-align: center;
                                            }
                                        }
                                    </style>
                                </div>


                            </div>
                        </div>



                        <div id="col-1939666664" class="col medium-3 small-6 large-3">
                            <div class="col-inner">



                                <div class="box has-hover   has-hover box-text-bottom">

                                    <div class="box-image" style="width:60%;">
                                        <div class="">
                                            <img width="250" height="250"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20250%20250'%3E%3C/svg%3E"
                                                class="attachment- size-" alt="Chứng nhận CDFA" decoding="async"
                                                data-lazy-srcset="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png 250w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-150x150.png 150w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-100x100.png 100w"
                                                data-lazy-sizes="(max-width: 250px) 100vw, 250px"
                                                title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                data-lazy-src="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png"><noscript><img
                                                    width="250" height="250"
                                                    src="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png"
                                                    class="attachment- size-" alt="Chứng nhận CDFA" decoding="async"
                                                    srcset="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png 250w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-150x150.png 150w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-100x100.png 100w"
                                                    sizes="(max-width: 250px) 100vw, 250px"
                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                        </div>
                                    </div>

                                    <div class="box-text text-center">
                                        <div class="box-text-inner">


                                            <h4>Chứng nhận CDFA</h4>
                                            <p>của Bộ Thực phẩm và Nông nghiệp California</p>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>



                        <div id="col-929442736" class="col medium-3 small-6 large-3">
                            <div class="col-inner">



                                <div class="box has-hover   has-hover box-text-bottom">

                                    <div class="box-image" style="width:60%;">
                                        <div class="">
                                            <img width="500" height="200"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20500%20200'%3E%3C/svg%3E"
                                                class="attachment- size-" alt="chứng nhận omri" decoding="async"
                                                data-lazy-srcset="/assets/wp-content/uploads/2023/06/omri.png 500w, /assets/wp-content/uploads/2023/06/omri-300x120.png 300w"
                                                data-lazy-sizes="(max-width: 500px) 100vw, 500px"
                                                title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                data-lazy-src="/assets/wp-content/uploads/2023/06/omri.png"><noscript><img
                                                    width="500" height="200"
                                                    src="/assets/wp-content/uploads/2023/06/omri.png"
                                                    class="attachment- size-" alt="chứng nhận omri" decoding="async"
                                                    srcset="/assets/wp-content/uploads/2023/06/omri.png 500w, /assets/wp-content/uploads/2023/06/omri-300x120.png 300w"
                                                    sizes="(max-width: 500px) 100vw, 500px"
                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                        </div>
                                    </div>

                                    <div class="box-text text-center">
                                        <div class="box-text-inner">


                                            <h4>Chứng nhận OMRI</h4>
                                            <p>của Viện đánh giá vật liệu hữu cơ Hoa Kỳ</p>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>



                        <div id="col-1484309390" class="col medium-3 small-6 large-3">
                            <div class="col-inner">



                                <div class="box has-hover   has-hover box-text-bottom">

                                    <div class="box-image" style="width:60%;">
                                        <div class="">
                                            <img width="250" height="250"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20250%20250'%3E%3C/svg%3E"
                                                class="attachment- size-"
                                                alt="WSDALogo Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                decoding="async"
                                                data-lazy-srcset="/assets/wp-content/uploads/2023/06/WSDALogo.png 250w, /assets/wp-content/uploads/2023/06/WSDALogo-150x150.png 150w, /assets/wp-content/uploads/2023/06/WSDALogo-100x100.png 100w"
                                                data-lazy-sizes="(max-width: 250px) 100vw, 250px"
                                                title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                data-lazy-src="/assets/wp-content/uploads/2023/06/WSDALogo.png"><noscript><img
                                                    width="250" height="250"
                                                    src="/assets/wp-content/uploads/2023/06/WSDALogo.png"
                                                    class="attachment- size-"
                                                    alt="WSDALogo Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                    decoding="async"
                                                    srcset="/assets/wp-content/uploads/2023/06/WSDALogo.png 250w, /assets/wp-content/uploads/2023/06/WSDALogo-150x150.png 150w, /assets/wp-content/uploads/2023/06/WSDALogo-100x100.png 100w"
                                                    sizes="(max-width: 250px) 100vw, 250px"
                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                        </div>
                                    </div>

                                    <div class="box-text text-center">
                                        <div class="box-text-inner">


                                            <h4>Chứng nhận WSDA</h4>
                                            <p>sản phẩm phân bón hữu cơ của Washington </p>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>



                        <div id="col-2099021072" class="col medium-3 small-6 large-3">
                            <div class="col-inner">



                                <div class="box has-hover   has-hover box-text-bottom">

                                    <div class="box-image" style="width:60%;">
                                        <div class="">
                                            <img width="816" height="538"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20816%20538'%3E%3C/svg%3E"
                                                class="attachment- size-" alt="Chứng nhận Ecocert" decoding="async"
                                                data-lazy-srcset="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png 816w, /assets/wp-content/uploads/2023/06/Ecocert-300x198.png 300w, /assets/wp-content/uploads/2023/06/Ecocert-768x506.png 768w, /assets/wp-content/uploads/2023/06/Ecocert-600x396.png 600w"
                                                data-lazy-sizes="(max-width: 816px) 100vw, 816px"
                                                title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                data-lazy-src="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png"><noscript><img
                                                    width="816" height="538"
                                                    src="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png"
                                                    class="attachment- size-" alt="Chứng nhận Ecocert" decoding="async"
                                                    srcset="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png 816w, /assets/wp-content/uploads/2023/06/Ecocert-300x198.png 300w, /assets/wp-content/uploads/2023/06/Ecocert-768x506.png 768w, /assets/wp-content/uploads/2023/06/Ecocert-600x396.png 600w"
                                                    sizes="(max-width: 816px) 100vw, 816px"
                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                        </div>
                                    </div>

                                    <div class="box-text text-center">
                                        <div class="box-text-inner">


                                            <h4>Chứng nhận ECOCERT</h4>
                                            <p>chứng nhận hữu cơ của Pháp</p>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>



                    </div>
                    <section class="section" id="section_482535467">
                        <div class="bg section-bg fill bg-fill  bg-loaded">





                        </div>



                        <div class="section-content relative">


                            <div class="row row-large align-middle nhom-san-pham" id="row-1588261898">


                                <div id="col-131282158" class="col medium-5 small-12 large-5">
                                    <div class="col-inner">



                                        <div id="text-2846442130" class="text">


                                            <h2 style="margin-bottom: 0px;">SẢN PHẨM TIÊU BIỂU</h2>

                                            <style>
                                                #text-2846442130 {
                                                    font-size: 1.2rem;
                                                    color: rgb(26, 98, 43);
                                                }

                                                #text-2846442130>* {
                                                    color: rgb(26, 98, 43);
                                                }

                                                @media (min-width:550px) {
                                                    #text-2846442130 {
                                                        font-size: 0.9rem;
                                                    }
                                                }

                                                @media (min-width:850px) {
                                                    #text-2846442130 {
                                                        font-size: 1.15rem;
                                                    }
                                                }
                                            </style>
                                        </div>


                                    </div>
                                </div>



                                <div id="col-1524264602" class="col medium-7 small-12 large-7">
                                    <div class="col-inner">



                                        <div id="text-3207304434" class="text">


                                            <p style="margin-bottom: 0px; margin-top: 10px;"><strong>Phân bón hữu cơ cao
                                                    cấp</strong> là loại phân bón được sản xuất từ các nguồn nguyên liệu
                                                tự
                                                nhiên quý hiếm như humic, fulvic và được áp dụng công nghệ kỹ thuật tiên
                                                tiến để tạo ra sản phẩm có chất lượng cao và đảm bảo tính hữu cơ.</p>

                                            <style>
                                                #text-3207304434 {
                                                    font-size: 0.95rem;
                                                }
                                            </style>
                                        </div>


                                    </div>
                                </div>



                            </div>
                            <div class="row row-collapse" id="row-281028591">


                                <div id="col-490279740" class="col medium-1 small-1 large-1">
                                    <div class="col-inner">



                                        <div class="is-divider divider clearfix"
                                            style="max-width:100%;height:2px;background-color:rgb(207, 209, 208);">
                                        </div>


                                    </div>
                                </div>



                                <div id="col-544353279" class="col medium-2 small-3 large-2">
                                    <div class="col-inner">



                                        <div class="is-divider divider clearfix"
                                            style="max-width:100%;background-color:rgb(0, 156, 15);"></div>


                                    </div>
                                </div>



                                <div id="col-2060766980" class="col medium-9 small-8 large-9">
                                    <div class="col-inner">



                                        <div class="is-divider divider clearfix"
                                            style="max-width:100%;height:2px;background-color:rgb(207, 209, 208);">
                                        </div>


                                    </div>
                                </div>



                            </div>
                            <div class="row" id="row-752440720">


                                <div id="col-1000714201" class="col medium-4 small-12 large-4">
                                    <div class="col-inner">



                                        <div class="box has-hover   has-hover box-text-bottom">

                                            <div class="box-image" style="border-radius:5%;">
                                                <div class="">
                                                    <img width="1200" height="800"
                                                        src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201200%20800'%3E%3C/svg%3E"
                                                        class="attachment- size-" alt="phân bón hữu cơ 25kg"
                                                        decoding="async"
                                                        data-lazy-srcset="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg 1200w, /assets/wp-content/uploads/2024/03/nhom-dang-25kg-768x512.jpg 768w, /assets/wp-content/uploads/2024/03/nhom-dang-25kg-600x400.jpg 600w"
                                                        data-lazy-sizes="(max-width: 1200px) 100vw, 1200px"
                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                        data-lazy-src="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"><noscript><img
                                                            width="1200" height="800"
                                                            src="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg"
                                                            class="attachment- size-" alt="phân bón hữu cơ 25kg"
                                                            decoding="async"
                                                            srcset="/assets/z6392182599909_9f94b4d8cacd64204e7b18995d193cfd.jpg 1200w, /assets/wp-content/uploads/2024/03/nhom-dang-25kg-768x512.jpg 768w, /assets/wp-content/uploads/2024/03/nhom-dang-25kg-600x400.jpg 600w"
                                                            sizes="(max-width: 1200px) 100vw, 1200px"
                                                            title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                </div>
                                            </div>

                                            <div class="box-text text-center">
                                                <div class="box-text-inner">


                                                    <div id="text-1419881896" class="text">


                                                        <h4><strong>Phân Bón Hưu Cơ AC2</strong></h4>

                                                        <style>
                                                            #text-1419881896 {
                                                                color: rgb(26, 98, 43);
                                                            }

                                                            #text-1419881896>* {
                                                                color: rgb(26, 98, 43);
                                                            }
                                                        </style>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <style>
                                        #col-1000714201>.col-inner {
                                            padding: 10px 10px 10px 10px;
                                        }
                                    </style>
                                </div>







                                <style>
                                    #row-752440720>.col>.col-inner {
                                        background-color: rgb(255, 255, 255);
                                        border-radius: 5px;
                                    }
                                </style>
                            </div>

                        </div>


                        <style>
                            #section_482535467 {
                                padding-top: 30px;
                                padding-bottom: 30px;
                                background-color: rgb(228, 244, 216);
                            }

                            #section_482535467 .ux-shape-divider--top svg {
                                height: 150px;
                                --divider-top-width: 100%;
                            }

                            #section_482535467 .ux-shape-divider--bottom svg {
                                height: 150px;
                                --divider-width: 100%;
                            }
                        </style>
                    </section>



                    <section class="section" id="section_2049433917">
                        <div class="bg section-bg fill bg-fill  ">





                        </div>



                        <div class="section-content relative">


                            <div class="row row-collapse" id="row-1115041363">


                                <div id="col-195401730" class="col small-12 large-12">
                                    <div class="col-inner">



                                        <div class="row" id="row-534938434">


                                            <div id="col-1432234740" class="col medium-8 small-12 large-8">
                                                <div class="col-inner">



                                                    <h2><strong>TIN TỨC NÔNG NGHIỆP</strong></h2>


                                                    <div class="row large-columns-3 medium-columns-2 small-columns-1 slider row-slider slider-nav-simple slider-nav-push"
                                                        data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 4000}'>
                                                        @foreach ($news as $item) <!-- Giả định $news là một collection chứa các bài viết -->
                                                            <div class="col post-item" data-animate="fadeInUp">
                                                                <div class="col-inner">
                                                                    <a href="{{ route('news.detail', ['slug' => $item->slug]) }}"
                                                                        class="plain">
                                                                        <div
                                                                            class="box box-normal box-text-bottom box-blog-post has-hover">
                                                                            <div class="box-image">
                                                                                <div class="image-cover"
                                                                                    style="padding-top:56.25%;">
                                                                                    <img width="720" height="480"
                                                                                        src="{{'/storage/' . $item->anh }}"
                                                                                        class="attachment-medium size-medium wp-post-image"
                                                                                        alt="{{ $item->ten }}"
                                                                                        decoding="async"
                                                                                        data-lazy-sizes="(max-width: 720px) 100vw, 720px"
                                                                                        title="{{ $item->ten }}">
                                                                                    <noscript><img width="720" height="480"
                                                                                            src="{{'/storage/' . $item->anh }}"
                                                                                            class="attachment-medium size-medium wp-post-image"
                                                                                            alt="{{ $item->ten }}"
                                                                                            decoding="async"
                                                                                            sizes="(max-width: 720px) 100vw, 720px"
                                                                                            title="{{ $item->ten }}"></noscript>
                                                                                </div>
                                                                            </div>
                                                                            <div class="box-text text-center">
                                                                                <div class="box-text-inner blog-post-inner">
                                                                                    <h5 class="post-title is-large">
                                                                                        {{ $item->ten }}
                                                                                    </h5>
                                                                                    <div class="is-divider"></div>
                                                                                    <p class="from_the_blog_excerpt">
                                                                                        {{ Str::limit($item->short_description, 100) }}
                                                                                    </p> <!-- Giới hạn nội dung -->
                                                                                    <button
                                                                                        class="button primary is-outline is-small mb-0">
                                                                                        Đọc tiếp
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="badge absolute top post-date badge-circle">
                                                                                <div class="badge-inner">
                                                                                    <span
                                                                                        class="post-date-day">{{ $item->created_at->format('d') }}</span><br>
                                                                                    <span
                                                                                        class="post-date-month is-xsmall">{{ $item->created_at->format('M') }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>


                                                </div>
                                            </div>



                                            <div id="col-990575737"
                                                class="col medium-4 small-12 large-4 small-col-first">
                                                <div class="col-inner">



                                                    <div id="text-1410249921" class="text">


                                                        <h2 style="text-align: center;"><strong>Tại sao chọn chúng
                                                                tôi?</strong></h2>

                                                        <style>
                                                            #text-1410249921 {
                                                                font-size: 1.45rem;
                                                                color: #1a622b;
                                                            }

                                                            #text-1410249921>* {
                                                                color: #1a622b;
                                                            }

                                                            @media (min-width:550px) {
                                                                #text-1410249921 {
                                                                    font-size: 0.85rem;
                                                                }
                                                            }

                                                            @media (min-width:850px) {
                                                                #text-1410249921 {
                                                                    font-size: 1.1rem;
                                                                }
                                                            }
                                                        </style>
                                                    </div>

                                                    <div class="accordion" rel="1">

                                                        <div class="accordion-item"><a href="#"
                                                                class="accordion-title plain"><button class="toggle"><i
                                                                        class="icon-angle-down"></i></button><span>Chứng
                                                                    nhận đạt chuẩn</span></a>
                                                            <div class="accordion-inner">

                                                                <p>Phân bón hữu cơ của chúng tôi đã được sản xuất và
                                                                    phân
                                                                    phối tại hơn 42 quốc gia trên toàn thế giới. Sản
                                                                    phẩm
                                                                    của chúng tôi đạt các chứng nhận hữu cơ quốc tế như
                                                                    OMRI, ECOCERT, CDFA và WSDA.</p>
                                                                <div class="row row-small align-middle align-center"
                                                                    id="row-1825959548">


                                                                    <div id="col-299915277"
                                                                        class="col medium-3 small-3 large-3">
                                                                        <div class="col-inner text-center">



                                                                            <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                                                id="image_1891962770">
                                                                                <div class="img-inner dark">
                                                                                    <img width="250" height="250"
                                                                                        src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20250%20250'%3E%3C/svg%3E"
                                                                                        class="attachment-large size-large"
                                                                                        alt="Chứng nhận CDFA"
                                                                                        decoding="async"
                                                                                        data-lazy-srcset="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png 250w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-150x150.png 150w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-100x100.png 100w"
                                                                                        data-lazy-sizes="(max-width: 250px) 100vw, 250px"
                                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                                        data-lazy-src="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png"><noscript><img
                                                                                            width="250" height="250"
                                                                                            src="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png"
                                                                                            class="attachment-large size-large"
                                                                                            alt="Chứng nhận CDFA"
                                                                                            decoding="async"
                                                                                            srcset="/assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1.png 250w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-150x150.png 150w, /assets/wp-content/uploads/2023/06/CDFA-seal-7cm-2col-spacing-250x250-1-100x100.png 100w"
                                                                                            sizes="(max-width: 250px) 100vw, 250px"
                                                                                            title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                                                </div>

                                                                                <style>
                                                                                    #image_1891962770 {
                                                                                        width: 100%;
                                                                                    }
                                                                                </style>
                                                                            </div>



                                                                        </div>
                                                                    </div>



                                                                    <div id="col-496375195"
                                                                        class="col medium-3 small-3 large-3">
                                                                        <div class="col-inner text-center">



                                                                            <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                                                id="image_474485265">
                                                                                <div class="img-inner dark">
                                                                                    <img width="500" height="200"
                                                                                        src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20500%20200'%3E%3C/svg%3E"
                                                                                        class="attachment-large size-large"
                                                                                        alt="chứng nhận omri"
                                                                                        decoding="async"
                                                                                        data-lazy-srcset="/assets/wp-content/uploads/2023/06/omri.png 500w, /assets/wp-content/uploads/2023/06/omri-300x120.png 300w"
                                                                                        data-lazy-sizes="(max-width: 500px) 100vw, 500px"
                                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                                        data-lazy-src="/assets/wp-content/uploads/2023/06/omri.png"><noscript><img
                                                                                            width="500" height="200"
                                                                                            src="/assets/wp-content/uploads/2023/06/omri.png"
                                                                                            class="attachment-large size-large"
                                                                                            alt="chứng nhận omri"
                                                                                            decoding="async"
                                                                                            srcset="/assets/wp-content/uploads/2023/06/omri.png 500w, /assets/wp-content/uploads/2023/06/omri-300x120.png 300w"
                                                                                            sizes="(max-width: 500px) 100vw, 500px"
                                                                                            title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                                                </div>

                                                                                <style>
                                                                                    #image_474485265 {
                                                                                        width: 100%;
                                                                                    }
                                                                                </style>
                                                                            </div>



                                                                        </div>
                                                                    </div>



                                                                    <div id="col-1291328259"
                                                                        class="col medium-3 small-3 large-3">
                                                                        <div class="col-inner text-center">



                                                                            <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                                                id="image_714695846">
                                                                                <div class="img-inner dark">
                                                                                    <img width="250" height="250"
                                                                                        src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20250%20250'%3E%3C/svg%3E"
                                                                                        class="attachment-large size-large"
                                                                                        alt="WSDALogo Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                                        decoding="async"
                                                                                        data-lazy-srcset="/assets/wp-content/uploads/2023/06/WSDALogo.png 250w, /assets/wp-content/uploads/2023/06/WSDALogo-150x150.png 150w, /assets/wp-content/uploads/2023/06/WSDALogo-100x100.png 100w"
                                                                                        data-lazy-sizes="(max-width: 250px) 100vw, 250px"
                                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                                        data-lazy-src="/assets/wp-content/uploads/2023/06/WSDALogo.png"><noscript><img
                                                                                            width="250" height="250"
                                                                                            src="/assets/wp-content/uploads/2023/06/WSDALogo.png"
                                                                                            class="attachment-large size-large"
                                                                                            alt="WSDALogo Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                                                            decoding="async"
                                                                                            srcset="/assets/wp-content/uploads/2023/06/WSDALogo.png 250w, /assets/wp-content/uploads/2023/06/WSDALogo-150x150.png 150w, /assets/wp-content/uploads/2023/06/WSDALogo-100x100.png 100w"
                                                                                            sizes="(max-width: 250px) 100vw, 250px"
                                                                                            title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                                                </div>

                                                                                <style>
                                                                                    #image_714695846 {
                                                                                        width: 100%;
                                                                                    }
                                                                                </style>
                                                                            </div>



                                                                        </div>
                                                                    </div>



                                                                    <div id="col-1809629859"
                                                                        class="col medium-3 small-3 large-3">
                                                                        <div class="col-inner text-center">



                                                                            <div class="img has-hover x md-x lg-x y md-y lg-y"
                                                                                id="image_567388572">
                                                                                <div class="img-inner dark">
                                                                                    <img width="816" height="538"
                                                                                        src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20816%20538'%3E%3C/svg%3E"
                                                                                        class="attachment-large size-large"
                                                                                        alt="Chứng nhận Ecocert"
                                                                                        decoding="async"
                                                                                        data-lazy-srcset="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png 816w, /assets/wp-content/uploads/2023/06/Ecocert-300x198.png 300w, /assets/wp-content/uploads/2023/06/Ecocert-768x506.png 768w, /assets/wp-content/uploads/2023/06/Ecocert-600x396.png 600w"
                                                                                        data-lazy-sizes="(max-width: 816px) 100vw, 816px"
                                                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                                                        data-lazy-src="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png"><noscript><img
                                                                                            width="816" height="538"
                                                                                            src="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png"
                                                                                            class="attachment-large size-large"
                                                                                            alt="Chứng nhận Ecocert"
                                                                                            decoding="async"
                                                                                            srcset="/assets/wp-content/uploads/2023/06/Ecocert-768x506.png 816w, /assets/wp-content/uploads/2023/06/Ecocert-300x198.png 300w, /assets/wp-content/uploads/2023/06/Ecocert-768x506.png 768w, /assets/wp-content/uploads/2023/06/Ecocert-600x396.png 600w"
                                                                                            sizes="(max-width: 816px) 100vw, 816px"
                                                                                            title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                                                                </div>

                                                                                <style>
                                                                                    #image_567388572 {
                                                                                        width: 100%;
                                                                                    }
                                                                                </style>
                                                                            </div>



                                                                        </div>
                                                                    </div>



                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="accordion-item"><a href="#"
                                                                class="accordion-title plain"><button class="toggle"><i
                                                                        class="icon-angle-down"></i></button><span>Chất
                                                                    lượng ưu việt</span></a>
                                                            <div class="accordion-inner">

                                                                <p>Sản phẩm của chúng tôi là những sản phẩm chính hãng,
                                                                    được
                                                                    sản xuất bằng công nghệ hàng đầu từ Hoa Kỳ và nhập
                                                                    khẩu
                                                                    trực tiếp, không thông qua trung gian. Chúng tôi cam
                                                                    kết
                                                                    đáp ứng tiêu chí &#8216;tốt cho đất &#8211; khỏe cho
                                                                    cây&#8217; để đồng hành cùng người dân tạo nên mùa
                                                                    vụ
                                                                    bội thu với giá trị kinh tế tốt nhất.</p>

                                                            </div>
                                                        </div>
                                                        <div class="accordion-item"><a href="#"
                                                                class="accordion-title plain"><button class="toggle"><i
                                                                        class="icon-angle-down"></i></button><span>Sản
                                                                    phẩm
                                                                    đa dạng</span></a>
                                                            <div class="accordion-inner">

                                                                <p>Chúng tôi phân phối trực tiếp các loại phân hữu cơ,
                                                                    với
                                                                    đa dạng dòng sản phẩm từ dạng hạt, bột đến dạng
                                                                    lỏng.
                                                                    Các sản phẩm của chúng tôi giúp nâng cao năng suất,
                                                                    chất
                                                                    lượng và giá trị kinh tế cho người nông dân. Mỗi
                                                                    loại
                                                                    phân được thiết kế phù hợp với từng loại cây trồng,
                                                                    thổ
                                                                    nhưỡng, thời tiết và khí hậu khác nhau.</p>

                                                            </div>
                                                        </div>
                                                        <div class="accordion-item"><a href="#"
                                                                class="accordion-title plain"><button class="toggle"><i
                                                                        class="icon-angle-down"></i></button><span>Dịch
                                                                    vụ
                                                                    tận tâm</span></a>
                                                            <div class="accordion-inner">

                                                                <p>Đội ngũ chuyên gia và kỹ sư nông nghiệp của chúng tôi
                                                                    luôn sẵn sàng tư vấn và hỗ trợ người nông dân trong
                                                                    việc
                                                                    lựa chọn sản phẩm phù hợp và đưa ra giải pháp kỹ
                                                                    thuật,
                                                                    dinh dưỡng và sản xuất tốt nhất cho cây trồng của
                                                                    họ.
                                                                </p>

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <style>
                                                    #col-990575737>.col-inner {
                                                        padding: 0px 0px 0px 0px;
                                                    }
                                                </style>
                                            </div>



                                        </div>

                                    </div>
                                </div>




                                <style>
                                    #row-1115041363>.col>.col-inner {
                                        padding: 30px 30px 30px 30px;
                                        background-color: rgb(255, 255, 255);
                                        border-radius: 10px;
                                    }
                                </style>
                            </div>

                        </div>


                        <style>
                            #section_2049433917 {
                                padding-top: 30px;
                                padding-bottom: 30px;
                            }

                            #section_2049433917 .section-bg.bg-loaded {
                                background-image: url(/assets/wp-content/uploads/2022/10/sanpham-bg.jpg);
                            }

                            #section_2049433917 .ux-shape-divider--top svg {
                                height: 150px;
                                --divider-top-width: 100%;
                            }

                            #section_2049433917 .ux-shape-divider--bottom svg {
                                height: 150px;
                                --divider-width: 100%;
                            }
                        </style>
                    </section>

                    <section class="section" id="section_337540562">
                        <div class="bg section-bg fill bg-fill  bg-loaded">





                        </div>



                        <div class="section-content relative">


                            <div class="container section-title-container">
                                <h3 class="section-title section-title-normal"><b></b><span
                                        class="section-title-main">KHÁCH
                                        HÀNG VÀ ĐỐI TÁC</span><b></b></h3>
                            </div>

                            <div class="row row-collapse align-center" id="row-1919264406">


                                <div id="col-239397146" class="col medium-3 small-6 large-2">
                                    <div class="col-inner">



                                        <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_809087876">
                                            <div class="img-inner dark">
                                                <img width="395" height="157"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20395%20157'%3E%3C/svg%3E"
                                                    class="attachment-large size-large"
                                                    alt="humicm removebg preview Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                    decoding="async"
                                                    data-lazy-srcset="/assets/wp-content/uploads/2022/10/humicm-removebg-preview.png 395w, /assets/wp-content/uploads/2022/10/humicm-removebg-preview-300x119.png 300w"
                                                    data-lazy-sizes="(max-width: 395px) 100vw, 395px"
                                                    title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"
                                                    data-lazy-src="/assets/wp-content/uploads/2022/10/humicm-removebg-preview.png"><noscript><img
                                                        width="395" height="157"
                                                        src="/assets/wp-content/uploads/2022/10/humicm-removebg-preview.png"
                                                        class="attachment-large size-large"
                                                        alt="humicm removebg preview Phân Bón Hữu Cơ Cao Cấp, Nhập Khẩu Từ Mỹ | TTP Global"
                                                        decoding="async"
                                                        srcset="/assets/wp-content/uploads/2022/10/humicm-removebg-preview.png 395w, /assets/wp-content/uploads/2022/10/humicm-removebg-preview-300x119.png 300w"
                                                        sizes="(max-width: 395px) 100vw, 395px"
                                                        title="phân bón hữu cơ cao cấp, nhập khẩu từ mỹ | ttp global count(title)"></noscript>
                                            </div>

                                            <style>
                                                #image_809087876 {
                                                    width: 100%;
                                                }
                                            </style>
                                        </div>



                                    </div>
                                </div>



                            </div>

                        </div>


                        <style>
                            #section_337540562 {
                                padding-top: 30px;
                                padding-bottom: 30px;
                            }

                            #section_337540562 .ux-shape-divider--top svg {
                                height: 150px;
                                --divider-top-width: 100%;
                            }

                            #section_337540562 .ux-shape-divider--bottom svg {
                                height: 150px;
                                --divider-width: 100%;
                            }
                        </style>
                    </section>




                </div>



            </main>



        </div>



        <div id="login-form-popup" class="lightbox-content mfp-hide">
            <div class="woocommerce-notices-wrapper"></div>
            <div class="account-container lightbox-inner">


                <div class="account-login-inner">

                    <h3 class="uppercase">Đăng nhập</h3>

                    <form class="woocommerce-form woocommerce-form-login login" method="post">


                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="username">Tên tài khoản hoặc địa chỉ email&nbsp;<span
                                    class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                name="username" id="username" autocomplete="username" value="" />
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password">Mật khẩu&nbsp;<span class="required">*</span></label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
                                name="password" id="password" autocomplete="current-password" />
                        </p>


                        <p class="form-row">
                            <label
                                class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                <input class="woocommerce-form__input woocommerce-form__input-checkbox"
                                    name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>Ghi
                                    nhớ mật khẩu</span>
                            </label>
                            <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce"
                                value="c7c14d5ece" /><input type="hidden" name="_wp_http_referer" value="/" />
                            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit"
                                name="login" value="Đăng nhập">Đăng nhập</button>
                        </p>
                        <p class="woocommerce-LostPassword lost_password">
                            <a href="https://ttpglobal.com.vn/my-account/lost-password/">Quên mật khẩu?</a>
                        </p>


                    </form>
                </div>


            </div>

        </div>
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


        <style id='metaslider-public-inline-css' type='text/css'>
            @media only screen and (max-width: 767px) {
                body:after {
                    display: none;
                    content: "smartphone";
                }

                .hide-arrows-smartphone .flex-direction-nav,
                .hide-navigation-smartphone .flex-control-paging,
                .hide-navigation-smartphone .flex-control-nav,
                .hide-navigation-smartphone .filmstrip {
                    display: none !important;
                }
            }

            @media only screen and (min-width : 768px) and (max-width: 1023px) {
                body:after {
                    display: none;
                    content: "tablet";
                }

                .hide-arrows-tablet .flex-direction-nav,
                .hide-navigation-tablet .flex-control-paging,
                .hide-navigation-tablet .flex-control-nav,
                .hide-navigation-tablet .filmstrip {
                    display: none !important;
                }
            }

            @media only screen and (min-width : 1024px) and (max-width: 1439px) {
                body:after {
                    display: none;
                    content: "laptop";
                }

                .hide-arrows-laptop .flex-direction-nav,
                .hide-navigation-laptop .flex-control-paging,
                .hide-navigation-laptop .flex-control-nav,
                .hide-navigation-laptop .filmstrip {
                    display: none !important;
                }
            }

            @media only screen and (min-width : 1440px) {
                body:after {
                    display: none;
                    content: "desktop";
                }

                .hide-arrows-desktop .flex-direction-nav,
                .hide-navigation-desktop .flex-control-paging,
                .hide-navigation-desktop .flex-control-nav,
                .hide-navigation-desktop .filmstrip {
                    display: none !important;
                }
            }
        </style>
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
                "nonce": "330b7ee394"
            };
            /* ]]> */
        </script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-content/plugins/kk-star-ratings/src/core/public/js/kk-star-ratings.min.js?ver=5.2.9'
            id='kk-star-ratings-js' defer></script>
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
            src='/assets/wp-includes/js/underscore.min.js?ver=1.13.4' id='underscore-js' defer></script>
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
            src='/assets/wp-includes/js/wp-util.min.js?ver=6.3' id='wp-util-js' defer></script>
        <script type='text/javascript' id='wp-api-request-js-extra'>
            /* <![CDATA[ */
            var wpApiSettings = {
                "root": "https:\/\/ttpglobal.com.vn\/wp-json\/",
                "nonce": "f482e748a0",
                "versionString": "wp\/v2\/"
            };
            /* ]]> */
        </script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/api-request.min.js?ver=6.3' id='wp-api-request-js' defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/dist/vendor/wp-polyfill-inert.min.js?ver=3.1.2' id='wp-polyfill-inert-js'
            defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/dist/vendor/regenerator-runtime.min.js?ver=0.13.11' id='regenerator-runtime-js'
            defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0' id='wp-polyfill-js'></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/dist/hooks.min.js?ver=c6aec9a8d4e5a5d543a1' id='wp-hooks-js'></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/dist/i18n.min.js?ver=7701b0c3857f914212ef' id='wp-i18n-js'></script>
        <script type="rocketlazyloadscript" id="wp-i18n-js-after" data-rocket-type="text/javascript">
wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
</script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/dist/url.min.js?ver=8814d23f2d64864d280d' id='wp-url-js'></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript' id='wp-api-fetch-js-translations'>
( function( domain, translations ) {
	var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
	localeData[""].domain = domain;
	wp.i18n.setLocaleData( localeData, domain );
} )( "default", {"translation-revision-date":"2023-07-15 15:30:50+0000","generator":"GlotPress\/4.0.0-alpha.4","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=1; plural=0;","lang":"vi_VN"},"You are probably offline.":["C\u00f3 th\u1ec3 b\u1ea1n \u0111ang ngo\u1ea1i tuy\u1ebfn."],"Media upload failed. If this is a photo or a large image, please scale it down and try again.":["T\u1ea3i l\u00ean media kh\u00f4ng th\u00e0nh c\u00f4ng. N\u1ebfu \u0111\u00e2y l\u00e0 h\u00ecnh \u1ea3nh c\u00f3 k\u00edch th\u01b0\u1edbc l\u1edbn, vui l\u00f2ng thu nh\u1ecf n\u00f3 xu\u1ed1ng v\u00e0 th\u1eed l\u1ea1i."],"The response is not a valid JSON response.":["Ph\u1ea3n h\u1ed3i kh\u00f4ng ph\u1ea3i l\u00e0 m\u1ed9t JSON h\u1ee3p l\u1ec7."],"An unknown error occurred.":["C\u00f3 l\u1ed7i n\u00e0o \u0111\u00f3 \u0111\u00e3 x\u1ea3y ra."]}},"comment":{"reference":"wp-includes\/js\/dist\/api-fetch.js"}} );
</script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-includes/js/dist/api-fetch.min.js?ver=0fa4dabf8bf2c7adf21a' id='wp-api-fetch-js'></script>
        <script type="rocketlazyloadscript" id="wp-api-fetch-js-after" data-rocket-type="text/javascript">
wp.apiFetch.use( wp.apiFetch.createRootURLMiddleware( "/assets/wp-json/" ) );
wp.apiFetch.nonceMiddleware = wp.apiFetch.createNonceMiddleware( "f482e748a0" );
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
        <script type="rocketlazyloadscript" id="rocket-browser-checker-js-after" data-rocket-type="text/javascript">
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
        <script type="rocketlazyloadscript" id="rocket-preload-links-js-after" data-rocket-type="text/javascript">
(function() {
"use strict";var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e=function(){function i(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}}();function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=function(){function n(e,t){i(this,n),this.browser=e,this.config=t,this.options=this.browser.options,this.prefetched=new Set,this.eventTime=null,this.threshold=1111,this.numOnHover=0}return e(n,[{key:"init",value:function(){!this.browser.supportsLinkPrefetch()||this.browser.isDataSaverModeOn()||this.browser.isSlowConnection()||(this.regex={excludeUris:RegExp(this.config.excludeUris,"i"),images:RegExp(".("+this.config.imageExt+")$","i"),fileExt:RegExp(".("+this.config.fileExt+")$","i")},this._initListeners(this))}},{key:"_initListeners",value:function(e){-1<this.config.onHoverDelay&&document.addEventListener("mouseover",e.listener.bind(e),e.listenerOptions),document.addEventListener("mousedown",e.listener.bind(e),e.listenerOptions),document.addEventListener("touchstart",e.listener.bind(e),e.listenerOptions)}},{key:"listener",value:function(e){var t=e.target.closest("a"),n=this._prepareUrl(t);if(null!==n)switch(e.type){case"mousedown":case"touchstart":this._addPrefetchLink(n);break;case"mouseover":this._earlyPrefetch(t,n,"mouseout")}}},{key:"_earlyPrefetch",value:function(t,e,n){var i=this,r=setTimeout(function(){if(r=null,0===i.numOnHover)setTimeout(function(){return i.numOnHover=0},1e3);else if(i.numOnHover>i.config.rateThrottle)return;i.numOnHover++,i._addPrefetchLink(e)},this.config.onHoverDelay);t.addEventListener(n,function e(){t.removeEventListener(n,e,{passive:!0}),null!==r&&(clearTimeout(r),r=null)},{passive:!0})}},{key:"_addPrefetchLink",value:function(i){return this.prefetched.add(i.href),new Promise(function(e,t){var n=document.createElement("link");n.rel="prefetch",n.href=i.href,n.onload=e,n.onerror=t,document.head.appendChild(n)}).catch(function(){})}},{key:"_prepareUrl",value:function(e){if(null===e||"object"!==(void 0===e?"undefined":r(e))||!1 in e||-1===["http:","https:"].indexOf(e.protocol))return null;var t=e.href.substring(0,this.config.siteUrl.length),n=this._getPathname(e.href,t),i={original:e.href,protocol:e.protocol,origin:t,pathname:n,href:t+n};return this._isLinkOk(i)?i:null}},{key:"_getPathname",value:function(e,t){var n=t?e.substring(this.config.siteUrl.length):e;return n.startsWith("/")||(n="/"+n),this._shouldAddTrailingSlash(n)?n+"/":n}},{key:"_shouldAddTrailingSlash",value:function(e){return this.config.usesTrailingSlash&&!e.endsWith("/")&&!this.regex.fileExt.test(e)}},{key:"_isLinkOk",value:function(e){return null!==e&&"object"===(void 0===e?"undefined":r(e))&&(!this.prefetched.has(e.href)&&e.origin===this.config.siteUrl&&-1===e.href.indexOf("?")&&-1===e.href.indexOf("#")&&!this.regex.excludeUris.test(e.href)&&!this.regex.images.test(e.href))}}],[{key:"run",value:function(){"undefined"!=typeof RocketPreloadLinksConfig&&new n(new RocketBrowserCompatibilityChecker({capture:!0,passive:!0}),RocketPreloadLinksConfig).init()}}]),n}();t.run();
}());
</script>
        <script type='text/javascript' id='wpcbn-frontend-js-extra'>
            /* <![CDATA[ */
            var wpcbn_vars = {
                "nonce": "b08ba52e74",
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
            src='/assets/wp-includes/js/hoverIntent.min.js?ver=1.10.2' id='hoverIntent-js' defer></script>
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
                "everest_forms_data_save": "bcc6f2d844",
                "everest_forms_slot_booking": "ec6dbada61",
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
                "ajax_nonce": "d337079d34",
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
            src='/assets/wp-content/plugins/everest-forms/assets/js/dropzone/dropzone.min.js?ver=5.5.0' id='dropzone-js'
            defer></script>
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
                "evf_ajax_submission": "383f1b37ea",
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
            src='/assets/wp-includes/js/jquery/ui/core.min.js?ver=1.13.2' id='jquery-ui-core-js' defer></script>
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
                "ajax_nonce": "1888d0d1b5",
                "google_analytics": ""
            };
            /* ]]> */
        </script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-content/plugins/mystickyelements-pro/js/mystickyelements-fronted.min.js?ver=2.0.7'
            id='mystickyelements-fronted-js-js' defer></script>
        <script type="rocketlazyloadscript" id="gt_widget_script_85929310-js-before" data-rocket-type="text/javascript">
window.gtranslateSettings = /* document.write */ window.gtranslateSettings || {};window.gtranslateSettings['85929310'] = {"default_language":"vi","languages":["km","lo","vi"],"dropdown_languages":["km","lo","vi"],"url_structure":"none","add_new_line":1,"flag_style":"3d","flag_size":16,"wrapper_selector":"li.menu-item-gtranslate.gt-menu-24719","alt_flags":[],"horizontal_position":"inline","flags_location":"\/wp-content\/plugins\/gtranslate\/flags\/"};
</script>
        <script type="rocketlazyloadscript" src="/assets/wp-content/plugins/gtranslate/js/fd.js?ver=6.3"
            data-no-optimize="1" data-no-minify="1" data-gt-orig-url="/" data-gt-orig-domain="ttpglobal.com.vn"
            data-gt-widget-id="85929310" defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-content/plugins/ml-slider/assets/sliders/flexslider/jquery.flexslider.min.js?ver=3.92.1'
            id='metaslider-flex-slider-js' defer></script>
        <script type="rocketlazyloadscript" id="metaslider-flex-slider-js-after" data-rocket-type="text/javascript">window.addEventListener('DOMContentLoaded', function() {
var metaslider_9062 = function($) {$('#metaslider_9062').addClass('flexslider');
            $('#metaslider_9062').flexslider({
                slideshowSpeed:3000,
                animation:"slide",
                controlNav:true,
                directionNav:false,
                pauseOnHover:true,
                direction:"horizontal",
                reverse:false,
                keyboard:true,
                touch:true,
                animationSpeed:600,
                prevText:"Previous",
                nextText:"Next",
                smoothHeight:false,
                fadeFirstSlide:false,
                easing:"linear",
                slideshow:true,
                pausePlay:false
            });
            $(document).trigger('metaslider/initialized', '#metaslider_9062');
        };
        var timer_metaslider_9062 = function() {
            var slider = !window.jQuery ? window.setTimeout(timer_metaslider_9062, 100) : !jQuery.isReady ? window.setTimeout(timer_metaslider_9062, 1) : metaslider_9062(window.jQuery);
        };
        timer_metaslider_9062();
});</script>
        <script type='text/javascript' id='metaslider-script-js-extra'>
            /* <![CDATA[ */
            var wpData = {
                "baseUrl": "https:\/\/ttpglobal.com.vn"
            };
            /* ]]> */
        </script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-content/plugins/ml-slider/assets/metaslider/script.min.js?ver=3.92.1'
            id='metaslider-script-js' defer></script>
        <script type="rocketlazyloadscript" data-rocket-type='text/javascript'
            src='/assets/wp-content/plugins/ml-slider/assets/easing/jQuery.easing.min.js?ver=3.92.1'
            id='metaslider-easing-js' defer></script>
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
        </style> <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T26K6WS" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
    </body>

</div>
