//Width and height
var w = 600;
var h = 150;
var xPadding = 40;
var yPadding = 30;
var barPadding = 1;

var dataset = [	{"date":1,"freq":05},
				{"date":2,"freq":10},
				{"date":3,"freq":13},
				{"date":4,"freq":19},
				{"date":5,"freq":21},
				{"date":6,"freq":25},
				{"date":7,"freq":22},
				{"date":8,"freq":18},	
				{"date":9,"freq":15},
				{"date":10,"freq":13},
				{"date":11,"freq":11},
				{"date":12,"freq":12},
				{"date":13,"freq":15},
				{"date":14,"freq":20},
				{"date":15,"freq":18},
				{"date":16,"freq":17},
				{"date":17,"freq":17},
				{"date":18,"freq":16},
				{"date":19,"freq":16},
				{"date":20,"freq":18},
				{"date":21,"freq":18},
				{"date":22,"freq":18},
				{"date":23,"freq":18},
				{"date":24,"freq":18},
				{"date":25,"freq":18},
				{"date":26,"freq":33},
				{"date":27,"freq":33},
				{"date":28,"freq":33},
				{"date":29,"freq":33},
				{"date":30,"freq":33},
				{"date":31,"freq":25},];

var bars = dataset.length;
var maxdate = d3.max(dataset, function(d){ return d.date;});

//Linear Time Scale
var xScale = d3.scale.linear()
					.domain([1,maxdate])
					.range([ xPadding, w+xPadding ])
					.clamp(true);

var yScale = d3.scale.linear()
					.domain([0,d3.max(dataset, function(d) { return d.freq;})])
					.range([ h+yPadding, yPadding])
					.clamp(true);

var line = d3.svg.line()
				.x(function(d) { return xScale(d.date); })
				.y(function(d) { return yScale(d.close); });

//Create SVG element
var svg = d3.select("div.chart")
			.append("svg")
			.attr("width", w+2*xPadding )
			.attr("height", h+2*yPadding );

svg.selectAll("rect")
   .data(dataset)
   .enter()
   .append("rect")
   .attr("x", function(d) {
   		return xScale(d.date) - (w/31)/2;
   })
   .attr("y", function(d) {
   		return yScale(d.freq);
   })
   .attr("width", w/31 - barPadding)
   .attr("height", function(d) {
   		return (h + yPadding) - yScale(d.freq);
   })
   .attr("fill", function(d) {
		return "rgba(231, 76, 60, 1.0)";
   });

svg.selectAll("text")
   .data(dataset)
   .enter()
   .append("text")
   .text(function(d) {
   		return d.freq;
   })
   .attr("text-anchor", "middle")
   .attr("x", function(d, i) {
   		return xScale(d.date) - 1;
   })
   .attr("y", function(d) {
   		return yScale(d.freq) + yPadding/2 - 3;
   })
   .attr("font-family", "sans-serif")
   .attr("font-size", "10px")
   .attr("fill", "white");

   svg.append("path")
		      .datum(dataset)
		      .attr("class", "line")
		      .attr("d", line);

	var xAxis = d3.svg.axis()
					.scale(xScale)
					.orient("bottom")
					.ticks(maxdate);

	var yAxis = d3.svg.axis()
					.scale(yScale)
					.orient("left")
					.ticks(5);

	svg.append("g")
		.attr("class","x axis")
		.attr("transform","translate(0,"+(h+yPadding+1)+")")
		.call(xAxis)
	.append("text")
		.attr("transform","translate("+(w+1.5*xPadding)+",0)")
		.style("text-anchor","start")
		.text("Date");

	svg.append("g")
		.attr("class","y axis")
		.attr("transform","translate("+(xPadding - yPadding/2 + 3)+",0)")
		.call(yAxis)
	.append("text")
		.attr("transform","rotate(-90)")
		.style("text-anchor","end")
		.text("Freq");