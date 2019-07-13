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