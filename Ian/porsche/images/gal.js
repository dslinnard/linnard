//Popup
function gal_register(id, styleid, position, noimage, x, y)
{
        if (typeof gal == 'object')
        {
                return gal.register(id, styleid, position, noimage, x, y);
        }
        //alert("gal registered " + id);
}

var GEEK_GAL_POPUP 		= 1;
var GEEK_GAL_FOLLOW 		= 2;
var GEEK_GAL_STICK 		= 3;

var GEEK_GAL_BOTTOM_LEFT	= 1;
var GEEK_GAL_BOTTOM_RIGHT	= 2;
var GEEK_GAL_TOP_LEFT 		= 3;
var GEEK_GAL_TOP_RIGHT 		= 4;


function geek_gal()
{
        this.slide_open = (is_opera || is_saf ? false : true);
        this.open_fade = true;
        this.active = false;
        this.popups = new Array();
        this.activepopup = null;
        this.hidden_selects = new Array();
}

		geek_gal.prototype.fetch_offset = function(obj)
		{
		        var l = obj.offsetLeft;
		        var t = obj.offsetTop;
		        var r = obj.offsetWidth;
		        var b = obj.offsetHeight

		        while ((obj = obj.offsetParent) != null)
		        {
		                l += obj.offsetLeft;
		                t += obj.offsetTop;
		        }

		        var r = r + l;
		        var b = b + t;
		        var h = b - t;
		        var w = r - l;

		        return { 'l' : l, 't' : t, 'r' : r, 'b' : b, 'h' : h, 'w' : w};
		};

		geek_gal.prototype.activate = function(active)
		{
		        this.active = active;
		};

		geek_gal.prototype.register = function(id, styleid, position, noimage, x, y)
		{
		        if (!this.popups[id])
		        {
					this.popups[id] = new geek_gal_popup(id, styleid, position, noimage, x, y);
		        }
		        return this.popups[id];
		};

		geek_gal.prototype.hide = function(force)
		{
		        if (this.activegal != null)
		        {
		                this.popups[this.activegal].hide(force);
		        }
		};

		geek_gal.prototype.tick = function()
		{
			this.clock = setTimeout("gal.tick();", this.tick_count);

	        if (this.activegal == null)
	        {
	        	return;
	        }

	        if (this.popups[this.activegal].styleid == GEEK_GAL_STICK)
	        {
	        	return;
	        }

	        if (this.popups[this.activegal].styleid == GEEK_GAL_FOLLOW)
	        {
	        	this.popups[this.activegal].pos = gal.fetch_offset(fetch_object(this.activegal));
	        	this.popups[this.activegal].reposition(this.mouseX, this.mouseY);
	        }

	        if (this.tick_clock < 10)
	        {
	        	this.tick_clock ++;
	        	return;
	        }
	        else
	        {
	        	this.tick_clock = 0;
	        }

	        if (this.tick_locked == true)
	        {
	        	return;
	        }
	        else
	        {
	        	this.tick_locked = true;
	        }

	        this.ticker ++;
	        //window.status = this.ticker;

	        var test = false;
	        var test2 = false;

	        if (this.activegal != null)
	        {
	        	test = this.popups[this.activegal].hit_test(this.mouseX, this.mouseY);
	        	test2 = this.popups[this.activegal].anchors[this.activelink].hit_test(this.mouseX, this.mouseY);

	        	//window.status = "content: " + test + " link: " +test2;
	        }

	        if (this.popups[this.activegal].styleid != GEEK_GAL_FOLLOW && !test2)
	        {
	        	this.hide();
	        }
	        else
	        {
		      if (!test && !test2 && this.popups[this.activegal].styleid != GEEK_GAL_FOLLOW)
		      {
		      	this.hide();
		      }
	        }

	        this.tick_locked = false;
		};


//anchors
function geek_gal_anchor(id, contentid, noimage)
{
        this.id = id;
        this.contentid = contentid;
        this.noimage = noimage;
        return this.register(id, contentid, noimage);
}

		geek_gal_anchor.prototype.hit_test = function(mouseX, mouseY)
		{

			var client = gal_clientarea();

			y = mouseY;
			x = mouseX;

			e = fetch_object(this.id);
			a = gal.fetch_offset(e);

			a.t -= client.h;
			a.b -= client.h;

			a.l -= client.w;
			a.r -= client.w;

			//window.status = mouseX;
	        if ((x > a.l) && (x < (a.r)) && (y > a.t) && (y < (a.b)))
	        {
	        	return true;
	        }
	        else
	        {
	        	return false;
	        }

		};

		geek_gal_anchor.prototype.register = function(id, contentid, noimage)
		{
		        this.contentid = contentid;

		        a = fetch_object(id);
				a.contentid = contentid;
				a.style.cursor = pointer_cursor;
		        //a.onclick = geek_gal_popup_events.prototype.controlobj_onclick;
		        a.onmouseover = geek_gal_popup_events.prototype.controlobj_onmouseover;

		        return this;
		};


