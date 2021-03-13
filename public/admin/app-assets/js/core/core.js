var active_modal = "";
var modal_delay = 300;
var baseURL = "";
var fnPositiveButton, fnNegativeButton;
var csrfParam = '_token';

function ajaxTransfer(url, data, callback){
	var response, csrfToken;
	url = baseURL + url;

	if(!(data instanceof FormData)){
		data = Object.toFormData(data);
	}

	csrfToken = $('input[name='+csrfParam+']').val();
	data.append(csrfParam, csrfToken);

	showLoading();
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);
	xhr.onload = function () {
		response = xhr.responseText;
		if (xhr.status === 200) {
			if(typeof callback == 'string'){
				$(callback).html(response);
			} else{
				callback(response);
			}

			setInputPlaceholder();
			validateRequiredInput();
		} else {
			console.log('ajax error! status : ' + xhr.status);
			console.log(xhr);
			$('.modal-body').append('<div class="alert alert-danger">Data tidak ditemukan</div>');
		}

		hideLoading();
	};
	xhr.send(data);
}

function modalAlert(title, message){
	$('.modal-backdrop, #modal-target.modal').remove();

    var modal_box = "";
	modal_box += "<div aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' id='modal-target' class='modal fade' style='display: none;'>";
	modal_box += "<div class='modal-dialog modal-dialog-scrollable'>";
	modal_box += "<div class='modal-content'>";
	modal_box += "<div class='modal-header'>";
	modal_box += "<h5 class='modal-title'>" + title + "</h5>";
	modal_box += "<button aria-hidden='true' data-dismiss='modal' class='close' onclick='removeModal(this)' rel='modal-target' type='button'>&#215;</button>";
	modal_box += "</div>";
	modal_box += "<div id='modal-output' class='modal-body'>"+message+"</div>";
	modal_box += "</div>";
	modal_box += "</div>";
	modal_box += "</div>";

	$('html').append(modal_box);
	$('#modal-target').modal('show');
}

function modalConfirm(title, message, positiveButton, negativeButton){
	if(typeof(positiveButton) == 'function'){
		fnPositiveButton = positiveButton;
	}
	if(typeof(negativeButton) == 'function'){
		fnNegativeButton = negativeButton;
	}

	$('.modal-backdrop, #modal-target.modal').remove();

	var modal_box = "";
    modal_box += "<div aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' id='modal-target' class='modal fade' style='display: none;'>";
	modal_box += "<div class='modal-dialog modal-dialog-scrollable'>";
	modal_box += "<div class='modal-content'>";
	modal_box += "<div class='modal-header bg-danger white'>";
	modal_box += "<h5 class='modal-title'>" + title + "</h5>";
	modal_box += "<button aria-hidden='true' data-dismiss='modal' class='close' onclick='removeModal(this)' rel='modal-target' type='button'>&#215;</button>";
	modal_box += "</div>";
	modal_box += "<div id='modal-output' class='modal-body'>"+message+"</div>";
	modal_box += '<div class="modal-footer"><button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" onclick="positiveButtonClick()">Ya</button></div>';
	modal_box += "</div>";
	modal_box += "</div>";
	modal_box += "</div>";

	$('html').append(modal_box);
	$('#modal-target').modal('show');
}

function positiveButtonClick(){
	if(typeof(fnPositiveButton) != 'function'){
		return false;
	} else{
		fnPositiveButton();
	}
}

function negativeButtonClick(){
	if(typeof(fnNegativeButton) != 'function'){
		closeModal();
	} else{
		fnNegativeButton();
	}
}

function loadModal(t){
	t.setAttribute('href', '#modal-target');
	t.setAttribute('data-toggle', 'modal');

	var title = t.getAttribute('title');
	if(title == null) title = t.innerHTML;
	$('.modal-backdrop, #modal-target.modal').remove();

	var modal_box = "";
	modal_box += "<div aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' id='modal-target' class='modal fade' style='display: none;'>";
	modal_box += "<div class='modal-dialog modal-dialog-scrollable'>";
	modal_box += "<div class='modal-content'>";
	modal_box += "<div class='modal-header'>";
	modal_box += "<h5 class='modal-title'>" + title + "</h5>";
	modal_box += "<button aria-hidden='true' data-dismiss='modal' class='close' onclick='removeModal(this)' rel='modal-target' type='button'>&#215;</button>";
	modal_box += "</div>";
	modal_box += "<div id='modal-output' class='modal-body'></div>";
	modal_box += "</div>";
	modal_box += "</div>";
	modal_box += "</div>";

	$('html').append(modal_box);

	var data = t.getAttribute('data');
	var ajaxData = new FormData();
	var ajaxUrl = t.getAttribute('target');

	if(data == null){
		data = [];
	} else{
		data = data.split(';');
	}

	for(var i=0; i<data.length; i++){
		if(data[i].length == 0) continue;
		else{
			var temp  = data[i].split('=');
			var key   = temp[0];
			var value = temp[1];

			ajaxData.append(key, value);
		}
	}
	ajaxTransfer(ajaxUrl, ajaxData, '#modal-output');
}

