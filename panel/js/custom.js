/**
 * Battlefield Play4free Servertool
 * Version 0.4.1
 * 
 * Copyright 2013 Danny Li <SharpBunny> <bfp4f.sharpbunny@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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