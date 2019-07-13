/*! DO NOT EDIT ajaxnoir 2018-06-26 */
function Login(sel) {
    var form = $(sel);
    form.submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "post/login.php",
            data: form.serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Login was successful
                    window.location.assign("./");
                } else {
                    // Login failed, a message is in json.message
                    $(sel + " .message").html("<p>" + json.message + "</p>");
                }
            },
            error: function(xhr, status, error) {
                // An error!
                $(sel + " .message").html("<p>Error: " + error + "</p>");
            }
        });
        console.log("Submitted");
    });

}
function MovieInfo(sel, title, year) {
    var that = this;
    this.clickTab = '';
    console.log("MovieInfo: " + title + "/" + year);
    var api_key = "8db9c7506683bcd0c1d49ec5bd8dd8f1";
    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key: api_key, query: title, year:year},
        dataType: "text",
        method: "GET",
        success: function(data) {
            var json = parse_json(data);
            // debugger;
            if(json.total_results > 0) {
                that.present(json.results[0]);
                var links = $("li > a");
                var len = links.length;
                links = Object.values(links).slice(0,len);
                links.forEach(function(element){
                    $(element).css("opacity","0.3");
                });
                $(links[0]).css("opacity","1.0");
                $($(links[0]).parent().children("div")).addClass("show").fadeIn(1000);
                links.forEach(function(element){
                    that.installListener(element, links);
                });
                // that.clickTab = $(links[0]);
                // that.installListener();

            } else {
                that.message("<p>No information available</p>");
            }
        },
        error: function(xhr, status, error) {
            // Error
            console.log("Error");
            that.message("<p>Unable to communicate<br>with themoviedb.org</p>");
        }
    });
}
MovieInfo.prototype.message = function(message) {
    $("div.paper").html(message);
};
MovieInfo.prototype.present = function(json){
    // debugger;
    var first = "<p> Title: "+json.original_title+"</p><p>Release Date: "+json.release_date+"</p>" +
        "<p>Vote Average: "+json.vote_average+"</p><p>Vote Count: "+ json.vote_count+"</p>";
    var html = "<ul>\n" +
        " <li><a href=\"\"><img src=\"images/info.png\"></a>\n" +
        "<div class=\"show\">\n" +
        first +
        "</div></li><li><a href=\"\"><img src=\"images/plot.png\"></a>\n" +
        "<div>\n" +
        "<p>"+json.overview+"</p>\n" +
        "</div>";
    if(json.poster_path){
        var posterurl = "http://image.tmdb.org/t/p/w500" + json.poster_path;
        html+= "</li><li><a href=\"\"><img src=\"images/poster.png\"></a>\n" +
            "<div>\n" +
            "<p><img src="+posterurl+">\n" +
            "</p></p>\n" +
            "</div></li>\n" +
            "</ul>";
    }

    $("div.paper").html(html);
};
MovieInfo.prototype.installListener = function(link, links){
    // var links = $("li>a");
    var that = this;
    var sel = $("li>a");
    $(link).click(function(event){
        event.preventDefault();
        // $($(that.clickTab).parent().children("div")).removeClass("show");
        $("div.show").fadeOut(1000, function() {
            // Animation complete.
            $(this).removeClass("show");
        });
        $($(this).parent().children("div")).fadeIn(1000, function() {
            // Animation complete.
            $(this).addClass("show");
        });

        links.forEach(function(element){
            $(element).css("opacity","0.3");
        });
        $(this).css("opacity", "1.0");
    });
    // console.log(links);
};
function parse_json(json) {
    try {
        var data = $.parseJSON(json);
    } catch(err) {
        throw "JSON parse error: " + json;
    }

    return data;
}
function Stars(sel) {
    var table = $(sel + " table");  // The table tag
    // Loop over the table rows
    var rows = table.find("tr");    // All of the table rows
    for(var r=1; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));
        // Determine the row ID
        var id = row.find('input[name="id"]').val();
        // Find and loop over the stars, installing a listener for each
        var stars = row.find("img");
        for(var s=0; s<stars.length; s++) {
            var star = $(stars.get(s));
            // We are at a star
            this.installListener(row, star, id, s+1);
        }

    }
    console.log("Stars constructor");
}
Stars.prototype.installListener = function(row, star, id, rating) {
    var that = this;

    star.click(function() {

        $.ajax({
            url: "post/stars.php",
            data: {id: id, rating: rating},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Successfully updated
                    $("form div.table").html(json.table);
                    $("head").html(json.head);
                    // that.update(row,rating);
                    that.message("<p>Successfully updated</p>");
                } else {
                    // Update failed
                    that.message("<p>Update failed</p>");

                }
            },
            error: function(xhr, status, error) {
                // Error
                that.message("<p>Error: " + error + "</p>");
            }
        });

    });
};
Stars.prototype.update = function(row, rating) {
    // Loop over the stars, setting the correct image
    var stars = row.find("img");
    for(var s=0; s<stars.length; s++) {
        var star = $(stars.get(s));
        if(s < rating) {
            star.attr("src", "images/star-green.png")
        } else {
            star.attr("src", "images/star-gray.png");
        }

    }
    var num = row.find("span.num");
    num.text("" + rating + "/10");

};
Stars.prototype.message = function(message) {
    $("div.message").html(message).show().fadeOut(1000);
};