//popup object
function geek_gal_popup(id, styleid, position, noimage, x, y)
{
        this.id = id;
        this.styleid = styleid;
        this.positionid = position;
        this.open_steps = gal.open_steps;
        this.open_fade = gal.open_fade;
        this.offx = (x * 1);
        this.offy = (y * 1);

        this.direction = (position == 1 || position == 3 ? 'left' : 'right');
        this.anchors = new Array();

        var a = fetch_tags(document, 'a');

        for (var i = 0; i < a.length; i++)
        {
                if (a[i].id && a[i].id.substr(0, id.length) == id)
                {
                        this.anchors[a[i].id] = new geek_gal_anchor(a[i].id, id, noimage);
                }
        }
        this.tick = geek_gal_popup_events.prototype.controlobj_tick;
        gal.tick();
}

	geek_gal_popup.prototype.init_gal = function()
	{
	        this.galobj = fetch_object(this.id);

	        if (this.galobj && !this.galobj.initialized)
	        {
	                this.galobj.initialized = true;
	                this.galobj.onclick = e_by_gum;
	                this.galobj.style.position = 'absolute';
	                this.galobj.style.zIndex = 50;

	                if (is_ie && !is_mac)
	                {
	                        this.galobj.style.filter += "progid:DXImageTransform.Microsoft.alpha(enabled=1,opacity=100)";
	                        this.galobj.style.filter += "progid:DXImageTransform.Microsoft.shadow(direction=135,color=#8E8E8E,strength=3)";
	                }
	        }
	};

	geek_gal_popup.prototype.reposition = function(x, y)
	{
		var l = 0;
		var t = 0;
		var client = gal_clientarea();
		var anchor = this.pos;

		e = fetch_object(this.id);

		if (e.style.display != '')
		{
			return;
		}

		if (this.positionid == GEEK_GAL_BOTTOM_RIGHT)
		{
			if (this.styleid == GEEK_GAL_FOLLOW)
        		{
				l = x - e.offsetWidth + client.w - 10 + this.offx;
				t = y + client.h + this.offy;
        		}
        		else
        		{
        			//l = anchor.r - e.offsetWidth + document.documentElement.scrollLeft + this.offx;
        			//t = anchor.b - document.documentElement.scrollTop + this.offy;
				l = (anchor.r - e.offsetWidth) + this.offx;
                		t = anchor.b + this.offy;
        		}
		}
		else if (this.positionid == GEEK_GAL_TOP_RIGHT)
		{
			if (this.styleid == GEEK_GAL_FOLLOW)
        		{
				l = x - e.offsetWidth + client.w - 10 + this.offx;
				t = y - e.offsetHeight + client.h + this.offy;
	        		if (t < (client.h + 10))
	            	{
	            		t = client.h + 10 + this.offy;
	            	}
        		}
        		else
        		{
				//l = anchor.r - e.offsetWidth + document.documentElement.scrollLeft + this.offx;
				t = anchor.t - e.offsetHeight + this.offy; //document.documentElement.scrollTop
	        		l = (anchor.r - e.offsetWidth) + this.offx;
				if (t < 1)
	            	{
	            		//t = anchor.b + this.offy;
					t = anchor.t + 10;
	            	}
        		}
		}
		else if (this.positionid == GEEK_GAL_TOP_LEFT)
		{
			if (this.styleid == GEEK_GAL_FOLLOW)
        		{
				l = x + client.w - 10 + this.offx;
				t = y - e.offsetHeight + client.h + this.offy;
	        		if (t < (client.h + 10))
	            	{
	            		t = client.h + 10 + this.offy;
	            	}
        		}
        		else
        		{
				//l = anchor.l - document.documentElement.scrollLeft + this.offx;
				t = anchor.t - e.offsetHeight;// - document.documentElement.scrollTop;
				l = anchor.l + this.offx;
	        		if (t < 1)
	            	{
					//alert ("poop");
					//alert(t + ' ' + y + ' ' + anchor.t + ' ' + e.offsetHeight + ' ' + anchor.b + ' ' + this.offy + ' ' + l);
		            	//t = anchor.b + this.offy;
					t = anchor.t + 10;
	            	}
        		}
		}
		else
		{
	        	if (this.styleid == GEEK_GAL_FOLLOW)
	        	{
	        		l = x + client.w - 10 + this.offx;
	        		t = y + client.h + this.offy;
	        	}
	        	else
	        	{
                		l = anchor.l + this.offx;
                		t = anchor.b + this.offy;
	        	}
		}

		if (l < 1)
		{
			l = 10;
		}
		if (l + e.offsetWidth + client.w > client.r)
		{
			l = client.r - e.offsetWidth - 20;
		}

        e.style.left = l + "px";
        e.style.top = t + "px";
	};

	geek_gal_popup.prototype.hit_test = function(mouseX, mouseY)
	{

		var client = gal_clientarea();

		y = mouseY;
		x = mouseX;

		e = fetch_object(this.id);
		a = gal.fetch_offset(e);

		a.t -= client.h;
		a.b -= client.h;

		a.l -= client.w;
		a.r -= client.w;

        if ((x > a.l) && (x < (a.r)) && (y > a.t) && (y < (a.b)))
        {
        	return true;
        }
        else
        {
        	return false;
        }
	};

	geek_gal_popup.prototype.show = function(obj)
	{
	        if (!gal.active)
	        {
	                return false;
	        }
	        else if (!this.galobj)
	        {
	                this.init_gal();
	        }

	        if (!this.galobj)
	        {
	                return false;
	        }

	        if (gal.activegal != null)
	        {
	            gal.tick_decayer = 0;
	        	gal.popups[gal.activegal].hide(true);
	        }

	        //window.status = "styleid " + this.styleid + " position " + this.positionid;

	        gal.activegal = this.id;
	        gal.activelink = obj.id;

	        if (gal.tick_decay)
	        {
	        	gal.tick_decayer = 1;
	        }
			this.galobj.style.clip = 'rect(auto, auto, auto, auto)';
			this.contentpos = gal.fetch_offset(fetch_object(this.id));

			//alert(this.offx + " :: "  + this.offy);

			this.galobj.style.display = '';

	        if (this.position == GEEK_GAL_FOLLOW)
	        {
	        	this.reposition(gal.mouseX, gal.mouseY);
	        }
	        else
	        {
		        this.pos = gal.fetch_offset(obj);
		        //alert(this.pos['l']);
		        //this.pos['l'] = (this.offx * 1) + (this.pos['l'] * 1);
		        //alert(this.pos['l']);
		        //this.pos['t'] -= this.offy;
	        	this.reposition(0, 0);
	        }


			if (gal.slide_open)
			{
				this.galobj.style.clip = 'rect(auto, 0px, 0px, auto)';
			}

			if (gal.slide_open)
			{
				this.intervalX = Math.ceil(this.galobj.offsetWidth / this.open_steps);
				this.intervalY = Math.ceil(this.galobj.offsetHeight / this.open_steps);
				this.slide((this.direction == 'left' ? 0 : this.galobj.offsetWidth), 0, 0);
			}
			else if (this.galobj.style.clip && this.slide_open)
			{
				this.galobj.style.clip = 'rect(auto, auto, auto, auto)';
			}

	        this.handle_overlaps(true);
	        gal.tick();
	};

	geek_gal_popup.prototype.hide = function(e)
	{

			if (gal.tick_decayer > 0 && e != true)
			{
				this.slidetimer = setTimeout("gal.popups[gal.activegal].decay_hide()", gal.tick_decay);
				return;
			}

			this.galobj.style.display = 'none';
	        this.handle_overlaps(false);
	        this.activegal = null;
	        this.activelink = null;
	        clearTimeout(gal.clock);
	};

	geek_gal_popup.prototype.decay_hide = function()
	{//alert("yo");
		gal.tick_decayer = null;
	};

	geek_gal_popup.prototype.hover = function(obj)
	{
	        this.show(obj, true);
	};

	geek_gal_popup.prototype.overlaps = function(obj, obj2)
	{
	        var s = new Array();
	        var pos = gal.fetch_offset(obj);

	        l = pos.l;
	        t = pos.t;
	        r = l + obj.offsetWidth;
	        h = t + obj.offsetHeight;


	        if (l > obj2.r || r < obj2.l || t > obj2.b || h < obj2.t)
	        {
				return false;
	        }
	        else
	        {
	        	return true;
	        }
	};

	geek_gal_popup.prototype.handle_overlaps = function(dohide)
	{
	        if (1==2 && is_ie && typeof(gal.hidden_selects) != 'undefined')
	        {
	                var selects = fetch_tags(document, 'select');

	                if (dohide)
	                {
	                        var galarea = new Array();

	                        galarea = {
	                                'l' : this.leftpx,
	                                'r' : this.leftpx + this.galobj.offsetWidth,
	                                't' : this.toppx,
	                                'h' : this.toppx + this.galobj.offsetHeight
	                        };

	                        for (var i = 0; i < selects.length; i++)
	                        {
	                                if (this.overlaps(selects[i], galarea))
	                                {
	                                        var hide = true;
	                                        var s = selects[i];
	                                        while (s = s.parentNode)
	                                        {
	                                                if (s.className == 'vbmenu_popup')
	                                                {
	                                                        hide = false;
	                                                        break;
	                                                }
	                                        }

	                                        if (hide)
	                                        {
	                                                selects[i].style.visibility = 'hidden';
	                                                array_push(gal.hidden_selects, i);
	                                        }
	                                }
	                        }
	                }
	                else
	                {
	                        while (true)
	                        {
	                                var i = array_pop(gal.hidden_selects);
	                                if (typeof i == 'undefined' || i == null)
	                                {
	                                        break;
	                                }
	                                else
	                                {
	                                        selects[i].style.visibility = 'visible';
	                                }
	                        }
	                }
	        }
	};

	geek_gal_popup.prototype.slide = function(clipX, clipY, opacity)
	{
		if (this.direction == 'left' && (clipX < this.galobj.offsetWidth || clipY < this.galobj.offsetHeight))
		{
			if (gal.open_fade && is_ie)
			{
				opacity += 5;
				this.galobj.filters.item('DXImageTransform.Microsoft.alpha').opacity = opacity;
			}

			clipX += this.intervalX;
			clipY += this.intervalY;

			this.galobj.style.clip = "rect(auto, " + clipX + "px, " + clipY + "px, auto)";
			this.slidetimer = setTimeout("gal.popups[gal.activegal].slide(" + clipX + ", " + clipY + ", " + opacity + ");", 0);
		}
		else if (this.direction == 'right' && (clipX > 0 || clipY < this.galobj.offsetHeight))
		{
			if (gal.open_fade && is_ie)
			{
				opacity += 5;
				this.galobj.filters.item('DXImageTransform.Microsoft.alpha').opacity = opacity;
			}

			clipX -= this.intervalX;
			clipY += this.intervalY;

			this.galobj.style.clip = "rect(auto, " + this.galobj.offsetWidth + "px, " + clipY + "px, " + clipX + "px)";
			this.slidetimer = setTimeout("gal.popups[gal.activegal].slide(" + clipX + ", " + clipY + ", " + opacity + ");", 0);
		}
		else
		{
			this.stop_slide();
		}
	};

	geek_gal_popup.prototype.stop_slide = function()
	{
		clearTimeout(this.slidetimer);

		this.galobj.style.clip = 'rect(auto, auto, auto, auto)';

		if (gal.open_fade && is_ie)
		{
			this.galobj.filters.item('DXImageTransform.Microsoft.alpha').opacity = 100;
		}
	};


