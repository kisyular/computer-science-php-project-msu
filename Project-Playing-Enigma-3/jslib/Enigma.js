function Enigma(sel){
    var that = this;
    this.form = $(sel);
    var keys = this.form.find("div.key button");
    // debugger;
    for(var i=0; i < 26; i++){
        that.installListener($(keys[i]));
    }
    this.resetListener();
    this.form.submit(function(event) {
        event.preventDefault();
        var buttonVal = $("form button[clicked=true]").val();
        $.ajax({
            url: "post/enigma.php",
            data: {key: buttonVal},
            method: "POST",
            success: function(data) {
                // debugger;
                if(parse_json(data)){
                    var json = parse_json(data);
                    $(sel + " div.rotors").html(json.rotors);
                    $("div.light.light-"+ json.light.toLowerCase()).addClass("light-on");
                } else {
                    $(sel + " .message").html("<p>Error</p>");
                }
            },
            error: function(xhr, status, error) {
                // An error!
                $(sel + " .message").html("<p>Error: " + error + "</p>");
            }
        });
    });
}
Enigma.prototype.installListener = function(button){
    button.mousedown(function(event){
        event.preventDefault();
        $("form button", $(this).parents("form")).removeAttr("clicked");
        $("form button[clicked=true]").removeAttr("clicked");
        $("div.light.light-on").removeClass("light-on");
        $(this).attr("clicked", "true");
        $($(this).parent()).addClass("pressed");
    });
    button.mouseup(function(event){
        event.preventDefault();
        $($(this).parent()).removeClass("pressed");
    });
};
Enigma.prototype.resetListener = function(){
    var that = this;
    var reset = $(" form div.dialog button");
    reset.click(function(event){
        event.preventDefault();
        $("form button", $(this).parents("form")).removeAttr("clicked");
        $("form button[clicked=true]").removeAttr("clicked");
        $("div.light.light-on").removeClass("light-on");
        $(this).attr("clicked", "true");
        that.form.submit();
    });
};