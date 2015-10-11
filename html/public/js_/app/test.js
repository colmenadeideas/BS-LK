$(document).ready(function() {

	/*$('a.panel').click(function() {

		$('a.panel').removeClass('selected');
		$(this).addClass('selected');

		current = $(this);

		$('#wrapper').scrollTo($(this).attr('href'), 800);

		return false;
	});


	$(".rotate").textrotator({
			animation : "fade",
			separator : ",",
			speed : 800
	});*/

	init();
	
}); 

function init() {
    var context = {
        name: { first: "John", last: "Doe", middle: null },
        age: 21,
        birthday: "Thu Aug 01 1991 00:00:00 GMT-0400 (EDT)",
        motto: "Lorem ipsum dolor sit amet",
        post: "Check it out! http://bit.ly/9HpzwA",
        siblings: ["Jack", "Jake", "Jim"],
        friends: [
            { name: "Justin", age: 12, gender: "M" },
            { name: "Jenny", age: 15, gender: "F" },
            { name: "Julie", age: 8, gender: "F" },
            { name: "Jackie", age: 32, gender: "F" },
            { name: "Joey", age: 14, gender: "M" }
        ]
    };

  

    Mark.includes.greeting = "Welcome, <b>{{name.first}}!</b>";

    Mark.includes.status = function () {
        return "You are here: " + location.href;
    };

    var elems = document.getElementsByClassName("template"),
        template,
        tbody,
        row,
        t1,
        t2;

    for (var i = 0; i < elems.length; i++) {
        template = elems[i].firstChild.textContent.trim();
        tbody = document.getElementById("results-" + elems[i].dataset.idx);

        row = document.createElement("tr");

        t1 = document.createElement("td");
        t1.className = "input";
        t1.appendChild(document.createTextNode(template));

        t2 = document.createElement("td");
        t2.className = "output";
        t2.innerHTML = Mark.up(template, context);

        row.appendChild(t1);
        row.appendChild(t2);

        tbody.appendChild(row);
    }
}