//Events
function geek_gal_popup_events()
{
};

geek_gal_popup_events.prototype.controlobj_tick = function()
{
        setTimeout("gal.tick();", 100);
        //alert("yo");
};

geek_gal_popup_events.prototype.controlobj_onclick = function(e)
{
        if (typeof do_an_e == 'function')
        {
                do_an_e(e);
                if (gal.activemenu == null || gal.menus[gal.activemenu].controlkey != this.id)
                {
                        gal.popups[this.id].show(this);
                        gal.activelink = e.id;
                        //alert(this.id + " SS " + e.id);
                }
                else
                {
                        gal.popups[this.id].hide();
                }
        }
};

geek_gal_popup_events.prototype.controlobj_onmouseover = function(e)
{
        if (typeof do_an_e == 'function')
        {
                do_an_e(e);
                gal.popups[this.contentid].hover(this);
        }
};

geek_gal_popup_events.prototype.controlobj_onmouseout = function(e)
{
    var tempx = 0;
    if (is_ie)
    {
            tempX = event.clientX;
            tempY = event.clientY;
    }
    else
    {
            tempX = e.clientX ;
            tempY = e.clientY;
    }
    this.style.cursor = pointer_cursor;
};

geek_gal_popup_events.prototype.menuoption_onclick_function = function(e)
{
        this.ofunc(e);
        gal.gals[this.controlkey].hide();
};

