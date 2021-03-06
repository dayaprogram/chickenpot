/*
 HeapBox 0.9.3
 (c) 2013 Filip Bartos
 */

(function (e, t, n, r) {
    function o(t, n) {
        this.element = t;
        this.options = e.extend({}, s, n);
        this._defaults = s;
        this._name = i;
        this.instance;
        this.callbackManager = new Array;
        this.init()
    }
    var i = "heapbox", s = {effect: {type: "slide", speed: "slow"}, insert: "before", heapsize: r, emptyMessage: "Empty", tabindex: "undefined", openStart: function () {}, openComplete: function () {}, closeStart: function () {}, closeComplete: function () {}, onChange: function () {}};
    o.prototype = {init: function () {
            this._hideSourceElement();
            this._isSourceSelectbox();
            this.instance = this.createInstance();
            this._createElements();
            this._setDefaultValues()
        }, createInstance: function () {
            return{heapId: Math.round(Math.random() * 99999999), state: false}
        }, _setEvents: function () {
            var t = this;
            this._setControlsEvents();
            e(n).on("click", "html", function (e) {
                e.stopPropagation();
                t._closeheap(true, function () {}, function () {})
            })
        }, _setSliderEvents: function () {
            var t = this;
            this.scrollingStatus = false;
            heap = e("#heapbox_" + this.instance.heapId + " .heap");
            heap.find(".sliderDown").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                t._setHeapboxFocus()
            });
            heap.find(".sliderDown").mousedown(function (n) {
                t.scrollingStatus = true;
                t._keyArrowDownHandler(e("#heapbox_" + t.instance.heapId));
                t.interval = setInterval(function () {
                    t._keyArrowDownHandler(e("#heapbox_" + t.instance.heapId))
                }, 300)
            }).mouseup(function (e) {
                clearInterval(t.interval);
                t.scrollingStatus = false
            }).mouseout(function (e) {
                clearInterval(t.interval);
                t.scrollingStatus = false
            });
            heap.find(".sliderUp").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                t._setHeapboxFocus()
            });
            heap.find(".sliderUp").mousedown(function (n) {
                t.scrollingStatus = true;
                t._keyArrowUpHandler(e("#heapbox_" + t.instance.heapId));
                t.interval = setInterval(function () {
                    t._keyArrowUpHandler(e("#heapbox_" + t.instance.heapId))
                }, 300)
            }).mouseup(function (e) {
                clearInterval(t.interval);
                t.scrollingStatus = false
            }).mouseout(function (e) {
                clearInterval(t.interval);
                t.scrollingStatus = false
            })
        }, _setViewPosition: function (t) {
            heap = e("div#heapbox_" + this.instance.heapId + " .heap");
            heap.show();
            var n = this;
            selected = t.find(".heapOptions li a.selected");
            firstTop = t.find(".heapOptions li a").first().offset().top;
            actTop = e(selected).offset().top;
            newTop = firstTop - actTop + this.sliderUpHeight;
            heapHeight = e("div#heapbox_" + this.instance.heapId + " .heapOptions").height();
            maxPosition = heapHeight - parseInt(this.options.heapsize, 10) + this.sliderDownHeight;
            minPosition = 0 + this.sliderUpHeight;
            if (-1 * newTop > maxPosition)
                newTop = -1 * maxPosition;
            t.find(".heapOptions").css("top", newTop);
            if (!this.instance.state)
                heap.hide()
        }, _setKeyboardEvents: function () {
            var t = this;
            heapbox = e("#heapbox_" + this.instance.heapId);
            heapbox.keydown(function (n) {
                switch (n.which) {
                    case 13:
                        t._handlerClicked();
                        return false;
                        break;
                    case 27:
                        t._closeheap();
                        break;
                    case 37:
                        t._keyArrowUpHandler(e("#heapbox_" + t.instance.heapId));
                        n.preventDefault();
                        break;
                    case 39:
                        t._keyArrowDownHandler(e("#heapbox_" + t.instance.heapId));
                        n.preventDefault();
                        break;
                    case 38:
                        t._keyArrowUpHandler(e("#heapbox_" + t.instance.heapId));
                        n.preventDefault();
                        break;
                    case 40:
                        t._keyArrowDownHandler(e("#heapbox_" + t.instance.heapId));
                        n.preventDefault();
                        break
                }
            })
        }, _keyArrowUpHandler: function (t) {
            var n = this;
            t.find("div.heap ul li").each(function () {
                if (e(this).find("a").hasClass("selected")) {
                    selectItem = n._findPrev(e(this));
                    if (selectItem) {
                        n._heapChanged(n, selectItem, true);
                        return false
                    }
                }
            });
            n._setViewPosition(e("#heapbox_" + n.instance.heapId))
        }, _keyArrowDownHandler: function (t) {
            var n = this;
            t.find("div.heap ul li").each(function () {
                if (e(this).find("a").hasClass("selected")) {
                    selectItem = n._findNext(e(this));
                    if (selectItem) {
                        n._heapChanged(n, selectItem, true);
                        return false
                    }
                }
            });
            n._setViewPosition(e("#heapbox_" + n.instance.heapId))
        }, _findPrev: function (e) {
            if (e.prev().length > 0) {
                if (!e.prev().find("a").hasClass("disabled")) {
                    return e.prev().find("a")
                } else {
                    return this._findPrev(e.prev())
                }
            }
        }, _findNext: function (e) {
            if (e.next().length > 0) {
                if (!e.next().find("a").hasClass("disabled")) {
                    return e.next().find("a")
                } else {
                    return this._findNext(e.next())
                }
            }
        }, _createElements: function () {
            var t = this;
            heapBoxEl = e("<div/>", {id: "heapbox_" + this.instance.heapId, "class": "heapBox", data: {sourceElement: this.element}});
            heapBoxHolderEl = e("<a/>", {href: "", "class": "holder"});
            heapBoxHandlerEl = e("<a/>", {href: "", "class": "handler"});
            heapBoxheapEl = e("<div/>", {"class": "heap"});
            heapBoxEl.append(heapBoxHolderEl);
            heapBoxEl.append(heapBoxHandlerEl);
            heapBoxEl.append(heapBoxheapEl);
            this.heapBoxEl = heapBoxEl;
            this._insertHeapbox(this.heapBoxEl)
        }, _insertHeapbox: function (t) {
            if (this.isSourceElementSelect && this.options.insert == "inside")
                this.options.insert = "before";
            switch (this.options.insert) {
                case"before":
                    e(this.element).before(t);
                    break;
                case"after":
                    e(this.element).after(t);
                    break;
                case"inside":
                    e(this.element).html(t);
                    this._showSourceElement();
                    break;
                default:
                    e(this.element).before(t);
                    break
            }
        }, _setDefaultValues: function () {
            this._initHeap();
            this._initView(heapBoxEl);
            this._setHolderTitle();
            this._setTabindex();
            this._setEvents()
        }, _setHeapboxFocus: function () {
            heapbox = e("div#heapbox_" + this.instance.heapId + " .holder");
            heapbox.focus()
        }, _setHeapSize: function () {
            if (this.options.heapsize) {
                if (heapBoxheapEl.height() < parseInt(this.options.heapsize, 10)) {
                    delete this.options.heapsize;
                    return
                } else {
                    heapBoxheapEl.css("height", this.options.heapsize)
                }
            }
        }, _initHeap: function () {
            var e;
            if (this.isSourceElementSelect) {
                e = this._optionsToJson();
                this._setData(e)
            }
        }, _initView: function (e) {
            if (this._isHeapEmpty()) {
                return
            } else {
                this._setViewPosition(e)
            }
        }, _setHolderTitle: function () {
            var t = this;
            holderEl = e("#heapbox_" + this.instance.heapId).find(".holder");
            selectedEl = e("#heapbox_" + this.instance.heapId).find(".heap ul li a.selected").last();
            if (selectedEl.length != 0) {
                holderEl.text(selectedEl.text());
                holderEl.attr("rel", selectedEl.attr("rel"));
                if (selectedEl.attr("data-icon-src")) {
                    iconEl = this._createIconElement(selectedEl.attr("data-icon-src"));
                    holderEl.append(iconEl)
                }
            } else {
                holderEl.text(this.options.emptyMessage);
                this._removeHeapboxHolderEvents();
                this._removeHeapboxHandlerEvents()
            }
        }, _setTabindex: function () {
            var t;
            t = this.options.tabindex != "undefined" ? this.options.tabindex : e(this.element).attr("tabindex");
            if (t != "undefined") {
                e("#heapbox_" + this.instance.heapId).attr("tabindex", t)
            }
        }, _setData: function (t) {
            var n = this;
            var r = jQuery.parseJSON(t);
            var i = false;
            if (this.isSourceElementSelect)
                this._refreshSourceSelectbox(r);
            heapBoxheapOptionsEl = e("<ul/>", {"class": "heapOptions"});
            e.each(r, function () {
                if (this.selected) {
                    i = true
                }
                heapBoxOptionLiEl = e("<li/>", {"class": "heapOption"});
                heapBoxheapOptionAEl = e("<a/>", {href: "", rel: this.value, title: this.text, text: this.text, "class": this.selected ? "selected" : "", click: function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        n._heapChanged(n, this)
                    }});
                if (this.disabled) {
                    heapBoxheapOptionAEl.unbind("click");
                    heapBoxheapOptionAEl.addClass("disabled");
                    heapBoxheapOptionAEl.click(function (e) {
                        e.preventDefault();
                        e.stopPropagation()
                    })
                }
                if (this.icon) {
                    heapBoxheapOptionAEl.attr("data-icon-src", this.icon);
                    heapBoxOptionIcon = n._createIconElement(this.icon);
                    heapBoxheapOptionAEl.append(heapBoxOptionIcon)
                }
                heapBoxOptionLiEl.append(heapBoxheapOptionAEl);
                heapBoxheapOptionsEl.append(heapBoxOptionLiEl)
            });
            e("div#heapbox_" + this.instance.heapId + " .heap ul").remove();
            e("div#heapbox_" + this.instance.heapId + " .heap").append(heapBoxheapOptionsEl);
            this._setHeapSize();
            if (this._isHeapsizeSet()) {
                this._createSliderUpElement();
                this._createSliderDownElement()
            }
            if (i != true) {
                e("div#heapbox_" + this.instance.heapId + " .heap ul li a").first().addClass("selected")
            }
        }, _createSliderUpElement: function () {
            slideUp = e("<a/>", {"class": "sliderUp", href: ""});
            e("div#heapbox_" + this.instance.heapId + " .heap .heapOptions").before(slideUp);
            sliderUp = e("#heapbox_" + this.instance.heapId + " .sliderUp");
            this.sliderUpHeight = parseInt(sliderUp.css("height"), 10) + parseInt(sliderUp.css("border-top-width"), 10) + parseInt(sliderUp.css("border-bottom-width"), 10);
            e("#heapbox_" + this.instance.heapId + " .heapOptions").css("top", this.sliderUpHeight)
        }, _createSliderDownElement: function () {
            slideDown = e("<a/>", {"class": "sliderDown", href: ""});
            e("div#heapbox_" + this.instance.heapId + " .heap .heapOptions").after(slideDown);
            sliderDown = e("#heapbox_" + this.instance.heapId + " .sliderDown");
            this.sliderDownHeight = parseInt(sliderDown.css("height"), 10) + parseInt(sliderDown.css("border-top-width")) + parseInt(sliderDown.css("border-bottom-width"))
        }, _createIconElement: function (t) {
            heapBoxOptionIcon = e("<img/>", {src: t, alt: t});
            return heapBoxOptionIcon
        }, _optionsToJson: function () {
            var t = [];
            e(this.element).find("option").each(function () {
                t.push({value: e(this).attr("value"), text: e(this).text(), icon: e(this).attr("data-icon-src"), disabled: e(this).attr("disabled"), selected: e(this).is(":selected") ? "selected" : ""})
            });
            var n = JSON.stringify(t);
            return n
        }, _heapboxToJson: function () {
            var t = [];
            e("div#heapbox_" + this.instance.heapId + " .heap ul li a").each(function () {
                t.push({value: e(this).attr("rel"), text: e(this).text(), selected: e(this).is(":selected") ? "selected" : ""})
            });
            var n = JSON.stringify(t);
            return n
        }, _isHeapEmpty: function () {
            var t = e("div#heapbox_" + this.instance.heapId + " .heap ul li").length;
            return t == 0
        }, _setControlsEvents: function () {
            if (!this._isHeapEmpty()) {
                this._setHeapboxHolderEvents();
                this._setHeapboxHandlerEvents();
                this._setKeyboardEvents();
                this._setSliderEvents()
            }
        }, _isSourceSelectbox: function () {
            this.isSourceElementSelect = e(this.element).is("select")
        }, _isHeapsizeSet: function () {
            return this.options.heapsize ? true : false
        }, _refreshSourceSelectbox: function (t) {
            var n = this;
            var r = false;
            e(this.element).find("option").remove();
            e.each(t, function () {
                option = e("<option/>", {value: this.value, text: this.text});
                if (this.selected) {
                    option.attr("selected", "selected");
                    r = true
                }
                e(n.element).append(option)
            });
            if (r != true)
                e(n.element).find("option").first().attr("selected", "selected")
        }, _setSelectedOption: function (t) {
            var n = this;
            this._deselectSelectedOptions();
            e(this.element).val(t);
            e(this.element).find("option[value='" + t + "']").attr("selected", "selected")
        }, _deselectSelectedOptions: function () {
            select = e(this.element).find("option");
            select.each(function () {
                e(this).removeAttr("selected")
            })
        }, _setHeapboxHolderEvents: function () {
            var t = this;
            heapBoxEl = e("div#heapbox_" + this.instance.heapId);
            heapBoxEl.find(".holder").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                t._setHeapboxFocus();
                t._handlerClicked()
            })
        }, _setHeapboxHandlerEvents: function () {
            var t = this;
            heapBoxEl = e("div#heapbox_" + this.instance.heapId);
            heapBoxEl.find(".handler").click(function (n) {
                n.preventDefault();
                n.stopPropagation();
                e(this).focus();
                t._handlerClicked()
            })
        }, _removeHeapboxHolderEvents: function () {
            var t = this;
            heapBoxEl = e("div#heapbox_" + this.instance.heapId);
            heapBoxEl.find(".holder").unbind("click");
            heapBoxEl.find(".holder").click(function (e) {
                e.preventDefault()
            });
            heapBoxEl.unbind("keydown")
        }, _removeHeapboxHandlerEvents: function () {
            var t = this;
            heapBoxEl = e("div#heapbox_" + this.instance.heapId);
            heapBoxEl.find(".handler").unbind("click");
            heapBoxEl.find(".handler").click(function (e) {
                e.preventDefault()
            })
        }, _handlerClicked: function (e) {
            if (this.instance.state) {
                this._closeheap()
            } else {
                if (!e)
                    this._closeOthers();
                else
                    this._openheap()
            }
        }, _heapChanged: function (t, n, r) {
            if (!r)
                this._closeheap(true, function () {}, function () {});
            this._setSelected(e(n));
            this._setHolderTitle();
            this._setHeapboxFocus();
            this._setSelectedOption(e(n).attr("rel"));
            this.options.onChange(e(n).attr("rel"))
        }, _setSelected: function (e) {
            this._deselectAll();
            e.addClass("selected")
        }, _deselectAll: function (t) {
            heapLinks = e("#heapbox_" + this.instance.heapId).find(".heap ul li a");
            heapLinks.each(function () {
                e(this).removeClass("selected")
            })
        }, _closeheap: function (t, n, r) {
            heapEl = e("#heapbox_" + this.instance.heapId).find(".heap");
            if (heapEl.is(":animated") && !t)
                return false;
            this.instance.state = false;
            if (t) {
                n = n;
                r = r
            } else {
                n = this.options.closeStart;
                r = this.options.closeComplete
            }
            n.call();
            switch (this.options.effect.type) {
                case"fade":
                    heapEl.fadeOut(this.options.effect.speed, r);
                    break;
                case"slide":
                    heapEl.slideUp(this.options.effect.speed, r);
                    break;
                case"standard":
                    heapEl.css("display", "none");
                    r.call();
                    break;
                default:
                    heapEl.slideUp(this.options.effect.speed, r);
                    break
            }
        }, _openheap: function () {
            heapEl = e("#heapbox_" + this.instance.heapId).find(".heap");
            if (heapEl.is(":animated"))
                return false;
            this.instance.state = true;
            this.options.openStart.call();
            switch (this.options.effect.type) {
                case"fade":
                    heapEl.fadeIn(this.options.effect.speed, this.options.openComplete);
                    break;
                case"slide":
                    heapEl.slideDown(this.options.effect.speed, this.options.openComplete);
                    break;
                case"standard":
                    heapEl.css("display", "block");
                    this.options.openComplete.call();
                    break;
                default:
                    heapEl.slideDown(this.options.effect.speed, this.options.openComplete);
                    break
            }
        }, _closeOthers: function () {
            var t = this;
            e("div[id^=heapbox_]").each(function (n) {
                el = e("div#" + e(this).attr("id"));
                if (el.data("sourceElement")) {
                    sourceEl = e.data(this, "sourceElement");
                    heapBoxInst = e.data(sourceEl, "plugin_" + i);
                    if (t.instance.heapId != heapBoxInst.instance.heapId) {
                        if (heapBoxInst.instance.state) {
                            t._callbackManager("change", "_closeOthers", true);
                            heapBoxInst._closeheap(true, function () {}, function () {
                                t._callbackManager("change", "_closeOthers", false)
                            })
                        }
                    }
                }
            });
            t._callbackManager("test", "_closeOthers")
        }, _callbackManager: function (e, t, n) {
            if (!this.callbackManager[t])
                this.callbackManager[t] = 0;
            if (e == "change") {
                n ? this.callbackManager[t]++ : this.callbackManager[t]--;
                this._callbackManager("test", t)
            } else if (e == "test") {
                if (this.callbackManager[t] == 0)
                    this._handlerClicked(true)
            }
        }, set: function (e) {
            this._setData(e);
            this._setHolderTitle();
            this._setEvents()
        }, update: function () {
            this._setDefaultValues()
        }, _hideSourceElement: function () {
            e(this.element).css("display", "none")
        }, _showSourceElement: function () {
            e(this.element).css("display", "block")
        }, hide: function () {
            e("div#heapbox_" + this.instance.heapId).css("visibility", "hidden")
        }, show: function () {
            e("div#heapbox_" + this.instance.heapId).css("visibility", "visible")
        }, disable: function () {
            heapBoxEl = e("div#heapbox_" + this.instance.heapId);
            heapBoxEl.addClass("disabled");
            this._removeHeapboxHandlerEvents();
            this._removeHeapboxHolderEvents();
            return this
        }, enable: function () {
            heapBoxEl = e("div#heapbox_" + this.instance.heapId);
            heapBoxEl.removeClass("disabled");
            this._setEvents();
            return this
        }};
    e.fn[i] = function (t, n) {
        return this.each(function () {
            if (!e.data(this, "plugin_" + i)) {
                e.data(this, "plugin_" + i, new o(this, t))
            } else {
                heapBoxInst = e.data(this, "plugin_" + i);
                switch (t) {
                    case"update":
                        heapBoxInst.update();
                        break;
                    case"set":
                        heapBoxInst.set(n);
                        break;
                    case"hide":
                        heapBoxInst.hide();
                        break;
                    case"show":
                        heapBoxInst.show();
                        break;
                    case"disable":
                        heapBoxInst.disable();
                        break;
                    case"enable":
                        heapBoxInst.enable();
                        break
                }
            }
        });
    };
})(jQuery, window, document);