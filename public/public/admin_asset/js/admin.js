$ (document).ready (function () {
	
	$ ('select').niceSelect ();
	//preloader
	$ (window).load (function () {
		$ ("html").removeClass ("loader");
		$ (".loader").css ({display : "none"});
		$ (".text").animate ({opacity : "1"});
	});
	
	// get schedule available
	var listHourDefault = [];
	$.ajax ({
		type    : 'GET',
		url     : 'get-list-hour',
		success : function (res) {
			listHourDefault = res;
			let time        = $ (".dayOfSchedule option:selected").val ();
			if (time) {
				getConfig (time);
			}
		}
	});
	
	$ ("select.dayOfSchedule").change (function () {
		var time = $ (this).children ("option:selected").val ();
		$ ("#contentHour").empty ();
		getConfig (time);
	});
	
	function setDisableChooseTime (time, listHourDefault, config) {
		$.ajax ({
			type    : 'GET',
			url     : 'get-count-schedule-by-day',
			data    : {time : time},
			success : function (data) {
				var countSchedule = data['data'];
				var listId        = data['listId'];
				var idUpdate      = parseInt ($ ('#idUpdate').val ());
				var maxSchedule   = config['max_schedule'];
				
				var option = new Option ('Chọn giờ', "");
				$ ("#contentHour").append (option);
				for (let item in listHourDefault) {
					var arrayIdOfShift = listId[item];
					if (countSchedule[item] >= maxSchedule) {
						if (idUpdate && arrayIdOfShift.indexOf (idUpdate) !== -1) {
							var option = new Option (listHourDefault[item], item);
						} else {
							var option      = new Option (listHourDefault[item] + ' - Hết chỗ', item);
							option.disabled = true;
						}
					} else {
						var option = new Option (listHourDefault[item], item);
					}
					$ ("#contentHour").append (option);
				}
				$ ('select').niceSelect ();
				$ ('select').niceSelect ('update');
			}
		});
	}
	
	function getConfig (time) {
		$.ajax ({
			type    : 'GET',
			url     : 'get-config',
			success : function (config) {
				setDisableChooseTime (time, listHourDefault, config);
			}
		});
	}
	
	// booking an appointment
	$ ("#btn-booking").click (function () {
		var name    = $ ('#name').val ();
		var phone   = $ ('#phone').val ();
		var day     = $ (".dayOfSchedule option:selected").val ();
		var hour    = $ ("#contentHour option:selected").val ();
		var service = $ ("#service option:selected").val ();
		
		$ ('.message-booking').removeClass ('hidden');
		
		if (!name || !phone || !day || !hour | !service) {
			$ ('.message-booking').text ('Vui lòng nhập đầy đủ thông tin');
			$ ('.message-booking').addClass ('text-danger');
		} else if (!validatePhone (phone)) {
			$ ('.message-booking').text ('Định dạng số điện thoại không chính xác!');
			$ ('.message-booking').addClass ('text-danger');
		} else {
			callApiBooking (name, phone, day, hour, service)
		}
	});
	
	function validatePhone (phone) {
		var regex = /(09|03|08|07|05)+([0-9]{8})\b/;
		return regex.test (phone);
	}
	
	function callApiBooking (name, phone, day, hour, service) {
		$ ('.message-booking').removeClass ('text-success');
		$ ('.message-booking').removeClass ('text-danger');
		$ ('.spin').removeClass ('hidden');
		$ ('.message-booking').addClass ('hidden');
		$.ajax ({
			headers : {
				'X-CSRF-TOKEN' : $ ('meta[name="csrf-token"]').attr ('content')
			},
			type    : 'POST',
			url     : 'booking-appointment',
			data    : {name : name, phone : phone, day : day, hour : hour, service : service},
			success : function (res) {
				$ ('.spin').addClass ('hidden');
				$ ('.message-booking').removeClass ('hidden');
				$ ('.message-booking').text (res);
				$ ('.message-booking').addClass ('text-success');
				$ ("#booking-form").trigger ("reset");
				$ ('select').niceSelect ('update');
			},
			error   : function () {
				$ ('.spin').addClass ('hidden');
				$ ('.message-booking').removeClass ('hidden');
				$ ('.message-booking').addClass ('text-danger');
				$ ('.message-booking').text ('One or more fields have an error. Please check and try again.');
			}
		});
	}
	
	//rating for trend
	$ (".star-rating").click (function () {
		var radioValue = $ ("input[name='rating']:checked").val ();
		if (radioValue) {
			var id = $ ('#id-trend').val ();
			$ ('.spin').removeClass ('hidden');  // loading
			$.ajax ({
				headers : {
					'X-CSRF-TOKEN' : $ ('meta[name="csrf-token"]').attr ('content')
				},
				type    : 'POST',
				url     : 'rating-trend',
				data    : {id : id, value : radioValue},
				success : function (res) {
					$ ('.star-rating').addClass ('none'); //disable rating
					$ ('.loading-vote').removeClass ('hidden'); // vote saved
					$ ('.spin').addClass ('hidden');  // remove loading
					// calculator
					var rating  = res.rating;
					var average = ( rating / res.rating_quantity );
					average     = Math.round (average * 100) / 100;
					$ ('#total-rating').text (res.rating_quantity);
					$ ('#avg-rating').text (average);
				},
				error   : function () {
					$ ('.spin').addClass ('hidden');  // remove loading
				}
			});
		}
		
	});
	
	$(".submit").click(function(){
		return false;
	});
	
	$('.close').click(function () {
		$('#modal-progress').addClass('hidden');
	});
	
	//message
	$('.close-toast').click(function() {
		$('.toast').addClass('hidden');
	});
	
	//checkbooking
	$('#btn-check-booking').click(function () {
		var phone = $('#check-phone').val();
		$('#result-checking').text('');
		$('#loading-check-booking').removeClass('hidden');
		$.ajax ({
			url     : 'check-booking-by-phone',
			data    : {phone : phone},
			success : function (res) {
				var text = '';
				if (res.status===404) {
					 text = '<p>Anh ơi, chúng em chưa thấy lịch đặt của mình. Anh <a style="font-weight:bold;color: #4A3600;cursor: pointer" href="/booking">Đặt lịch tại đây</a> để chúng em phục vụ anh chu đáo nhất nhé.</p>';
				}else if (res.status===201) {
					 text = '<p>Anh <b style="color: #4A3600">'+res.data.nameCustomer+ '</b> ơi, chúng em chưa thấy lịch đặt của mình. Anh <a style="font-weight:bold;color: #4A3600;cursor: pointer" href="/booking">Đặt lịch tại đây</a> để chúng em phục vụ anh chu đáo nhất nhé.</p>';
				}else if (res.status===403) {
					text = '<p>Số điện thoại của anh chưa được xác thực !</p>';
				} else {
					text = '<p>Chúng em đã gửi thông tin về lịch đặt vào số điện thoại:<b style="font-weight: bold;color: #0b0b0b">'+ res.data.phone+ '</b> Anh kiểm tra nhé ạ!';
				}
				$('#result-checking').append(text);
				$('#loading-check-booking').addClass('hidden');
			},
			error   : function (err) {
				$('#loading-check-booking').addClass('hidden');
				$('#result-checking').text('Anh vui lòng kiểm tra lại số điện thoại giúp em nhé !');
			}
		});
	});
	
	//reset form when closed checking form
	$('#bk-close').click(function () {
		$('#check-phone').val('');
		$('#result-checking').text('');
	});
	
	
});
