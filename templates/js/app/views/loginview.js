var LoginView = Backbone.View.extend( {

    initialize: function(){
        $('html, body').animate({ scrollTop: 0 }, 'fast'); // Can't decide whether I like the animation or not
        this.firstload = Backbone.history.firstLoad;
        this.render();
    },

    render: function(){

        var firstload = this.firstload;

        // Create vars so we can pass them into callback function
        var partials = [];

        // Load partials and append filename to defined root url
        if( firstload ){
            var header = new Partial( "header" );
            partials.push( header );
        }

        var login = new Partial( "login" );
        partials.push( login );

        // When all partials are done fetching call callback function
        var complete = _.invoke( partials, "fetch" );
        $.when.apply($, complete).done( function(){

            if( firstload ){
                var template = _.template( header.get("template") );
                $("body").append( template );
            }
            else{
                $( "main" ).empty();
            }

            template = _.template( login.get("template") );
            $("main").append( template );

            $( ".login-button" ).click( function(event){
                event.preventDefault();
                $.post( "/login", {username: $("#username").val(), password: $("#password").val()}, function(data){
                    console.log( data.error );
                    if( data.error === false ){
                        window.location.hash = '/home';
                    }
                    else{
                        console.log( data.message );
                    }
                }, "json" );
            } );


        } );

    }

} );