function removeModal(t){
	var modal_id = t.getAttribute('rel');
	$('.modal, .modal-overlay, .modal-backdrop').animate({opacity: 0}, modal_delay);
	setTimeout(function(){
		$('#modal-target.modal, .modal-overlay, .modal-backdrop').remove();
		$('body').removeClass('modal-open');
	}, modal_delay);
}

function closeModal(timeout){
	if(timeout == undefined) $('.modal-header .close').click();
	else{
		timeout = parseInt(timeout);
		setTimeout(function(){
			$('.modal-header .close').click();
		}, timeout);
	}
}

function showLoading(){
	$('#loading-screen').css({display: 'block'});
	$('#loading-screen').animate({opacity: '1'}, 100);
}

function hideLoading(){
	$('#loading-screen').animate({opacity: '0'}, 100);
	setTimeout(function(){
		$('#loading-screen').css({display: 'none'});
	}, 100);
}

function reload(timeout){
	if(timeout == undefined) location.reload();
	else{
		timeout = parseInt(timeout);
		setTimeout(function(){
			location.reload();
		}, timeout);
	}
}

// function initiateLoadingBar(){
// 	var new_element = "";
// 	new_element += "<div id='loading-screen'>";
// 	new_element += "<div id='loading-box'>";
// 	new_element += "<span>Sedang mengolah data, mohon tunggu...</span>";
// 	new_element += "</div>";
// 	new_element += "</div>";
// 	new_element += "<div id='global-temp'></div>";

// 	$(document).ready(function(){
// 		$('body').append(new_element);
// 	});
// }

function getFormData(formId, asObject){
	if(typeof asObject == 'boolean' && asObject){
		var $form = $("#"+formId);
		var unindexed_array = $form.serializeArray();
		var indexed_array = {};

		$.map(unindexed_array, function(n, i){
			indexed_array[n['name']] = n['value'];
		});

		return indexed_array;
	}

	var formData = new FormData();
	var input = $('#'+formId+' input');
	var select = $('#'+formId+' select');
	var textarea = $('#'+formId+' textarea');
	var ignored = ['submit', 'button', 'reset'];
	var i, j, inputType, inputName, inputValue, file, files;

	for(i=0; i<input.length; i++){
		inputType = input[i].getAttribute('type');
		inputName = input[i].getAttribute('name');
		inputValue = input[i].value;

		if(ignored.indexOf(inputType) != -1){
			continue;
		} else if(inputType == 'checkbox'){
			if(!input[i].checked){
				inputValue = null;
			}
			formData.append(inputName, inputValue);
		} else if(inputType == 'radio'){
			inputValue = $('input[name="'+inputName+'"]:checked').val();
			formData.append(inputName, inputValue);
		} else if(inputType == 'file'){
			files = input[i].files;
			for (j=0; j<files.length; j++) {
				file = files[j];
				formData.append(inputName, file, file.name);
			}
		} else{
			formData.append(inputName, inputValue);
		}
	}

	for(i=0; i<select.length; i++){
		inputName = select[i].getAttribute('name');
		inputValue = select[i].value;
		formData.append(inputName, inputValue);
	}

	for(i=0; i<textarea.length; i++){
		inputName = textarea[i].getAttribute('name');
		inputValue = textarea[i].value;
		formData.append(inputName, inputValue);
	}

	return formData;
}

function setInputPlaceholder(){
	var labels = $('label');
	var label, placeholder;

	for(var i=0; i<labels.length; i++){
		label = $(labels[i]).attr('for');
		placeholder = $(labels[i]).html();
		$(labels[i]).parents('form').find('*[name='+label+']').attr('placeholder', placeholder);
	}
}