geek_gal_popup_events.prototype.menuoption_onclick_link = function(e)
{
        e = e ? e : window.event;

        if (e.shiftKey)
        {
                window.open(this.href);
        }
        else
        {
                window.location = this.href;
        }

        e.cancelBubble = true;
        if (e.stopPropagation) e.stopPropagation();
        if (e.preventDefault) e.preventDefault();

        gal.gals[this.controlkey].hide();
        return false;
};

geek_gal_popup_events.prototype.popupoption_onmouseover = function(e)
{
        this.className = 'vbmenu_hilite' + (this.islink ? ' vbmenu_hilite_alink' : '');
        this.style.cursor = pointer_cursor;
};

geek_gal_popup_events.prototype.popupoption_onmouseout = function(e)
{
        this.className = 'vbmenu_option' + (this.islink ? ' vbmenu_option_alink' : '');
        this.style.cursor = 'default';
};


//common functions
function gal_hide(e)
{
        if (e && e.button && e.button != 1 && e.type == 'click')
        {
                return true;
        }
        else
        {
                gal.hide(true);
        }
};

function geek_gal_ajax(obj, postid)
{
        if (typeof gal != 'undefined')
        {
                var divs = fetch_tags(obj, 'div');
                for (var i = 0; i < divs.length; i++)
                {
                        if (divs[i].id && divs[i].id.substr(0, 9) == 'postmenu_')
                        {
                                gal.register(divs[i].id, true);
                        }
                }
        }
}

