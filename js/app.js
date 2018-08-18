$(document).ready(function(){
	$.ajax({
		url: "http://169.254.211.182/dt/graphdata.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var time = [];
			var temp = [];

			for(var i in data) {
				time.push( data[i].dateandtime);
				temp.push(data[i].temperature);
			}

			var chartdata = {
				labels: time,
				datasets : [
					{
						label: '',
						backgroundColor: 'rgba(105,105,105, 0.50)',
						borderColor: 'rgba(105, 105, 105, 0.75)',
						hoverBackgroundColor: 'rgba(105, 105, 105, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: temp
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