function pipelineDatatable(tableId, dataUrl, excludeFilter){
	$.fn.dataTable.pipeline = function ( opts ) {
        var conf = $.extend( {
            pages   : 5,
            url     : '',
            data    : null,
            method  : 'POST'
        }, opts );

        var cacheLower = -1;
        var cacheUpper = null;
        var cacheLastRequest = null;
        var cacheLastJson = null;

        return function(request, drawCallback, settings){
            var ajax          = false;
            var requestStart  = request.start;
            var drawStart     = request.start;
            var requestLength = request.length;
            var requestEnd    = requestStart + requestLength;

            if(settings.clearCache){
                ajax = true;
                settings.clearCache = false;
            } else if(cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper){
                ajax = true;
            } else if(JSON.stringify(request.order) !== JSON.stringify(cacheLastRequest.order) || JSON.stringify(request.columns) !== JSON.stringify(cacheLastRequest.columns) || JSON.stringify(request.search) !== JSON.stringify(cacheLastRequest.search)){
                ajax = true;
            }

            cacheLastRequest = $.extend(true, {}, request);
            if(ajax){
                if (requestStart < cacheLower) {
                    requestStart = requestStart - (requestLength*(conf.pages-1));
                    if(requestStart < 0 ){
                        requestStart = 0;
                    }
                }

                cacheLower = requestStart;
                cacheUpper = requestStart + (requestLength * conf.pages);

                request.start = requestStart;
                request.length = requestLength*conf.pages;

                if($.isFunction (conf.data)){
                    var d = conf.data(request);
                    if (d) {
                        $.extend(request, d);
                    }
                } else if ($.isPlainObject(conf.data)){
                    $.extend( request, conf.data );
                }

                settings.jqXHR = $.ajax( {
                    type      : conf.method,
                    url       : conf.url,
                    data      : request,
                    dataType  : 'json',
                    cache     : false,
                    success   : function(json){
                        cacheLastJson = $.extend(true, {}, json);
                        if(cacheLower != drawStart){
                            json.data.splice( 0, drawStart-cacheLower );
                        }
                        json.data.splice( requestLength, json.data.length );
                        drawCallback(json);
                    }
                });
            } else {
                json = $.extend(true, {}, cacheLastJson);
                json.draw = request.draw;
                json.data.splice( 0, requestStart-cacheLower );
                json.data.splice( requestLength, json.data.length );
                drawCallback(json);
            }
        }
    };

    $.fn.dataTable.Api.register('clearPipeline()', function(){
        return this.iterator( 'table', function(settings){
            settings.clearCache = true;
        });
    });

    $(tableId).append('<tfoot></tfoot>');
	$(tableId + ' thead tr').clone().appendTo(tableId + ' tfoot');
	$(tableId + ' thead tr').attr('id', 'head-order');
	//$(tableId + ' thead tr').before("<tr id='head-filter'></tr>");

    $(tableId + ' thead tr#head-order th').each(function(){
        $(this).clone().appendTo(tableId + ' thead tr#head-filter');
    });

    if(typeof(excludeFilter) == "undefined"){
    	excludeFilter = [];
    }

    var index = 0;
    $(tableId + ' thead tr#head-filter th').each(function(){
        $(this).addClass('th-filter');
        if(excludeFilter.indexOf(index) == -1){
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
        } else{
            $(this).html('');
        }
        index++;
    });

    var idx = 0;
    $(tableId).DataTable( {
        processing  : true,
        serverSide  : true,
        iDisplayLength: 25,
        ajax: $.fn.dataTable.pipeline( {
            url: baseURL + dataUrl,
            pages: 5 // number of pages to cache
        } )
    }).columns().every(function(){
        var that = this;
        var elem = $(this.header()).parent().parent().find('#head-filter th');
        var input = $(elem[idx++]).find('input');
        $(input).on('keyup change', function(){
            if(that.search() !== this.value){
                that.search(this.value).draw();
            }
        });
    });

    $(tableId + ' thead tr#head-filter').appendTo('thead');
    $('.dataTables_processing').html('');
}


function dataTable(selector, length){
	$(document).ready(function(){
		$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings ) {
			return {
				"iStart":         oSettings._iDisplayStart,
				"iEnd":           oSettings.fnDisplayEnd(),
				"iLength":        oSettings._iDisplayLength,
				"iTotal":         oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
				"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
			};
		}

        if(typeof(length) == 'undefined'){
            length = 25;
        }

		$(selector).DataTable({
			'iDisplayLength': length,
			'fnDrawCallback': function(x) {
				var currentPage = this.fnPagingInfo().iPage;
				var displayLength = this.fnPagingInfo().iLength;
				var page = (currentPage * displayLength) + 1;
				rearrangeDataTableNumbering(selector, page);
			}
		});
	});
}

function rearrangeDataTableNumbering(selector, page){
	var firstField = $(selector).find('th:first-child').html().toLowerCase();
	if(firstField == 'no'){
		var trList = $(selector).find('tbody tr');
		for(var i=0; i<trList.length; i++){
			$(trList[i]).find('td:first-child').html(page+i);
		}
	}
}

function dataTables(selector){
    $(document).ready(function(){
        $(selector).DataTable({
            'iDisplayLength': 25,
            "order": []
        });
    });
}

function setActiveMenu(url){
	if(typeof(url) == 'undefined'){
		url = document.URL;
	}
	$('li').has('a[href="'+url+'"]').addClass('active');
}

function validateRequiredInput(){
	var required = $(':required');
	for(var i=0; i<required.length; i++){
		$(required[i]).blur(function(t){
			var element = t.currentTarget;
			var value = $(element).val();
			var parent = $(element).parent();

			if(value.length == 0){
				$(parent).addClass('has-error');
			} else{
				$(parent).removeClass('has-error');
			}
		});
	}
}

function redirect(timeout, url){
    if(timeout == undefined) location.reload();
    else{
      timeout = parseInt(timeout);
      setTimeout(function(){
        window.location= baseURL+url;
      }, timeout);
    }
  }

function scrollToTop(){
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
 }

function chevronActive(classname){
    $('.chevron-shapes li').removeClass('active');
    $('.chevron-shapes li.'+classname).addClass('active');
}

function isValidDate(dateString){
    // First check for the pattern
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
        return false;

    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
};

function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function getCsrfToken(){
    return $('input[name='+csrfParam+']').val();
}

$(document).ready(function(){
	setActiveMenu(document.URL);
    // initiateLoadingBar();
	setInputPlaceholder();
	validateRequiredInput();
})