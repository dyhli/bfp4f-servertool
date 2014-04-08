/**
 * BattlefieldTools.com BFP4F ServerTool
 * Version 0.7.2
 *
 * Copyright (C) 2014 <Danny Li> a.k.a. SharpBunny
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 */

$(document).ready(function() {	
	
	$('[rel=tooltip]').tooltip();
	$('[rel=popover]').popover();
	$('.selectpicker').selectpicker();
	
	$('table th input:checkbox').on('click', function(){
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox').each(function(){
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
	});
	
	$('.db-item.disabled, .db-item.disabled a, li.disabled').each(function() {
		$(this).click(function() { return false }).attr('onclick', false)
	});
	
	$('a[data-toggle="tab"]').on('shown', function (e) {
		localStorage.setItem('lastTab', $(e.target).attr('id'));
	});

	if(window.location.hash){
		$('.tabs-nav').find('a[href="'+window.location.hash+'"]').tab('show');
	}
	
});

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

String.prototype.toHHMMSS = function () {
	var sec_num = parseInt(this, 10); // don't forget the second parm
	var hours   = Math.floor(sec_num / 3600);
	var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
	var seconds = sec_num - (hours * 3600) - (minutes * 60);

	if (hours   < 10) {hours   = "0"+hours;}
	if (minutes < 10) {minutes = "0"+minutes;}
	if (seconds < 10) {seconds = "0"+seconds;}
	var time    = hours+':'+minutes+':'+seconds;
	return time;
}

function Interval(fn, time) {
    var timer = false;
    this.start = function() {
        if(!this.isRunning())
            timer = setInterval(fn, time);
    };
    this.stop = function() {
        clearInterval(timer);
        timer = false;
    };
    this.toggle = function() {
    	if(!this.isRunning()) {
    		this.start();
    	} else {
    		this.stop();
    	}
    };
    this.isRunning = function() {
        return timer !== false;
    };
}