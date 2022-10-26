// "use strict";
// //Notify
// $.notify({
// 	icon: 'flaticon-alarm-1',
// 	title: 'Hi Shoshi Vi',
// 	message: 'Body Valo Hoyica',
// }, {
// 	type: 'info',
// 	placement: {
// 		from: "bottom",
// 		align: "right"
// 	},
// 	time: 1000,
// });

// Circles.create({
// 	id: 'circles-3',
// 	radius: 45,
// 	value: 40,
// 	maxValue: 100,
// 	width: 7,
// 	text: 12,
// 	colors: ['#f1f1f1', '#F25961'],
// 	duration: 400,
// 	wrpClass: 'circles-wrp',
// 	textClass: 'circles-text',
// 	styleWrapper: true,
// 	styleText: true
// })

// var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

// var mytotalIncomeChart = new Chart(totalIncomeChart, {
// 	type: 'bar',
// 	data: {
// 		labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
// 		datasets: [{
// 			label: "Total Income",
// 			backgroundColor: '#ff9e27',
// 			borderColor: 'rgb(23, 125, 255)',
// 			data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
// 		}],
// 	},
// 	options: {
// 		responsive: true,
// 		maintainAspectRatio: false,
// 		legend: {
// 			display: false,
// 		},
// 		scales: {
// 			yAxes: [{
// 				ticks: {
// 					display: false //this will remove only the label
// 				},
// 				gridLines: {
// 					drawBorder: false,
// 					display: false
// 				}
// 			}],
// 			xAxes: [{
// 				gridLines: {
// 					drawBorder: false,
// 					display: false
// 				}
// 			}]
// 		},
// 	}
// });