function gal_clientarea()
{
	  var w = 0;
	  var h = 0;
	  var r = 0;
	  var b = 0;

	  if (typeof(window.innerWidth) == 'number')
	  {
	    r = window.innerWidth;
	    b = window.innerHeight;

	  }
	  else if(document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight))
	  {
	    r = document.documentElement.clientWidth;
	    b = document.documentElement.clientHeight;
	  }
	  else if(document.body && (document.body.clientWidth || document.body.clientHeight))
	  {
		r = document.body.clientWidth;
		b = document.body.clientHeight;
	  }
	  if(typeof(window.pageYOffset) == 'number')
	  {
	    h = window.pageYOffset;
	    w = window.pageXOffset;
	  }
	  else if(document.body && (document.body.scrollLeft || document.body.scrollTop))
	  {
	    h = document.body.scrollTop;
	    w = document.body.scrollLeft;
	  }
	  else if(document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop))
	  {
	    h = document.documentElement.scrollTop;
	    w = document.documentElement.scrollLeft;
	  }
		//window.status = " nw " + w + " nh " + h + " st " + document.documentElement.scrollTop;
	  return {'w' : w, 'h' : h, 'r' : r, 'b' : b};
}

function gal_mouse_move(e)
{
	if (typeof gal == 'object')
	{
		var client = gal_clientarea();
            if (is_ie)
            {
			gal.mouseX = event.clientX + client.w;
			gal.mouseY = event.clientY + client.h;

            }
            else
            {
			gal.mouseX = e.clientX;
			gal.mouseY = e.clientY;
            }
	}
}

//INI
function geek_gal_register_all()
{
	if (typeof geek_gal_to_register == Array())
	{
	  //alert("uo2 " + geek_gal_to_register.length);
        for (var i = 0; i < geek_gal_to_register.length; i++)
        {
        	gal.register(geek_gal_to_register[i].id, geek_gal_to_register[i].styleid, geek_gal_to_register[i].posititonid);
        }
	}
}

var gal = new geek_gal();
gal.hidden_selects = new Array();

if (typeof gal == 'object')
{
	  gal.open_steps = gal_open_steps;
        gal.tick_count = gal_tick_count; // Ticker (in milliseconds).
        gal.tick_steps = gal_tick_steps; // Checker (every x amount of times)
        gal.tick_decay = gal_tick_decay;
        gal.tick_clock = 0; 			 //current tick
        gal.ticker = 0;
        gal.decay = 0;

	  if (window.attachEvent && !is_saf)
        {
                document.attachEvent('onclick', gal_hide);
                window.attachEvent('onresize', gal_hide);
        }
        else if (document.addEventListener && !is_saf)
        {
                document.addEventListener('click', gal_hide, false);
                window.addEventListener('resize', gal_hide, false);
        }
        else
        {
                window.onclick = gal_hide;
                window.onresize = gal_hide;
        }

        gal.activate(true);
        var oldonload = window.onload;

        if (typeof window.onload != 'function')
        {
			window.onload = geek_gal_register_all;
	  }
	  else
	  {
		    window.onload = function()
		    {
				if (oldonload)
				{
					oldonload();
				}
				geek_gal_register_all();
			};
	  }

	var oldmove = document.documentElement.onmousemove;

	if (typeof document.documentElement.onmousemove != 'function')
	{
		document.onmousemove = gal_mouse_move;
	}
	else
	{
	    document.documentElement.onmousemove = function()
	    {
			if (oldmove)
			{
				oldmove();
			}
			gal_mouse_move();
		};
	}
}
