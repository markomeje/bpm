(function ($) {
	var propertyChartWrapper = $('div.property-chart-wrapper');
	if (propertyChartWrapper.length) {
		var propertyChart = $('#property-chart');
		var spinner = $('.property-chart-spinner');
		var url = $("#properties-chart-year option:selected").attr('data-url');

		(window.outerWidth <= 372) ? Chart.defaults.font.size = 4 : Chart.defaults.font.size = 14;
	    var options = {
	    	responsive: true,
	        scales: {
	            y: {
	                beginAtZero: true,
	            },
	        },
	    };

	    spinner.addClass('d-none');

	    $.ajax({
	        method: 'post',
	        url: url,
	        dataType: 'json',
	        success: function(response) {
	            if (response.status === 1) {
	            	console.log(response);

				    var data = {
				        labels: $.map(response.months, function(month, index) {
						  	return (month.slice(0, 3));
						}),
				        datasets: [
					        {
					        	type: 'bar',
					        	fillColor: 'rgba(0, 60, 45, 1)',
	    						strokeColor: 'black',
					            label: 'Monthly Property Listings',
					            data: response.data,
					            backgroundColor: [
					                'rgba(255, 99, 132, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(255, 206, 86, 0.2)',
					                'rgba(75, 192, 192, 0.2)',
					                'rgba(153, 102, 255, 0.2)',
					                'rgba(255, 159, 64, 0.2)',
					                'rgba(255, 99, 132, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(255, 206, 86, 0.2)',
					                'rgba(75, 192, 192, 0.2)',
					                'rgba(153, 102, 255, 0.2)',
					                'rgba(255, 159, 64, 0.2)',
					            ],
					            borderColor: [
						            'rgba(255, 99, 132, 1)',
					                'rgba(54, 162, 235, 1)',
					                'rgba(255, 206, 86, 1)',
					                'rgba(75, 192, 192, 1)',
					                'rgba(153, 102, 255, 1)',
					                'rgba(255, 159, 64, 1)',
					                'rgba(255, 99, 132, 1)',
					                'rgba(54, 162, 235, 1)',
					                'rgba(255, 206, 86, 1)',
					                'rgba(75, 192, 192, 1)',
					                'rgba(153, 102, 255, 1)',
					                'rgba(255, 159, 64, 1)',
					            ],
					            borderWidth: 1
					        },
				        ]
					};

					var myChart = new Chart(propertyChart, {
						data: data,
						options: options
					});
					myChart.update();
	            }
	        },
	        error: function(error) {
	        	console.log(error);
	        	spinner.text('An Error Occurred');
	        },
	    });    

		$('#properties-chart-year').change(function() {
			spinner.removeClass('d-none');
			var url = $(this).find(':selected').attr('data-url');
			$.ajax({
		        method: 'post',
		        url: url,
		        dataType: 'json',
		        success: function(response) {
		            if (response.status === 1) {
		            	console.log(response);
		            	spinner.addClass('d-none');

					    var data = {
					        labels: $.map(response.months, function(month, index) {
							  	return (month.slice(0, 3));
							}),
					        datasets: [
						        {
						        	type: 'bar',
						        	fillColor: 'rgba(0, 60, 100, 1)',
	    							strokeColor: 'black',
						            label: 'Monthly Property Listings',
						            data: response.data,
						            backgroundColor: [
						                'rgba(255, 99, 132, 0.2)',
						                'rgba(54, 162, 235, 0.2)',
						                'rgba(255, 206, 86, 0.2)',
						                'rgba(75, 192, 192, 0.2)',
						                'rgba(153, 102, 255, 0.2)',
						                'rgba(255, 159, 64, 0.2)',
						                'rgba(255, 99, 132, 0.2)',
						                'rgba(54, 162, 235, 0.2)',
						                'rgba(255, 206, 86, 0.2)',
						                'rgba(75, 192, 192, 0.2)',
						                'rgba(153, 102, 255, 0.2)',
						                'rgba(255, 159, 64, 0.2)'
						            ],
						            borderColor: [
							            'rgba(255, 99, 132, 1)',
						                'rgba(54, 162, 235, 1)',
						                'rgba(255, 206, 86, 1)',
						                'rgba(75, 192, 192, 1)',
						                'rgba(153, 102, 255, 1)',
						                'rgba(255, 159, 64, 1)',
						                'rgba(255, 99, 132, 1)',
						                'rgba(54, 162, 235, 1)',
						                'rgba(255, 206, 86, 1)',
						                'rgba(75, 192, 192, 1)',
						                'rgba(153, 102, 255, 1)',
						                'rgba(255, 159, 64, 1)',
						            ],
						            borderWidth: 1
						        },
					        ]
						};

						$("canvas#property-chart").remove();
						propertyChartWrapper.append('<canvas id="property-chart" class="animated fadeIn h-100 w-100 text-white"></canvas>');

						var ctx = document.getElementById('property-chart').getContext('2d');
						var myChart = new Chart(ctx, {
							data: data,
							options: options
						});
						myChart.update();
		            }
		        },

		        error: function(error) {
		        	console.log(error);
		        	spinner.text('An Error Occurred');
		        },
		    }); 
		})
	}

})(jQuery);

	
	

	